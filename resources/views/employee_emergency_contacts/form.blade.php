<div>


    <x-employee-dropdown :value="old('employee_id', $form->employee_id ?? '')"/>
    <x-family-relation-dropdown :value="old('family_relation', $form->family_relation ?? '')"/>

   <x-form.input type="text" :label="__('Name')" name="name" :value="old('name', $form->name ?? '')" />
    <x-form.input type="text" :label="__('Phone')" name="phone" :value="old('phone', $form->phone ?? '')" />


  
</div>


@section('js')
<script>

</script>
@stop