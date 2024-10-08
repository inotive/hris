@props([
    'import_url'    => null,
    'export_url'    => null,
])
<div class="">



    <!--begin::Menu toggle-->
    <a href="#" class="btn  btn-flex btn-light  fw-bolder show menu-dropdown" data-kt-menu-trigger="click"
        data-kt-menu-placement="bottom-end">
        <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
        <span class="svg-icon svg-icon-5 svg-icon-gray-500 me-1">
            <svg height="800px" width="800px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26 26" xml:space="preserve">
                <g>
                    <path style="fill:#616161;" d="M25.162,3H16v2.984h3.031v2.031H16V10h3v2h-3v2h3v2h-3v2h3v2h-3v3h9.162
  C25.623,23,26,22.609,26,22.13V3.87C26,3.391,25.623,3,25.162,3z M24,20h-4v-2h4V20z M24,16h-4v-2h4V16z M24,12h-4v-2h4V12z M24,8
  h-4V6h4V8z" />
                    <path style="fill:#616161;" d="M0,2.889v20.223L15,26V0L0,2.889z M9.488,18.08l-1.745-3.299c-0.066-0.123-0.134-0.349-0.205-0.678
  H7.511C7.478,14.258,7.4,14.494,7.277,14.81l-1.751,3.27H2.807l3.228-5.064L3.082,7.951h2.776l1.448,3.037
  c0.113,0.24,0.214,0.525,0.304,0.854h0.028c0.057-0.198,0.163-0.492,0.318-0.883l1.61-3.009h2.542l-3.037,5.022l3.122,5.107
  L9.488,18.08L9.488,18.08z" />
                </g>
            </svg>
        </span>
        <!--end::Svg Icon-->

        Bulk Data
    </a>
    <!--end::Menu toggle-->
    <!--begin::Menu 1-->
    <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_620792fa02dd8"
        style="z-index: 105; position: fixed; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(-115px, 110px, 0px);"
        data-popper-placement="bottom-end">


        <!--begin::Menu separator-->
        <div class="separator border-gray-200"></div>
        <!--end::Menu separator-->
        <!--begin::Form-->
        <div class="px-7 py-5">
            @if ($import_url != null)
                <a class="btn btn-light w-100" target="_blank" href="{{ $export_url ?? '' }}">{{ __('Import') }}</a>
            @endif
            @if ($export_url != null)
                <a class="btn btn-light w-100" target="_blank" href="{{ $export_url ?? '' }}">{{ __('Export') }}</a>
            @endif
        </div>
    </div>
    <!--end::Menu 1-->
</div>
