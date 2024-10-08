<table>
    <thead>
        <tr>
            @for ($i = 1; $i <= 5; $i++)
                <th>{{ $i }}</th>
            @endfor
        </tr>
    <tr>
        <th>{{ __('NIK') }}</th>
        <th>{{ __('First Name') }}</th>
        <th>{{ __('Last Name') }}</th>
        <th>{{ __('Email') }}</th>
        <th>{{ __('Username') }}</th>
        {{-- <th>{{ __('Status (YES/NO)') }}</th>
        <th>{{ __('Gender') }}</th>
        <th>{{ __('Birth Place') }}</th>
        <th>{{ __('Birth Date') }}</th>
        <th>{{ __('Religion') }}</th>
        <th>{{ __('Martial Status') }}</th>
        <th>{{ __('Nationality') }}</th>
        <th>{{ __('Address') }}</th>
        <th>{{ __('Province') }}</th>
        <th>{{ __('City') }}</th>
        <th>{{ __('District') }}</th>
        <th>{{ __('Sub District') }}</th>
        <th>{{ __('ZIP Code') }}</th>
        <th>{{ __('Country') }}</th>
        <th>{{ __('Company ID') }}</th>
        <th>{{ __('Department ID') }}</th>
        <th>{{ __('Position ID') }}</th>
        <th>{{ __('Level') }}</th>
        <th>{{ __('Shift ID') }}</th>
        <th>{{ __('Bank Account Number') }}</th>
        <th>{{ __('Bank Account Name') }}</th>
        <th>{{ __('Join Date') }}</th>
        <th>{{ __('Salary') }}</th>
        <th>{{ __('Reimbursement Limit') }}</th>
        <th>{{ __('Document ID') }}</th>
        <th>{{ __('Document Expiry') }}</th>
        <th>{{ __('Tax Number') }}</th>
        <th>{{ __('Tax Registered Name') }}</th> --}}
    </tr>
    </thead>
    <tbody>
    @foreach($employees as $row)
        <tr>
            <td>{{ $row->nik }}</td>
            <td>{{ $row->first_name }}</td>
            <td>{{ $row->last_name }}</td>
            <td>{{ $row->email }}</td>
            <td>{{ $row->username }}</td>
        </tr>
    @endforeach
    </tbody>
</table>