<x-table.index>
  <x-slot name="title">{{ __("Education") }}</x-slot>

  <x-slot name="header">
    <b>{{ $employee->full_name ?? '' }}</b>
  </x-slot>

  <x-slot name="back">
    <x-back href="{{ route('company-subscriptions.index') }}" />
  </x-slot>

  <x-slot name="tab_header">
    <x-company-info-detail :companyid="$company->id" />
    <div class="separator mb-6"></div>
  </x-slot>

  <x-slot name="toolbar">
    <x-table.add-button
      :label="__('Add Subscription')"
      :href="route('company-subscriptions-detail.create', $company->id)" />
  </x-slot>

  <x-slot name="body">
    @if (count($list) == 0)
    <x-table.empty />
    @else
    <div class="table-responsive">
      <x-table.table>
        <x-slot name="header">
          <th class="min-w-10px">{{ __("ID") }}</th>

          <th class="min-w-125px">{{ __("Subscription Type") }}</th>
          <th class="min-w-125px">{{ __("Start") }}</th>
          <th class="min-w-125px">{{ __("End") }}</th>
          <th class="min-w-125px">{{ __("Bank") }}</th>
          <th class="min-w-125px">{{ __("Payment Status") }}</th>
          <th class="text-end min-w-70px">{{ __("Action") }}</th>
        </x-slot>

        <x-slot name="body">
          @foreach ($list as $key => $value)
          <tr>
            <td>
              {{ ($list->currentPage() - 1) * $list->perPage() + $key + 1 }}
            </td>

            <td>{{ $value->subscription_type ?? '-' }}</td>
            <td>
              {{ \App\Helpers\DateFormatHelper::format($value->start_date_at) }}
            </td>
            <td>
              {{ \App\Helpers\DateFormatHelper::format($value->end_date_at) }}
            </td>
            <td>{{ $value->bank ?? '-' }}</td>
            <td>{{ $value->payment_status == 1 ? __('Yes') : __('No') }}</td>

            <td class="text-end">
              <x-table.actions>
                <x-table.edit-button
                  :href="route('company-subscriptions-detail.edit', [$company, $value->id])" />

                  <x-table.edit-button
                  :href="route('company-subscriptions-detail.show', [$company, $value->id])" route_name="company-subscriptions-detail.show" label="Detail" />

                <x-table.delete-button
                  :href="route('company-subscriptions-detail.destroy', [$company, $value->id])" />
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
