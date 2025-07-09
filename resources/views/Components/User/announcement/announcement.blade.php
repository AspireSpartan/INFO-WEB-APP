<div class="w-full relative overflow-hidden py-8 px-4 sm:px-6 lg:px-8 bg-white"
         x-data="{ loaded: false }"
         x-init="$nextTick(() => { loaded = true })"
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
            <div x-data="{
                announcements: [
                    {
                        id: 1,
                        title: 'Cedula Request',
                        requesterName: 'Juan Dela Cruz',
                        date: 'July 8, 2025',
                        author: 'Barangay Hall',
                        content: 'Your Cedula request has been approved and is ready for pick-up at the Barangay Hall during office hours. Please bring a valid ID.',
                        isNew: true,
                        category: 'Cedula Request'
                    },
                    {
                        id: 2,
                        title: 'Barangay Clearance Request',
                        requesterName: 'Maria Santos',
                        date: 'July 7, 2025',
                        author: 'Barangay Hall',
                        content: 'Your Barangay Clearance request is now processed. It can be claimed at the Barangay Hall. Ensure all fees are settled upon claiming.',
                        isNew: true,
                        category: 'Barangay Clearance Request'
                    },
                    {
                        id: 3,
                        title: 'Website Maintenance Advisory',
                        requesterName: 'Admin Team',
                        date: 'July 6, 2025',
                        author: 'Website Administration',
                        content: 'Our website will undergo scheduled maintenance on July 10, 2025, from 10:00 PM to 2:00 AM. Services may be temporarily unavailable during this period. We apologize for any inconvenience.',
                        isNew: true,
                        category: 'Website Update'
                    },
                    {
                        id: 4,
                        title: 'Business Permit Application',
                        requesterName: 'Pedro Reyes',
                        date: 'June 20, 2025',
                        author: 'Business Permits Office',
                        content: 'Your Business Permit application is under review. You will be notified once it is approved or if further documents are needed.',
                        isNew: false,
                        category: 'Business Permit Request'
                    },
                    {
                        id: 5,
                        title: 'Report Concern: Streetlight Outage',
                        requesterName: 'Anna Lim',
                        date: 'June 15, 2025',
                        author: 'Engineering Department',
                        content: 'Your report regarding the streetlight outage on Maple Street has been received and scheduled for repair within 3-5 business days.',
                        isNew: false,
                        category: 'Report Concern'
                    },
                    {
                        id: 6,
                        title: 'Cedula Request',
                        requesterName: 'Jose Rizal',
                        date: 'May 10, 2025',
                        author: 'Barangay Hall',
                        content: 'Your Cedula request from May 10, 2025, is ready for claiming at the Barangay Hall. Please present your reference number.',
                        isNew: false,
                        category: 'Cedula Request'
                    },
                    {
                        id: 7,
                        title: 'Barangay Clearance Request',
                        requesterName: 'Elena Cruz',
                        date: 'April 25, 2025',
                        author: 'Barangay Hall',
                        content: 'Your Barangay Clearance request from April 25, 2025, has been processed and is available for pick-up.',
                        isNew: false,
                        category: 'Barangay Clearance Request'
                    }
                ],
                categories: ['All', 'Cedula Request', 'Barangay Clearance Request', 'Business Permit Request', 'Report Concern', 'Website Update'],
                activeCategory: 'All',
                searchQuery: '',
                truncateText(text, maxLength) {
                    if (text.length <= maxLength) return text;
                    return text.substring(0, maxLength) + '...';
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
                            a.requesterName.toLowerCase().includes(query)
                        );
                    }
                    
                    return filtered;
                },
                get todayAnnouncements() {
                    return this.filteredAnnouncements.filter(a => a.isNew);
                },
                get earlierAnnouncements() {
                    return this.filteredAnnouncements.filter(a => !a.isNew);
                },
                formatDate(dateStr) {
                    const date = new Date(dateStr);
                    return date.toLocaleDateString('en-US', { 
                        month: 'short', 
                        day: 'numeric', 
                        year: 'numeric' 
                    });
                }
            }">
                
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
                                    <i class="fas fa-user-circle mr-1"></i> Requester: <span class="font-medium" x-text="announcement.requesterName"></span>
                                </p>

                                <p class="text-gray-600 text-xs mb-3" x-text="truncateText(announcement.content, 90)"></p>
                                
                                <div class="flex justify-between items-center text-gray-500 text-xs mt-auto pt-2 border-t border-gray-100">
                                    <div class="flex items-center">
                                        <i class="far fa-building mr-1"></i>
                                        <span x-text="announcement.author"></span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="far fa-clock mr-1"></i>
                                        <span x-text="announcement.date"></span>
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
                                    <i class="fas fa-user-circle mr-1"></i> Requester: <span class="font-medium" x-text="announcement.requesterName"></span>
                                </p>

                                <p class="text-gray-600 text-xs mb-3" x-text="truncateText(announcement.content, 90)"></p>
                                
                                <div class="flex justify-between items-center text-gray-500 text-xs mt-auto pt-2 border-t border-gray-100">
                                    <div class="flex items-center">
                                        <i class="far fa-building mr-1"></i>
                                        <span x-text="announcement.author"></span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="far fa-clock mr-1"></i>
                                        <span x-text="announcement.date"></span>
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