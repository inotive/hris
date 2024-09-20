<div class="row">

    <x-employee-dropdown />
    <x-employee-shift-dropdown />
    <x-form.datepicker :label="__('Date')" name="date" :value="old('date', $form->date ?? '')" />
    

    <h4>{{ __('Check In') }}</h4>
    <hr>
    <x-form.timepicker :label="__('Date')" name="checkin_time" :value="old('checkin_time', $form->checkin_time ?? '')" />
    



    <x-form.textarea :label="__('Link')" name="link" :value="old('link', $form->link ?? '')" />

        <x-form.switch label="Status" name="status" :value="old('status', $form?->status == true ? 1 : 0)" />
</div>

