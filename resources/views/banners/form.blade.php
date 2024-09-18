<div>


    <x-company-dropdown :value="old('company_id', $form->company_id ?? '')" />

    <x-form.image-picker :label="__('Image')" name="image" folder="banners" :value="old('image', $form->image ?? '')" />

    <x-form.input type="text" :label="__('Title')" name="title" :value="old('title', $form->title ?? '')" />
    <x-form.textarea :label="__('Link')" name="link" :value="old('link', $form->link ?? '')" />

</div>


@section('js')
    <script></script>
@stop
