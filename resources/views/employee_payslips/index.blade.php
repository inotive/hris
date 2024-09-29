<x-table.index>
    <x-slot name="title">{{ __('Data Payslips') }}</x-slot>

    
    <x-slot name="toolbar">
        <x-table.add-button :label="__('Add Payslip')" :href="route('employee-payslips.create')"/>
    </x-slot>


    <x-slot name="body">

        @if (count($list) == 0)
            <x-table.empty />
        @else
            <div class="table-responsive">
                <x-table.table>
                    <x-slot name="header">
                        <th>{{ __('No') }}</th>
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
                                <td>{{ ($list->currentPage() - 1) * $list->perPage() + $key + 1 }}</td>

                                <td>
                                    <x-table.employee-item :employee="$value" />
                                </td>
                                <td>{{ $value->company->name ?? '' }}</td>
                                <td>{{ number_format($value->total_payslip_earning ?? 0,0,",",".") }}</td>
                                <td>{{ number_format($value->total_payslip_deduction ?? 0,0,",",".") }}</td>
                                <td>{{ number_format($value->tax ?? 0,0,",",".") }}</td>
                                <td>{{ number_format($value->take_home_pay ?? 0,0,",",".") }}</td>
                                <td>{{ \Carbon\Carbon::parse($value->pay_date)->format('d M Y') }}</td>
                                <td class="text-end">
                                    <x-table.actions>

                                        <x-table.edit-button :href="route('employee-payslips.edit', [ $value->id])" />
                                        <x-table.delete-button :href="route('employee-payslips.destroy', [ $value->id])" />
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