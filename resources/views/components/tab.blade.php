@props([ 'tabs' => [], 'tab' => null, 'align' => 'right' ])
<div class="">
  {{-- FOR LARGE SCREEN --}}
  <div class="w-full d-none d-lg-inline">
    <div class="card" style="background: none">
      <div class="card-body p-0">
        <ul
          class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-7 fw-bolder">
          @foreach ($tabs as $key => $value)
          <li class="nav-item mt-2">
            <a
              class="nav-link text-active-primary ms-0 me-6 fw-bolder py-4 {{
                $tab == $value['code'] ? ' active' : ''
              }}"
              href="{{ $value['route'] }}"
              >{{ $value["label"] }}</a
            >
          </li>
          @endforeach
        </ul>
      </div>
    </div>
    <!-- <ul class="nav nav-pills  mb-6 d-none d-lg-flex  {{ $align == 'right' ? 'justify-content-end' : '' }}" role="tablist">
            @foreach ($tabs as $key => $value)
                <li class="nav-item mb-2">
                    <a class="nav-link {{ $tab == $value['code'] ? ' active ' : ' bg-secondary text-black ' }}" data-toggle="tab" href="{{ $value['route'] }}">{{ $value['label'] }}</a>
                </li>
            @endforeach
            
        </ul> -->
  </div>

  {{-- FOR MOBILE --}}
  <ul
    class="nav nav-pills justify-content-center mb-2 d-inline-flex d-lg-none mt-4"
    role="tablist">
    @foreach ($tabs as $key => $value)
    <li class="nav-item mb-2">
      <a
        class="nav-link {{
          $tab == $value['code'] ? ' active ' : ' bg-secondary text-black '
        }}"
        data-toggle="tab"
        href="{{ $value['route'] }}"
        >{{ $value["label"] }}</a
      >
    </li>
    @endforeach
  </ul>
</div>
