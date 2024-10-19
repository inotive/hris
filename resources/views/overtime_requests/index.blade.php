@extends('crud.index')


@section('page_title')
    {{ __($page_title) }}
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
    <th class="min-w-125px">{{ __('Shift Type') }}</th>
    <th class="min-w-125px">{{ __('Start Shift') }}</th>
    <th class="min-w-125px">{{ __('End Shift') }}</th>
    <th class="min-w-125px">{{ __('Hours') }}</th>
    <th class="min-w-125px">{{ __('Approver') }}</th>
    <th class="min-w-125px">{{ __('Status') }}</th>

    <th class="text-end min-w-70px">{{ __('Action') }}</th>
@stop

@section('table_body')
    @foreach ($list as $key => $value)
        <tr>

            <td>{{ ($list->currentPage() - 1) * $list->perPage() + $key + 1 }}</td>
            @if (auth()->user()->company_id == null)
                <td>{{ $value->company->name ?? '-' }}</td>
            @endif

            <td>{{ $value->employee->full_name ?? '-' }}</td>
            <td>{{ $value->overtime_shift_request->name ?? '-' }}</td>
            <td>{{ $value->start_shift_date_time ?? '-' }}</td>
            <td>{{ $value->end_shift_date_time ?? '-' }}</td>
            <td>{{ $value->hours ?? '-' }}</td>
            <td>{{ $value->manager->full_name ?? '-' }}</td>
            <td>{{ $value->status ?? '-' }}</td>
            <td>{{ $value->reason ?? '-' }}</td>


            <td class="text-end">
                <x-table.actions>
                    <x-table.edit-button :id="$value->id" />
                    <x-table.delete-button :id="$value->id" />
                </x-table.actions>
            </td>

        </tr>
    @endforeach
@endsection
