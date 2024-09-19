<x-table.index>
    <x-slot name="title">{{ __('Family Info') }}</x-slot>


    <x-slot name="header">
        {{ $employee->full_name ?? '' }}
    </x-slot>
    <x-slot name="header_toolbar">
        <x-employee-edit-tab :employeeid="$employee->id" tab="family_info"/>
    </x-slot>
    
    <x-slot name="toolbar">
        <x-table.add-button :href="route('family-info.create', $employee->id)"/>
    </x-slot>


    <x-slot name="body">


        <div class="table-responsive">
            <x-table.table>
                <x-slot name="header">
                    <th>{{ __('No') }}</th>
                    <th>{{ __('Family Relation') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th class="text-end">{{ __('Actions') }}</th>
                </x-slot>

                <x-slot name="body">
                    @foreach ($list as $key => $value)
                        <tr>
                            <td>{{ ($list->currentPage() - 1) * $list->perPage() + $key + 1 }}</td>
                            <td>{{ $value->family_relation ?? '' }}</td>
                            <td>{{ $value->name ?? '' }}</td>
                            <td class="text-end">
                                <x-table.actions>

                                    <x-table.edit-button :href="route('family-info.edit', [$employee, $value->id])" />
                                    <x-table.delete-button :href="route('family-info.destroy', [$employee, $value->id])" />
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