<div class="row">
  @if (isset($form))
  <div class="d-flex flex-wrap flex-sm-nowrap mt-8">
    <div class="me-7 mb-4">
      <div
        class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
        <img src="{{ Storage::url($form->logo) }}" alt="image" />
        <div
          class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border-4 border-white h-20px w-20px"></div>
      </div>
    </div>
    <div class="flex-grow-1">
      <div
        class="d-flex justify-content-between align-items-start flex-wrap mb-2">
        <div class="d-flex flex-column">
          <div class="d-flex align-items-center mb-2">
            <a
              href="#"
              class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1"
              >{{$form->name ?? ''}}</a
            >
            <a href="#">
              <span class="svg-icon svg-icon-1 svg-icon-primary">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="24px"
                  height="24px"
                  viewBox="0 0 24 24">
                  <path
                    d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z"
                    fill="#00A3FF"></path>
                  <path
                    class="permanent"
                    d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z"
                    fill="white"></path>
                </svg>
              </span>
            </a>
          </div>
          <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
            <a
              href="#"
              class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
              <span class="svg-icon svg-icon-4 me-1">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  fill="none">
                  <path
                    opacity="0.3"
                    d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z"
                    fill="black"></path>
                  <path
                    d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z"
                    fill="black"></path>
                </svg>
              </span>
              {{$form->city ?? ''}}</a
            >
            <a
              href="#"
              class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
              <span class="svg-icon svg-icon-4 me-1">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="20"
                  height="20"
                  fill="currentColor"
                  class="bi bi-telephone"
                  viewBox="0 0 20 20">
                  <path
                    d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z" />
                </svg>
              </span>
              {{$form->phone ?? ''}}</a
            >
            <a
              href="#"
              class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
              <span class="svg-icon svg-icon-4 me-1">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  fill="none">
                  <path
                    opacity="0.3"
                    d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z"
                    fill="black"></path>
                  <path
                    d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z"
                    fill="black"></path>
                </svg>
              </span>
              {{$form->email ?? ''}}</a
            >
          </div>
        </div>
      </div>
      <div class="d-flex flex-wrap align-items-center">
        <div class="d-flex flex-column pe-8">
          <div class="d-flex flex-wrap">
            <div
              class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
              <div class="fs-2 fw-bolder counted" data-kt-countup-value="123">
                123
              </div>
              <div class="fw-bold fs-6 text-gray-400">Total Employee</div>
            </div>
            <div
              class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
              <div class="fs-2 fw-bolder counted" data-kt-countup-value="123">
                4
              </div>
              <div class="fw-bold fs-6 text-gray-400">Total User</div>
            </div>
          </div>
        </div>
        <div
          class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
          <div class="d-flex justify-content-between w-100 mt-auto mb-2">
            <span class="fw-bold fs-6 text-gray-400"
              >Days Left Subscription</span
            >
            <span class="fw-bolder fs-6">47</span>
          </div>
          <div class="h-5px mx-3 w-100 bg-light mb-3">
            <div
              class="bg-warning rounded h-5px"
              role="progressbar"
              style="width: 10%"
              aria-valuenow="47"
              aria-valuemin="0"
              aria-valuemax="360"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <x-company-edit-tab :companyid="$form->id" :tab="'edit'" />
  @endif

  <h4>{{ __("Company Basic Information") }}</h4>
  <div>
    <hr />
  </div>
  <x-form.input
    type="text"
    :label="__('Name')"
    name="name"
    :value="old('name', $form->name ?? '')" />
  <x-form.input
    type="email"
    :label="__('Email')"
    name="email"
    :value="old('email', $form->email ?? '')" />
  <x-form.phone
    :label="__('Phone')"
    name="phone"
    :value="old('phone', $form->phone ?? '')" />
  <x-form.select
    :list="['backward' => 'Backward', 'current' => 'Current']"
    label="Cut Off Payroll Method"
    name="cut_off_payroll_method"
    :value="old('cut_off_payroll_method', $form->cut_off_payroll_method ?? '')" />
  <x-form.number
    min="1"
    max="31"
    :label="__('Cut Off Payroll Date')"
    name="cut_off_payroll_date"
    :value="old('cut_off_payroll_date', $form->cut_off_payroll_date ?? '')" />
  <x-form.select
    :list="['none' => 'None', 'gross' => 'Gross', 'gross-up' => 'Gross Up']"
    label="Tax Calculation Method"
    name="tax_calculation_method"
    :value="old('tax_calculation_method', $form->tax_calculation_method ?? '')" />

  <x-form.image-picker
    :label="__('Logo')"
    name="logo"
    folder="companies"
    :value="old('logo', $form->logo ?? '')" />

  <x-form.switch
    label="Status"
    name="status"
    :value="old('status', $form->status ?? '')" />

  <h4>{{ __("Company Address Information") }}</h4>
  <div>
    <hr />
  </div>
  <x-form.textarea
    :label="__('Address')"
    name="address"
    :value="old('address', $form->address ?? '')" />
  <x-form.input
    type="text"
    label="Sub District"
    name="sub_district"
    :value="$form->sub_district ?? ''" />
  <x-form.input
    type="text"
    label="District"
    name="district"
    :value="$form->district ?? ''" />
  <x-form.input
    type="text"
    label="City"
    name="city"
    :value="$form->city ?? ''" />
  <x-form.input
    type="text"
    label="Province"
    name="province"
    :value="$form->province ?? ''" />
  <x-form.input
    type="text"
    label="Country"
    name="country"
    :value="$form->country ?? ''" />
  <x-form.number
    type="text"
    label="Postal Code"
    name="zip_code"
    :value="$form->zip_code ?? ''" />

  <x-time-zone-dropdown :value="old('time_zone', $form->time_zone ?? '')" />

  <div class="col-12 col-lg-6 mb-4 row">
    <x-form.input
      type="text"
      label="Latitude"
      name="lat"
      :value="$form->lat ?? ''" />
    <x-form.input
      type="text"
      label="Longitude"
      name="lng"
      :value="$form->lng ?? ''" />
  </div>

  <h4>{{ __("Company Menu Config") }}</h4>
  <div>
    <hr />
  </div>
  <x-form.switch
    label="Leave Request"
    name="is_leave_request"
    :value="old('is_leave_request', $form->is_leave_request ?? '')" />
  <x-form.switch
    label="Overtime Request"
    name="is_overtime_request"
    :value="old('is_overtime_request', $form->is_overtime_request ?? '')" />
  <x-form.switch
    label="Reimbursement Request"
    name="is_reimbursement_request"
    :value="old('is_reimbursement_request', $form->is_reimbursement_request ?? '')" />
  <x-form.switch
    label="Attendance"
    name="is_attendance"
    :value="old('is_attendance', $form->is_attendance ?? '')" />
  <x-form.switch
    label="EWA"
    name="is_ewa"
    :value="old('is_ewa', $form->is_ewa ?? '')" />
  <x-form.switch
    label="Payslip"
    name="is_payslip"
    :value="old('is_payslip', $form->is_payslip ?? '')" />
</div>
