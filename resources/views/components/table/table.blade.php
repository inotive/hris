<div class="table-responsive">
    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
        <!--begin::Table head-->
        <thead>
            <!--begin::Table row-->
            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">

                {{ $header ?? '' }}
            </tr>
            <!--end::Table row-->
        </thead>
        <!--end::Table head-->
        <!--begin::Table body-->
        <tbody class="fw-bold text-gray-600">
            {{ $body ?? '' }}
        </tbody>
        <!--end::Table body-->
    </table>
</div>
