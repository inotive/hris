@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-white">
        <h3>Welcome back, {{ auth()->user()->first_name ?? 'User' }}!</h3>
        <p class="text-gray-600">Tagline</p>


        <div class="row">
            <div class="col-12 col-lg-4">
                <div class="card border round-3">
                    <div class="card-body p-5">
                        <h5>Total Company</h5>
                        <p class="text-gray-800">Description</p>


                        <div class="d-flex justify-content-between mt-10">
                            <div>
                                <h1 class="fs-1">{{ number_format($total_company, 0, ',', '.') }}</h1>
                            </div>
                            <div>
                                <a href="">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card border round-3">
                    <div class="card-body p-5">
                        <h5>Total Employee</h5>
                        <p class="text-gray-800">Description</p>


                        <div class="d-flex justify-content-between mt-10">
                            <div>
                                <h1 class="fs-1">{{ number_format($total_employee, 0, ',', '.') }}</h1>
                            </div>
                            <div>
                                <a href="">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card border round-3">
                    <div class="card-body p-5">
                        <h5>Total Company Subscription</h5>
                        <p class="text-gray-800">Description</p>


                        <div class="d-flex justify-content-between mt-10">
                            <div>
                                <h1 class="fs-1">{{ number_format($total_company, 0, ',', '.') }}</h1>
                            </div>
                            <div>
                                <a href="">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card border round-3 mt-8">
            <div class="card-body p-5">
                <h5>Employee Activity</h5>
                <p class="text-gray-800">Description</p>


                <div class="row">
                    <div class="col-12 col-lg-3">

                        <div class="card border round-3">
                            <div class="card-body p-5">
                                @include('icons.clipboard')
                                <h5 class="mt-1">Attendance</h5>


                                <div class="mt-10 fs-1"><b>{{ number_format($total_attendance, 0, ',', '.') }}</b></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-3">

                        <div class="card border round-3">
                            <div class="card-body p-5">
                                @include('icons.clipboard')
                                <h5 class="mt-1">Leave Request</h5>


                                <div class="mt-10 fs-1"><b>{{ number_format($total_leave, 0, ',', '.') }}</b></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-3">

                        <div class="card border round-3">
                            <div class="card-body p-5">
                                @include('icons.clipboard')
                                <h5 class="mt-1">Overtime Request</h5>


                                <div class="mt-10 fs-1"><b>{{ number_format($total_overtime, 0, ',', '.') }}</b></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-3">

                        <div class="card border round-3">
                            <div class="card-body p-5">
                                @include('icons.clipboard')
                                <h5 class="mt-1">Reimburse</h5>


                                <div class="mt-10 fs-1"><b>{{ number_format($total_reimbursement, 0, ',', '.') }}</b></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card border round-3 mt-8">
            <div class="card-body p-5">
                <div class="d-flex justify-content-between ">
                


                    <div class="col-12 col-lg-8">
                        <h5>Top Company Active</h5>
                    </div>
                    <div class="col-12 col-lg-4">
                        <input type="text" class="form-control" />
                    </div>
                </div>
                <div class="table-responsive mt-10">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
                        <!--begin::Table head-->
                        <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th>Company Name</th>
                                <th>Industry</th>
                                <th>Total Employee</th>
                                <th>Permanent</th>
                                <th>Contract</th>
                                <th>Total Deparment</th>
                                <th>Activity Rate</th>
                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="fw-bold text-gray-600">
                            @foreach ($top_companies as $key => $value)
                                <tr>
                                    <td>{{ $value->name }}</td>
                                    <td></td>
                                    <td>{{ $value->total_employee }}</td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ $value->total_department }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                           
                        </tbody>
                        <!--end::Table body-->
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
