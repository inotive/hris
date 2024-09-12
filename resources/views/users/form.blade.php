<div>



    <x-form.input type="text" :label="__('First Name')" name="first_name" :value="old('first_name', $form->first_name ?? '')" />
    <x-form.input type="text" :label="__('Last Name')" name="last_name" :value="old('last_name', $form->last_name ?? '')" />

  <x-form.input type="email" :label="__('Email')" name="email" :value="old('email', $form->email ?? '')" />

    


</div>