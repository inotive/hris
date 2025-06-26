@props([
    'name' => 'filter[daterange]',
    'label' => '',
    'value' => null,
    'placeholder' => '',
    'required' => false,
    'class' => 'col-12',
    'add_class' => '',
])
<div class="{{ $class }}" id="{{ $name }}_div">


    @php
        $defaultStart = now()->startOfMonth()->format('d/m/Y');
        $defaultEnd = now()->endOfMonth()->format('d/m/Y');
        $daterange = request()->input('filter.daterange');

        if ($daterange && strpos($daterange, ' - ') !== false) {
            [$start, $end] = explode(' - ', $daterange);
            try {
                $startFormatted = \Carbon\Carbon::createFromFormat('d/m/Y', trim($start))->format('d/m/Y');
                $endFormatted = \Carbon\Carbon::createFromFormat('d/m/Y', trim($end))->format('d/m/Y');
                $value = "$startFormatted - $endFormatted";
            } catch (\Exception $e) {
                $value = "$defaultStart - $defaultEnd";
            }
        } else {
            $value = "$defaultStart - $defaultEnd";
        }
    @endphp

    <div class="input-group input-group-solid mb-3">
        <input type="text" class="form-control form-control-solid table-daterangepicker {{ $add_class }}"
            placeholder="{{ $placeholder }}" name="{{ $name }}" value="{{ $value }}">
        <span class="input-group-text border-0">
            <i class="fa fa-fw fa-calendar"></i>
        </span>
    </div>

</div>
