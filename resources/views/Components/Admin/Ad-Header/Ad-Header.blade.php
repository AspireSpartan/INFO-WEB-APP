<div class="bg-neutral-200 min-h-screen flex flex-col">

    <!-- Header -->
    <div class="relative w-full bg-gray-700 py-4 px-6 md:px-12 lg:px-20 flex items-center justify-between z-20">
        <div class="flex items-center gap-2">
            <img src="{{ asset('storage/CoreDev.svg') }}" alt="COREDEV Logo" class="h-11 w-auto" />
        </div>
 
        <!-- Navigation -->
        <nav class="hidden lg:flex items-center gap-x-8">
            <template x-for="screen in ['dashboard', 'news', 'blog', 'contact']">
                <a href="#"
                   @click.prevent="switchScreen(screen)"
                   :class="{'text-amber-400': activeScreen === screen, 'text-white': activeScreen !== screen}"
                   class="text-base font-normal font-questrial hover:text-amber-400 transition-colors capitalize"
                   x-text="screen">
                </a>
            </template>
        </nav>

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

    <div class="w-full h-px bg-neutral-400"></div>

    <!-- Main Screen Transitions -->
    <div class="flex-grow relative bg-white">
        <template x-for="screen in ['dashboard', 'news', 'blog', 'contact']" :key="screen">
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
                    <div>@include('Components.Admin.newss.news_content', ['newsItems' => $newsItems])</div>
                </template>
                <template x-if="screen === 'blog'">
                    <div>@include('Components.Admin.blog.blog_content')</div>
                </template>
                <template x-if="screen === 'contact'">
                    <div class="p-8 text-gray-700">This is the Contact Us content area.</div>
                </template>
            </div>
        </template>
    </div>
    
    <!-- Upload Modal -->
    <x-Admin.upload-Modal.upload-Modal></x-Admin.upload-Modal.upload-Modal>
</div>
