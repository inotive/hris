<x-table.index>
    <x-slot name="title">{{ __('Emergency Contact') }}</x-slot>


    <x-slot name="header">
        <b>{{ $employee->full_name ?? '' }}</b>
    </x-slot>
    
    <x-slot name="header_toolbar">
        <x-employee-edit-tab :employeeid="$employee->id" tab="emergency_contact"/>
    </x-slot>
    
    <x-slot name="toolbar">
        <x-table.add-button :label="__('Add Emergency Contact')" :href="route('emergency-contact.create', $employee->id)"/>
    </x-slot>


    <x-slot name="body">

        @if (count($list) == 0)
            <x-table.empty />
        @else
            <div class="table-responsive">
                <x-table.table>
                    <x-slot name="header">
                        <th>{{ __('No') }}</th>
                        <th>{{ __('Family Relation') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Phone') }}</th>
                        <th class="text-end">{{ __('Actions') }}</th>
                    </x-slot>

                    <x-slot name="body">
                        @foreach ($list as $key => $value)
                            <tr>
                                <td>{{ ($list->currentPage() - 1) * $list->perPage() + $key + 1 }}</td>
                                <td>{{ $value->family_relation ?? '' }}</td>
                                <td>{{ $value->name ?? '' }}</td>
                                <td>{{ $value->phone }}</td>
                                <td class="text-end">
                                    <x-table.actions>

                                        <x-table.edit-button :href="route('emergency-contact.edit', [$employee, $value->id])" />
                                        <x-table.delete-button :href="route('emergency-contact.destroy', [$employee, $value->id])" />
                                    </x-table.actions>
                                </td>
                            </tr>
                        @endforeach
                    </x-slot>
                </x-table.table>

                {{ $list->links() }}
            </div>

        @endif

    </x-slot>
</x-table.index>