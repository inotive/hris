@props([ 'title' => 'No Title', 'action' => null, 'cancel' => null, ])
@extends('layouts.app') @section('page_title')
{{ $title }}
@stop @section('content')

<!--begin::Post-->
<div class="post d-flex flex-column-fluid" id="kt_post">
  <!--begin::Container-->
  <div id="kt_content_container" class="w-100">
    @if (session('messages.success'))
    <div class="alert alert-success">
      {{ session("messages.success") }}
    </div>
    @endif @if (session('messages.warning'))
    <div class="alert alert-warning">
      {{ session("messages.warning") }}
    </div>
    @endif

    <div class="post" id="kt_post">
      <div id="kt_content_container" class="container-fluid">
        <div class="row">
          <div class="col-12">
            <x-back
              href="{{ $back_route ?? route(explode('.', Route::currentRouteName())[0] . '.index') }}" />
          </div>
        </div>

        <form action="{{ $action }}" method="POST" id="crud-form">
          @csrf

          {{ $top_header ?? "" }}

          <!--begin::Card-->
          <div class="card border round-3">
            @if (isset($header) || isset($toolbar))
            <div class="card-header">
              <div class="card-title">
                {{ $header ?? "" }}
              </div>

              <div class="card-toolbar">
                <div class="d-flex justify-content-end">
                  {{ $toolbar ?? "" }}
                </div>
              </div>
            </div>
            @endif

            <div class="card-body pt-0">
              {{ $tab_header ?? "" }}
              {{ $body ?? "" }}
            </div>

            <div class="card-footer text-end">
              <a href="{{ $cancel }}" class="btn btn-light me-3">{{
                __("Cancel")
              }}</a>

              <button
                type="submit"
                id="kt_modal_add_customer_submit"
                class="btn btn-primary">
                <span class="indicator-label">{{ __("Save") }}</span>
              </button>
            </div>
          </div>
          <!--end::Card-->
        </form>
      </div>
    </div>
  </div>
  <!--end::Container-->
</div>
<!--end::Post-->

@endsection @section('js')
{{ $js ?? "" }}
@stop
