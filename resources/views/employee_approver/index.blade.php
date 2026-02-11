<x-table.index>
  <x-slot name="title">{{ __("Approver") }}</x-slot>

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
        <x-employee-edit-tab :employeeid="$employee->id" :tab="'approver'" />
      </div>
    </div>
  </x-slot>

  <x-slot name="toolbar">
    <x-table.add-button
      :label="__('Add Approval')"
      :href="route('approver.create', $employee->id)" />
  </x-slot>

  <x-slot name="body">
    @if (count($list) == 0)
    <x-table.empty />
    @else
    <div class="table-responsive">
      <x-table.table>
        <x-slot name="header">
          <th>{{ __("ID") }}</th>
          <th>{{ __("Approval") }}</th>
          <th>{{ __("Level") }}</th>
          <th>{{ __("Request Type") }}</th>
          <th class="text-end">{{ __("Actions") }}</th>
        </x-slot>

        <x-slot name="body">
          @foreach ($list as $key => $value)
          <tr>
            <td>
              {{ ($list->currentPage() - 1) * $list->perPage() + $key + 1 }}
            </td>
            <td>{{ $value->approver_employee->full_name ?? '' }}</td>
            <td>{{ $value->approver_level ?? '' }}</td>
            <td>{{ $value->request_type_name ?? '' }}</td>
            <td class="text-end">
              <x-table.actions>
                <x-table.edit-button
                  :href="route('approver.edit', [$employee, $value->id])" />
                <x-table.delete-button
                  :href="route('approver.destroy', [$employee, $value->id])" />
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
