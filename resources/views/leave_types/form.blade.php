<div class="row">


    <x-company-dropdown :value="old('company_id', $form->company_id ?? '')" />


    <x-form.input type="text" :label="__('Name')" name="name" :value="old('name', $form->name ?? '')" />
    <x-form.number :label="__('Days Limit')" name="days_limit" :value="old('name', $form->days_limit ?? '')" />
</div>
