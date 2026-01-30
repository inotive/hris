<x-form.index :title="__('Edit') . ' ' . __('Reimbursement')" 
    :action="route('reimbursement-requests.update', [ $form->id])" 
    :cancel="route('reimbursement-requests.index')">


    <x-slot name="body">
        @method('PUT')

        @include('reimbursement_requests.form')

    </x-slot>
</x-form.index>
