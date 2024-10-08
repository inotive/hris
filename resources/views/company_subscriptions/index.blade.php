@extends('crud.index')


@section('page_title')
    {{ __($page_title) }}
@stop


@section('toolbar')
    <x-table.filter-dropdown :company="true" />
@stop

@section('table_header')
    <th class="min-w-50px">{{ __('No') }}</th>
    @if (auth()->user()->company_id == null)
        <th class="min-w-125px">{{ __('Company') }}</th>
    @endif
    <th class="min-w-125px">{{ __('Start') }}</th>
    <th class="min-w-125px">{{ __('End') }}</th>
    <th class="min-w-125px">{{ __('Payment Status') }}</th>
    <th class="text-end min-w-70px">{{ __('Action') }}</th>
@stop

@section('table_body')
    @foreach ($list as $key => $value)
        <tr>

            <td>{{ ($list->currentPage() - 1) * $list->perPage() + $key + 1 }}</td>
            @if (auth()->user()->company_id == null)
                <td>{{ $value->company->name ?? '-' }}</td>
            @endif
          
            <td>{{ $value->start_date_at ?? '-' }}</td>
            <td>{{ $value->end_date_at ?? '-' }}</td>
            <td>{{ $value->payment_status == 1 ? __('Yes') : __('No') }}</td>

            <td class="text-end">
                <x-table.actions>
                    <x-table.edit-button :id="$value->id" />
                    <x-table.delete-button :id="$value->id" />
                </x-table.actions>
            </td>

        </tr>
    @endforeach
@endsection
