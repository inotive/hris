<div class="row">


    <x-company-dropdown :value="old('company_id', $form->company_id ?? '')" />

    <x-form.input type="text" :label="__('Name')" name="name" :value="old('name', $form->name ?? '')" />
    <x-form.time type="time" :label="__('Start Time')" name="start_time" :value="old('start_time', $form->start_time ?? '')" />
    <x-form.time type="time" :label="__('End Time')" name="end_time" :value="old('end_time', $form->end_time ?? '')" />

    <x-form.switch label="Default" name="default" :value="old('default', $form->default ?? '')"/>



    </div>

