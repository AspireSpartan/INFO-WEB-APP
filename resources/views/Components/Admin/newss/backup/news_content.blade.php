{{-- resources/views/Components/Admin/signin/news_content.blade.php --}}
<main class="flex-grow p-4 md:p-8 lg:p-12">
    <!-- Changed text color to D4AF37 -->
    <h1 class="text-[#D4AF37] text-3xl font-semibold font-montserrat mb-8 mt-4 md:ml-8">News</h1>

    <!-- Search & Upload Bar with Filtering -->
    <div class="flex flex-col md:flex-row justify-between items-center bg-transparent gap-4 mb-8">
        <div class="relative w-full md:w-auto flex-grow max-w-xl">
            <input type="text" placeholder="Search news"
                   class="w-full pl-12 pr-4 py-2 border border-amber-400 rounded-[30px] bg-white focus:outline-none focus:ring-1 focus:ring-amber-500 text-gray-700 placeholder-zinc-400 font-montserrat">
            <!-- Search Icon (SVG) -->
            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
            </svg>
        </div>

        <!-- Filtering and Upload Buttons -->
        <div class="flex flex-col sm:flex-row items-center gap-4 w-full md:w-auto justify-end">
            <!-- Filter by Sponsored Dropdown -->
            <div class="relative" x-data="{ sponsoredFilterOpen: false }" @click.away="sponsoredFilterOpen = false">
                <button @click="sponsoredFilterOpen = !sponsoredFilterOpen" class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg shadow-sm hover:bg-gray-100 transition-colors">
                    <span>Sponsored</span>
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
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">All</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sponsored</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Non-Sponsored</a>
                    </div>
                </div>
            </div>

            <!-- Sort By Dropdown -->
            <div class="relative" x-data="{ sortByOpen: false }" @click.away="sortByOpen = false">
                <button @click="sortByOpen = !sortByOpen" class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg shadow-sm hover:bg-gray-100 transition-colors">
                    <span>Sort by</span>
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
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Date (Newest)</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Date (Oldest)</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Views (Most)</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Views (Least)</a>
                    </div>
                </div>
            </div>

            

            <!-- Upload News Button -->
            <button class="flex items-center gap-2 px-6 py-2 bg-amber-400 hover:bg-amber-500 text-white text-lg font-normal rounded-lg transition-colors shadow-md"
                    @click="showUploadModal = true;
                            $nextTick(() => {
                                const today = new Date();
                                const USAF = today.getFullYear();
                                const mm = String(today.getMonth() + 1).padStart(2, '0'); // Months start at 0!
                                const dd = String(today.getDate()).padStart(2, '0');
                                document.getElementById('newsDatePosted').value = `${USAF}-${mm}-${dd}`;
                            });">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                </svg>
                Upload News
            </button>
            <!-- Trash/Delete Button -->
            <button class="p-2 bg-white rounded-lg shadow-md hover:bg-gray-100 transition-colors">
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
            <div class="col-span-1">Author</div>
            <div class="col-span-1">Date</div>
            <div class="col-span-2">Title</div>
            <div class="col-span-1">Sponsored</div>
            <div class="col-span-1">Views</div>
            <div class="col-span-2 text-right">Actions</div>
        </div>

        <!-- Table Body Rows (Static Data) -->
        {{-- Static news data to pass to the component --}}
        @php
            $newsItems = [
                [
                    'picture' => asset('storage/Department_of_Agriculture_of_the_Philippines.svg 1.svg'),
                    'author' => 'Maria Santos',
                    'date' => '15/06/2025',
                    'title' => 'Youth Leader Launches Park Clean-Up Drive in Cebu City',
                    'sponsored' => false,
                    'views' => '1,230',
                ],
                [
                    'picture' => asset('storage/Department_of_Agriculture_of_the_Philippines.svg 1.svg'),
                    'author' => 'Juan Dela Cruz',
                    'date' => '14/06/2025',
                    'title' => 'Local Government Approves New Infrastructure Projects',
                    'sponsored' => true,
                    'views' => '5,876',
                ],
                [
                    'picture' => asset('storage/Department_of_Agriculture_of_the_Philippines.svg 1.svg'),
                    'author' => 'Ana Reyes',
                    'date' => '13/06/2025',
                    'title' => 'Community Workshop on Sustainable Farming Practices',
                    'sponsored' => false,
                    'views' => '987',
                ],
                [
                    'picture' => asset('storage/Department_of_Agriculture_of_the_Philippines.svg 1.svg'),
                    'author' => 'Pedro Lim',
                    'date' => '12/06/2025',
                    'title' => 'Health Awareness Campaign Kicks Off in Local Schools',
                    'sponsored' => true,
                    'views' => '2,450',
                ],
                [
                    'picture' => asset('storage/Department_of_Agriculture_of_the_Philippines.svg 1.svg'),
                    'author' => 'Sofia Tan',
                    'date' => '11/06/2025',
                    'title' => 'Art Festival Showcases Local Talents',
                    'sponsored' => false,
                    'views' => '789',
                ],
                [
                    'picture' => asset('storage/Department_of_Agriculture_of_the_Philippines.svg 1.svg'),
                    'author' => 'Carlos Gomez',
                    'date' => '10/06/2025',
                    'title' => 'Emergency Preparedness Drill Conducted for Residents',
                    'sponsored' => false,
                    'views' => '1,012',
                ],
                [
                    'picture' => asset('storage/Department_of_Agriculture_of_the_Philippines.svg 1.svg'),
                    'author' => 'Jessica Yu',
                    'date' => '09/06/2025',
                    'title' => 'New Public Library Opens its Doors to the Community',
                    'sponsored' => true,
                    'views' => '3,200',
                ],
            ];
        @endphp

        @foreach ($newsItems as $news)
            @include('Components.Admin.newss.news_row', [
                'picture' => asset($news['picture']), // Use asset() helper for images
                'author' => $news['author'],
                'date' => $news['date'],
                'title' => $news['title'],
                'sponsored' => $news['sponsored'],
                'views' => $news['views']
            ])
        @endforeach

    </div>
</main>
