@props([
    'name'  => '',
    'list'  => '',
    'label'  => '',
    'value'  => '',
    'class' => 'col-12 col-lg-6 mb-4',
    'disabled'  => false,
    'required'  => false,
    'div_id'    => null,
])

    
    <x-form.select :name="$name"
    :list="$list"
    :label="$label"
    :add_class="$add_class"
    :value="$value"
    :class="$class"
    :disabled="$disabled"
    :required="$required"
    :div_id="$div_id"
    data_name="{{ \App\Models\Company::where('id', $value)->first()->name ?? '' }}"
/>

