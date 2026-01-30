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
    <th class="min-w-125px">{{ __('Name') }}</th>

    <th class="text-end min-w-70px">{{ __('Action') }}</th>
@stop

@section('table_body')
    @foreach ($list as $key => $value)
        <tr>

            <td>{{ ($list->currentPage() - 1) * $list->perPage() + $key + 1 }}</td>
            @if (auth()->user()->company_id == null)
                <td>{{ $value->company->name ?? '-' }}</td>
            @endif

            <td>{{ $value->name ?? '-' }}</td>


            <td class="text-end">
                <x-table.actions>
                    <x-table.edit-button :id="$value->id" />
                    <x-table.delete-button :id="$value->id" />
                </x-table.actions>
            </td>

        </tr>
    @endforeach
@endsection
