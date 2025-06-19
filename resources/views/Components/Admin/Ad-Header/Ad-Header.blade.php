<div class="bg-neutral-200 min-h-screen flex flex-col"
     x-data="{
        activeScreen: 'dashboard', // Default active screen
        notificationCount: localStorage.getItem('unreadNotifications') ? parseInt(localStorage.getItem('unreadNotifications')) : 0, // Load from local storage
        screens: ['dashboard', 'news', 'blog', 'contact', 'notifications'], // 'notifications' removed from main navigation screens
        switchScreen(screen) {
            this.activeScreen = screen;
            // No window.location.href here for SPA-like transitions
        },
        resetNotifications() {
            this.notificationCount = 0;
            localStorage.setItem('unreadNotifications', 0); // Reset in local storage
            // In a real app, send an AJAX request to backend to mark all notifications as read
            // Example: fetch('/api/notifications/mark-all-read', { method: 'POST', headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'} });
        }
     }">

    <!-- Header -->
    <div class="relative w-full bg-gray-700 py-4 px-6 md:px-12 lg:px-20 flex items-center justify-between z-20">
        <div class="flex items-center gap-2">
            <img src="{{ asset('storage/CoreDev.svg') }}" alt="COREDEV Logo" class="h-11 w-auto" />
        </div>

        <!-- Navigation -->
        <nav class="hidden lg:flex items-center gap-x-8">
            {{-- Loop through the 'screens' array to generate navigation links --}}
            <template x-for="screen in screens" :key="screen">
                <a href="#"
                @click.prevent="switchScreen(screen)"
                :class="{'text-amber-400': activeScreen === screen, 'text-white': activeScreen !== screen}"
                class="text-base font-normal font-questrial hover:text-amber-400 transition-colors capitalize"
                x-text="screen !== 'notifications' ? screen : ''">
                </a>
            </template>

        </nav>

        <!-- Admin Profile and Notification -->
        <div class="flex items-center gap-4">
            <!-- Notification Icon -->
            <div class="relative" x-data="{ open: false }" @click.away="open = false">
                <button @click="open = !open; if(open) resetNotifications();" class="p-2 rounded-full text-white hover:bg-gray-600 focus:outline-none relative">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                    {{-- MODIFIED: Notification Badge with Count --}}
                    <span x-show="notificationCount > 0"
                          class="absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full ring-2 ring-gray-700"
                          x-text="notificationCount">
                    </span>
                </button>

                <!-- Notification Dropdown -->
                <div x-show="open"
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95"
                     class="origin-top-right absolute top-full right-0 mt-2 w-72 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-30"
                     role="menu">
                    <div class="py-1">
                        {{-- Display notification count in the header --}}
                        <div class="block px-4 py-2 text-sm text-gray-700 font-semibold border-b border-gray-200">
                            Notifications <span x-show="notificationCount > 0" class="ml-2 px-2 py-0.5 text-xs font-bold text-white bg-blue-500 rounded-full" x-text="notificationCount"></span>
                        </div>
                        <template x-if="notificationCount === 0">
                            <div class="block px-4 py-2 text-sm text-gray-500">No new notifications.</div>
                        </template>
                        <template x-if="notificationCount > 0">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">New message received!</a>
                            {{-- Add more dynamic notifications here from a backend API, perhaps for the last N messages --}}
                        </template>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 text-blue-600"
                           @click.prevent="switchScreen('notifications'); open = false;">View All Notifications</a>
                    </div>
                </div>
            </div>

            <!-- Admin Profile -->
            <div class="relative flex items-center gap-4" x-data="{ open: false }" @click.away="open = false">
                <button @click="open = !open" class="flex items-center gap-4 focus:outline-none">
                    <span class="text-white text-base font-normal font-questrial hidden md:block">Admin</span>
                    <img class="w-14 h-14 rounded-full object-cover" src="https://placehold.co/60x60/cccccc/white?text=Admin" alt="Admin Profile" />
                </button>

                <!-- Dropdown -->
                <div x-show="open"
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95"
                     class="origin-top-right absolute top-full right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-30"
                     role="menu">
                    <div class="py-1">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                        <a href="/logout" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full h-px bg-neutral-400"></div>

    <!-- Main Screen Transitions -->
    <div class="flex-grow relative bg-white">
        <template x-for="screen in screens" :key="screen">
            <div
                x-show="activeScreen === screen"
                x-transition:enter="transition-opacity duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity duration-300"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                x-cloak
                class="absolute top-0 left-0 w-full h-full"
            >
                <template x-if="screen === 'dashboard'">
                    <div>@include('Components.Admin.dashboard.dashboard_content')</div>
                </template>
                <template x-if="screen === 'news'">
                    {{-- Pass newsItems only if news_content expects it --}}
                    <div>@include('Components.Admin.newss.news_content', ['newsItems' => $newsItems ?? []])</div>
                </template>
                <template x-if="screen === 'blog'">
                    <div>@include('Components.Admin.blog.blog_content')</div>
                </template>
                <template x-if="screen === 'contact'">
                    <div>@include('Components.User.contact-us.contact-us')</div>
                </template>
                <template x-if="screen === 'notifications'">
                    {{-- Pass contactMessages, ensuring it's defined by the route rendering this layout --}}
                    <div>@include('Components.Admin.notification.notification', ['contactMessages' => $contactMessages ?? []])</div>
                </template>
            </div>
        </template>
    </div>
    
    <!-- Upload Modal -->
    <x-Admin.upload-Modal.upload-Modal></x-Admin.upload-Modal.upload-Modal>

    {{-- Event listener for notification increment and decrement --}}
    <script>
        document.addEventListener('notification-increment', () => {
            const mainAlpineData = document.querySelector('[x-data]').__alpine.$data;
            if (mainAlpineData && typeof mainAlpineData.notificationCount !== 'undefined') {
                mainAlpineData.notificationCount++;
                localStorage.setItem('unreadNotifications', mainAlpineData.notificationCount);
            }
        });

        document.addEventListener('notification-decrement', () => {
            const mainAlpineData = document.querySelector('[x-data]').__alpine.$data;
            if (mainAlpineData && typeof mainAlpineData.notificationCount !== 'undefined' && mainAlpineData.notificationCount > 0) {
                mainAlpineData.notificationCount--;
                localStorage.setItem('unreadNotifications', mainAlpineData.notificationCount);
            }
        });
    </script>
</div>
