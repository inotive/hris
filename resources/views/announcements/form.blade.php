<div class="row">


    <x-company-dropdown :value="old('company_id', $form->company_id ?? '')" />
    <x-for-employee-dropdown :value="old('for_employee_id', $form->for_employee_id ?? '')" />


    <x-form.input type="text" :label="__('Title')" name="title" :value="old('title', $form->title ?? '')" />
    <x-form.textarea :label="__('Content')" name="content" :value="old('content', $form->content ?? '')" />
    <x-form.textarea :label="__('Reference')" name="reference" :value="old('reference', $form->reference ?? '')" />

</div>
