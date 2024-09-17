<div>


    <x-company-dropdown :value="old('company_id', $form->company_id ?? '')" />

    <x-form.select label="Payslip Type" name="payslip_type" :list="\App\Models\EmployeePayslipMaster::master_type_dropdown()" :value="old('payslip_type', $form->payslip_type ?? '')" />

    <x-employee-payslip-master-dropdown :value="old('employee_payslip_master_earning_id', $form->employee_payslip_master_earning_id ?? '')" />

    <x-form.input type="number" :label="__('Value')" name="value" :value="old('value', $form->value ?? '')" />



</div>


@section('js')
    <script></script>
@stop
