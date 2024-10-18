 <!--begin::Toolbar-->
 <div class="toolbar bg-white" id="kt_toolbar">
     <!--begin::Container-->
     <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack bg-white">

         <div class="w-100">
             <!-- @php
                 $menus = config('sidebar.menus');
                 $current_menu = null;
                 foreach ($menus as $key => $value) {
                     $is_active = \App\Services\SidebarService::isActive($value);

                     if ($is_active == true) {
                         $current_menu = $value;
                     }
                 }
             @endphp

             <h1>
                 @if ($current_menu != null)
                     {{ __($current_menu['label']) }}
                 @else
                     @yield('page_title')
                 @endif
             </h1> -->

             <!-- @hasSection('page_subtitle')
                 <p class="page_subtitle">@yield('page_subtitle')</p>
            @else
             <p class="mt-11"></p>
            @endif -->



         </div>

     </div>
     <!--end::Container-->


 </div>
 <!--end::Toolbar-->
