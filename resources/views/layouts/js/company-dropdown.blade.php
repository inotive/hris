<script>
    $(document).ready(function() {

        setDefaultSelect2($(".company_id"));

        $('.company_id').select2({
            placeholder: 'Search Company',
            ajax: {
                url: '{{ route('companies.select2') }}', // Server endpoint
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
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
