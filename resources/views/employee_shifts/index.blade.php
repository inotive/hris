@extends('crud.index')


@section('page_title')
    {{ __($page_title) }}
@stop

@section('table_header')
    <th class="min-w-125px">{{ __('Company') }}</th>
    <th class="min-w-125px">{{ __('Name') }}</th>
    <th class="min-w-125px">{{ __('Start Time') }}</th>
    <th class="min-w-125px">{{ __('End Time') }}</th>
    <th class="min-w-125px">{{ __('Default') }}</th>
    <th class="text-end min-w-70px">Actions</th>
@stop

@section('table_body')
    @foreach ($list as $key => $value)
        <tr>


            <td>{{ $value->company->name ?? '-' }}</td>
            <td>{{ $value->name ?? '-' }}</td>
            <td>{{ $value->start_time ?? '-' }}</td>
            <td>{{ $value->end_time ?? '-' }}</td>
            <td>{{ $value->default == 1 ? __('YES') : __('No') }}</td>
            
            <td class="text-end">
                <x-table.actions>
                    <x-table.edit-button :id="$value->id" />
                    <x-table.delete-button :id="$value->id" />
                </x-table.actions>
            </td>

        </tr>
    @endforeach
@endsection
