<div class="row">

    <x-form.input type="text" :label="__('Name')" name="name" :value="old('name', $form->name ?? '')" />
    <x-company-dropdown :value="old('company_id', $form->company_id ?? '')" />

</div>
