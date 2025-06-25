<x-card>
    <x-slot name="title">{{ __('Data Payslips') }}</x-slot>
    <x-slot name="header">
        <b>{{ __('Data Payslips') }}</b>
    </x-slot>
    <x-slot name="toolbar">
        <x-table.filter-dropdown :company="true" />
        <x-table.add-button :label="__('Add Payslip')" :href="route('employee-payslips.create')" />
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
                        <th>{{ __('Company') }}</th>
                        <th>{{ __('Earning') }}</th>
                        <th>{{ __('Deduction') }}</th>
                        <th>{{ __('Tax') }}</th>
                        <th>{{ __('Total') }}</th>
                        <th>{{ __('Paydate') }}</th>
                        <th class="text-end">{{ __('Actions') }}</th>
                    </x-slot>

                    <x-slot name="body">
                        @foreach ($list as $key => $value)
                            <tr>
                                <td>
                                    {{ ($list->currentPage() - 1) * $list->perPage() + $key + 1 }}
                                </td>

                                <td>
                                    <x-table.employee-item :employee="$value->employee" />
                                </td>
                                <td>{{ $value->company->name ?? '' }}</td>
                                <td>
                                    {{ number_format($value->total_payslip_earning ?? 0, 0, ',', '.') }}
                                </td>
                                <td>
                                    {{ number_format($value->total_payslip_deduction ?? 0, 0, ',', '.') }}
                                </td>
                                <td>{{ number_format($value->tax ?? 0, 0, ',', '.') }}</td>
                                <td>
                                    {{ number_format($value->take_home_pay ?? 0, 0, ',', '.') }}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($value->pay_date)->format('d M Y') }}
                                </td>
                                <td class="text-end">
                                    <x-table.actions>

                                        <div class="menu-item px-3 text-start">
                                            <a href="javascript:void(0);" 
                                               class="menu-link px-3 text-left view-payslip" 
                                               data-url="{{ route('payslip.view', $value->id) }}">
                                                {{ __('View') }}
                                            </a>
                                        </div>
                                        <div class="menu-item px-3 text-start">
                                            <a href="javascript:void(0);" 
                                               class="menu-link px-3 text-left view-payslip" 
                                               data-url="{{ route('payslip.print', $value->id) }}">
                                                {{ __('Print') }}
                                            </a>
                                        </div>
                                        <div class="menu-item px-3 text-start">
                                            <a href="{{ route('payslip.download', $value->id) }}" 
                                               class="menu-link px-3 text-left" 
                                               target="_blank">
                                                {{ __('Download') }}
                                            </a>
                                        </div>
                                        <x-table.edit-button :href="route('employee-payslips.edit', [$value->id])" />
                                        <x-table.delete-button :href="route('employee-payslips.destroy', [$value->id])" />
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
</x-card>
