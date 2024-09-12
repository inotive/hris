@extends('crud.index')


@section('page_title')
    {{ __($page_title) }}
@stop

@section('table_header')
    <th class="min-w-125px">{{ __('Company') }}</th>
    <th class="min-w-125px">{{ __('Name') }}</th>
    <th class="min-w-125px">{{ __('Head Department') }}</th>
    <th class="text-end min-w-70px">Actions</th>
@stop

@section('table_body')
    @foreach ($list as $key => $value)
        <tr>

            <td><img class="rounded" src="{{ Storage::url($value->image) }}"
                    onerror="this.onerror=null; this.src='{{ asset('assets/images/no_image.jpg') }}';" width="50" /></td>
            
            <td>{{ $value->company->name ?? '-' }}</td>
            <td>{{ $value->name }}</td>
            <td>{{ $value->head_department->first_name ?? '' }}</td>
            
            <td class="text-end">
                <x-table.actions>
                    <x-table.edit-button :id="$value->id" />
                    <x-table.delete-button :id="$value->id" />
                </x-table.actions>
            </td>

        </tr>
    @endforeach
@endsection
