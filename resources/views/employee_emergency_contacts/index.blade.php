@extends('crud.index')


@section('page_title')
    {{ __($page_title) }}
@stop

@section('table_header')
    <th class="min-w-125px">{{ __('Company') }}</th>
    <th class="min-w-125px">{{ __('Employee') }}</th>
    <th class="min-w-125px">{{ __('Family Relation') }}</th>
    <th class="min-w-125px">{{ __('Name') }}</th>
    <th class="text-end min-w-70px">{{ __('Action') }}</th>
@stop

@section('table_body')
    @foreach ($list as $key => $value)
        <tr>


            <td>{{ $value->employee->company->name ?? '-' }}</td>
            <td>{{ $value->employee->full_name ?? '-' }}</td>
            <td>{{ $value->family_relation ?? '-' }}</td>
            <td>{{ $value->name ?? '-' }}</td>
            <td>{{ $value->phone ?? '-' }}</td>
            
            <td class="text-end">
                <x-table.actions>
                    <x-table.edit-button :id="$value->id" />
                    <x-table.delete-button :id="$value->id" />
                </x-table.actions>
            </td>

        </tr>
    @endforeach
@endsection
