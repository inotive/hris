@props([
    'menu' => null,
])
<div>
    @if (isset($menu['roles']) && in_array(auth()->user()->role, $menu['roles']))


        @if (isset($menu['children']))
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            @if (isset($menu['icon']) && strlen($menu['icon']) > 0)
                                @include($menu['icon'])
                            @endif
                        </span>
                    </span>
                    <span class="menu-title">{{ __($menu['label']) }}</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">

                    @foreach ($menu['children'] as $key => $value)
                        @if (isset($value['roles']) && in_array(auth()->user()->role, $value['roles']))
                            <div class="menu-item">
                                <a class="menu-link "
                                    href="{{ isset($value['route']) != null && strlen($value['route']) > 0 ? route($value['route']) : $value['url'] ?? '#' }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __($value['label']) }}</span>
                                </a>
                            </div>
                        @endif
                    @endforeach


                </div>
            </div>
        @else
            <div class="menu-item">
                <a class="menu-link"
                    href="{{ isset($menu['route']) != null && strlen($menu['route']) > 0 ? route($menu['route']) : $menu['url'] ?? '#' }}">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            @if (isset($menu['icon']) && strlen($menu['icon']) > 0)
                                @include($menu['icon'])
                            @endif
                        </span>
                    </span>

                    <span class="menu-title">{{ __($menu['label']) }}</span>
                </a>
            </div>

        @endif

    @endif
</div>
