
@props([

    'employee'  => null,
])

<div class="menu-item px-3 text-start">
    <a href="#" class="menu-link px-3 text-left employee-reset-password" data-reset-password-url="{{ route('employee-reset-password', $employee->id) }}" data-email="{{ $employee->email }}">{{ __('Reset Password') }}</a>
</div>