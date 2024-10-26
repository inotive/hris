<div class="row">
    @if (isset($form))
        <x-company-edit-tab :companyid="$form->id" :tab="'edit'" />
    @endif

    <h4>{{ __('Basic Information') }}</h4>
    <hr>
    <x-form.input type="text" :label="__('Name')" name="name" :value="old('name', $form->name ?? '')" />
</div>
