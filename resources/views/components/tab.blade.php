@props([
    'tabs' => [],
    'tab'   => null,
    'align' => 'right'
])
<div class="">
    {{-- FOR LARGE SCREEN --}}
    <ul class="nav nav-pills  mb-6 d-none d-lg-flex  {{ $align == 'right' ? 'justify-content-end' : '' }}" role="tablist">
        @foreach ($tabs as $key => $value)
            <li class="nav-item mb-2">
                <a class="nav-link {{ $tab == $value['code'] ? ' active ' : ' bg-secondary text-black ' }}" data-toggle="tab" href="{{ $value['route'] }}">{{ $value['label'] }}</a>
            </li>
        @endforeach
        
    </ul>

    {{-- FOR MOBILE --}}
    <ul class="nav nav-pills justify-content-center mb-6 d-inline-flex d-lg-none" role="tablist">
        @foreach ($tabs as $key => $value)
            <li class="nav-item mb-2">
                <a class="nav-link {{ $tab == $value['code'] ? ' active ' : ' bg-secondary text-black ' }}" data-toggle="tab" href="{{ $value['route'] }}">{{ $value['label'] }}</a>
            </li>
        @endforeach
        
    </ul>
</div>