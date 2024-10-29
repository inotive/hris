@if (in_array(Route::currentRouteName(), ['employee-shifts-day-off.create']))
    <script>
        var row_dayoff = 0;




        function add_dayoff() {
            row_dayoff++;

            var row = `<div class="row">
                <x-form.datepicker class="col-12 col-lg-2" add_class="datepickersingle-` + row_dayoff +
                `" label="" name="dayoff[` + row_dayoff + `][date]" />
                <x-form.select class="col-12 col-lg-3" add_class="shift_id shift-id-` + row_dayoff +
                `" label="" name="dayoff[` + row_dayoff + `][shift_id]" />
                <x-form.input class="col-12 col-lg-7" name="dayoff[` + row_dayoff + `][desc]" label="" placeholder="Description" />
            </div>`;

            $("#day-off-container").append(row);

            $(".shift-id-" + row_dayoff).select2({
                placeholder: 'Search Shift',
                ajax: {
                    url: '{{ route('employee-shifts.select2') }}', // Server endpoint
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

            $(".datepickersingle-" + row_dayoff).daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901,
                maxYear: parseInt(moment().format("YYYY"), 12),
                locale: {
                    format: "DD/MM/Y"
                },
            });


        }

        add_dayoff();

        $("#add-data-day-off").on('click', function() {
            add_dayoff();

        });
    </script>
@endif
