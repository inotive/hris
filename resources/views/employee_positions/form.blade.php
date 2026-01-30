<div class="row">


    <x-company-dropdown :value="old('company_id', $form->company_id ?? '')"/>
    <x-employee-department-dropdown required :value="old('department_id', $form->department_id ?? '')" />

    <x-form.input required type="text" :label="__('Name')" name="name" :value="old('name', $form->name ?? '')" />
    <x-form.textarea required :label="__('Description')" name="description" :value="old('description', $form->description ?? '')" />


  
</div>
