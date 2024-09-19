<x-table.index>
    <x-slot name="title">{{ __('Organization Experience') }}</x-slot>


    <x-slot name="header">
        {{ $employee->full_name ?? '' }}
    </x-slot>
    <x-slot name="header_toolbar">
        <x-employee-edit-tab :employeeid="$employee->id" tab="organization_experience"/>
    </x-slot>
    
    <x-slot name="toolbar">
        <x-table.add-button :href="route('organization-experience.create', $employee->id)"/>
    </x-slot>


    <x-slot name="body">


        <div class="table-responsive">
            <x-table.table>
                <x-slot name="header">
                    <th>{{ __('No') }}</th>
                    <th>{{ __('Company Name') }}</th>
                    <th>{{ __('Company Location') }}</th>
                    <th>{{ __('Start Periode') }}</th>
                    <th>{{ __('End Periode') }}</th>
                    <th class="text-end">{{ __('Actions') }}</th>
                </x-slot>

                <x-slot name="body">
                    @foreach ($list as $key => $value)
                        <tr>
                            <td>{{ ($list->currentPage() - 1) * $list->perPage() + $key + 1 }}</td>
                            <td>{{ $value->company_name ?? '' }}</td>
                            <td>{{ $value->company_location ?? '' }}</td>
                            <td>{{ $value->start_period ?? '' }}</td>
                            <td>{{ $value->end_period ?? '' }}</td>
                            <td class="text-end">
                                <x-table.actions>

                                    <x-table.edit-button :href="route('organization-experience.edit', [$employee, $value->id])" />
                                    <x-table.delete-button :href="route('organization-experience.destroy', [$employee, $value->id])" />
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