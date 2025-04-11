<x-form.index :back_route="route('company-subscriptions-detail.index', $company)" :title="__('Add') . ' ' . __('Subscription')" :action="route('company-subscriptions-detail.store', $company)" :cancel="route('company-subscriptions-detail.index', $company)">


    <x-slot name="body">



        @include('company_subscription_detail.form')

    </x-slot>
</x-form.index>
