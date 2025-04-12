<x-form.index
  :back_route="route('company-subscriptions-detail.index', $company)"
  :title="__('Edit') . ' ' . __('Subscription')"
  :action="route('company-subscriptions-detail.update', [$company, $form->id])"
  :cancel="route('company-subscriptions-detail.index', $company)">
  <x-slot name="body">
    @method('PUT') @include('company_subscription_detail.form')
  </x-slot>
</x-form.index>
