<!-- resources/views/Components/Admin/Ad-Header/Ad-Header.blade.php -->
@extends('layouts.admin') {{-- resources/views/Components/Admin/Ad-Header/Ad-Header.blade.php --}}
@section('title', 'Admin View')
@section('content')

{{-- Add contentManager and contentOffer to the props if they are needed directly in this layout for other purposes --}}
@props([
    'newsItems', 'contactMessages', 'blogfeeds', 'projects', 'description',
    'logos', 'caption', 'contentMlogos', 'vmgEditableContentData', 'strategicPlans',
    // Add these if they are passed to the admin layout directly
    'contentManager','contentOffer', 'concerns','request','reports','applications', 'communityContent','communityCarouselImages', 'announcements', 'developers',
])

    <div class="bg-neutral-200 min-h-screen flex flex-col"
         x-data="{
             activeScreen: '{{ session('activeAdminScreen', Request::query('screen', 'dashboard')) }}',
             notificationCount: localStorage.getItem('unreadNotifications') ? parseInt(localStorage.getItem('unreadNotifications')) : 0,
             screens: ['dashboard', 'news', 'Blog', 'projects', 'content manager', 'notifications', 'Hero', 'latestnews', 'announcement', 'publicofficials', 'links', 'aboutsection', 'about-section-1', 'about-section-2', 'about-section-3', 'about-section-4', 'reported_concerns','cedulareports','business-permits'],

             resetNotifications() {
                 this.notificationCount = 0;
                 localStorage.setItem('unreadNotifications', 0);
             },

             switchScreen(screenName) {
                 this.activeScreen = screenName;
                 const url = new URL(window.location);
                 url.searchParams.set('screen', screenName);
                 history.pushState({ screen: screenName }, '', url.toString()); // Pass state for popstate
             }
         }"
         x-init="
             const initialScreenFromUrl = new URLSearchParams(window.location.search).get('screen');
             if (initialScreenFromUrl && screens.includes(initialScreenFromUrl) && activeScreen === 'dashboard') {
                 // Only override if the activeScreen hasn't been set by a session flash already
                 activeScreen = initialScreenFromUrl;
             }

             window.addEventListener('popstate', (event) => {
                 const popUrlParams = new URLSearchParams(window.location.search);
                 const popScreen = popUrlParams.get('screen');
                 if (popScreen && screens.includes(popScreen)) {
                     activeScreen = popScreen;
                 } else if (!popScreen && activeScreen !== 'dashboard') { // If no screen param, go to dashboard
                     activeScreen = 'dashboard';
                 }
             });

             @if ($errors->any() && session('showCreateBlogModal'))

             @endif
         ">

        <div class="relative w-full bg-gray-700 py-4 px-6 md:px-12 lg:px-20 flex items-center justify-between z-20">
            <meta name="csrf-token" content="{{ csrf_token() }}">

            <div class="flex items-center gap-2">
                <img src="{{ asset('storage/CoreDev.svg') }}" alt="COREDEV Logo" class="h-11 w-auto"/>
            </div>

            <nav class="hidden lg:flex items-center gap-x-8">
                <template x-for="screen in ['dashboard', 'news']" :key="screen">
                    <a href="#"
                       @click.prevent="switchScreen(screen)"
                       :class="{'text-amber-400': activeScreen === screen, 'text-white': activeScreen !== screen}"
                       class="text-base font-normal font-questrial hover:text-amber-400 transition-colors capitalize"
                       x-text="screen">
                    </a>
                </template>

                <div class="relative" x-data="{ open: false }" @click.away="open = false">
                    <button @click="open = !open"
                            :class="{'text-amber-400': ['Blog', 'projects'].includes(activeScreen) || open, 'text-white': !(['Blog', 'projects'].includes(activeScreen) || open)}"
                            class="text-base font-normal font-questrial hover:text-amber-400 transition-colors capitalize focus:outline-none flex items-center">
                        Blog
                        <svg class="h-4 w-4 inline-block ml-1" :class="{'transform rotate-180': open}" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="origin-top-left absolute top-full left-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-30"
                         role="menu">
                        <div class="py-1">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                               @click.prevent="switchScreen('Blog'); open = false">Latest Articles</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                               @click.prevent="switchScreen('projects'); open = false">Projects</a>
                        </div>
                    </div>
                </div>

                <div class="relative" x-data="{ open: false }" @click.away="open = false">
                    <button @click="open = !open"
                            :class="{'text-amber-400': ['Hero', 'latestnews', 'announcement', 'publicofficials', 'links'].includes(activeScreen) || open, 'text-white': !(['Hero', 'latestnews', 'announcement', 'publicofficials', 'links'].includes(activeScreen) || open)}"
                            class="text-base font-normal font-questrial hover:text-amber-400 transition-colors capitalize focus:outline-none flex items-center">
                        Content Manager
                        <svg class="h-4 w-4 inline-block ml-1" :class="{'transform rotate-180': open}" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="origin-top-left absolute top-full left-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-30"
                         role="menu">
                        <div class="py-1">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                               @click.prevent="switchScreen('Hero'); open = false">Hero</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                               @click.prevent="switchScreen('latestnews'); open = false">Latest News</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                               @click.prevent="switchScreen('announcement'); open = false">Announcement</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                               @click.prevent="switchScreen('publicofficials'); open = false">Public Officials</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                               @click.prevent="switchScreen('links'); open = false">Links</a>
                        </div>
                    </div>
                </div>

                <div class="relative" x-data="{ open: false }" @click.away="open = false">
                    <button @click="open = !open"
                            :class="{'text-amber-400': ['about-section-1', 'about-section-2', 'about-section-3', 'about-section-4'].includes(activeScreen) || open, 'text-white': !(['about-section-1', 'about-section-2', 'about-section-3', 'about-section-4'].includes(activeScreen) || open)}"
                            class="text-base font-normal font-questrial hover:text-amber-400 transition-colors capitalize focus:outline-none flex items-center">
                        About Section
                        <svg class="h-4 w-4 inline-block ml-1" :class="{'transform rotate-180': open}" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="origin-top-left absolute top-full left-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-30"
                         role="menu">
                        <div class="py-1">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                               @click.prevent="switchScreen('about-section-1'); open = false">Who we are/Offer</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                               @click.prevent="switchScreen('about-section-2'); open = false">Strategic Goals</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                               @click.prevent="switchScreen('about-section-3'); open = false">Documentation</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                               @click.prevent="switchScreen('about-section-4'); open = false">Developers</a>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="flex items-center gap-4">
                <div class="relative" x-data="{ open: false }" @click.away="open = false">
                    <button @click="open = !open"
                            class="p-2 rounded-full text-white hover:bg-gray-600 focus:outline-none relative">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        <span x-show="notificationCount > 0"
                              class="absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-bold text-white transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full ring-2 ring-gray-700"
                              x-text="notificationCount">
                    </span>
                    </button>

                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="origin-top-right absolute top-full right-0 mt-2 w-72 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-30"
                         role="menu">
                        <div class="py-1">
                            <div class="block px-4 py-2 text-sm text-gray-700 font-semibold border-b border-gray-200">
                                Notifications
                                <span x-show="notificationCount > 0"
                                      class="ml-2 px-2 py-0.5 text-xs font-bold text-white bg-blue-500 rounded-full"
                                      x-text="notificationCount"></span>
                            </div>

                            <template x-if="notificationCount === 0">
                                <div class="block px-4 py-2 text-sm text-gray-500">No new notifications.</div>
                            </template>
                            <template x-if="notificationCount > 0">
                                <div class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <span x-text="notificationCount"></span>
                                    <span
                                        x-text="notificationCount === 1 ? 'notification unread' : 'notifications unread'"></span>
                                </div>
                            </template>

                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 text-blue-600"
                             @click.prevent="switchScreen('notifications'); open = false; resetNotifications();">View All Notifications</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                             @click.prevent="switchScreen('reported_concerns'); open = false">Manage Reported Concerns</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                             @click.prevent="switchScreen('cedulareports'); open = false">Manage Cedula Forms</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                             @click.prevent="switchScreen('business-permits'); open = false">Manage Business Permit Applications</a>
                            
                        </div>
                    </div>
                </div>

                <div class="relative flex items-center gap-4" x-data="{ open: false }" @click.away="open = false">
                    <button @click="open = !open" class="flex items-center gap-4 focus:outline-none">
                        <span class="text-white text-base font-normal font-questrial hidden md:block">Admin</span>
                        <img class="w-14 h-14 rounded-full object-cover" src="{{ asset('storage/user_image.png') }}"
                             alt="Admin Profile"/>
                    </button>

                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="origin-top-right absolute top-full right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-30"
                         role="menu">
                        <div class="py-1 z-[9999] relative">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                            <a href="/logout" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full h-px bg-neutral-400"></div>

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
                    <div>@include('Components.Admin.newss.news_content', ['newsItems' => $newsItems ?? []])</div>
                </template>
                <template x-if="screen === 'Blog'">
                    <div>@include('Components.Admin.Blog.blog_content', ['blogfeeds' => $blogfeeds ?? []])</div>
                </template>
                <template x-if="screen === 'projects'">
                    <div>@include('Components.Admin.Blog.projects.project_content', ['projects' => $projects ?? [], 'description' => $description ?? []])</div>
                </template>
                <template x-if="screen === 'Hero'">
                    <div>@include('Components.Admin.Content-Manager.Hero.Hero', ['pageContent' => $pageContent ?? []])</div>
                </template>
                <template x-if="screen === 'latestnews'">
                    <div>@include('Components.Admin.Content-Manager.latestnews.latestnews', ['newsItems' => $newsItems ?? [], 'logos' => $logos ?? [], 'caption' => $caption ?? []])</div>
                </template>
                <template x-if="screen === 'announcement'">
                    <div>@include('Components.Admin.Content-Manager.announcement.announcement', ['announcements' => $announcements ?? []])</div>
                </template>
                <template x-if="screen === 'publicofficials'">
                    <div>@include('Components.Admin.Content-Manager.PublicOfficials.PublicOfficials', ['contentMlogos' => $contentMlogos ?? [], 'publicOfficialCaption' => $publicOfficialCaption ?? [], 'officials' => $officials ?? []])</div>
                </template>
                <template x-if="screen === 'links'">
                    <div>@include('Components.Admin.Content-Manager.footer.footer', ['contentMlogos' => $contentMlogos ?? []])</div>
                </template>
                <template x-if="screen === 'notifications'">
                    <div>@include('Components.Admin.notification.notification', ['contactMessages' => $contactMessages ?? []])</div>
                </template>
                <template x-if="screen === 'reported_concerns'">
                    <div>@include('Components.Admin.reported_concerns.index', ['concerns' => $concerns ?? []])</div>
                </template>
                <template x-if="screen === 'cedulareports'">
                    <div>@include('Components.Admin.CedulaReports.index', ['reports' => $reports ?? []])</div>
                </template>
                <template x-if="screen === 'business-permits'">
                    <div>@include('Components.Admin.business_permit.index', ['applications' => $applications ?? []])</div>
                </template>
                <template x-if="screen === 'content manager'">
                    <div class="p-8 text-center text-gray-500">Select an item from the "Content Manager" dropdown.</div>
                </template>
                <template x-if="screen === 'about-section-1'">
                    <div>
                        @include('Components.Admin.about-us.section-1', [
                            'contentManager' => $contentManager ?? [],
                            'contentOffer' => $contentOffer ?? []
                        ])
                    </div>
                </template>
                <template x-if="screen === 'about-section-2'">
                    <div>@include('Components.Admin.about-us.StrategicGoals.StrategicGoals', ['contentMlogos' => $contentMlogos ?? [], 'vmgEditableContentData' => $vmgEditableContentData ?? [], 'strategicPlans' => $strategicPlans ?? []])</div>
                </template>
                <template x-if="screen === 'about-section-3'">
                <div>@include('Components.Admin.about-us.section-3', ['communityContent' => $communityContent, 'communityCarouselImages' => $communityCarouselImages])</div>
            </template>
                <template x-if="screen === 'about-section-4'">
                    <div>@include('Components.Admin.about-us.section-4', ['developers' => $developers ?? []])</div>
                </template>
            </div>
        </template>
    </div>
    
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
        form.action = '{{ route('admin.announcements.bulkDestroy') }}'; // Correct route for announcements bulk delete

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
@endsection
