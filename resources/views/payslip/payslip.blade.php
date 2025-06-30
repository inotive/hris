<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Slip Gaji</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
        }

        .section-title {
            background: #f8d7da;
            padding: 5px;
            font-weight: bold;
        }

        .table {
            width: 100%;
            margin-top: 10px;
        }

        .table td {
            padding: 4px 6px;
            vertical-align: top;
        }

        .left,
        .right {
            width: 48%;
            display: inline-block;
            vertical-align: top;
        }

        .total-box {
            background: #f8d7da;
            padding: 10px;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }

        .footer {
            margin-top: 40px;
        }
    </style>
</head>

<body>


    <img src="{{ public_path('logo-withtext.png') }}" alt="Logo" height="30"><br>

    <div class="header">
        <img class="company-logo" src="{{ Storage::path($company->logo) }}"
            onerror="this.onerror=null; this.src='{{ asset('assets/images/no_image.jpg') }}';" width="80" />
        <br>
        <br>
        
        <h2 style="padding-bottom:0px; margin-bottom:8px;">{{ $company->name ?? '' }}</h2>
        <p style="padding-top:0px; margin-top:0px;">{{ $company->address ?? '' }}</p>
    </div>

    <hr>

    <table class="table">
        <tr>
            <td>ID Karyawan: {{ $employee->nik ?? '' }}</td>
            <td>Departemen: {{ $employee->department->name ?? '' }}</td>
        </tr>
        <tr>
            <td>Nama: {{ $employee->full_name ?? '' }}</td>
            <td>NPWP: {{ $employee->npwp_number ?? '' }}</td>
        </tr>
        <tr>
            <td>Jabatan: {{ $employee->position->name ?? '' }}</td>
        </tr>
    </table>


    <table class="table">
        <tr>
            <td>
                <div class="section-title">Penghasilan</div>
                <table class="table">
                    @foreach ($payslip->earning_details as $payslip_earning)
                        <tr>
                            <td>{{ $payslip_earning->master->name }}</td>
                            <td>Rp</td>
                            <td style="text-align: right">{{ number_format($payslip_earning->value, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td><strong>Total</strong></td>
                        <td><strong>Rp</strong></td>
                        <td style="text-align: right"><strong>{{ number_format($payslip->total_payslip_earning, 0, ',', '.') }}</strong></td>
                    </tr>
                </table>
            </td>
            <td>
                <div class="section-title">Potongan</div>
                <table class="table">
                    @foreach ($payslip->deduction_details as $payslip_deduction)
                        <tr>
                            <td>{{ $payslip_deduction->master->name }}</td>
                            <td>Rp</td>
                            <td style="text-align: right">{{ number_format($payslip_deduction->value, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td><strong>Total</strong></td>
                        <td><strong>Rp</strong></td>
                        <td style="text-align: right"><strong>{{ number_format($payslip->total_payslip_deduction, 0, ',', '.') }}</strong>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>



    <div class="total-box">
        Take Home Pay: Rp{{ number_format($payslip->take_home_pay, 0, ',', '.') }}
    </div>

    <div class="footer">
        <p>Mengetahui,</p>
        <p>Manajer HRD</p>
        <p><strong>____________</strong></p>
    </div>

</body>

</html>
