<div class="row">

    <x-company-dropdown :value="old('company_id', $form->company_id ?? '')" />

    <x-form.input type="text" :label="__('Name')" name="name" :value="old('name', $form->name ?? '')" />
    <x-form.time type="time" :label="__('Start Time')" name="start_time" :value="old('start_time', isset($form->start_time) && $form->start_time ? $form->start_time->format('H:i') : '')" />
    <x-form.time type="time" :label="__('End Time')" name="end_time" :value="old('end_time', isset($form->end_time) && $form->end_time ? $form->end_time->format('H:i') : '')" />

    <x-form.switch label="Default" name="default" :value="old('default', $form->default ?? '')" />



</div>