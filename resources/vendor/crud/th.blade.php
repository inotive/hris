<th>
    <a href="{{ route(Route::currentRouteName(), [
            "search"    => request()->search,
            "sort_col"  => request()->sort_col == $col && request()->sort == "desc" ? null : $col,
            "sort" => request()->sort_col != $col ? null : (request()->sort == "asc" ? "desc" : (request()->sort == "desc" ? null : "desc")),
        ]) }}">

        {{ $title }}
        <i class="fa fa-sort{{ request()->sort_col == $col ? "-" : "" }}{{ request()->sort_col == $col ? (request()->sort == "desc" ? "down" : "up") : "" }}"></i>
    </a>
</th>