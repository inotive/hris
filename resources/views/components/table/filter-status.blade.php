@props([
    'selected' => null,
    'name' => 'status',
    'placeholder' => 'Status'
])
<div class="d-flex flex-row gap-4">

    <select class="form-select form-select-solid table-filter filter-{{ $name }}" id="filter-{{ $name }}" name="filter[{{ $name }}]"
        data-data-id="" data-data-name="" data-placeholder="{{ $placeholder }}">
        <option></option>
        <option value="YES" {{ $selected == 'YES' ? ' selected ' : '' }}>{{ __('Yes') }}</option>
        <option value="NO" {{ $selected == 'NO' ? ' selected ' : '' }}>{{ __('No') }}</option>
    </select>


</div>
