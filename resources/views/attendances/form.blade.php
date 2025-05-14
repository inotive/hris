<div class="row">

    <x-company-dropdown :value="old('company_id', $form->employee->company_id ?? '')" />
    <x-employee-dropdown required :value="old('employee_id', $form->employee_id ?? '')" />
    <x-form.datepicker :label="__('Date')" name="date" :value="old('date', $form->date ?? '')" />



    <x-form.timepicker required :label="__('Clock In Time')" name="clockin_time" :value="old(
        'clockin_time',
        $form?->clockin_time != null ? \Carbon\Carbon::parse($form->clockin_time)->format('H:i:s') : '',
    )" />
    {{-- <x-form.input class="col-12 col-lg-3" type="text" :label="__('Clock In Latitude')" name="clockin_lat" :value="old('clockin_lat', $form->clockin_lat ?? '')" />
    <x-form.input class="col-12 col-lg-3" type="text" :label="__('Clock In Longitude')" name="clockin_long" :value="old('clockin_long', $form->clockin_long ?? '')" /> --}}





    {{-- <x-form.image-picker :label="__('Clock In Image')" folder="attendances" name="clockin_image" :value="old('clockin_image', $form->clockin_image ?? '')" /> --}}



    {{-- <h4>{{ __('Check Out') }}</h4>
    <hr> --}}


    <x-form.timepicker required :label="__('Clock Out Time')" name="clockout_time" :value="old(
        'clockout_time',
        $form?->clockout_time != null ? \Carbon\Carbon::parse($form->clockout_time)->format('H:i:s') : '',
    )" />
    {{-- <x-form.image-picker :label="__('Clock In Image')" folder="attendances" name="clockout_image" :value="old('clockout_image', $form->clockout_image ?? '')" /> --}}


    {{-- <x-form.input class="col-12 col-lg-3" type="text" :label="__('Clock Out Latitude')" name="clockout_lat" :value="old('clockout_lat', $form->clockout_lat ?? '')" />
    <x-form.input class="col-12 col-lg-3" type="text" :label="__('Clock Out Longitude')" name="clockout_long" :value="old('clockout_long', $form->clockout_long ?? '')" /> --}}


        <div class="col-12 mb-4 row">
            <x-form.input-map :label="__('Clock In Coordinate')" 
            
            lat_input="clockin_lat"
            lng_input="clockin_long"
            :lat="$form->clockin_lat??0" :lng="$form->clockin_long??0" />
        </div>



        <div class="col-12 mb-4 row">
            <x-form.input-map :label="__('Clock Out Coordinate')" 
                lat_input="clockout_lat"
                lng_input="clockout_long"

                :lat="$form->clockout_lat??0" :lng="$form->clockout_long??0" />
        </div>

</div>
