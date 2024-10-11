<div class="row">

    <x-form.input type="text" :label="__('Type TER')" name="type_ter" :value="old('type_ter', $form->type_ter ?? '')" />
    <x-form.currency :label="__('Start')" name="value_start" :value="old('value_start', $form->value_start ?? '')" />
    <x-form.currency :label="__('End')" name="value_end" :value="old('value_end', $form->value_end ?? '')" />
    <x-form.decimal :label="__('Value Percent (%)')" min="0" max="100" step="0.01" name="value" :value="old('value', $form->value ?? '')" />
</div>

