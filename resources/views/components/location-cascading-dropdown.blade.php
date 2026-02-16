@props(['country' => '', 'province' => '', 'city' => '', 'district' => '', 'subDistrict' => '', 'zipCode' => null])



<div class="row">
    {{-- Country (Select) --}}
    <div class="col-12 col-lg-6 mb-4">
        <label for="country" class="fs-6 fw-bold mb-2">Country</label>
        <select name="country" id="country" class="form-select form-select-solid" data-control="select2" required>
            <option value="">Select Country</option>
        </select>
    </div>

    {{-- Province (Select) --}}
    <div class="col-12 col-lg-6 mb-4">
        <label for="province" class="fs-6 fw-bold mb-2">Province</label>
        <select name="province" id="province" class="form-select form-select-solid" data-control="select2" required
            disabled>
            <option value="">Select Province</option>
        </select>
    </div>

    {{-- City (Select) --}}
    <div class="col-12 col-lg-6 mb-4">
        <label for="city" class="fs-6 fw-bold mb-2">City</label>
        <select name="city" id="city" class="form-select form-select-solid" data-control="select2" required disabled>
            <option value="">Select City</option>
        </select>
    </div>

    {{-- District (Hybrid) --}}
    <div class="col-12 col-lg-6 mb-4">
        <label for="district" class="fs-6 fw-bold mb-2">District</label>
        <input type="text" list="district_list" name="district" id="district" class="form-control form-control-solid"
            value="{{ $district }}" placeholder="Select or Type District" autocomplete="off">
        <datalist id="district_list"></datalist>
    </div>

    {{-- Sub District (Hybrid) --}}
    <div class="col-12 col-lg-6 mb-4">
        <label for="sub_district" class="fs-6 fw-bold mb-2">Sub District</label>
        <input type="text" list="sub_district_list" name="sub_district" id="sub_district"
            class="form-control form-control-solid" value="{{ $subDistrict }}" placeholder="Select or Type Sub District"
            autocomplete="off">
        <datalist id="sub_district_list"></datalist>
    </div>

    {{-- Zip Code --}}
    @if(!is_null($zipCode))
        <div class="col-12 col-lg-6 mb-4">
            <label for="zip_code" class="fs-6 fw-bold mb-2">Postal Code</label>
            <input type="text" name="zip_code" id="zip_code" class="form-control form-control-solid" value="{{ $zipCode }}"
                placeholder="Postal Code" autocomplete="off">
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const inputs = {
            country: document.getElementById('country'),
            province: document.getElementById('province'),
            city: document.getElementById('city'),
            district: document.getElementById('district'),
            sub_district: document.getElementById('sub_district')
        };

        const lists = {
            district: document.getElementById('district_list'),
            sub_district: document.getElementById('sub_district_list')
        };

        // Initial Values
        const initialValues = {
            country: '{{ $country }}',
            province: '{{ $province }}',
            city: '{{ $city }}'
        };

        // Initialize Select2 for dropdowns
        $(inputs.country).select2({
            placeholder: 'Select Country',
            allowClear: true,
            width: '100%'
        });

        $(inputs.province).select2({
            placeholder: 'Select Province',
            allowClear: true,
            width: '100%'
        });

        $(inputs.city).select2({
            placeholder: 'Select City',
            allowClear: true,
            width: '100%'
        });

        // 1. Load Countries
        loadCountries();

        // Event Listeners for Selects (using Select2 events)
        $(inputs.country).on('change', function () {
            const val = this.value;
            resetSelect(inputs.province, 'Select Province');
            resetSelect(inputs.city, 'Select City');
            // Clear children text inputs
            inputs.district.value = ''; lists.district.innerHTML = '';
            inputs.sub_district.value = ''; lists.sub_district.innerHTML = '';

            if (val) loadOptions(`/api/locations/provinces?country_id=${val}`, inputs.province, 'Select Province');
        });

        $(inputs.province).on('change', function () {
            const val = this.value;
            resetSelect(inputs.city, 'Select City');
            inputs.district.value = ''; lists.district.innerHTML = '';
            inputs.sub_district.value = ''; lists.sub_district.innerHTML = '';

            if (val) loadOptions(`/api/locations/cities?province_id=${val}`, inputs.city, 'Select City');
        });

        $(inputs.city).on('change', function () {
            const val = this.value;
            inputs.district.value = ''; lists.district.innerHTML = '';
            inputs.sub_district.value = ''; lists.sub_district.innerHTML = '';
            if (val) loadDataList(`/api/locations/districts?city_id=${val}`, lists.district);
        });

        // Event Listeners for Text Inputs (District/SubDistrict)
        inputs.district.addEventListener('change', () => {
            lists.sub_district.innerHTML = '';
            if (inputs.district.value) loadDataList(`/api/locations/sub-districts?district_id=${inputs.district.value}`, lists.sub_district);
        });


        // --- Functions ---

        async function loadCountries() {
            await loadOptions('/api/locations/countries', inputs.country, 'Select Country', initialValues.country);

            // Cascade load if initial value exists
            if (initialValues.country) {
                await loadOptions(`/api/locations/provinces?country_id=${initialValues.country}`, inputs.province, 'Select Province', initialValues.province);
            }
            if (initialValues.province) {
                await loadOptions(`/api/locations/cities?province_id=${initialValues.province}`, inputs.city, 'Select City', initialValues.city);
            }
            if (initialValues.city) {
                loadDataList(`/api/locations/districts?city_id=${initialValues.city}`, lists.district);
            }
            const distVal = '{{ $district }}';
            if (distVal) {
                loadDataList(`/api/locations/sub-districts?district_id=${distVal}`, lists.sub_district);
            }
        }

        async function loadOptions(url, selectElement, placeholder, selectedValue = null) {
            try {
                $(selectElement).prop('disabled', true);
                const res = await fetch(url);
                const data = await res.json();

                selectElement.innerHTML = `<option value="">${placeholder}</option>`;
                data.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.name; // Use Name as Value
                    option.text = item.name;
                    if (selectedValue && item.name === selectedValue) option.selected = true;
                    selectElement.appendChild(option);
                });

                // Trigger Select2 to update
                $(selectElement).trigger('change.select2');
                $(selectElement).prop('disabled', false);
            } catch (e) {
                console.error(e);
            }
        }

        async function loadDataList(url, listElement) {
            try {
                const res = await fetch(url);
                const data = await res.json();
                listElement.innerHTML = '';
                data.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.name;
                    listElement.appendChild(option);
                });
            } catch (e) {
                console.error(e);
            }
        }

        function resetSelect(selectElement, placeholder) {
            selectElement.innerHTML = `<option value="">${placeholder}</option>`;
            $(selectElement).prop('disabled', true);
            $(selectElement).trigger('change.select2');
        }
    });
</script>