<form method="GET">
    <select class="form-select form-select-solid table-filter" id="{{ $name }}" name="filter[{{ $name }}]"  data-placeholder="{{ __($placeholder) }}">
        <option></option>
        @foreach ($list as $key => $val)
            <option value="{{ $key }}" {{ $key == $value ? ' selected ' : '' }}>{{ $val ?? '-' }}</option>
        @endforeach
        
    </select>
</form>
