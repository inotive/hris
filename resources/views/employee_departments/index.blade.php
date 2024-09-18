@extends('crud.index')


@section('page_title')
    {{ __($page_title) }}
@stop

@section('table_header')

    <th class="min-w-50px">{{ __('No') }}</th>
    <th class="min-w-125px">{{ __('Name') }}</th>
    <th class="min-w-125px">{{ __('Description') }}</th>
    <th class="min-w-125px">{{ __('Head') }}</th>
    <th class="min-w-125px">{{ __('Company') }}</th>
    <th class="text-end min-w-70px">{{ __('Action') }}</th>
@stop

@section('table_body')
    @foreach ($list as $key => $value)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $value->name }}</td>
            <td>{{ $value->description }}</td>
            <td>{{ $value->head_department->first_name ?? '' }}</td>
            <td>{{ $value->company->name ?? '-' }}</td>
            
            <td class="text-end">
                <x-table.actions>
                    <x-table.edit-button :id="$value->id" />
                    <x-table.delete-button :id="$value->id" />
                </x-table.actions>
            </td>

        </tr>
    @endforeach
@endsection
