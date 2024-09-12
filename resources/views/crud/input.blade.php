<div class="form-group mb-2 mb20">
    <label for="image" class="form-label">{{ $label }}</label>
    <input type="text" name="{{ $field }}" class="form-control @error($field) is-invalid @enderror" value="{{ old($field, $value) }}" id="{{ $field }}" placeholder="{{ $label }}">
    {!! $errors->first($field, '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
</div>