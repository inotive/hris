<x-table.index>
    <x-slot name="title">{{ __('Organization Experience') }}</x-slot>



    <x-slot name="toolbar">
        <x-table.filter-dropdown :company="true" :monthyear="true" />
        <x-table.add-button :label="__('Add')" :href="route('employee-payslip-generate.create')" />
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
                        <th>{{ __('Approved Overtime') }}</th>
                        <th>{{ __('Earning') }}</th>
                        <th>{{ __('Deduction') }}</th>
                        <th>{{ __('Tax') }}</th>
                        <th>{{ __('Take Home Pay') }}</th>
                        <th class="text-end">{{ __('Actions') }}</th>
                    </x-slot>

                    <x-slot name="body">
                        @foreach ($list as $key => $value)
                            <tr>
                                <td>{{ ($list->currentPage() - 1) * $list->perPage() + $key + 1 }}</td>
                                <td>{{ $value->employee->full_name ?? '' }}</td>
                                <td>{{ $value->approved_overtime_hours ?? '0' }} {{ __('Hours') }}</td>
                                <td class="text-end">{{ number_format($value->total_payslip_earning, 0,",",".") }}</td>
                                <td class="text-end">{{ number_format($value->total_payslip_deduction, 0,",",".") }}</td>
                                <td class="text-end">{{ number_format($value->tax, 0,",",".") }}</td>
                                <td class="text-end">{{ number_format($value->take_home_pay, 0,",",".") }}</td>
                                <td class="text-end">

                                    @if ($value->approved_at == null)
                                        <a href="{{ route('employee-payslips.edit', [$value->id, 'redirect'=> url()->current()]) }}">
                                            @include('icons.edit')
                                        </a>
                                    @else
                                        <a href="{{ route('employee-payslips.edit', [$value->id, 'redirect'=> url()->current()]) }}">
                                            @include('icons.eye')
                                        </a>
                                    @endif
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
