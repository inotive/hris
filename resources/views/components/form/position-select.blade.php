@props([
    'name' => '',
    'label' => __('Manager'),
    'value' => null,
    'list' => [],
    'required'  => false,
])

<div class="col-12 col-lg-6 mb-4" id="{{ $name }}_div">

    <label class="{{ $required == true ? 'required ' : '' }} fs-6 fw-bold mb-2">{{ __($label) }}</label>


    <select class="form-select form-select-solid employee-position" id="{{ $name }}" name="{{ $name }}" data-control="select2" data-placeholder="{{ __('Select an option') }}">
        <option></option>
        @foreach ($list as $key => $val)
            <option data-department-id="{{ $val->department_id }}" value="{{ $val->id }}" {{ $val->id == $value ? ' selected ' : '' }}>{{ $val->name ?? '-' }}</option>
        @endforeach
    </select>


    <div class="fv-plugins-message-container invalid-feedback {{ $name }}-error">
        @error($name)
            {{ $message }}
        @enderror
    </div>
</div>
