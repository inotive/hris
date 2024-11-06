<x-table.index>
    <x-slot name="title">{{ __('Approver') }}</x-slot>


    <x-slot name="header">
        <b>{{ $employee->full_name ?? '' }}</b>
    </x-slot>
    <x-slot name="header_toolbar">
        <x-employee-edit-tab :employeeid="$employee->id" tab="approver" />
    </x-slot>

    <x-slot name="toolbar">
        <x-table.add-button :label="__('Add Approval')" :href="route('approver.create', $employee->id)" />
    </x-slot>


    <x-slot name="body">

        @if (count($list) == 0)
            <x-table.empty />
        @else
            <div class="table-responsive">
                <x-table.table>
                    <x-slot name="header">
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Approval') }}</th>
                        <th>{{ __('Level') }}</th>
                        <th>{{ __('Request Type') }}</th>
                        <th class="text-end">{{ __('Actions') }}</th>
                    </x-slot>

                    <x-slot name="body">
                        @foreach ($list as $key => $value)
                            <tr>
                                <td>{{ ($list->currentPage() - 1) * $list->perPage() + $key + 1 }}</td>
                                <td>{{ $value->approver_employee->full_name ?? '' }}</td>
                                <td>{{ $value->approver_level ?? '' }}</td>
                                <td>{{ $value->request_type ?? '' }}</td>
                                <td class="text-end">
                                    <x-table.actions>

                                        <x-table.edit-button :href="route('approver.edit', [$employee, $value->id])" />
                                        <x-table.delete-button :href="route('approver.destroy', [$employee, $value->id])" />
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
