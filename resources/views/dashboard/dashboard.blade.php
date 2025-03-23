@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-4">
                {{-- Data Employee --}}
                <div class="card bg-white shadow">
                    <div class="card-body">
                        <div class="d-flex-column d-flex-lg-row justify-content-between align-items-center mb-3">
                            <div>
                                <h5 class="card-title mb-0">Data Employee</h5>
                                <p class="text-muted">Descriptions</p>
                            </div>
                            <div class="text-end">
                                <div class="d-flex align-items-center">
                                    <span class="me-2">Emotion summary</span>
                                    <div class="progress" style="width: 100px; height: 8px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 85%"
                                            aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="ms-2">85%</span>
                                    <span class="ms-2">😊</span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="position-relative" style="height: 200px;">
                                    <div class="position-absolute top-50 start-50 translate-middle text-center">
                                        <h2 class="fw-bold">526</h2>
                                        <p class="text-muted">Total Employee</p>
                                    </div>
                                    <canvas id="employeeChart" width="100%" height="100%"></canvas>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="badge rounded-circle p-2 me-2"
                                                style="background-color: #6366F1;"></span>
                                            Permanent
                                        </div>
                                        <span class="fw-bold">250</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="badge rounded-circle p-2 me-2"
                                                style="background-color: #A855F7;"></span>
                                            Contract
                                        </div>
                                        <span class="fw-bold">92</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="badge rounded-circle p-2 me-2"
                                                style="background-color: #EC4899;"></span>
                                            Probation
                                        </div>
                                        <span class="fw-bold">92</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="badge rounded-circle p-2 me-2"
                                                style="background-color: #333;"></span>
                                            Data not completed
                                        </div>
                                        <span class="fw-bold">92</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('employeeChart');

            if (ctx) {
                const employeeChart = new Chart(ctx.getContext('2d'), {
                    type: 'doughnut',
                    data: {
                        labels: ['Permanent', 'Contract', 'Probation', 'Data not completed'],
                        datasets: [{
                            data: [250, 92, 92, 92],
                            backgroundColor: [
                                '#6366F1', // Permanent - Purple
                                '#A855F7', // Contract - Violet
                                '#EC4899', // Probation - Pink
                                '#333' // Data not completed - Dark
                            ],
                            borderWidth: 0,
                            cutout: '70%'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                enabled: true
                            }
                        }
                    }
                });
            } else {
                console.error('Employee chart element not found');
            }
        });
    </script>
@endsection
