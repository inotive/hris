@extends('crud.index')


@section('page_title')
    {{ __($page_title) }}
@stop

@section('table_header')
    <th class="min-w-10px">{{ __('ID') }}</th>
    <th class="min-w-125px">{{ __('Company') }}</th>
    <th class="min-w-125px">{{ __('Phone') }}</th>
    <th class="min-w-125px">{{ __('Email') }}</th>
    <th class="min-w-125px">{{ __('City') }}</th>
    <th class="min-w-125px">{{ __('Status') }}</th>
    <th class="text-end min-w-70px">{{ __('Action') }}</th>
@stop

@section('table_body')
    @foreach ($list as $key => $value)
        <tr>
            <td>{{ ($list->currentPage() - 1) * $list->perPage() + $key + 1 }}</td>
            <td>
                <div class="d-flex align-items-center">
                    <img class="rounded" src="{{ Storage::url($value->logo) }}"
                        onerror="this.onerror=null; this.src='{{ asset('assets/images/no_image.jpg') }}';"
                        width="50" />
                    <div class="ms-5">
                        <b>{{ $value->name }}</b>
                    </div>
                </div>
            </td>
            <td><a href="tel:{{ $value->phone ?? '' }}" target="_blank">{{ $value->phone ?? '' }}</a></td>
            <td><a href="mailto:{{ $value->email ?? '' }}" target="_blank">{{ $value->email ?? '' }}</a></td>
            <td>{{ $value->cut_off_payroll_date ?? '' }}</td>
            <td>{{ $value->status ? __('YES') : __('ID') }}</td>
            <td class="text-end">
                <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click"
                    data-kt-menu-placement="bottom-end">{{ __('Actions') }}
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                    <span class="svg-icon svg-icon-5 m-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <path
                                d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon--></a>
                <!--begin::Menu-->
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4"
                    data-kt-menu="true">
                    <!--begin::Menu item-->
                    {{-- <div class="menu-item px-3">
                        <a href="../../demo1/dist/apps/customers/view.html"
                            class="menu-link px-3">View</a>
                    </div> --}}
                    <!--end::Menu item-->
                    <!--begin::Menu item-->

                    <x-table.edit-button :id="$value->id" />
                    <x-table.delete-button :id="$value->id" />

                    <!--end::Menu item-->
                </div>
                <!--end::Menu-->
            </td>
            <!--end::Action=-->
        </tr>
    @endforeach
@endsection