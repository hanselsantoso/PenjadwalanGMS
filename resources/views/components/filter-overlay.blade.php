@props(['title' => 'Filter Data'])

<div id="filterOverlay" class="filter-overlay">
    <div class="filter-sidebar">
        <div class="filter-header d-flex justify-content-between align-items-center mb-3">
            <h5 class="m-0">{{ $title }}</h5>
            <button type="button" class="btn-close" id="closeFilter"></button>
        </div>
        <form id="filterForm">
            {{ $slot }}
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Terapkan Filter</button>
                <button type="button" class="btn btn-secondary" id="resetFilter">Reset Filter</button>
            </div>
        </form>
    </div>
</div>

<script>
$(document).ready(function() {
    const filterOverlay = $('#filterOverlay');
    const closeFilter = $('#closeFilter');
    const filterForm = $('#filterForm');
    const resetFilter = $('#resetFilter');

    // Show filter overlay
    $('#btnFilter').on('click', function() {
        filterOverlay.addClass('show');
    });

    // Close filter overlay
    closeFilter.on('click', function() {
        filterOverlay.removeClass('show');
    });

    // Close on overlay click
    filterOverlay.on('click', function(e) {
        if ($(e.target).is(filterOverlay)) {
            filterOverlay.removeClass('show');
        }
    });

    // Handle form submission (to be overridden by specific pages)
    filterForm.on('submit', function(e) {
        e.preventDefault();
        // This will be overridden by specific pages
        if (typeof window.applyFilters === 'function') {
            window.applyFilters();
        }
        filterOverlay.removeClass('show');
    });

    // Handle reset (to be overridden by specific pages)
    resetFilter.on('click', function() {
        filterForm[0].reset();
        // This will be overridden by specific pages
        if (typeof window.resetFilters === 'function') {
            window.resetFilters();
        }
        filterOverlay.removeClass('show');
    });
});
</script> 