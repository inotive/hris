<div>


    <x-company-dropdown :value="old('company_id', $form->company_id ?? '')"/>

   <x-form.input type="text" :label="__('Name')" name="name" :value="old('name', $form->name ?? '')" />
   <x-form.textarea :label="__('Description')" name="description" :value="old('description', $form->description ?? '')" />

    <x-form.select label="Master Type" name="master_type" :list="\App\Models\EmployeePayslipMaster::master_type_dropdown()"  :value="old('is_overtime_request', $form->is_overtime_request ?? '')"/>
    <x-form.select label="Type" name="type" :list="\App\Models\EmployeePayslipMaster::type_dropdown()"  :value="old('is_overtime_request', $form->is_overtime_request ?? '')"/>


  
</div>


@section('js')
<script>

</script>
@stop