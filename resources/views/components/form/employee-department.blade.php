@props([
    'name'  => '',
    'list'  => '',
    'label'  => '',
    'value'  => '',
    'class' => 'col-12 col-lg-6 mb-4',
    'required'  => false,
])

    
    <x-form.select :name="$name"
    :list="$list"
    :label="$label"
    :add_class="$add_class"
    :value="$value"
    :class="$class"
    :required="$required"
    data_name="{{ \App\Models\EmployeeDepartment::where('id', $value)->first()->name ?? '' }}"
/>

