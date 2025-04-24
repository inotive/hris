<table>
    <thead>

        <tr>
            <th>{{ __('ID') }}</th>
            <th>{{ __('NIK') }}</th>
            <th>{{ __('Employee') }}</th>
            <th>{{ __('Department') }}</th>
            <th>{{ __('Position') }}</th>
            @for ($i = 1; $i <= ($list[0]->total_day ?? 0); $i++)
                <th class="text-center " colspan="1" style="min-width:100px;">
                    {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}
                    <br>
                    {{ \Carbon\Carbon::parse($year . '-' . $month . '-' . $i)->format('D') }}
                </th>
            @endfor

        </tr>
    </thead>
    <tbody>
        @foreach ($list as $key => $value)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $value->nik }}</td>
                <td>{{ $value->employee_name }}</td>
                <td>{{ $value->department_name }}</td>
                <td>{{ $value->position_name }}</td>

                @for ($i = 1; $i <= ($value->total_day ?? 0); $i++)
                    <td class="text-center">
                       {{ ((array) $value)['day' . $i . '_dates']  }}

                    </td>
                @endfor
            </tr>
        @endforeach
    </tbody>
</table>
