<x-form.index 
    :title="__('Add') . ' ' . __('Reimbursement')"
    :action="route('reimbursement-requests.store')" 
    :cancel="route('reimbursement-requests.index')" 
    
    >


    <x-slot name="body">


       
        @include('reimbursement_requests.form')
        
    </x-slot>
</x-form.index>