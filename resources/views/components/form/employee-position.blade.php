@props([
    'name'  => '',
    'list'  => '',
    'label'  => '',
    'value'  => '',
    'class' => 'col-12 col-lg-6 mb-4',
])

    
    <x-form.select :name="$name"
    :list="$list"
    :label="$label"
    :add_class="$add_class"
    :value="$value"
    :class="$class"
    data_name="{!! \App\Models\EmployeePosition::where('id', $value)->first()?->name ?? '' !!}"
/>

