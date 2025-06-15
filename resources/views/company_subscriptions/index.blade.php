@extends('crud.index')


@section('page_title')
    {{ __($page_title) }}
@stop


@section('toolbar')
    <x-table.filter-dropdown :payment_status="true" />
@stop

@section('table_header')
    <th class="min-w-10px">{{ __('ID') }}</th>
    @if (auth()->user()->company_id == null)
        <th class="min-w-125px">{{ __('Company') }}</th>
    @endif
    <th class="min-w-125px">{{ __('Start') }}</th>
    <th class="min-w-125px">{{ __('End') }}</th>
    <th class="min-w-125px">{{ __('Day Left') }}</th>
    <th class="min-w-125px">{{ __('Payment Status') }}</th>
    <th class="text-end min-w-70px">{{ __('Action') }}</th>
@stop

@section('table_body')
    @foreach ($list as $key => $value)
        <tr>

            <td>{{ ($list->currentPage() - 1) * $list->perPage() + $key + 1 }}</td>
            @if (auth()->user()->company_id == null)
                <td>{{ $value->name ?? '-' }}</td>
            @endif

            <td>
                @if ($value->active_subscriptions()->first()->start_date_at ?? null != null)
                    {{ \App\Helpers\DateFormatHelper::format($value->active_subscriptions()->first()->start_date_at) }}
                @else
                    -
                @endif
            </td>

            <td>
                @if ($value->active_subscriptions()->first()->end_date_at ?? null  != null)
                    {{ \App\Helpers\DateFormatHelper::format($value->active_subscriptions()->first()->end_date_at) }} 
                @else 
                -
                @endif
            </td>
            <td>{{ $value->day_left_subscription() ?? '-' }}</td>
            <td>{{ $value->active_subscriptions()->first() != null ? ($value->active_subscriptions()->first()->payment_status == 1 ? __('Yes') : __('No')) : '-' }}
            </td>

            <td class="text-end">
                <x-table.actions>
                    <x-table.action-button href="{{ route('company-subscriptions-detail.index', [$value->id]) }}"
                        label="{{ __('Detail') }}" />
                    {{-- <x-table.edit-button :id="$value->id" />
                    <x-table.delete-button :id="$value->id" /> --}}
                </x-table.actions>
            </td>

        </tr>
    @endforeach
@endsection
