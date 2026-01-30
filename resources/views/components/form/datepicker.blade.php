@props([
    'name' => '',
    'label' => '',
    'value' => null,
    'placeholder' => '',
    'required' => false,
    'class' => 'col-12 col-lg-6 mb-4',
    'add_class' => '',
    'disabled' => false,
])

<div class="{{ $class }}" id="{{ $name }}_div">

    @if ($label != null && strlen($label) > 0)
    <label class="{{ $required == true ? 'required ' : '' }} fs-6 fw-bold mb-2">{{ __($label) }}</label>
    @endif


    <div class="input-group input-group-solid mb-3">

        <input type="text" class="form-control form-control-solid datepickersingle {{ $add_class }}" placeholder="{{ $placeholder }}"
        name="{{ $name }}" value="{{ old($name, $value != null ? \Carbon\Carbon::parse($value)->format('d/m/Y') : '') }}" {{ $disabled == true ? ' disabled ' : '' }}>

        <span class="input-group-text border-0"><i class="fa fa-fw fa-calendar"></i></span>
    </div>

    <div class="fv-plugins-message-container invalid-feedback {{ $name }}-error">
        @error($name)
            {{ $message }}
        @enderror
    </div>


</div>
