@extends('crud.index')


@section('page_title')
    {{ __($page_title) }}
@stop

@section('table_header')

    <th class="min-w-125px">{{ __('First Name') }}</th>
    <th class="min-w-125px">{{ __('Last Name') }}</th>
    <th class="min-w-125px">{{ __('Department') }}</th>
    <th class="min-w-125px">{{ __('Position') }}</th>
    <th class="min-w-125px">{{ __('Level') }}</th>
    <th class="text-end min-w-70px">{{ __('Action') }}</th>
@stop

@section('table_body')
    @foreach ($list as $key => $value)
        <tr>

           
            <td>{{ $value->first_name ?? '' }}</td>
            <td>{{ $value->last_name ?? '' }}</td>
            <td>{{ $value->department->name ?? '' }}</td>
            <td>{{ $value->position->name ?? '' }}</td>
            <td>{{ $value->level->name ?? '' }}</td>
           
            <td class="text-end">
                <x-table.actions>
                    <x-table.action-button label="Emergency Contact" :href="route('employee-emergency-contacts.index',['filter'=> ['employee_id'=> $value->id]])" />
                    <x-table.edit-button :id="$value->id" />
                    <x-table.delete-button :id="$value->id" />
                </x-table.actions>
            </td>

        </tr>
    @endforeach
@endsection
