<!-- Components/User/announcement/announcement.blade.php-->
<div class="w-full relative overflow-hidden py-8 px-4 sm:px-6 lg:px-8 bg-white"
         x-data="announcementData()" {{-- Call a function to return the data object --}}
         x-init="init()"
         :class="{ 'opacity-0': !loaded, 'opacity-100': loaded }"
         x-transition:enter="transition ease-out duration-700"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100">

            <div class="rounded-2xl py-10 px-6 pl-[200px] mb-12 w-full bg-white text-left">
                <div class="flex items-start gap-8">
                    <!-- Icon -->
                    <div class="text-orange-500 text-5xl">
                    <!-- Sample icon (Bullhorn/Announcement) -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-20 h-20" viewBox="0 0 24 24">
                        <path d="M20 3.01 4 7v4.18a3 3 0 0 0 1.64 2.68l2.27 1.14a4 4 0 1 0 7.73 1H16a1 1 0 0 0 1-1V14l3-.75a1 1 0 0 0 .76-.97V4a1 1 0 0 0-1.24-.99zM10 18a2 2 0 0 1-1.85-2.78l1.64.82A1.98 1.98 0 0 1 10 18zm6-4.5h-.92a4.03 4.03 0 0 0-1.58-.8L8 10.87V8.14l8-2v8.36z"/>
                    </svg>
                    </div>

                    <!-- Text -->
                    <div>
                    <h1 class="text-4xl md:text-5xl font-bold mb-4 text-black leading-tight">
                        <span class="text-orange-500">Official</span> <br />
                        Announcements!!
                    </h1>
                    <p class="text-lg text-black">
                        Track the status of your online requests and know when they are ready for claim.
                    </p>
                    </div>
                </div>
            </div>




        <main class="max-w-7xl mx-auto w-full">
            <div> {{-- Removed x-data here, as it's in the parent div --}}

                <div class="mb-10 bg-white rounded-xl shadow-md p-6 w-full">
                    <div class="flex flex-col md:flex-row justify-between gap-4">
                        <div class="relative flex-1">
                            <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden transition-all w-full focus-within:ring-2 focus-within:ring-blue-500">
                                <span class="pl-4 text-gray-400">
                                    <i class="fas fa-search"></i>
                                </span>
                                <input
                                    x-model="searchQuery"
                                    type="text"
                                    placeholder="Search requests by title, content, or requester..."
                                    class="w-full py-3 px-4 focus:outline-none text-gray-800"
                                >
                                <button
                                    x-show="searchQuery"
                                    @click="searchQuery = ''"
                                    class="px-4 text-gray-400 hover:text-gray-600"
                                >
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-2 mt-4 md:mt-0">
                            <template x-for="category in categories" :key="category">
                                <button
                                    @click="activeCategory = category"
                                    :class="{
                                        'bg-gray-800 text-white shadow-md': activeCategory === category,
                                        'bg-gray-100 text-gray-700 hover:bg-gray-200': activeCategory !== category
                                    }"
                                    class="px-4 py-2 rounded-full text-sm font-medium transition-all"
                                >
                                    <span x-text="category"></span>
                                </button>
                            </template>
                        </div>
                    </div>

                    <div class="mt-4 flex justify-between items-center">
                        <p class="text-gray-600">
                            Showing <span x-text="filteredAnnouncements.length"></span>
                            of <span x-text="announcements.length"></span> requests
                        </p>
                        <div class="text-sm text-gray-500">
                            <span x-show="searchQuery">Search: "<span x-text="searchQuery"></span>" • </span>
                            <span x-show="activeCategory !== 'All'">Category: <span x-text="activeCategory"></span></span>
                        </div>
                    </div>
                </div>

                <div x-show="todayAnnouncements.length > 0" class="mb-12">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                            <i class="fas fa-bolt text-yellow-500"></i>
                            Recent Updates
                        </h2>
                        <span class="bg-indigo-100 text-indigo-800 text-sm font-medium px-3 py-1 rounded-full">
                            <span x-text="todayAnnouncements.length"></span> new
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                        <template x-for="announcement in todayAnnouncements" :key="announcement.id">
                            <div class="bg-white rounded-xl shadow-md relative overflow-hidden
                                         hover:shadow-lg cursor-pointer border border-gray-100 p-5">

                                <div class="mb-2">
                                    <span class="bg-indigo-100 text-indigo-800 text-xs font-medium px-2 py-0.5 rounded">
                                        <span x-text="announcement.category"></span>
                                    </span>
                                </div>

                                <h3 class="text-lg font-bold text-gray-900 mb-1" x-text="announcement.title"></h3>

                                <p class="text-gray-700 text-xs mb-2">
                                    <i class="fas fa-user-circle mr-1"></i> Requester: <span class="font-medium" x-text="announcement.requester_name"></span>
                                </p>

                                <p class="text-gray-600 text-xs mb-3" x-text="truncateText(announcement.content, 90)"></p>

                                <div class="flex justify-between items-center text-gray-500 text-xs mt-auto pt-2 border-t border-gray-100">
                                    <div class="flex items-center">
                                        <i class="far fa-building mr-1"></i>
                                        <span x-text="announcement.author"></span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="far fa-clock mr-1"></i>
                                        <span x-text="formatDate(announcement.date)"></span>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <div x-show="earlierAnnouncements.length > 0">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                            <i class="fas fa-history text-gray-500"></i>
                            Earlier Requests
                        </h2>
                        <span class="bg-gray-100 text-gray-800 text-sm font-medium px-3 py-1 rounded-full">
                            <span x-text="earlierAnnouncements.length"></span> found
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                        <template x-for="announcement in earlierAnnouncements" :key="announcement.id">
                            <div class="bg-white rounded-xl shadow-md relative overflow-hidden
                                         hover:shadow-lg cursor-pointer border border-gray-100 p-5">
                                <div class="mb-2">
                                    <span class="bg-indigo-100 text-indigo-800 text-xs font-medium px-2 py-0.5 rounded">
                                        <span x-text="announcement.category"></span>
                                    </span>
                                </div>

                                <h3 class="text-lg font-bold text-gray-900 mb-1" x-text="announcement.title"></h3>

                                <p class="text-gray-700 text-xs mb-2">
                                    <i class="fas fa-user-circle mr-1"></i> Requester: <span class="font-medium" x-text="announcement.requester_name"></span>
                                </p>

                                <p class="text-gray-600 text-xs mb-3" x-text="truncateText(announcement.content, 90)"></p>

                                <div class="flex justify-between items-center text-gray-500 text-xs mt-auto pt-2 border-t border-gray-100">
                                    <div class="flex items-center">
                                        <i class="far fa-building mr-1"></i>
                                        <span x-text="announcement.author"></span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="far fa-clock mr-1"></i>
                                        <span x-text="formatDate(announcement.date)"></span>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <div x-show="filteredAnnouncements.length === 0" class="text-center py-20">
                    <div class="mx-auto text-indigo-500 mb-4">
                        <i class="fas fa-inbox text-6xl opacity-30"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-700 mb-2">No requests found</h3>
                    <p class="text-gray-500 max-w-md mx-auto">
                        Try adjusting your search or filter criteria. There are no requests matching your current selection.
                    </p>
                    <button
                        @click="searchQuery = ''; activeCategory = 'All'"
                        class="mt-6 px-6 py-3 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 transition"
                    >
                        Reset Filters
                    </button>
                </div>
            </div>
        </main>
    </div>

{{-- Add a script block to define the Alpine.js data function --}}
<script>
    function announcementData() {
        return {
            loaded: false,
            announcements: [], // Initialize as empty, will be populated in init()
            categories: [],
            activeCategory: 'All',
            searchQuery: '',
            truncateText(text, maxLength) {
                if (text.length <= maxLength) return text;
                return text.substring(0, maxLength) + '...';
            },
            init() {
                // Set loaded to true after the component initializes for transition effect
                this.$nextTick(() => { this.loaded = true });

                // Parse the JSON data passed from Laravel
                // Ensure $announcements is always an array, even if empty
                const rawAnnouncements = @json($announcements ?? []);
                this.announcements = rawAnnouncements.map(ann => ({
                    id: ann.id,
                    title: ann.title,
                    requester_name: ann.requester_name, // Match database column name
                    date: ann.date,
                    author: ann.author,
                    content: ann.content,
                    is_new: ann.is_new, // Match database column name
                    category: ann.category
                }));

                // Dynamically populate categories from announcements
                const uniqueCategories = new Set(this.announcements.map(a => a.category));
                this.categories = ['All', ...Array.from(uniqueCategories)];
            },
            get filteredAnnouncements() {
                let filtered = this.announcements;

                // Filter by category
                if (this.activeCategory !== 'All') {
                    filtered = filtered.filter(a => a.category === this.activeCategory);
                }

                // Filter by search query
                if (this.searchQuery) {
                    const query = this.searchQuery.toLowerCase();
                    filtered = filtered.filter(a =>
                        a.title.toLowerCase().includes(query) ||
                        a.content.toLowerCase().includes(query) ||
                        a.author.toLowerCase().includes(query) ||
                        a.requester_name.toLowerCase().includes(query)
                    );
                }

                return filtered;
            },
            get todayAnnouncements() {
                return this.filteredAnnouncements.filter(a => a.is_new);
            },
            get earlierAnnouncements() {
                return this.filteredAnnouncements.filter(a => !a.is_new);
            },
            formatDate(dateStr) {
                const date = new Date(dateStr);
                // Check if the date is valid before formatting
                if (isNaN(date.getTime())) {
                    return dateStr; // Return original string if invalid date
                }
                return date.toLocaleDateString('en-US', {
                    month: 'short',
                    day: 'numeric',
                    year: 'numeric'
                });
            }
        };
    }
</script>
