<div>


    <x-company-dropdown :value="old('company_id', $form->company_id ?? '')"/>
    <x-employee-department-dropdown :value="old('department_id', $form->department_id ?? '')" />

    <x-form.input type="text" :label="__('Name')" name="name" :value="old('name', $form->name ?? '')" />
    <x-form.textarea  :label="__('Description')" name="description" :value="old('description', $form->description ?? '')" />


  
</div>


@section('js')
<script>

</script>
@stop