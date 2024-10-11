@extends('crud.index')


@section('page_title')
    {{ __($page_title) }}
@stop

@section('toolbar')
<x-table.filter-dropdown :company="true" />
@stop

@section('table_header')
    <th class="min-w-50px">{{ __('No') }}</th>
  
    <th class="min-w-125px">{{ __('Type TER') }}</th>
    <th class="min-w-125px">{{ __('Range') }}</th>
    <th class="min-w-125px">{{ __('Value') }}</th>
    <th class="text-end min-w-70px">{{ __('Action') }}</th>
@stop

@section('table_body')
    @foreach ($list as $key => $value)
        <tr>

            <td>{{ ($list->currentPage() - 1) * $list->perPage() + $key + 1 }}</td>
         
            <td>{{ $value->type_ter ?? '-' }}</td>
            <td>
                Rp {{ number_format($value->value_start, 0,",",".") }} - Rp {{ number_format($value->value_end, 0,",",".") }}
            </td>
            <td>{{ $value->value ?? '-' }}%</td>

            <td class="text-end">
                <x-table.actions>
                    <x-table.edit-button :id="$value->id" />
                    <x-table.delete-button :id="$value->id" />
                </x-table.actions>
            </td>

        </tr>
    @endforeach
@endsection
