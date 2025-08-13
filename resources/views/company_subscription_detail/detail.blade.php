<x-form.index
  :back_route="route('company-subscriptions-detail.index', $company)"
  :title="__('Edit') . ' ' . __('Subscription')"
  :action="route('company-subscriptions-detail.update', [$company, $form->id])"
  :cancel="route('company-subscriptions-detail.index', $company)"
  :readonly="true">
  <x-slot name="body">
    


    <div class="row">


    
      <x-form.hidden name="company_id" :value="old('company_id', $form->company_id ?? '')" />
  
  
      <x-form.datepicker :disabled="true" required :label="__('Start Date')" name="start_date_at" :value="old('start_date_at', $form->start_date_at ?? '')" />
      <x-form.datepicker :disabled="true" required :label="__('End Date')" name="end_date_at" :value="old('end_date_at', $form->end_date_at ?? '')" />
  
      <x-form.input :disabled="true" required type="text" :label="__('Subscription Type')" name="subscription_type" :value="old('subscription_type', $form->subscription_type ?? '')" />
      <x-form.textarea :disabled="true" required :label="__('Subscription Description')" name="subscription_description" :value="old('subscription_description', $form->subscription_description ?? '')" />
      <x-form.currency :disabled="true" required :label="__('Price')" name="price" :value="old('price', $form->price ?? '')" />
  
  
  
      <x-form.select :disabled="true" required name="bank" label="Payment Bank Account" :value="old('bank', $form->bank)" :list="\App\Models\BankList::pluck('name','name')" />
      <x-form.input :disabled="true" required type="text" :label="__('Payment Bank Account No')" name="payment_bank_account_no" :value="old('payment_bank_account_no', $form->payment_bank_account_no ?? '')" />
      <x-form.input :disabled="true" required type="text" :label="__('Payment Bank Account Name')" name="payment_bank_account_name" :value="old('payment_bank_account_name', $form->payment_bank_account_name ?? '')" />
  
      {{-- <x-form.image-picker :label="__('Image')" name="payment_bank_account_logo" folder="company_subscription" :value="old('payment_bank_account_logo', $form->payment_bank_account_logo ?? '')" /> --}}
  
  
      <x-form.datetimepicker :disabled="true" required :label="__('Payment At')" name="payment_at" :value="old('payment_at', $form->payment_at ?? '')" />
  
      <x-form.switch :disabled="true" label="Payment Status" name="payment_status" :value="old('payment_status',  isset($form)  ? $form?->payment_status == true ? 1 : 0 : 0)" />
  
  
  </div>

  

  </x-slot>
</x-form.index>
