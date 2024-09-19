<div class="row">


    <x-company-dropdown :value="old('company_id', $form->company_id ?? '')" />


    <x-form.datepicker :label="__('Start Date')" name="start_date_at" :value="old('start_date_at', $form->start_date_at ?? '')" />
    <x-form.datepicker :label="__('End Date')" name="end_date_at" :value="old('end_date_at', $form->start_date_at ?? '')" />
    
        <x-form.input type="text" :label="__('Subscription Type')" name="subscription_type" :value="old('subscription_type', $form->subscription_type ?? '')" />
        <x-form.textarea :label="__('Subscription Description')" name="subscription_description" :value="old('subscription_description', $form->subscription_description ?? '')" />
            <x-form.input type="number" :label="__('Price')" name="price" :value="old('price', $form->price ?? '')" />
       

   
            <x-form.input type="text" :label="__('Payment Bank Account No')" name="payment_bank_account_no" :value="old('payment_bank_account_no', $form->payment_bank_account_no ?? '')" />
            <x-form.input type="text" :label="__('Payment Bank Account Name')" name="payment_bank_account_name" :value="old('payment_bank_account_name', $form->payment_bank_account_name ?? '')" />
      
            <x-form.image-picker :label="__('Image')" name="payment_bank_account_logo" folder="company_subscription" :value="old('payment_bank_account_logo', $form->payment_bank_account_logo ?? '')" />


                <x-form.datetimepicker :label="__('Payment At')" name="payment_at" :value="old('payment_at', $form->payment_at ?? '')" />
    
                    <x-form.switch label="Payment Status" name="payment_status" :value="old('payment_status', $form?->payment_status == true ? 1 : 0)" />

                
        </div>

