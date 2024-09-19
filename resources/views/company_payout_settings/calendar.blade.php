<x-form.index
    :action="$form_action"
    :cancel="$cancel"
>
    <x-slot name="title">{{ __('Payout Settings') }}</x-slot>

    <x-slot name="body">    

        <x-company-edit-tab :companyid="$company->id" tab="payout_setting" />

       <x-tab :tabs="$tabs" :tab="$active_tab"/>

        <div class="row">
            @foreach ($payouts as $key => $value)
                <div class="col-12 col-lg-3 mb-10">
                    <div class="form-group">
                        <label class="mb-2">{{ \Carbon\Carbon::parse($value->date)->format('F') }}</label>
                        <input type="date" class="form-control" name="payouts[{{ \Carbon\Carbon::parse($value->date)->format('m') }}]" value="{{ $value->date }}" 
                            min="{{ \Carbon\Carbon::parse($value->date)->format('Y-m') }}-01" max="{{ \Carbon\Carbon::parse($value->date)->format('Y-m-t') }}" />
                    </div>
                </div>
            @endforeach
        </div>
    </x-slot>
</x-form.index>