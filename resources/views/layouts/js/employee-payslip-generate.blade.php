@if (strpos(Route::currentRouteName(), 'employee-payslip-generate.create') === 0)

<script>
    $(".company_id").on('change', function(){
        getAllEmployeeCompany();
    });


    function getAllEmployeeCompany()
    {
        var company_id = $(".company_id").val();

        if (company_id != null) {
            $.get("{{ route('employees.getall') }}?company_id="+company_id)
                .then((res) => {
                    console.log(res);
                    $.each(res.items, function(index, row){
                        const newRow = `
                            <tr>
                                <td><input type="checkbox" value="${row.id}" name="employee_ids[]" class="row-checkbox"></td>
                                <td>${row.first_name} ${row.last_name}</td>
<td>${row.position.name}</td>
                            </tr>
                        `;
                        // Append the new row to the table body
                        $('#employee_list_body').append(newRow);
                    });
                });

        }
    }

    $(document).ready(function () {
        // Toggle all checkboxes
        $('#select-all').on('click', function() {
            $('.row-checkbox').prop('checked', this.checked);
            $('tbody tr').toggleClass('table-active', this.checked);
        });

        // Toggle row highlight on individual checkbox selection
        $('.row-checkbox').on('click', function() {
            $(this).closest('tr').toggleClass('table-active', this.checked);

            // Uncheck 'Select All' if not all checkboxes are selected
            if (!this.checked) {
                $('#select-all').prop('checked', false);
            }

            // Check 'Select All' if all checkboxes are selected
            if ($('.row-checkbox:checked').length === $('.row-checkbox').length) {
                $('#select-all').prop('checked', true);
            }
        });
    });
</script>

@endif
