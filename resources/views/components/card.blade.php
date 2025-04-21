@props(['title' => 'No Title']) @extends('layouts.app') @section('page_title')
    {{ $title }}
    @stop @section('content')

    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="w-100 container-fluid">
            @if (session('messages.success'))
                <div class="alert alert-success">
                    {{ session('messages.success') }}
                </div>
                @endif @if (session('messages.warning'))
                    <div class="alert alert-warning">
                        {{ session('messages.warning') }}
                    </div>
                @endif
                <div class="row">
                    <div class="col-12">
                        {{ $back ?? '' }}
                    </div>
                </div>
                <form method="GET">
                    <div class="w-full">
                        <h1 class="fs-2 fw-bold my-4">
                            {{ $header ?? '' }}
                        </h1>
                    </div>
                    <div class="card border bg-white">
                        @if (!empty($header_toolbar))
                            <div class="card-header">
                                <div class="card-toolbar">
                                    <div class="d-flex justify-content-end gap-2">
                                        {{ $header_toolbar ?? '' }}
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="card-body">
                            {{ $tab_header ?? '' }}
                            <div class="row">
                                <div class="col-12 col-lg-2">
                                    <x-table.search />
                                </div>
                                <div class="col-12 col-lg-10 d-flex justify-content-end gap-2">
                                    {{ $toolbar ?? '' }}

                                </div>
                            </div>
                            {{ $body ?? '' }}
                        </div>
                    </div>
                </form>
        </div>
    </div>
@endsection
