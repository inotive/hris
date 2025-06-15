<div class="row">
    <x-company-dropdown required :value="old('company_id', $form->company_id ?? '')" />

    <x-form.input required type="text" :label="__('Department Name')" name="name" :value="old('name', $form->name ?? '')" />
    <x-form.textarea required :label="__('Description')" name="description" :value="old('description', $form->description ?? '')" />
        <x-head-department-employee-dropdown :value="old('head_departmen_id', $form->head_departmen_id ?? '')" />






</div>
