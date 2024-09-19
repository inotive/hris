@props([
    'tabs' => [],
    'tab'   => null,
    'align' => 'right'
])
<div class="">
    <ul class="nav nav-pills {{ $align == 'right' ? 'justify-content-end' : '' }} mb-6" role="tablist">
        @foreach ($tabs as $key => $value)
            <li class="nav-item">
                <a class="nav-link {{ $tab == $value['code'] ? ' active ' : ' bg-secondary text-black ' }}" data-toggle="tab" href="{{ $value['route'] }}">{{ $value['label'] }}</a>
            </li>
        @endforeach
        
    </ul>
</div>