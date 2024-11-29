<div class="mb-4">
    <div class="row">
        <div class="col-6">
            <select class="form-select form-select-solid table-filter filter-month" id="filter-month"
                name="filter[month]" data-data-id="" data-data-name="" data-placeholder="{{ __('Month') }}">
                <option></option>
                @foreach ($months as $key => $value)
                    <option value="{{ $value['key'] }}" {{ $month_selected == $value['key'] ? ' selected ' : '' }}>{{ $value['value'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-6">
            <select class="form-select form-select-solid table-filter filter-year" id="filter-year"
                name="filter[year]" data-data-id="" data-data-name="" data-placeholder="{{ __('Year') }}">
                <option></option>
                @foreach ($years as $key => $value)
                    <option value="{{ $value['key'] }}" {{ $year_selected ? ' selected ' : '' }}>{{ $value['value'] }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
