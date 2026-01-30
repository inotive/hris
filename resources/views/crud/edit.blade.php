@extends('layouts.app') @section('page_title')
{{ __($page_title) }}
@stop @section('content')
<div class="post" id="kt_post">
  <div id="kt_content_container" class="container-fluid">
    <div class="row">
      <div class="col-12">
        <x-back
          href="{{ $back_route ?? route(explode('.', Route::currentRouteName())[0] . '.index') }}" />
      </div>
    </div>

    <div class="card border round-3">
      <div class="card-body">
        <form
          id="crud-form"
          action="{{ $action ?? route(explode('.', Route::currentRouteName())[0] . '.update', $form->id) }}"
          method="POST">
          @csrf @method('PUT') @include($view)

          <div class="card-footer text-end">
            <a
              href="{{ $back_route ?? route(explode('.', Route::currentRouteName())[0] . '.index') }}"
              class="btn btn-light me-3"
              >{{ __("Cancel") }}</a
            >

            <button
              type="submit"
              id="kt_modal_add_customer_submit"
              class="btn btn-primary">
              <span class="indicator-label">{{ __("Save") }}</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@stop
