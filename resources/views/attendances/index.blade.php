@extends('crud.index')


@section('page_title')
    {{ __($page_title) }}
@stop

@section('toolbar_left')

@stop

@section('toolbar')
    <x-table.filter-dropdown :company="true" />
@stop

@section('table_header')
    <th class="min-w-10px">{{ __('ID') }}</th>
    @if (auth()->user()->company_id == null)
        <th class="min-w-125px">{{ __('Company') }}</th>
    @endif
    <th class="min-w-125px">{{ __('Employee') }}</th>
    <th class="min-w-125px">{{ __('Shift') }}</th>
    <th class="min-w-125px">{{ __('Date') }}</th>
    <th class="min-w-125px">{{ __('Check In') }}</th>
    <th class="min-w-125px">{{ __('Check Out') }}</th>
    <th class="text-end min-w-70px">{{ __('Action') }}</th>
@stop

@section('table_body')
    @foreach ($list as $key => $value)
        <tr>

            <td>{{ ($list->currentPage() - 1) * $list->perPage() + $key + 1 }}</td>
            @if (auth()->user()->company_id == null)
                <td>{{ $value->employee->company->name ?? '-' }}</td>
            @endif

            <td>{{ $value->employee->full_name ?? '-' }}</td>
            <td>{{ $value->employee_shift->name ?? '-' }}</td>
            <td>{{ \Carbon\Carbon::parse($value->date)->format('d M Y') }}</td>
            <td>{{ $value->clockin_time ?? '-' }}</td>
            <td>{{ $value->clockout_time ?? '-' }}</td>
            <td class="text-end">
                <x-table.actions>
                    <x-table.edit-button :id="$value->id" />
                    <x-table.delete-button :id="$value->id" />
                </x-table.actions>
            </td>

        </tr>
    @endforeach
@endsection
