<form method="GET">
  <div class="input-group">
      <input type="search" class="form-control" placeholder="{{ __('Search') }}" aria-label="{{ __('Search') }}" name="search" value="{{ request()->search ?? '' }}">
      <div class="input-group-append">
        <button class="btn btn-default" type="submit">
          <i class="fas fa-search"></i>
        </button>
      </div>
  </div>
</form>