@extends('crud.index')


@section('page_title')
    Companies
@stop

@section('table_header')
    <th class="min-w-125px">{{ __('Image') }}</th>
    <th class="min-w-125px">{{ __('First Name') }}</th>
    <th class="min-w-125px">{{ __('Phone') }}</th>
    <th class="min-w-125px">{{ __('Email') }}</th>
    <th class="text-end min-w-70px">Actions</th>
@stop

@section('table_body')
    @foreach ($list as $key => $value)
        <tr>

            <td><img class="rounded" src="{{ Storage::url($value->image) }}"
                    onerror="this.onerror=null; this.src='{{ asset('assets/images/no_image.jpg') }}';" width="50" /></td>
            <td>{{ $value->first_name }}</td>
            <td><a href="tel:{{ $value->phone ?? '' }}" target="_blank">{{ $value->phone ?? '' }}</a></td>
            <td><a href="mailto:{{ $value->email ?? '' }}" target="_blank">{{ $value->email ?? '' }}</a></td>
            <td class="text-end">
                <x-table.actions>
                    <x-table.edit-button :id="$value->id" />
                    <x-table.delete-button :id="$value->id" />
                </x-table.actions>
            </td>

        </tr>
    @endforeach
@endsection
