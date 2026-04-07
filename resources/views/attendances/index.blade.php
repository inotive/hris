@extends('crud.index')


@section('page_title')
    {{ __($page_title) }}
@stop

@section('toolbar_left')

@stop

@section('toolbar')
    <x-table.filter-dropdown :company="true" />
@stop

@section('table_header')
    <th class="min-w-10px">{{ __('ID') }}</th>
    @if (auth()->user()->company_id == null)
        <th class="min-w-125px">{{ __('Company') }}</th>
    @endif
    <th class="min-w-125px">{{ __('Employee') }}</th>
    <th class="min-w-125px">{{ __('Shift') }}</th>
    <th class="min-w-125px">{{ __('Date') }}</th>
    <th class="min-w-125px">{{ __('Check In') }}</th>
    <th class="min-w-125px">{{ __('Check Out') }}</th>
    <th class="text-end min-w-70px">{{ __('Action') }}</th>
@stop

@section('table_body')
    @foreach ($list as $key => $value)
        <tr>

            <td>{{ ($list->currentPage() - 1) * $list->perPage() + $key + 1 }}</td>
            @if (auth()->user()->company_id == null)
                <td>{{ $value->employee->company->name ?? '-' }}</td>
            @endif

            <td>{{ $value->employee->full_name ?? '-' }}</td>
            <td>{{ $value->employee_shift->name ?? '-' }}</td>
            <td>{{ \Carbon\Carbon::parse($value->date)->format('d M Y') }}</td>
            <td class="fs-8">
                {{ $value->clockin_time != null ? \App\Helpers\DateFormatHelper::formatTime($value->clockin_time) : '-' }}
                @if ($value->clockin_range_status != null)
                    <span
                        class="badge badge-light-{{ $value->clockin_range_status == 'IN' ? 'success' : 'danger' }} badge-dot">
                        {{ $value->clockin_range_status == 'IN' ? __('IN AREA') : __('OUT AREA') }}
                    </span>
                @endif
                @if ($value->clockin_image)
                    <br>
                    <a href="{{ Storage::url($value->clockin_image) }}" target="_blank">
                        <img src="{{ Storage::url($value->clockin_image) }}" width="40" height="40" style="object-fit: cover; border-radius: 4px; margin-top: 5px;" alt="Check In">
                    </a>
                @endif
            </td>
            <td class="fs-8">
                {{ $value->clockout_time != null ? \App\Helpers\DateFormatHelper::formatTime($value->clockout_time) : '-' }}
                @if ($value->clockout_range_status != null)
                    <span
                        class="badge badge-light-{{ $value->clockout_range_status == 'IN' ? 'success' : 'danger' }} badge-dot">
                        {{ $value->clockout_range_status == 'IN' ? __('IN AREA') : __('OUT AREA') }}
                    </span>
                @endif
                @if ($value->clockout_image)
                    <br>
                    <a href="{{ Storage::url($value->clockout_image) }}" target="_blank">
                        <img src="{{ Storage::url($value->clockout_image) }}" width="40" height="40" style="object-fit: cover; border-radius: 4px; margin-top: 5px;" alt="Check Out">
                    </a>
                @endif
            </td>

            <td class="text-end">
                <x-table.actions>
                    <x-table.edit-button :id="$value->id" />
                    <x-table.delete-button :id="$value->id" />
                </x-table.actions>
            </td>

        </tr>
    @endforeach
@endsection
