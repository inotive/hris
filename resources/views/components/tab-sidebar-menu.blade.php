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

    <!-- New -->
    @if ($current_menu != null && isset($current_menu['children']))
        <div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch d-none d-lg-flex"
            id="#kt_header_menu">

            @foreach ($current_menu['children'] ?? [] as $key => $submenu)
                <div class="menu-item menu-lg-down-accordion me-lg-1">
                    <a class="menu-link py-3 {{ \App\Services\SidebarService::isActiveSubmenu($submenu) ? ' active ' : '' }}"
                        href="{{ isset($submenu['route']) != null && strlen($submenu['route']) > 0 ? route($submenu['route']) : $submenu['url'] ?? '#' }}">
                        <span class="menu-title">{{ $submenu['label'] ?? '' }}</span>
                    </a>
                </div>
            @endforeach
        </div>


    @endif
</div>
