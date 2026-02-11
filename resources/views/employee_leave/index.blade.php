<x-table.index>
  <x-slot name="title">{{ __("leave") }}</x-slot>

  <x-slot name="header">
    <b>{{ $employee->full_name ?? '' }}</b>
  </x-slot>

  <x-slot name="back">
    <x-back href="{{ route('employees.index') }}" />
  </x-slot>

  <x-slot name="tab_header">
    <div>
      <x-employee-info-detail :employeeid="$employee->id" />
      <div class="separator mb-6"></div>
    </div>
    <div class="w-full mb-6">
      <div
        class="card px-6 border-0 rounded-lg"
        style="background-color: #eef3ff">
        <x-employee-edit-tab :employeeid="$employee->id" :tab="'leave'" />
      </div>
    </div>
  </x-slot>

  <x-slot name="toolbar"> </x-slot>

  <x-slot name="body">
    @if (count($list) == 0)
    <x-table.empty />
    @else
    <div class="table-responsive">
      <x-table.table>
        <x-slot name="header">
          <th>{{ __("ID") }}</th>
          <th>{{ __("Name") }}</th>
          <th>{{ __("Limit") }}</th>
          <th class="text-end">{{ __("Actions") }}</th>
        </x-slot>

        <x-slot name="body">
          @foreach ($list as $key => $value)
          <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $value->name ?? '' }}</td>
            <td>{{ $value->days_limit ?? '' }}</td>
            <td class="text-end">
              <x-table.actions>
                <x-table.edit-button
                  :href="route('leave.edit', [$employee, $value->leave_type_id])" />
              </x-table.actions>
            </td>
          </tr>
          @endforeach
        </x-slot>
      </x-table.table>
    </div>
    @endif
  </x-slot>
</x-table.index>
