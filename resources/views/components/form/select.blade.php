@props([
    'name' => '',
    'label' => __('Select'),
    'value' => null,
    'data_name' => null,
    'list' => [],
    'required'  => false,
    'class' => 'col-12 col-lg-6 mb-4',
    'add_class' => '',
])

<div class="{{ $class }}" id="{{ $name }}_div">

    <label class="{{ $required == true ? 'required ' : '' }} fs-6 fw-bold mb-2">{{ __($label) }}</label>

    <select class="form-select form-select-solid {{ $add_class ?? '' }}" data-control="select2" id="{{ $name }}" name="{{ $name }}" data-placeholder="{{ __('Select an option') }}" data-data-id="{{ $value ?? '' }}" data-data-name="{{ $data_name ?? '' }}">
        <option></option>
        @foreach ($list as $key => $val)
            <option value="{{ $key }}" {{ $key == $value ? ' selected ' : '' }}>{{ $val ?? '-' }}</option>
        @endforeach
    </select>


    <div class="fv-plugins-message-container invalid-feedback {{ $name }}-error">
        @error($name)
            {{ $message }}
        @enderror
    </div>
</div>
