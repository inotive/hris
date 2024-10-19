<x-table.index>
    <x-slot name="title">{{ __('Data Reimbursement Requests') }}</x-slot>


    <x-slot name="toolbar">
        <x-table.filter-dropdown :company="true" />
        <x-table.add-button :label="__('Add Reimbursement Request')" :href="route('reimbursement-requests.create')" />
    </x-slot>


    <x-slot name="body">

        @if (count($list) == 0)
            <x-table.empty />
        @else
            <div class="table-responsive">
                <x-table.table>
                    <x-slot name="header">
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Employee') }}</th>
                        <th>{{ __('Type') }}</th>
                        <th>{{ __('Date') }}</th>
                        <th>{{ __('Total') }}</th>
                        <th>{{ __('Approver') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th class="text-end">{{ __('Actions') }}</th>
                    </x-slot>

                    <x-slot name="body">
                        @foreach ($list as $key => $value)
                            <tr>
                                <td>{{ ($list->currentPage() - 1) * $list->perPage() + $key + 1 }}</td>

                                <td>
                                    <x-table.employee-item :employee="$value->employee" />
                                </td>
                                <td>{{ $value->type->name ?? '' }}</td>
                                <td>{{ \Carbon\Carbon::parse($value->date)->format('d M Y') }}</td>
                                <td>{{ number_format($value->total ?? 0, 0, ',', '.') }}</td>
                                <td>
                                    {{-- <x-table.employee-item :employee="$value->manager" /> --}}
                                    {{ $value->manager->full_name ?? '-' }}
                                </td>
                                <td>{{ $value->status ?? '' }}</td>

                                <td class="text-end">
                                    <x-table.actions>

                                        <x-table.edit-button :href="route('reimbursement-requests.edit', [$value->id])" />
                                        <x-table.delete-button :href="route('reimbursement-requests.destroy', [$value->id])" />
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
