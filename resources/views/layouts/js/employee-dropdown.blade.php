
<script>
    $(document).ready(function() {

        setDefaultSelect2($(".employee_id"));

        $('.employee_id').select2({
            placeholder: 'Search Employee',
            ajax: {
                url: '{{ route('employees.select2') }}', // Server endpoint
                dataType: 'json',
                delay: 250,
                data: function(params) {

                    return {
                        company_id: $("[name='company_id']").val(),
                        query: params.term, // Search query
                        page: params.page || 1 // Pagination
                    };
                },
                processResults: function(data, params) {
                    params.page = params.page || 1;
                    return {
                        results: $.map(data.items, function(item) {
                            return {
                                id: item.id,
                                text: item.name // Display name in the dropdown
                            };
                        }),
                        pagination: {
                            more: data.more // Whether there are more results to load
                        }
                    };
                },
                cache: true
            },
            minimumInputLength: 0 // Start search after typing 1 character
        });


    });
</script>