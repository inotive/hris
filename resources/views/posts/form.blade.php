<div>


    <x-company-dropdown :value="old('company_id', $form->company_id ?? '')" />

    <x-form.image-picker :label="__('Image')" name="image" folder="banners" :value="old('image', $form->image ?? '')" />

    <x-form.input type="text" :label="__('Title')" name="title" :value="old('title', $form->title ?? '')" />
    <x-form.textarea :label="__('Description')" name="description" :value="old('description', $form->description ?? '')" />


    <x-form.switch label="Status" name="status" :value="old('status', $form?->status == true ? 1 : 0)" />
</div>
