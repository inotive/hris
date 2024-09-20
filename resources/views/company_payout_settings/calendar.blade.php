<x-form.index
    :action="$form_action"
    :cancel="$cancel"
>
    <x-slot name="title">{{ __('Payout Settings') }}</x-slot>

    <x-slot name="toolbar"> 
        <x-company-edit-tab :companyid="$company->id" tab="payout_setting" />
    </x-slot>
    <x-slot name="body">  
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
      



       <x-tab :tabs="$tabs" :tab="$active_tab"/>

        <div class="row">
            @foreach ($payouts as $key => $value)
                <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-10">


                        <div class="card">
                            <div class="card-body p-3">
                                <div id="inline-datepicker-{{ $key }}" class="text-center" data-date="{{ $value->date }}"></div>

                                     <input type="hidden" class="form-control" id="payouts_{{ $key }}" name="payouts[{{ \Carbon\Carbon::parse($value->date)->format('m') }}]" value="{{ $value->date }}"  />

                            </div>
                        </div>
                </div>
            @endforeach
        </div>
    </x-slot>

    <x-slot name="js">
        <script>
            @foreach ($payouts as $key => $value)
                $('#inline-datepicker-{{ $key }}').datepicker({

                    format: 'yyyy-mm-dd',
                    autoclose: true,

                    startDate: '{{ \Carbon\Carbon::parse($value->date)->format('Y-m') }}-01',
                    endDate: '{{ \Carbon\Carbon::parse($value->date)->format('Y-m-t') }}',
                    language: '{{ session("app_locale")["code"] ?? "en" }}',
                });
                $('#inline-datepicker-{{ $key }}').on('changeDate', function() {
                    $('#payouts_{{ $key }}').val(
                        $('#inline-datepicker-{{ $key }}').datepicker('getFormattedDate')
                    );
                });
            @endforeach
        </script>
        
    </x-slot>
</x-form.index>