@extends('crud.index')


@section('page_title')
    {{ __($page_title) }}
@stop

@section('table_header')
    <th class="min-w-50px">{{ __('No') }}</th>
    @if (auth()->user()->company_id == null)
        <th class="min-w-125px">{{ __('Company') }}</th>
    @endif
    <th class="min-w-125px">{{ __('Employee') }}</th>
    <th class="min-w-125px">{{ __('Manager') }}</th>
    <th class="min-w-125px">{{ __('Leave Type') }}</th>
    <th class="min-w-125px">{{ __('Date') }}</th>
    <th class="min-w-125px">{{ __('Files') }}</th>
    <th class="min-w-125px">{{ __('Status') }}</th>
    <th class="min-w-125px">{{ __('Reason') }}</th>

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
            <td>{{ \Carbon\Carbon::parse($value->date)->format('d/m/Y') }}</td>
            <td>{{ $value->leave_type->name ?? '-' }}</td>
            <td>{{ $value->manager->full_name ?? '-' }}</td>
            <td>{{ $value->status ?? '-' }}</td>
            <td>{{ $value->files()->first()->name ?? '-' }}</td>
           
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
