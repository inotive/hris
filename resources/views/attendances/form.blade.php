<div class="row">

    <x-company-dropdown :value="old('company_id', $form->employee->company_id ?? '')" />
    <x-employee-dropdown required :value="old('employee_id', $form->employee_id ?? '')" />
    <x-form.datepicker :label="__('Date')" name="date" :value="old('date', $form->date ?? '')" />
    <div class="col-12 col-lg-6 mb-4"></div>


    <x-form.timepicker required :label="__('Clock In Time')" name="clockin_time" :value="old(
        'clockin_time',
        $form?->clockin_time != null ? \Carbon\Carbon::parse($form->clockin_time)->format('H:i:s') : '',
    )" />

    <x-form.timepicker required :label="__('Clock Out Time')" name="clockout_time" :value="old(
        'clockout_time',
        $form?->clockout_time != null ? \Carbon\Carbon::parse($form->clockout_time)->format('H:i:s') : '',
    )" />

    @if (isset($form) && $form->clockin_image)
        <div class="col-12 col-lg-6 mb-4">
            <label class="form-label">{{ __('Clock In Image') }}</label><br>
            <a href="{{ Storage::url($form->clockin_image) }}" target="_blank">
                <img src="{{ Storage::url($form->clockin_image) }}" height="200" style="object-fit: contain; border-radius: 8px; border: 1px solid #ccc;" alt="Check In Image">
            </a>
        </div>
    @else
        <div class="col-12 col-lg-6 mb-4"></div>
    @endif

    @if (isset($form) && $form->clockout_image)
        <div class="col-12 col-lg-6 mb-4">
             <label class="form-label">{{ __('Clock Out Image') }}</label><br>
             <a href="{{ Storage::url($form->clockout_image) }}" target="_blank">
                 <img src="{{ Storage::url($form->clockout_image) }}" height="200" style="object-fit: contain; border-radius: 8px; border: 1px solid #ccc;" alt="Check Out Image">
             </a>
        </div>
    @else
        <div class="col-12 col-lg-6 mb-4"></div>
    @endif

        <div class="col-12 mb-4 row">
            <x-form.input-map :label="__('Clock In Coordinate')" 
            
            lat_input="clockin_lat"
            lng_input="clockin_long"
            :lat="$form->clockin_lat ?? auth()->user()->company->lat ?? 0" :lng="$form->clockin_long ?? auth()->user()->company->lng ?? 0" />
        </div>



        <div class="col-12 mb-4 row">
            <x-form.input-map :label="__('Clock Out Coordinate')" 
                lat_input="clockout_lat"
                lng_input="clockout_long"

                :lat="$form->clockout_lat ?? auth()->user()->company->lat ?? 0" :lng="$form->clockout_long ?? auth()->user()->company->lng ?? 0" />
        </div>

</div>
