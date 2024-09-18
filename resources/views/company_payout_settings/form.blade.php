<div class="row">


    <x-company-dropdown :value="old('company_id', $form->company_id ?? '')" />

    <x-form.input type="date" :label="__('Date')" name="date" :value="old('date', $form->date ?? '')" />


</div>


@section('js')
    <script></script>
@stop
