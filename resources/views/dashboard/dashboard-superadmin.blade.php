@extends('layouts.app') @section('content')
<div class="container-fluid bg-white pt-10 pb-14">
  <h3>
    {{ __("dashboard.welcome_back") }},
    {{ auth()->user()->first_name ?? 'User' }}!
  </h3>
  {{--
  <p class="text-gray-600">Tagline</p>
  --}}

  <div class="row">
    <div class="col-12 col-lg-4">
      <div class="card border round-3">
        <div class="card-body p-5">
          <h5>{{ __("Total Company") }}</h5>
          <p class="text-gray-800">
            {{ __("dashboard.total_company_description") }}
          </p>

          <div class="d-flex justify-content-between mt-10">
            <div>
              <h1 class="fs-1">
                {{ number_format($total_company, 0, ",", ".") }}
              </h1>
            </div>
            <div>
              <a href="{{ route('companies.index') }}">{{
                __("dashboard.view_detail_button")
              }}</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-12 col-lg-4">
      <div class="card border round-3">
        <div class="card-body p-5">
          <h5>{{ __("dashboard.total_company_subscription") }}</h5>
          <p class="text-gray-800">
            {{ __("dashboard.total_company_subscription_description") }}
          </p>

          <div class="d-flex justify-content-between mt-10">
            <div>
              <h1 class="fs-1">
                {{ number_format($total_company, 0, ",", ".") }}
              </h1>
            </div>
            <div>
              <a href="{{ route('company-subscriptions.index') }}">{{
                __("dashboard.view_detail_button")
              }}</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

 

  <div class="card border round-3 mt-8">
    <div class="card-body p-5">
      <div class="d-flex justify-content-between">
        <div class="col-12 col-lg-8">
          <h5>{{ __("dashboard.top_company_active") }}</h5>
        </div>
        <div class="col-12 col-lg-4">
          <form method="GET">
            <input
              type="text"
              class="form-control"
              name="search_company"
              placeholder="{{
                __('dashboard.top_company_active_search_placeholder')
              }}"
              value="{{ request()->search_company }}" />
          </form>
        </div>
      </div>
      <div class="table-responsive mt-10">
        <table
          class="table align-middle table-row-dashed fs-6 gy-5"
          id="kt_customers_table">
          <!--begin::Table head-->
          <thead>
            <!--begin::Table row-->
            <tr
              class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
              <th>{{ __("dashboard.top_company.columns.company_name") }}</th>
              {{--
              <th>Industry</th>
              --}}
              <th>{{ __("dashboard.top_company.columns.total_employee") }}</th>
              <th>{{ __("dashboard.top_company.columns.permanent") }}</th>
              <th>{{ __("dashboard.top_company.columns.contract") }}</th>
              <th>
                {{ __("dashboard.top_company.columns.total_department") }}
              </th>
              <th>{{ __("dashboard.top_company.columns.activity_rate") }}</th>
            </tr>
            <!--end::Table row-->
          </thead>
          <!--end::Table head-->
          <!--begin::Table body-->
          <tbody class="fw-bold text-gray-600">
            @foreach ($top_companies as $key => $value)
            <tr>
              <td>{{ $value->name }}</td>
              {{--
              <td></td>
              --}}
              <td>{{ $value->total_employee }}</td>
              <td>
                {{ $value->active_contracts()->where('status','permanent')->count() }}
              </td>
              <td>
                {{ $value->active_contracts()->where('status','contract')->count() }}
              </td>
              <td>{{ $value->total_department }}</td>
              <td></td>
            </tr>
            @endforeach
          </tbody>
          <!--end::Table body-->
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
