<div class="row">

    <x-head-department-employee-dropdown :value="old('head_departmen_id', $form->head_departmen_id ?? '')" />


    <x-form.input type="text" :label="__('Name')" name="name" :value="old('name', $form->name ?? '')" />
    <x-form.textarea :label="__('Description')" name="description" :value="old('description', $form->description ?? '')" />




    <x-company-dropdown :value="old('company_id', $form->company_id ?? '')" />
</div>
