{{-- resources/views/Components/Admin/newss/news_content.blade.php --}}

<main class="flex-grow p-4 md:p-8 lg:p-12"
      x-data="{ showUploadModal: false }" {{-- showUploadModal state is now managed here --}}
      x-init="
          // Open the modal if there are validation errors AND the session indicates the modal should be shown
          @if ($errors->any() && session('showUploadModal'))
              showUploadModal = true;
          @endif
      ">
    <!-- Changed text color to D4AF37 -->
    <h1 class="text-[#D4AF37] text-3xl font-semibold font-montserrat mb-8 mt-4 md:ml-8">News</h1>

    <!-- Search & Upload Bar with Filtering -->
    <div class="flex flex-col md:flex-row justify-between items-center bg-transparent gap-4 mb-8">
        {{-- We'll use a form for search, filter, and sort for proper GET requests --}}
        <form action="{{ route('news.index') }}" method="GET" class="relative w-full md:w-auto flex-grow max-w-xl flex items-center">
            {{-- Hidden input to ensure 'news' screen remains active after search --}}
            <input type="hidden" name="screen" value="news">
            {{-- Search Input --}}
            <input type="text" name="search" placeholder="Search news"
                class="w-full pl-12 pr-4 py-2 border border-amber-400 rounded-[30px] bg-white focus:outline-none focus:ring-1 focus:ring-amber-500 text-gray-700 placeholder-zinc-400 font-montserrat"
                value="{{ request('search') }}" {{-- Retain search term --}}
                onkeydown="if(event.keyCode == 13) this.form.submit();"> {{-- Submit on Enter --}}
            <button type="submit" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-amber-400">
                <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </form>

        <div class="flex flex-col sm:flex-row items-center gap-4 w-full md:w-auto justify-end">
            <div class="relative" x-data="{ sponsoredFilterOpen: false }" @click.away="sponsoredFilterOpen = false">
                <button @click="sponsoredFilterOpen = !sponsoredFilterOpen" class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg shadow-sm hover:bg-gray-100 transition-colors">
                    <span>{{ match(request('sponsored_filter')) { 'sponsored' => 'Sponsored', 'non-sponsored' => 'Non-Sponsored', default => 'All' } }}</span> {{-- Display current selection --}}
                    <svg class="w-4 h-4 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" :class="{'rotate-180': sponsoredFilterOpen}">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="sponsoredFilterOpen"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-36 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-10"
                    role="menu">
                    <div class="py-1">
                        {{-- Ensure 'screen' parameter is included in filter links --}}
                        <a href="{{ route('news.index', array_merge(request()->except('sponsored_filter', 'screen'), ['sponsored_filter' => 'all', 'screen' => 'news'])) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ request('sponsored_filter', 'all') == 'all' ? 'bg-gray-100 font-semibold' : '' }}">All</a>
                        <a href="{{ route('news.index', array_merge(request()->except('sponsored_filter', 'screen'), ['sponsored_filter' => 'sponsored', 'screen' => 'news'])) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ request('sponsored_filter') == 'sponsored' ? 'bg-gray-100 font-semibold' : '' }}">Sponsored</a>
                        <a href="{{ route('news.index', array_merge(request()->except('sponsored_filter', 'screen'), ['sponsored_filter' => 'non-sponsored', 'screen' => 'news'])) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ request('sponsored_filter') == 'non-sponsored' ? 'bg-gray-100 font-semibold' : '' }}">Non-Sponsored</a>
                    </div>
                </div>
            </div>

            <div class="relative" x-data="{ sortByOpen: false }" @click.away="sortByOpen = false">
                <button @click="sortByOpen = !sortByOpen" class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg shadow-sm hover:bg-gray-100 transition-colors">
                    <span>{{ match(request('sort_by')) { 'date_asc' => 'Date (Oldest)', 'views_desc' => 'Views (Most)', 'views_asc' => 'Views (Least)', default => 'Date (Newest)' } }}</span> {{-- Display current selection --}}
                    <svg class="w-4 h-4 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" :class="{'rotate-180': sortByOpen}">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="sortByOpen"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-36 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-10"
                    role="menu">
                    <div class="py-1">
                        {{-- Ensure 'screen' parameter is included in sort links --}}
                        <a href="{{ route('news.index', array_merge(request()->except('sort_by', 'screen'), ['sort_by' => 'date_desc', 'screen' => 'news'])) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ request('sort_by', 'date_desc') == 'date_desc' ? 'bg-gray-100 font-semibold' : '' }}">Date (Newest)</a>
                        <a href="{{ route('news.index', array_merge(request()->except('sort_by', 'screen'), ['sort_by' => 'date_asc', 'screen' => 'news'])) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ request('sort_by') == 'date_asc' ? 'bg-gray-100 font-semibold' : '' }}">Date (Oldest)</a>
                        <a href="{{ route('news.index', array_merge(request()->except('sort_by', 'screen'), ['sort_by' => 'views_desc', 'screen' => 'news'])) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ request('sort_by') == 'views_desc' ? 'bg-gray-100 font-semibold' : '' }}">Views (Most)</a>
                        <a href="{{ route('news.index', array_merge(request()->except('sort_by', 'screen'), ['sort_by' => 'views_asc', 'screen' => 'news'])) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ request('sort_by') == 'views_asc' ? 'bg-gray-100 font-semibold' : '' }}">Views (Least)</a>
                    </div>
                </div>
            </div>

            <button class="flex items-center gap-2 px-6 py-2 bg-amber-400 hover:bg-amber-500 text-white text-lg font-normal rounded-lg transition-colors shadow-md"
                    @click="showUploadModal = true"> {{-- Correctly triggers showUploadModal --}}
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                </svg>
                Upload News
            </button>
            
            <button id="bulk-delete-button" class="p-2 bg-white rounded-lg shadow-md hover:bg-gray-100 transition-colors" onclick="confirmBulkDelete()">
                <svg class="w-6 h-6 text-amber-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 011-1h4a1 1 0 110 2H8a1 1 0 01-1-1zm2 3a1 1 0 011-1h2a1 1 0 110 2h-2a1 1 0 01-1-1zm0 3a1 1 0 011-1h2a1 1 0 110 2h-2a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Main Data Table Card -->
    <div class="bg-white rounded-xl shadow-xl overflow-hidden">
        <!-- Table Header -->
        <div class="bg-gray-200 px-6 py-4 grid grid-cols-9 gap-4 items-center text-neutral-400 text-lg font-semibold font-poppins">
            <div class="col-span-1 flex items-center gap-2">
                <input type="checkbox" id="selectAll" class="h-4 w-4 rounded border-gray-300 text-amber-400 focus:ring-amber-400 cursor-pointer">
                <label for="selectAll" class="text-black text-base font-light font-source-sans-pro">All</label>
            </div>
            <div class="col-span-1 text-center">Author</div>
            <div class="col-span-1 text-center">Date</div>
            <div class="col-span-2 text-center">Title</div>
            <div class="col-span-1 text-center">Sponsored</div>
            <div class="col-span-1 text-center">Views</div>
            <div class="col-span-1 text-center">Link</div> {{-- Changed from URL to Link to match the button in news_row --}}
            <div class="col-span-1 text-center">Actions</div> {{-- Changed col-span from 2 to 1 and added text-center --}}
        </div>

        <!-- Table Body Rows (Dynamic Data) -->
        @foreach ($newsItems as $news)
            @include('Components.Admin.newss.news_row', [
                'newsItem' => $news,
                'picture' => asset('storage/' . $news->picture), // Use the accessor for the picture URL
                'author' => $news->author,
                'date' => $news->date->format('d/m/Y'), // Format the date as needed
                'title' => $news->title,
                'sponsored' => $news->sponsored,
                'views' => number_format($news->views), // Format views with commas
                'url' => $news->url // Add the URL attribute
            ])
        @endforeach
    </div>

    {{-- The upload modal for news is now included here --}}
    <x-Admin.upload-Modal.upload-Modal x-show="showUploadModal"></x-Admin.upload-Modal.upload-Modal>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.news-checkbox');

    selectAll.addEventListener('change', function () {
        checkboxes.forEach(cb => cb.checked = selectAll.checked);
    });

    // Optional: If all individual checkboxes are manually checked/unchecked, update the "Select All" checkbox
    checkboxes.forEach(cb => {
        cb.addEventListener('change', function () {
            selectAll.checked = Array.from(checkboxes).every(cb => cb.checked);
        });
    });
});
</script>

<script>
        function confirmBulkDelete() {
    const checkboxes = document.querySelectorAll('input[type="checkbox"][name="selected_news_items[]"]:checked');
    const selectedIds = Array.from(checkboxes).map(cb => cb.value);

    if (selectedIds.length === 0) {
        alert('Please select at least one news item to delete.');
        return;
    }

    if (confirm(`Are you sure you want to delete ${selectedIds.length} selected news item(s)?`)) {
        const form = document.createElement('form');
        form.method = 'POST';
        // CHANGE THIS LINE:
        form.action = '{{ route('news.hulkDestroy') }}'; // Correct route for announcements bulk delete

        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = '{{ csrf_token() }}';
        form.appendChild(csrfInput);

        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        form.appendChild(methodInput);

        selectedIds.forEach(id => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'ids[]';
            input.value = id;
            form.appendChild(input);
        });

        document.body.appendChild(form);
        form.submit();
    }
}
    </script>