<x-card>
    <x-slot name="title">{{ __($page_title) }}</x-slot>
    <x-slot name="header">
        <b>{{ __('Shift') }}</b>
    </x-slot>
    <x-slot name="tab_header">
        {{-- <x-web.shift-day-off-calendar /> --}}
    </x-slot>

    <x-slot name="toolbar">
        <x-table.filter-dropdown :company="true" />
        <x-table.add-button :label="__('Add Shift')" href="{{ route('employee-shifts.create') }}" />
    </x-slot>

    <x-slot name="body">
        @if (count($list) == 0)
            <x-table.empty />
        @else
            <div class="table-responsive">
                <x-table.table>
                    <x-slot name="header">
                        <th class="min-w-10px">{{ __('ID') }}</th>
                        <th class="min-w-125px">{{ __('Name') }}</th>
                        <th class="min-w-125px">{{ __('Time') }}</th>

                        <th class="min-w-125px">{{ __('Default') }}</th>
                        @if (auth()->user()->company_id == null)
                            <th class="min-w-125px">{{ __('Company') }}</th>
                        @endif
                        <th class="text-end min-w-70px">{{ __('Action') }}</th>
                    </x-slot>

                    <x-slot name="body">
                        @foreach ($list as $key => $value)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $value->name ?? '-' }}</td>
                                <td>{{ $value->start_time != null ? \Carbon\Carbon::parse($value->start_time)->format('d M Y h:m') : '-' }}
                                    -
                                    {{ $value->end_time != null ? \Carbon\Carbon::parse($value->end_time)->format('d M Y h:m') : '-' }}
                                </td>
                                <td>{{ $value->default == 1 ? __('YES') : __('ID') }}</td>
                                @if (auth()->user()->company_id == null)
                                    <td>{{ $value->company->name ?? '-' }}</td>
                                @endif

                                <td class="text-end">
                                    <x-table.actions>
                                        <x-table.edit-button :id="$value->id" />
                                        <x-table.delete-button :id="$value->id" />
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
