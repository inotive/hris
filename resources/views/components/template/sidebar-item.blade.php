@props([
    'menu' => null,

])
<div>
    @if (isset($menu['roles']) && in_array(auth()->user()->role, $menu['roles']))


        @if (isset($menu['children']) && isset($menu['children_tab']) == false)
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ \App\Services\SidebarService::isActive($menu) ? ' hover show ' : ''  }}">
                <span class="menu-link {{ \App\Services\SidebarService::isActive($menu) ? ' active ' : ''  }}">
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
                                <a class="menu-link {{ \App\Services\SidebarService::isActiveSubmenu($value) ? ' active ' : '' }}"
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
            @php
                $sidebar_label = $menu['label'];
                $sidebar_href = isset($menu['route']) != null && strlen($menu['route']) > 0 ? route($menu['route']) : $menu['url'] ?? '#';
                if (isset($menu['children_tab']) && $menu['children_tab'] == true) {
                    $sidebar_href = $menu['children'][0]['route'] ?? null;
                    if ($sidebar_href != null) {
                        $sidebar_href = route($sidebar_href);
                        $sidebar_label = $menu['children'][0]['label'] ?? '';
                    }

                }
            @endphp
            <div class="menu-item">
                <a class="menu-link {{ \App\Services\SidebarService::isActive($menu) ? ' active ' : '' }}"
                    href="{{ $sidebar_href }}">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            @if (isset($menu['icon']) && strlen($menu['icon']) > 0)
                                @include($menu['icon'])
                            @endif
                        </span>
                    </span>

                    <span class="menu-title">{{ __($sidebar_label) }}</span>
                </a>
            </div>

        @endif

    @endif
</div>
