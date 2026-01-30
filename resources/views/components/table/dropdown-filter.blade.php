<div class="mb-4">
    <select class="form-select form-select-solid table-filter {{ $name }}" id="{{ $name }}" name="filter[{{ $name }}]" data-data-id="{{ $value ?? '' }}" data-data-name="{{ $value_name ?? '' }}"  data-placeholder="{{ __($placeholder) }}">
        <option></option>
        @foreach ($list as $key => $val)
            <option value="{{ $key }}" {{ $key == $value ? ' selected ' : '' }}>{{ $val ?? '-' }}</option>
        @endforeach
        
    </select>
</div>