<div class="d-flex align-items-center position-relative w-100">
    <!-- Search Icon -->
    <span class="svg-icon svg-icon-1 position-absolute ms-6">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                transform="rotate(45 17.0365 15.1223)" fill="black" />
            <path
                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                fill="black" />
        </svg>
    </span>

    <input type="text" name="search" id="searchInput" class="form-control form-control-solid  ps-15"
        placeholder="{{ __('Search') }}" aria-label="{{ __('Search') }}" value="{{ request()->search ?? '' }}" />

    <!-- Clear Icon Button -->
    <button type="button" id="clearButton" class="btn btn-link position-absolute end-0 me-2" style="display: none;"
        aria-label="Clear">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="black" viewBox="0 0 24 24">
            <path
                d="M12 10.585l-4.243-4.243-1.414 1.414L10.585 12l-4.243 4.243 1.414 1.414L12 13.414l4.243 4.243 1.414-1.414L13.414 12l4.243-4.243-1.414-1.414z" />
        </svg>
    </button>


    <script>
        const searchInput = document.getElementById('searchInput');
        const clearButton = document.getElementById('clearButton');

        if (searchInput.value.length > 0) {
            clearButton.style.display = 'block';
        }

        // Show the clear button when there is input
        searchInput.addEventListener('input', function() {
            if (this.value.length > 0) {
                clearButton.style.display = 'block'; // Show clear button
            } else {
                clearButton.style.display = 'none'; // Hide clear button
            }
        });



        // Clear input when the clear button is clicked
        clearButton.addEventListener('click', function(event) {
            var search = searchInput.value;
            searchInput.value = ''; // Clear the input field


            $(this).closest('form').submit();


        });
    </script>

</div>
