@props([
    'name' => '',
    'label' => '',
    'value' => null,
    'placeholder' => '',
    'required' => false,
])

<div class="col-12 col-lg-6 mb-4">

    <label class="{{ $required == true ? 'required ' : '' }} fs-6 fw-bold mb-2">{{ __($label) }}</label>


    <div class="input-group input-group-solid mb-3">

        <input type="text" class="form-control form-control-solid datepicker" placeholder="{{ $placeholder }}"
        name="{{ $name }}" value="{{ old($name, $value != null ? \Carbon\Carbon::parse($value)->format('d/m/Y') : '') }}">

        <span class="input-group-text border-0"><i class="fa fa-fw fa-calendar"></i></span>
    </div>

    <div class="fv-plugins-message-container invalid-feedback {{ $name }}-error">
        @error($name)
            {{ $message }}
        @enderror
    </div>

</div>
