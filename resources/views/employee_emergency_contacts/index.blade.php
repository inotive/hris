<x-table.index>
    <x-slot name="title">{{ __('Emergency Contact') }}</x-slot>


    <x-slot name="header">
        <x-employee-edit-tab :employeeid="$employee->id" tab="emergency_contact"/>
    </x-slot>
    
    <x-slot name="toolbar">
        <x-table.add-button :href="route('emergency-contact.create', $employee->id)"/>
    </x-slot>


    <x-slot name="body">


        <div class="table-responsive">
            <x-table.table>
                <x-slot name="header">
                    <th>{{ __('Family Relation') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Phone') }}</th>
                    <th class="text-end">{{ __('Actions') }}</th>
                </x-slot>

                <x-slot name="body">
                    @foreach ($list as $key => $value)
                        <tr>
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

    </x-slot>
</x-table.index>