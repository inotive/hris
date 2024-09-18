@props([
        'rows_count'    => 0,
])

@if ($rows_count == 0 && auth()->user()->company_id != null)
<a type="button" class="btn btn-warning" href="{{ route(explode('.',Route::currentRouteName())[0] . '.index',['generate_dummy'    => 1 ]) }}">{{ __('Generate Dummy') }} <i
        class="fa fa-fw fa-list"></i></a>
@endif