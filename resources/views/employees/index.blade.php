@extends('crud.index')


@section('page_title')
    {{ __($page_title) }}
@stop

@section('toolbar_left')
    <x-company-filter />
@stop

@section('table_header')

    <th class="min-w-50px">{{ __('No') }}</th>
    <th class="min-w-125px">{{ __('Image') }}</th>
    <th class="min-w-125px">{{ __('Full Name') }}</th>
    @if (auth()->user()->company_id == null)
    <th class="min-w-125px">{{ __('Company') }}</th>
    @endif
    <th class="min-w-125px">{{ __('Department') }}</th>
    <th class="min-w-125px">{{ __('Position') }}</th>
    <th class="min-w-125px">{{ __('Phone') }}</th>
    <th class="min-w-125px">{{ __('Email') }}</th>
    <th class="text-end min-w-70px">{{ __('Action') }}</th>
@stop

@section('table_body')
    @foreach ($list as $key => $value)
        <tr>

            <td>{{ ($list->currentPage() - 1) * $list->perPage() + $key + 1 }}</td>
            <td>
                <img class="rounded" src="{{ Storage::url($value->image) }}"
                onerror="this.onerror=null; this.src='{{ asset('assets/images/no_image.jpg') }}';" width="50" />
            </td>
            <td>{{ $value->full_name ?? '' }}</td>
            <td>{{ $value->company->name ?? '' }}</td>
            <td>{{ $value->department->name ?? '' }}</td>
            <td>{{ $value->position->name ?? '' }}</td>
            <td>{{ $value->phone ?? '' }}</td>
            <td>{{ $value->email ?? '' }}</td>
           
            <td class="text-end">
                <x-table.actions>
                    <x-table.employee-resend-password :employee="$value" />
                    <x-table.edit-button :id="$value->id" />
                    <x-table.delete-button :id="$value->id" />
                </x-table.actions>
            </td>

        </tr>
    @endforeach
@endsection
