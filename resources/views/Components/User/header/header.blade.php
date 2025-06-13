<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Web Info App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body>
     <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<header class="absolute inset-x-0 top-0 z-50 py-6 px-4 md:px-8 lg:px-16 flex items-center justify-between">
    {{-- Logo --}}
    <div class="flex items-center gap-2">
        <img src="{{ asset('storage/CoreDev.svg') }}" alt="COREDEV Logo" class="h-10 w-auto">
    </div>

    {{-- Desktop Navigation --}}
    <nav class="hidden lg:flex items-center gap-x-12">
        {{-- Home --}}
        <a href="/home" class="text-white text-base font-normal font-['Questrial'] hover:text-amber-400">Home</a>

        {{-- Services Dropdown (assuming dropdown functionality here) --}}
        {{-- The 'relative' class on the parent div is CRUCIAL for absolute positioning of its children --}}
        <div class="relative" x-data="{ open: false }" @click.away="open = false">
            <button type="button" class="flex items-center gap-x-1 text-white text-base font-normal font-['Questrial'] hover:text-amber-400"
                    @click="open = !open" aria-expanded="false" :aria-expanded="open.toString()">
                Services
                <svg class="size-4 flex-none text-white transition-transform duration-200"
                     :class="{ 'rotate-180': open }" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                </svg>
            </button>
            {{-- The dropdown content itself needs to be 'absolute' and have a higher 'z-index' --}}
            <div x-show="open"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-1"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 translate-y-1"
                 class="absolute left-1/2 -translate-x-1/2 mt-2 w-48 rounded-md shadow-lg bg-gray-800 ring-1 ring-black ring-opacity-5 focus:outline-none z-50" {{-- Added z-50 here --}}
                 role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                <div class="py-1" role="none">
                    <a href="#" class="text-white block px-4 py-2 text-sm hover:bg-gray-700" role="menuitem" tabindex="-1">Service 1</a>
                    <a href="#" class="text-white block px-4 py-2 text-sm hover:bg-gray-700" role="menuitem" tabindex="-1">Service 2</a>
                    <a href="#" class="text-white block px-4 py-2 text-sm hover:bg-gray-700" role="menuitem" tabindex="-1">Service 3</a>
                </div>
            </div>
        </div>

        {{-- Blog Dropdown --}}
         <div class="relative" x-data="{ open: false }" @click.away="open = false">
            <button type="button" class="flex items-center gap-x-1 text-white text-base font-normal font-['Questrial'] hover:text-amber-400"
                    @click="open = !open" aria-expanded="false" :aria-expanded="open.toString()">
                Blog
                <svg class="size-4 flex-none text-white transition-transform duration-200"
                     :class="{ 'rotate-180': open }" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                </svg>
            </button>
            <div x-show="open"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-1"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 translate-y-1"
                 class="absolute left-1/2 -translate-x-1/2 mt-2 w-48 rounded-md shadow-lg bg-gray-800 ring-1 ring-black ring-opacity-5 focus:outline-none z-50" {{-- Added z-50 here --}}
                 role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                <div class="py-1" role="none">
                    <a href="#" class="text-white block px-4 py-2 text-sm hover:bg-gray-700" role="menuitem" tabindex="-1">Article 1</a>
                    <a href="#" class="text-white block px-4 py-2 text-sm hover:bg-gray-700" role="menuitem" tabindex="-1">Article 2</a>
                    <a href="#" class="text-white block px-4 py-2 text-sm hover:bg-gray-700" role="menuitem" tabindex="-1">Article 3</a>
                </div>
            </div>
        </div>

        <a href="#" class="text-white text-base font-normal font-['Questrial'] hover:text-amber-400">Contact Us</a>
    </nav>

    {{-- Sign In Button (Desktop) --}}
    <a href="#" class="hidden lg:block bg-amber-400 text-white text-lg font-normal font-['Segoe_UI'] py-2 px-8 rounded-[30px] hover:bg-amber-500 transition-colors">Sign In</a>

    {{-- Mobile Menu Button --}}
    <button type="button" class="lg:hidden text-gray-400 hover:text-white" @click="mobileMenuOpen = true">
        <span class="sr-only">Open main menu</span>
        <svg class="size-8" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
    </button>
</header>

{{$slot}}

</body>
</html>

