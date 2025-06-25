<x-card>
    <x-slot name="title">{{ __('Report Attendance') }}</x-slot>
    <x-slot name="header">
        <b>{{ __('Report Attendance') }}</b>
    </x-slot>
    <x-slot name="toolbar">
        <x-table.bulk-data-dropdown export_url="{{ route('attendance-export',[
            'company_id'    => request()->filter['company_id'] ?? null,
            'year'    => request()->filter['year'] ?? null,
            'month'    => request()->filter['month'] ?? null,
        ]) }}" />
        <x-table.filter-dropdown :company="true" :monthyear="true" />
    </x-slot>
    <x-slot name="body">
        @if (count($list) == 0)
            <x-table.empty message="{{ request()->filter['company_id'] ? __('Data not found') : __('Please Select Company in Filter') }}" />
        @else
            <style>


            </style>
            <div class="table-responsive  ">
                <x-table.table>
                    <x-slot name="header">
                        <th>{{ __('ID') }}</th>
                        <th style="min-width:300px;">{{ __('Employee') }}</th>
                        @for ($i = 1; $i <= ($list[0]->total_day ?? 0); $i++)
                            <th class="text-center " colspan="2" style="min-width:100px;">
                                {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}
                                <br>
                                {{ \Carbon\Carbon::parse($year . '-' . $month . '-' . $i)->format('D') }}
                            </th>
                        @endfor

                    </x-slot>

                    <x-slot name="body">
                        @foreach ($list as $key => $value)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <x-table.employee-item-2 :image="$value->employee_image" :name="$value->employee_name" :department_name="$value->department_name"
                                        :position_name="$value->position_name" />
                                </td>

                                @for ($i = 1; $i <= ($value->total_day ?? 0); $i++)
                                    <td class="text-center">
                                        @if (((array) $value)['day' . $i . '_in_time'])
                                            <div
                                                class="badge badge-{{ ((array) $value)['day' . $i . '_in_status_code'] == 'PRS' ? 'success' : 'danger' }}">
                                                {{ ((array) $value)['day' . $i . '_in_status_code'] }}</div>

                                            <div class="mt-1">
                                                {{ \Carbon\Carbon::parse(((array) $value)['day' . $i . '_in_time'])->format('H:m') ?? '-' }}
                                            </div>
                                        @else
                                            -
                                        @endif

                                    </td>
                                    <td class="text-center">



                                        @if (((array) $value)['day' . $i . '_out_time'])
                                            <div
                                                class="badge badge-{{ ((array) $value)['day' . $i . '_out_status_code'] == 'PRS' ? 'success' : 'danger' }}">
                                                {{ ((array) $value)['day' . $i . '_out_status_code'] }}</div>

                                            <div class="mt-1">
                                                {{ \Carbon\Carbon::parse(((array) $value)['day' . $i . '_out_time'])->format('H:m') ?? '-' }}
                                            </div>
                                        @else
                                            -
                                        @endif


                                    </td>
                                @endfor
                            </tr>
                        @endforeach
                    </x-slot>
                </x-table.table>

            </div>
        @endif
    </x-slot>
</x-card>
