@props([
    'name' => '',
    'label' => '',
    'value' => null,
    'list'  => [],
])

<div class="fv-row mb-7 fv-plugins-icon-container">

    <label class="required fs-6 fw-bold mb-2">{{ $label }}</label>


    <select class="form-control form-control-solid" name="{{ $name }}">
        @foreach ($list as $key => $val)
            <option value="{{ $key }}" {{ $key == $value ? ' selected ' : '' }}>{{ $val }}</option>
        @endforeach
    </select>


    @error($name)
            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
    @enderror
</div>