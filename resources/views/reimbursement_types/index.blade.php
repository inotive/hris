@extends('crud.index')


@section('page_title')
    {{ __($page_title) }}
@stop

@section('table_header')
    @if (count($list) > 0)
        @if (auth()->user()->company_id == null)
        <th class="min-w-125px">{{ __('Company') }}</th>
        @endif
        <th class="min-w-125px">{{ __('Name') }}</th>
     
        <th class="text-end min-w-70px">{{ __('Action') }}</th>
    @endif
@stop

@section('table_body')
    @if (count($list) == 0)
        <x-table.empty />
    @else
        @foreach ($list as $key => $value)
            <tr>


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
    @endif
@endsection
