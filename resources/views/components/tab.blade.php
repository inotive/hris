@props([
    'tabs' => [],
    'tab'   => null
])
<div>
    <ul class="nav nav-pills mb-10" role="tablist">
        @foreach ($tabs as $key => $value)
            <li class="nav-item">
                <a class="nav-link {{ $tab == $value['code'] ? ' active ' : ' border ' }}" data-toggle="tab" href="{{ $value['route'] }}">{{ $value['label'] }}</a>
            </li>
        @endforeach
        
    </ul>
</div>