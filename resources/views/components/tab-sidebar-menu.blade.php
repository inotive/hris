<div>
    @php
        $menus = config('sidebar.menus');
        $current_menu = null;
        foreach ($menus as $key => $value) {
            $is_active = \App\Services\SidebarService::isActive($value);

            if ($is_active == true) {
                $current_menu = $value;
            }
        }
    @endphp

    @if ($current_menu != null && isset($current_menu['children']))
        <ul class="nav nav-tab-sidebar">
            @foreach ($current_menu['children'] ?? [] as $key => $submenu)
                <li class="nav-item tab-sidebar-submenu">
                    <a class="nav-link {{ \App\Services\SidebarService::isActiveSubmenu($submenu) ? ' active ' : '' }} "
                        aria-current="page"
                        href="{{ isset($submenu['route']) != null && strlen($submenu['route']) > 0 ? route($submenu['route']) : $submenu['url'] ?? '#' }}">
                        {{ $submenu['label'] ?? '' }}
                    </a>
                </li>
            @endforeach

        </ul>
    @endif
</div>
