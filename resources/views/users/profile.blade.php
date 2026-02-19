<div class="row">
    @if (session('messages.success'))
        <div class="alert alert-success">
            {{ session('messages.success') }}
        </div>
    @endif

    <x-form.input :required="true" type="text" :label="__('First Name')" name="first_name" :value="old('first_name', $form->first_name ?? '')" />
    <x-form.input :required="true" type="text" :label="__('Last Name')" name="last_name" :value="old('last_name', $form->last_name ?? '')" />

    <x-form.input :required="true" type="email" :label="__('Email')" name="email" :value="old('email', $form->email ?? '')" />
    <x-form.input :required="true" type="phone" :label="__('Phone')" name="phone" :value="old('phone', $form->phone ?? '')" />

    <x-form.image-picker :label="__('Image')" name="image" folder="users" :value="old('image', $form->image ?? '')" />

</div>