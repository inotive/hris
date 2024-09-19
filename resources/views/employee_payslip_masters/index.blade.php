@extends('crud.index')


@section('page_title')
    {{ __($page_title) }}
@stop

@section('table_header')
    @if (auth()->user()->company_id == null)
    <th class="min-w-125px">{{ __('Company') }}</th>
    @endif
    <th class="min-w-125px">{{ __('Name') }}</th>
    <th class="min-w-125px">{{ __('Master Type') }}</th>
    <th class="min-w-125px">{{ __('Type') }}</th>
    <th class="text-end min-w-70px">{{ __('Action') }}</th>
@stop

@section('table_body')
    @foreach ($list as $key => $value)
        <tr>


            @if (auth()->user()->company_id == null)
            <td>{{ $value->company->name ?? '-' }}</td>
            @endif

            <td>{{ $value->name ?? '-' }}</td>
            <td>{{ $value->master_type_name ?? '-' }}</td>
            <td>{{ $value->type_name ?? '-' }}</td>
            
            <td class="text-end">
                <x-table.actions>
                    <x-table.edit-button :id="$value->id" />
                    <x-table.delete-button :id="$value->id" />
                </x-table.actions>
            </td>

        </tr>
    @endforeach
@endsection
