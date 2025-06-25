@props([
    'message' => __('Data not found'),
])
<div class="row empty-container">
    <div class="col-12 text-center" style="padding-top:100px; padding-bottom:100px">
        <img src="{{ asset('assets/images/data-not-found.svg') }}" width="200" />

        <br>
        <br>
        <br>
        <h5>{{ $message }}</h5>
    </div>
</div>