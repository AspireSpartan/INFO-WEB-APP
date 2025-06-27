<header style="font-family: 'Merriweather', questrial;" class="fixed top-0 left-0 w-full bg-black/50 z-50" x-data="{ mobileMenuOpen: false }">
    <nav class="container mx-auto px-4 h-20 flex items-center justify-between">
        {{-- Logo --}}
        <div class="flex items-center">
           <a href="/home">
        <img src="{{ asset('storage/CoreDev.svg') }}" alt="COREDEV Logo" class="h-10 w-auto">
    </a>
        </div>

        {{-- Desktop Navigation --}}
        <div class="hidden lg:flex items-center space-x-8 lg:space-x-12">
            {{-- Home Dropdown (assuming it needs one based on previous discussions) --}}
            <div class="relative" x-data="{ open: false }" @click.away="open = false">
                <button type="button" class="flex items-center gap-x-1 text-white text-base font-normal font-['Questrial'] hover:text-amber-400 cursor-pointer"style="font-size: 15px !important;"
                        @click="open = !open" aria-expanded="false" :aria-expanded="open.toString()">
                    Home
                    <svg class="size-4 flex-none text-white transition-transform duration-200"
                         :class="{ 'rotate-180': open }" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                    </svg>
                </button>
                <div x-show="open" x-cloak
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-1"
                        class="absolute left-1/2 -translate-x-1/2 mt-2 w-48 rounded-md shadow-lg bg-gray-800 ring-1 ring-black ring-opacity-5 focus:outline-none z-50"
                        role="menu" aria-orientation="vertical" aria-labelledby="services-menu-button" tabindex="-1">
                    <div class="py-1" role="none">
                        <a href="/home" data-scroll-percent="0" class="scroll-link block px-4 py-2 text-sm text-white hover:bg-gray-700 font-['Questrial'] whitespace-nowrap" role="menuitem" tabindex="-1" @click="open = false; mobileMenuOpen = false">Banner</a>
                        <a href="/home" data-scroll-percent="22" class="scroll-link block px-4 py-2 text-sm text-white hover:bg-gray-700 font-['Questrial'] whitespace-nowrap" role="menuitem" tabindex="-1" @click="open = false; mobileMenuOpen = false">Latest News</a>
                        <a href="/home" data-scroll-percent="36" class="scroll-link block px-4 py-2 text-sm text-white hover:bg-gray-700 font-['Questrial'] whitespace-nowrap" role="menuitem" tabindex="-1" @click="open = false; mobileMenuOpen = false">Strategic plan</a>
                        <a href="/home" data-scroll-percent="51" class="scroll-link block px-4 py-2 text-sm text-white hover:bg-gray-700 font-['Questrial'] whitespace-nowrap" role="menuitem" tabindex="-1" @click="open = false; mobileMenuOpen = false">Projects</a>
                        <a href="/home" data-scroll-percent="80" class="scroll-link block px-4 py-2 text-sm text-white hover:bg-gray-700 font-['Questrial'] whitespace-nowrap" role="menuitem" tabindex="-1" @click="open = false; mobileMenuOpen = false">Officials</a>
                        <a href="/home" data-scroll-percent="100" class="scroll-link block px-4 py-2 text-sm text-white hover:bg-gray-700 font-['Questrial'] whitespace-nowrap" role="menuitem" tabindex="-1" @click="open = false; mobileMenuOpen = false">Footer</a>
                    </div>
                </div>
            </div>

            {{-- Services Dropdown --}}
            <div class="relative" x-data="{ open: false }" @click.away="open = false">
                <button type="button" class="flex items-center gap-x-1 text-white text-base font-normal font-['Questrial'] hover:text-amber-400 cursor-pointer"style="font-size: 15px !important;"
                        @click="open = !open" aria-expanded="false" :aria-expanded="open.toString()">
                    Services
                    <svg class="size-4 flex-none text-white transition-transform duration-200"
                         :class="{ 'rotate-180': open }" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                    </svg>
                </button>
                <div x-show="open" x-cloak
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-1"
                        class="absolute left-1/2 -translate-x-1/2 mt-2 w-48 rounded-md shadow-lg bg-gray-800 ring-1 ring-black ring-opacity-5 focus:outline-none z-50"
                        role="menu" aria-orientation="vertical" aria-labelledby="services-menu-button" tabindex="-1">
                    <div class="py-1" role="none">
                        <a href="/cedula" class="block px-4 py-2 text-sm text-white hover:bg-gray-700 font-['Questrial'] whitespace-nowrap" role="menuitem" tabindex="-1">Cedula</a>
                        <a href="#" class="block px-4 py-2 text-sm text-white hover:bg-gray-700 font-['Questrial'] whitespace-nowrap" role="menuitem" tabindex="-1">Mobile App Development</a>
                        <a href="#" class="block px-4 py-2 text-sm text-white hover:bg-gray-700 font-['Questrial'] whitespace-nowrap" role="menuitem" tabindex="-1">UI/UX Design</a>
                        <a href="#" class="block px-4 py-2 text-sm text-white hover:bg-gray-700 font-['Questrial'] whitespace-nowrap" role="menuitem" tabindex="-1">Cloud Solutions</a>
                    </div>
                </div>
            </div>

            {{-- Blog Dropdown --}}
            <div class="relative" x-data="{ open: false }" @click.away="open = false">
                <button type="button" class="flex items-center gap-x-1 text-white text-base font-normal font-['Questrial'] hover:text-amber-400 cursor-pointer"style="font-size: 15px !important;"
                        @click="open = !open" aria-expanded="false" :aria-expanded="open.toString()">
                    Blog
                    <svg class="size-4 flex-none text-white transition-transform duration-200"
                         :class="{ 'rotate-180': open }" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                    </svg>
                </button>
               <div x-show="open" x-cloak
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-1"
                        class="absolute left-1/2 -translate-x-1/2 mt-2 w-48 rounded-md shadow-lg bg-gray-800 ring-1 ring-black ring-opacity-5 focus:outline-none z-50"
                        role="menu" aria-orientation="vertical" aria-labelledby="services-menu-button" tabindex="-1">
                    <div class="py-1" role="none">
                        <a href="/blog" class="block px-4 py-2 text-sm text-white hover:bg-gray-700 font-['Questrial'] whitespace-nowrap" role="menuitem" tabindex="-1">Latest Articles</a>
                        <a href="#" class="block px-4 py-2 text-sm text-white hover:bg-gray-700 font-['Questrial'] whitespace-nowrap" role="menuitem" tabindex="-1">Tech News</a>
                        <a href="#" class="block px-4 py-2 text-sm text-white hover:bg-gray-700 font-['Questrial'] whitespace-nowrap" role="menuitem" tabindex="-1">Case Studies</a>
                    </div>
                </div>
            </div>

            {{-- Contact Us (No Dropdown) --}}
            <a href="/contact-us" class="text-white text-base font-normal font-['Questrial'] hover:text-amber-400"style="font-size: 15px !important;">Contact Us</a>
        </div>

        {{-- Sign In Button (Desktop) --}}
        <a href="/sign-in" class="hidden lg:block bg-amber-400 text-white text-lg font-normal font-['Segoe_UI'] py-1 px-6 rounded-[30px] hover:bg-amber-500 transition-colors"style="font-size: 15px !important;">Sign In</a>

        {{-- Mobile Menu Button --}}
        <button type="button" style="font-size: 15px !important;"class="lg:hidden text-white focus:outline-none" @click="mobileMenuOpen = true">
            <span class="sr-only">Open main menu</span>
            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>
    </nav>

    {{-- Mobile Menu (Overlay) --}}
    <div x-show="mobileMenuOpen"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-full"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-full"
         class="fixed inset-0 bg-black bg-opacity-95 z-50 lg:hidden flex flex-col items-center justify-center space-y-8 py-8"
         @click.away="mobileMenuOpen = false">
        <button type="button" class="absolute top-4 right-4 text-white focus:outline-none" @click="mobileMenuOpen = false">
            <span class="sr-only">Close menu</span>
            <svg class="size-8" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <a href="/home" class="text-white text-2xl font-normal font-['Questrial'] hover:text-amber-400" @click="mobileMenuOpen = false">Home</a>

        {{-- Mobile Services Dropdown (simplified for mobile, or could be an accordion) --}}
        <div x-data="{ open: false }" class="w-full text-center">
            <button class="text-white text-2xl font-normal font-['Questrial'] hover:text-amber-400 flex items-center justify-center mx-auto gap-x-2"
                    @click="open = !open">
                Services
                <svg class="size-6 text-white transition-transform duration-200"
                     :class="{ 'rotate-180': open }" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                </svg>
            </button>
            <div x-show="open" x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                 class="mt-4 flex flex-col space-y-4 text-xl">
                <a href="#" class="text-white hover:text-amber-400 font-['Questrial']" @click="mobileMenuOpen = false">Web Dev</a>
                <a href="#" class="text-white hover:text-amber-400 font-['Questrial']" @click="mobileMenuOpen = false">Mobile Apps</a>
                <a href="#" class="text-white hover:text-amber-400 font-['Questrial']" @click="mobileMenuOpen = false">UI/UX</a>
            </div>
        </div>

        {{-- Mobile Blog Dropdown --}}
        <div x-data="{ open: false }" class="w-full text-center">
            <button class="text-white text-2xl font-normal font-['Questrial'] hover:text-amber-400 flex items-center justify-center mx-auto gap-x-2"
                    @click="open = !open">
                Blog
                <svg class="size-6 text-white transition-transform duration-200"
                     :class="{ 'rotate-180': open }" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                </svg>
            </button>
            <div x-show="open" x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                 class="mt-4 flex flex-col space-y-4 text-xl">
                <a href="#" class="text-white hover:text-amber-400 font-['Questrial']" @click="mobileMenuOpen = false">Latest</a>
                <a href="#" class="text-white hover:text-amber-400 font-['Questrial']" @click="mobileMenuOpen = false">Categories</a>
            </div>
        </div>
        <a href="/sign-in" class="bg-amber-400 text-white text-2xl font-normal font-['Segoe_UI'] py-3 px-10 rounded-[30px] hover:bg-amber-500 transition-colors" @click="mobileMenuOpen = false">Sign In</a>
    </div>
</header>