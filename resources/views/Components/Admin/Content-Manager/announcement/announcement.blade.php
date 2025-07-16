<main class="max-w-full mx-auto w-full py-8 px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-center mb-6">
        <i class="fas fa-bullhorn text-orange-500 text-3xl mr-3"></i>
        <h2 class="text-4xl font-extrabold text-gray-900 leading-tight">Announcements</h2>
    </div>
    <div x-data="{
        announcements: [],
        searchQuery: '',
        activeCategory: 'All',
        categories: ['All', 'Cedula Request', 'Barangay Clearance Request', 'Business Permit Request', 'Report Concern', 'Website Update'],
        openModal: false,
        modalMode: 'add', // 'add' or 'edit'
        currentAnnouncement: {}, // Holds data for the modal form
        selectedAnnouncements: [], // Holds IDs of selected announcements
        csrfToken: document.querySelector('meta[name=&quot;csrf-token&quot;]').getAttribute('content'),
        showNotification: false,
        notificationMessage: '',
        notificationType: 'success', // 'success' or 'error'
        showConfirmModal: false, // New: Controls visibility of the custom confirmation modal
        confirmMessage: '',      // New: Message for the confirmation modal
        confirmAction: null,     // New: Function to execute on confirmation

        // Computed property to check if all filtered announcements are selected
        get allAnnouncementsSelected() {
            return this.filteredAnnouncements.length > 0 && this.selectedAnnouncements.length === this.filteredAnnouncements.length;
        },

        // Method to toggle all checkboxes
        toggleSelectAll() {
            if (this.allAnnouncementsSelected) {
                this.selectedAnnouncements = [];
            } else {
                this.selectedAnnouncements = this.filteredAnnouncements.map(a => a.id);
            }
        },

        get filteredAnnouncements() {
            let filtered = this.announcements;
            if (this.activeCategory !== 'All') {
                filtered = filtered.filter(a => a.category === this.activeCategory);
            }
            if (this.searchQuery) {
                const query = this.searchQuery.toLowerCase();
                filtered = filtered.filter(a =>
                    a.title.toLowerCase().includes(query) ||
                    a.content.toLowerCase().includes(query) ||
                    a.author.toLowerCase().includes(query) ||
                    a.requester_name.toLowerCase().includes(query) ||
                    a.category.toLowerCase().includes(query)
                );
            }
            return filtered;
        },

        // Function to show a temporary notification
        showTempNotification(message, type = 'success') {
            this.notificationMessage = message;
            this.notificationType = type;
            this.showNotification = true;
            setTimeout(() => {
                this.showNotification = false;
            }, 3000); // Hide after 3 seconds
        },

        // Fetch announcements from the backend
        async fetchAnnouncements() {
            try {
                const response = await fetch('{{ route('admin.announcements.data') }}');
                if (!response.ok) {
                    const errorText = await response.text();
                    console.error('Error fetching announcements (raw response):', errorText);
                    throw new Error('Failed to fetch announcements.');
                }
                const data = await response.json();
                this.announcements = data;
            } catch (error) {
                console.error('Error fetching announcements:', error);
                this.showTempNotification('Error fetching announcements.', 'error');
            }
        },

        openAddModal() {
            this.modalMode = 'add';
            this.currentAnnouncement = {
                id: null,
                title: '',
                requester_name: '',
                date: new Date().toISOString().slice(0, 10),
                author: 'Admin',
                content: '',
                is_new: true,
                category: ''
            };
            this.openModal = true;
        },

        openEditModal(announcement) {
            this.modalMode = 'edit';
            this.currentAnnouncement = {
                ...announcement,
                date: new Date(announcement.date).toISOString().slice(0, 10)
            };
            this.openModal = true;
        },

        async saveAnnouncement() {
            if (!this.currentAnnouncement.title || !this.currentAnnouncement.requester_name || !this.currentAnnouncement.date || !this.currentAnnouncement.author || !this.currentAnnouncement.content || !this.currentAnnouncement.category) {
                this.showTempNotification('Please fill in all required fields.', 'error');
                return;
            }

            try {
                let response;
                let url;
                let method;
                let bodyData = { ...this.currentAnnouncement }; // Copy currentAnnouncement

                if (this.modalMode === 'add') {
                    url = '{{ route('admin.announcements.store') }}';
                    method = 'POST';
                } else {
                    url = `/admin/announcements/${this.currentAnnouncement.id}`; // Matches the POST route for update
                    method = 'POST';
                    bodyData._method = 'PUT'; // Spoof PUT method
                }

                response = await fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': this.csrfToken
                    },
                    body: JSON.stringify(bodyData)
                });

                if (!response.ok) {
                    const contentType = response.headers.get('content-type');
                    if (contentType && contentType.includes('application/json')) {
                        const errorData = await response.json();
                        throw new Error(errorData.message || `Server Error (${response.status})`);
                    } else {
                        const errorText = await response.text();
                        console.error('Raw response on save error:', errorText); // Log raw HTML
                        throw new Error(`Non-JSON response from server during save: ${response.status} ${response.statusText}. Check console for details.`);
                    }
                }

                this.showTempNotification(`Announcement ${this.modalMode === 'add' ? 'created' : 'updated'} successfully!`, 'success');
                this.openModal = false;
                await this.fetchAnnouncements();
                this.selectedAnnouncements = [];
            } catch (error) {
                console.error('Error saving announcement:', error);
                this.showTempNotification(`Error: ${error.message}`, 'error');
            }
        },

        // Modified to use custom confirmation modal
        deleteAnnouncement(id) {
            this.confirmMessage = 'Are you sure you want to delete this announcement?';
            this.confirmAction = async () => {
                try {
                    const response = await fetch(`/admin/announcements/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': this.csrfToken,
                            'Content-Type': 'application/json',
                        },
                    });

                    if (!response.ok) {
                        const contentType = response.headers.get('content-type');
                        if (contentType && contentType.includes('application/json')) {
                            const errorData = await response.json();
                            throw new Error(errorData.message || `Failed to delete announcement (Server Error: ${response.status})`);
                        } else {
                            const errorText = await response.text();
                            console.error('Raw response on single delete error:', errorText);
                            throw new Error(`Non-JSON response from server during single delete: ${response.status} ${response.statusText}. Check console for details.`);
                        }
                    }

                    this.showTempNotification('Announcement deleted successfully!', 'success');
                    await this.fetchAnnouncements();
                    this.selectedAnnouncements = this.selectedAnnouncements.filter(selectedId => selectedId !== id);
                } catch (error) {
                    console.error('Error deleting announcement:', error);
                    this.showTempNotification(`Error: ${error.message}`, 'error');
                } finally {
                    this.showConfirmModal = false; // Close modal after action
                }
            };
            this.showConfirmModal = true; // Open confirmation modal
        },

        // Modified to use custom confirmation modal
        deleteSelectedAnnouncements() {
        if (this.selectedAnnouncements.length === 0) {
            this.showTempNotification('Please select announcements to delete.', 'error');
            return;
        }

        this.confirmMessage = `Are you sure you want to delete ${this.selectedAnnouncements.length} selected announcements?`;
        this.confirmAction = async () => {
            try {
                const response = await fetch('{{ route('admin.announcements.bulkDestroy') }}', {
                    method: 'POST', // Using POST to avoid CORS/preflight issues
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': this.csrfToken,
                        'X-HTTP-Method-Override': 'DELETE' // Laravel will treat this as DELETE
                    },
                    body: JSON.stringify({
                        ids: this.selectedAnnouncements
                    })
                });

                // First check if response is HTML (error page)
                const contentType = response.headers.get('content-type');
                if (contentType && contentType.includes('text/html')) {
                    const errorHtml = await response.text();
                    console.error('Server returned HTML error:', errorHtml);
                    throw new Error('Server error occurred');
                }

                const data = await response.json();
                
                if (!response.ok) {
                    throw new Error(data.message || 'Failed to delete announcements');
                }

                this.showTempNotification(data.message || `${this.selectedAnnouncements.length} announcements deleted successfully!`, 'success');
                await this.fetchAnnouncements();
                this.selectedAnnouncements = [];
            } catch (error) {
                console.error('Error:', error);
                this.showTempNotification(`Error: ${error.message}`, 'error');
            } finally {
                this.showConfirmModal = false;
            }
        };
        this.showConfirmModal = true;
    },

        formatDate(dateStr) {
            if (!dateStr) return '';
            const date = new Date(dateStr);
            return date.toLocaleDateString('en-US', {
                month: 'short',
                day: 'numeric',
                year: 'numeric'
            });
        }
    }"
    x-init="fetchAnnouncements()"
    >

        <div x-show="showNotification"
             :class="{ 'bg-green-100 border-green-400 text-green-700': notificationType === 'success', 'bg-red-100 border-red-400 text-red-700': notificationType === 'error' }"
             class="fixed top-4 right-4 p-4 rounded-lg shadow-lg border z-[60]"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform translate-x-full"
             x-transition:enter-end="opacity-100 transform translate-x-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 transform translate-x-0"
             x-transition:leave-end="opacity-0 transform translate-x-full"
        >
            <span x-text="notificationMessage"></span>
        </div>

        <div class="mb-8 bg-white rounded-xl shadow-md p-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
                <div class="relative flex-1 w-full">
                    <div class="flex items-center border border-gray-300 rounded-full overflow-hidden transition-all w-full focus-within:ring-2 focus-within:ring-orange-500">
                        <span class="pl-4 text-gray-400">
                            <i class="fas fa-search"></i>
                        </span>
                        <input
                            x-model="searchQuery"
                            type="text"
                            placeholder="Search announcements..."
                            class="w-full py-2 px-4 focus:outline-none text-gray-800"
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

                <div class="flex-shrink-0 w-full md:w-auto flex flex-col sm:flex-row gap-3">
                    <button @click="openAddModal()" class="w-full bg-orange-500 text-white px-4 py-2 rounded-full font-medium hover:bg-orange-600 transition-colors duration-300 shadow-md flex items-center justify-center gap-2 text-sm">
                        <i class="fas fa-plus"></i> Create Announcement
                    </button>
                    <button
                        @click="deleteSelectedAnnouncements()"
                        :disabled="selectedAnnouncements.length === 0"
                        class="w-full text-red-600 border border-red-600 px-4 py-2 rounded-full font-medium hover:bg-red-50 hover:text-red-700 transition-colors duration-300 flex items-center justify-center gap-2 text-sm"
                        :class="{'opacity-50 cursor-not-allowed': selectedAnnouncements.length === 0}"
                    >
                        <i class="fas fa-trash"></i> <span x-text="selectedAnnouncements.length"></span>
                    </button>
                </div>
            </div>

            <div class="flex flex-wrap gap-2 mt-4 md:mt-0 justify-center md:justify-start">
                <template x-for="category in categories" :key="category">
                    <button
                        @click="activeCategory = category"
                        :class="{
                            'bg-orange-500 text-white shadow-md': activeCategory === category,
                            'bg-gray-100 text-gray-700 hover:bg-gray-200': activeCategory !== category
                        }"
                        class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-300"
                    >
                        <span x-text="category"></span>
                    </button>
                </template>
            </div>
            <div class="mt-4 flex flex-col sm:flex-row justify-between items-center text-gray-600 text-sm gap-2">
                <span>
                    Showing <span x-text="filteredAnnouncements.length"></span> of <span x-text="announcements.length"></span> requests
                </span>
                <div class="text-sm text-gray-500 text-center sm:text-right">
                    <span x-show="searchQuery">Search: "<span x-text="searchQuery"></span>" • </span>
                    <span x-show="activeCategory !== 'All'">Category: <span x-text="activeCategory"></span></span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <input type="checkbox" @change="toggleSelectAll()" :checked="allAnnouncementsSelected" class="h-4 w-4 text-orange-600 border-gray-300 rounded focus:ring-orange-500">
                            </th>
                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Requester</th>
                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <template x-for="announcement in filteredAnnouncements" :key="announcement.id">
                            <tr>
                                <td class="px-3 py-4 whitespace-nowrap text-sm">
                                    <input type="checkbox" :value="announcement.id" x-model="selectedAnnouncements" class="h-4 w-4 text-orange-600 border-gray-300 rounded focus:ring-orange-500">
                                </td>
                                <td class="px-3 py-4 max-w-xs sm:max-w-sm lg:max-w-md xl:max-w-lg truncate text-sm text-gray-900" x-text="announcement.title" :title="announcement.title"></td>
                                <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-700" x-text="announcement.requester_name"></td>
                                <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-700">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800" x-text="announcement.category"></span>
                                </td>
                                <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-700" x-text="formatDate(announcement.date)"></td>
                                <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-700" x-text="announcement.author"></td>
                                <td class="px-3 py-4 whitespace-nowrap text-sm">
                                    <span x-show="announcement.is_new" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">New</span>
                                    <span x-show="!announcement.is_new" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Archived</span>
                                </td>
                                <td class="px-3 py-4 whitespace-nowrap text-left text-sm font-medium">
                                    <button @click="openEditModal(announcement)" class="text-orange-600 hover:text-orange-900 text-sm">Edit</button>
                                    <button @click="deleteAnnouncement(announcement.id)" class="text-gray-600 hover:text-red-600 ml-2 text-sm">Delete</button>
                                </td>
                            </tr>
                        </template>
                        <tr x-show="filteredAnnouncements.length === 0">
                            <td colspan="9" class="px-6 py-10 text-center text-gray-500">No announcements found matching your criteria.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div x-show="openModal" class="fixed inset-0 bg-gray-600 bg-opacity-75 flex items-center justify-center p-4 z-50" x-cloak>
            <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-auto overflow-y-auto max-h-[90vh] p-6" @click.away="openModal = false">
                <h3 class="text-2xl font-bold text-gray-800 mb-6" x-text="modalMode === 'add' ? 'Add New Announcement' : 'Edit Announcement'"></h3>

                <div class="space-y-4">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" id="title" x-model="currentAnnouncement.title" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-orange-500 focus:border-orange-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="requesterName" class="block text-sm font-medium text-gray-700">Requester Name</label>
                        <input type="text" id="requesterName" x-model="currentAnnouncement.requester_name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-orange-500 focus:border-orange-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                        <select id="category" x-model="currentAnnouncement.category" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-orange-500 focus:border-orange-500 sm:text-sm">
                            <option value="">Select a Category</option>
                            <template x-for="cat in categories.filter(c => c !== 'All')" :key="cat">
                                <option :value="cat" x-text="cat"></option>
                            </template>
                        </select>
                    </div>
                     <div>
                        <label for="author" class="block text-sm font-medium text-gray-700">Author</label>
                        <input type="text" id="author" x-model="currentAnnouncement.author" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-orange-500 focus:border-orange-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                        <textarea id="content" x-model="currentAnnouncement.content" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-orange-500 focus:border-orange-500 sm:text-sm"></textarea>
                    </div>
                    <div x-show="modalMode === 'edit'">
                        <label for="isNew" class="flex items-center text-sm font-medium text-gray-700">
                            <input type="checkbox" id="isNew" x-model="currentAnnouncement.is_new" class="mr-2 h-4 w-4 text-orange-600 border-gray-300 rounded focus:ring-orange-500">
                            Mark as New
                        </label>
                    </div>
                </div>

                <div class="mt-8 flex justify-end gap-3">
                    <button @click="openModal = false" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors duration-300">
                        Cancel
                    </button>
                    <button @click="saveAnnouncement()" class="px-4 py-2 bg-orange-500 text-white rounded-md text-sm font-medium hover:bg-orange-600 transition-colors duration-300">
                        <span x-text="modalMode === 'add' ? 'Add Announcement' : 'Save Changes'"></span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Custom Confirmation Modal -->
        <div x-show="showConfirmModal" class="fixed inset-0 bg-gray-600 bg-opacity-75 flex items-center justify-center p-4 z-50" x-cloak>
            <div class="bg-white rounded-lg shadow-xl w-full max-w-sm mx-auto p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Confirm Action</h3>
                <p class="text-gray-700 mb-6" x-text="confirmMessage"></p>
                <div class="flex justify-end gap-3">
                    <button @click="showConfirmModal = false" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors duration-300">
                        Cancel
                    </button>
                    <button @click="if (confirmAction) confirmAction()" class="px-4 py-2 bg-red-600 text-white rounded-md text-sm font-medium hover:bg-red-700 transition-colors duration-300">
                        Confirm
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
