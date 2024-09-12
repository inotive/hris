<div class="form-group mb-2 mb20">
    <label for="{{ $field }}" class="form-label">{{ $label }}</label>
    <select name="{{ $field }}" class="form-control @error($field) is-invalid @enderror">
        <option>== PILIH ==</option>
        @foreach ($list as $key => $val) 
            <option value="{{ $key }}" {{ $value == $key ? ' selected ' : '' }}>{{ $val }}</option>
        @endforeach
    </select>
    {!! $errors->first($field, '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
</div>