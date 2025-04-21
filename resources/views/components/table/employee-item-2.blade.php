@props([
    'image'  => null,
    'name'  => null,
    'department_name' => null,
    'position_name' => null,
])
<div class="d-flex align-items-center">
    <img class="rounded" src="{{ Storage::url($image) }}"
    onerror="this.onerror=null; this.src='{{ asset('assets/images/no_image.jpg') }}';" width="50" />
    <div class="ms-5">
        <div>
            <b>{{ $name ?? '' }}</b>
        </div>
        <div class="text-muted fs-base">{{ $department_name ?? '' }}</div>
        <div class="fs-8">{{ $position_name ?? '' }}</div>
    </div>
</div>