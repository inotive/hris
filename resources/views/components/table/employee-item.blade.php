@props([
    'employee'  => null,
])
<div class="d-flex align-items-center">
    <img class="rounded" src="{{ Storage::url($employee->image) }}"
    onerror="this.onerror=null; this.src='{{ asset('assets/images/no_image.jpg') }}';" width="50" />
    <div class="ms-5">
        <div>
            <b>{{ $employee->full_name ?? '' }}</b>
        </div>
        <div class="text-muted fs-base">{{ $employee->department->name ?? '' }}</div>
        <div class="fs-8">{{ $employee->position->name ?? '' }}</div>
    </div>
</div>