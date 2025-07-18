<x-card>
  <x-slot name="title">{{ __("Shift Day Off") }}</x-slot>
  <x-slot name="header">
    <b>{{ __("Shift Day Off") }}</b>
  </x-slot>
  <x-slot name="tab_header">
    {{-- <x-web.shift-day-off-calendar /> --}}
  </x-slot>

  <x-slot name="toolbar">
    <x-table.filter-dropdown :company="true" />

    <x-table.add-button
      :label="__('Add Day Off')"
      href="{{ route('employee-shifts-day-off.create') }}" />
  </x-slot>

  <x-slot name="body">
    @if (count($list) == 0)
    <x-table.empty />
    @else
    <div class="table-responsive">
      <x-table.table>
        <x-slot name="header">
          <th>{{ __("ID") }}</th>
          <th>{{ __("Shift") }}</th>
          <th>{{ __("Date") }}</th>
          <th>{{ __("Description") }}</th>
          @if (auth()->user()->company_id == null)
          <th>{{ __("Company") }}</th>
      @endif

          <th class="text-end">{{ __("Actions") }}</th>
        </x-slot>

        <x-slot name="body">
          @foreach ($list as $key => $value)
          <tr>
            <td>
              {{ ($list->currentPage() - 1) * $list->perPage() + $key + 1 }}
            </td>
            <td>{{ $value->shift->name ?? '' }}</td>
            <td>{{ \Carbon\Carbon::parse($value->date)->format('d/M') }}</td>
            <td>{{ $value->description }}</td>
            @if (auth()->user()->company_id == null)
            <td>{{ $value->company->name ?? '-' }}</td>
        @endif
            <td class="text-end">
              <x-table.actions>
                <x-table.delete-button
                  :href="route('employee-shifts-day-off.destroy', [ $value->id])" />
              </x-table.actions>
            </td>
          </tr>
          @endforeach
        </x-slot>
      </x-table.table>

      {{ $list->appends(request()->query())->links() }}
    </div>

    @endif
  </x-slot>
</x-table.index>
