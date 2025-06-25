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


    <div class="input-group input-group-solid mb-3">

        <input type="text" class="form-control form-control-solid table-daterangepicker {{ $add_class }}" placeholder="{{ $placeholder }}"
        name="{{ $name }}" value="{{ isset(request()->filter['daterange']) ? \Carbon\Carbon::parse(explode(' - ', request()->filter['daterange'])[0])->format('d/m/Y') . ' - ' . \Carbon\Carbon::parse(explode(' - ', request()->filter['daterange'])[1])->format('d/m/Y') : date('01/m/Y') . ' - ' . date('t/m/Y') }}">

        <span class="input-group-text border-0"><i class="fa fa-fw fa-calendar"></i></span>
    </div>


</div>
