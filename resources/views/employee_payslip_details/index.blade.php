@extends('crud.index')


@section('page_title')
    {{ __($page_title) }}
@stop

@section('table_header')
    <th class="min-w-125px">{{ __('Company') }}</th>
    <th class="min-w-125px">{{ __('Payslip Type') }}</th>
    <th class="min-w-125px">{{ __('Value') }}</th>
    <th class="text-end min-w-70px">Actions</th>
@stop

@section('table_body')
    @foreach ($list as $key => $value)
        <tr>


            <td>{{ $value->company->name ?? '-' }}</td>

            <td>{{ $value->payslip_type ?? '-' }}</td>
            <td>{{ $value->value ?? '-' }}</td>
            
            <td class="text-end">
                <x-table.actions>
                    <x-table.edit-button :id="$value->id" />
                    <x-table.delete-button :id="$value->id" />
                </x-table.actions>
            </td>

        </tr>
    @endforeach
@endsection