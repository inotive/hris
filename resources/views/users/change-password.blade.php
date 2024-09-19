<div class="row">
    @if (session('messages.success'))
        <div class="alert alert-success">
            {{ session('messages.success') }}
        </div>
    @endif

    @if ($form->id == auth()->user()->id && auth()->user()->password_updated_at == null)
        <div class="col-12">
            <div class="alert alert-warning">{{ __('You have not changed your password yet, please change your password first.') }}</div>
        </div>
    @endif
    <x-form.input type="text" :label="__('Password')" name="password" :value="old('password', '')" />
    <x-form.input type="text" :label="__('Re Password')" name="password_confirmation" :value="old('password_confirmation', '')" />

</div>

