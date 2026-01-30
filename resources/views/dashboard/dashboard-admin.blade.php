@extends('layouts.app') @section('content')
    <div class="container-fluid bg-white pt-10 pb-14">
        <h3>
            {{ __('dashboard.welcome_back') }},
            {{ auth()->user()->first_name ?? 'User' }}!
        </h3>
        {{--
  <p class="text-gray-600">Tagline</p>
  --}}

        <div class="row">
         
            <div class="col-12 col-lg-4">
                <div class="card border round-3">
                    <div class="card-body p-5">
                        <h5>{{ __('dashboard.total_employee') }}</h5>
                        <p class="text-gray-800">
                            {{ __('dashboard.total_employee_description') }}
                        </p>

                        <div class="d-flex justify-content-between mt-10">
                            <div>
                                <h1 class="fs-1">
                                    {{ number_format($total_employee, 0, ',', '.') }}
                                </h1>
                            </div>
                            <div>
                                <a href="{{ route('employees.index') }}">{{ __('dashboard.view_detail_button') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         
        </div>

        <div class="card border round-3 mt-8">
            <div class="card-body p-5">
                <h5>{{ __('dashboard.employee_activity') }}</h5>
                <p class="text-gray-800">
                    {{ __('dashboard.employee_activity_description') }}
                </p>

                <div class="row">
                    <div class="col-12 col-lg-3">
                        <div class="card border round-3">
                            <div class="card-body p-5">
                                @include('icons.clipboard')
                                <h5 class="mt-1">{{ __('dashboard.attendance') }}</h5>

                                <div class="mt-10 fs-1">
                                    <b>{{ number_format($total_attendance, 0, ',', '.') }}</b>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-3">
                        <div class="card border round-3">
                            <div class="card-body p-5">
                                @include('icons.clipboard')
                                <h5 class="mt-1">{{ __('dashboard.leave_request') }}</h5>

                                <div class="mt-10 fs-1">
                                    <b>{{ number_format($total_leave, 0, ',', '.') }}</b>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-3">
                        <div class="card border round-3">
                            <div class="card-body p-5">
                                @include('icons.clipboard')
                                <h5 class="mt-1">{{ __('dashboard.overtime_request') }}</h5>

                                <div class="mt-10 fs-1">
                                    <b>{{ number_format($total_overtime, 0, ',', '.') }}</b>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-3">
                        <div class="card border round-3">
                            <div class="card-body p-5">
                                @include('icons.clipboard')
                                <h5 class="mt-1">{{ __('dashboard.reimburse') }}</h5>

                                <div class="mt-10 fs-1">
                                    <b>{{ number_format($total_reimbursement, 0, ',', '.') }}</b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
