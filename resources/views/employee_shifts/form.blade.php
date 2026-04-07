<div class="row">

    <x-company-dropdown :value="old('company_id', $form->company_id ?? '')" />

    <x-form.input type="text" :label="__('Name')" name="name" :value="old('name', $form->name ?? '')" />
    <x-form.time type="time" :label="__('Start Time')" name="start_time" :value="old('start_time', isset($form->start_time) && $form->start_time ? $form->start_time->format('H:i') : '')" />
    <x-form.time type="time" :label="__('End Time')" name="end_time" :value="old('end_time', isset($form->end_time) && $form->end_time ? $form->end_time->format('H:i') : '')" />

    <x-form.switch label="Default" name="default" :value="old('default', $form->default ?? '')" />

    {{-- Working Days --}}
    <div class="col-12 mb-4">
        <label class="fs-6 fw-bold mb-3 d-block">{{ __('Working Days') }}</label>
        <div class="d-flex flex-wrap gap-3">
            @foreach ([
                'wd_monday'    => __('Monday'),
                'wd_tuesday'   => __('Tuesday'),
                'wd_wednesday' => __('Wednesday'),
                'wd_thursday'  => __('Thursday'),
                'wd_friday'    => __('Friday'),
                'wd_saturday'  => __('Saturday'),
                'wd_sunday'    => __('Sunday'),
            ] as $field => $label)
                <div class="form-check form-check-custom form-check-solid">
                    <input type="hidden" name="{{ $field }}" value="0">
                    <input class="form-check-input" type="checkbox"
                        name="{{ $field }}"
                        value="1"
                        id="{{ $field }}"
                        {{ old($field, $form->$field ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label fw-semibold" for="{{ $field }}">
                        {{ $label }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>

</div>