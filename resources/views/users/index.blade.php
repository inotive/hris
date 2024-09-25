@extends('crud.index')



@section('table_header')
    <th class="min-w-50px">{{ __('No') }}</th>
    <th class="min-w-125px">{{ __('User') }}</th>
    <th class="min-w-125px">{{ __('Email') }}</th>
    <th class="min-w-125px">{{ __('Phone') }}</th>
    <th class="min-w-125px">{{ __('Role') }}</th>
    @if (auth()->user()->company_id == null)
    <th class="min-w-125px">{{ __('Company') }}</th>
    @endif
    <th class="text-end min-w-70px">{{ __('Action') }}</th>
@stop

@section('table_body')
    @foreach ($list as $key => $value)
        <tr>
            <td>{{ ($list->currentPage() - 1) * $list->perPage() + $key + 1 }}</td>
            <td>
                <div class="d-flex align-items-center">
                    <img class="rounded" src="{{ Storage::url($value->image) }}"
                    onerror="this.onerror=null; this.src='{{ asset('assets/images/no_image.jpg') }}';" width="50" />
                    <div class="ms-5">
                        <b>{{ $value->first_name }} {{ $value->last_name }}</b>
                    </div>
                </div>
            </td>
            <td>{{ $value->email }}</td>
            <td>{{ $value->phone ?? '-' }}</td>
            <td>{{ $value->role_label() }}</td>
            @if (auth()->user()->company_id == null)
            <td>{{ $value->company->name ?? '-' }}</td>
            @endif
            
            <td class="text-end">
                <x-table.actions>
                    <!--begin::Menu item-->
                    {{-- <div class="menu-item px-3">
                        <a href="../../demo1/dist/apps/customers/view.html"
                            class="menu-link px-3">View</a>
                    </div> --}}
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <x-table.action-button label="Change Password" href="{{ route('users.change-password', $value->id) }}" />
                    <x-table.edit-button :id="$value->id"/>
                    <x-table.delete-button :id="$value->id"/>
                    
                    <!--end::Menu item-->
                </x-table.actions>
                <!--end::Menu-->
            </td>
            <!--end::Action=-->
        </tr>
    @endforeach
@endsection
