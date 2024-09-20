<div class="row">

    <x-employee-dropdown />
    <x-employee-shift-dropdown />
    <x-form.datepicker :label="__('Date')" name="date" :value="old('date', $form->date ?? '')" />


    <h4>{{ __('Check In') }}</h4>
    <hr>
    <x-form.timepicker :label="__('Clock In Time')" name="clockin_time" :value="old('clockin_time', $form->clockin_time ?? '')" />
    <x-form.image-picker :label="__('Clock In Image')" folder="attendances" name="clockin_image" :value="old('clockin_image', $form->clockin_image ?? '')" />


    <x-form.input type="text" :label="__('Clock In Latitude')" name="clockin_lat" :value="old('clockin_lat', $form->clockin_lat ?? '')" />
    <x-form.input type="text" :label="__('Clock In Longitude')" name="clockin_long" :value="old('clockin_long', $form->clockin_long ?? '')" />


    <h4>{{ __('Check Out') }}</h4>
    <hr>
    <x-form.timepicker :label="__('Clock In Time')" name="clockout_time" :value="old('clockout_time', $form->clockout_time ?? '')" />
    <x-form.image-picker :label="__('Clock In Image')" folder="attendances" name="clockout_image" :value="old('clockout_image', $form->clockout_image ?? '')" />


    <x-form.input type="text" :label="__('Clock In Latitude')" name="clockout_lat" :value="old('clockout_lat', $form->clockout_lat ?? '')" />
    <x-form.input type="text" :label="__('Clock In Longitude')" name="clockout_long" :value="old('clockout_long', $form->clockout_long ?? '')" />


</div>
