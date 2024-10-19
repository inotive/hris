<x-table.index>
    <x-slot name="title">{{ __('Contract') }}</x-slot>


    <x-slot name="header">
        <b>{{ $employee->full_name ?? '' }}</b>
    </x-slot>
    <x-slot name="header_toolbar">
        <x-employee-edit-tab :employeeid="$employee->id" tab="contract" />
    </x-slot>

    <x-slot name="toolbar">
        <x-table.add-button :label="__('Add Contract')" :href="route('contract.create', $employee->id)" />
    </x-slot>


    <x-slot name="body">

        @if (count($list) == 0)
            <x-table.empty />
        @else
            <div class="table-responsive">
                <x-table.table>
                    <x-slot name="header">
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Start') }}</th>
                        <th>{{ __('End') }}</th>
                        <th>{{ __('Notes') }}</th>
                        <th>{{ __('File') }}</th>
                        <th class="text-end">{{ __('Actions') }}</th>
                    </x-slot>

                    <x-slot name="body">
                        @foreach ($list as $key => $value)
                            <tr>
                                <td>{{ ($list->currentPage() - 1) * $list->perPage() + $key + 1 }}</td>
                                <td>{{ $value->status_label ?? '' }}</td>
                                <td>{{ \Carbon\Carbon::parse($value->date_start)->format('d M Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($value->date_end)->format('d M Y') }}</td>
                                <td>{{ $value->notes }}</td>
                                <td><a target="_blank" href="{{ Storage::url($value->file) }}">File</a></td>
                                <td class="text-end">
                                    <x-table.actions>

                                        <x-table.edit-button :href="route('contract.edit', [$employee, $value->id])" />
                                        <x-table.delete-button :href="route('contract.destroy', [$employee, $value->id])" />
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
