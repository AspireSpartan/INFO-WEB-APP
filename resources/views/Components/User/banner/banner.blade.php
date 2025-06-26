<!-- Component/user/banner/banner.blade.php-->
@props(['pageContent']) {{-- Accept the pageContent array as a prop --}}

@php
    // Use the main-container-bg field from the pageContent array, with a default fallback
    $bgImagePath = ($pageContent['main-container-bg'] ?? null)
        ? asset('storage/' . str_replace(asset('storage/'), '', $pageContent['main-container-bg'])) // Extract path if full URL is stored
        : asset('storage/LGU_bg.png'); // Fallback to a default local image
    // If the image is stored as a full URL, strip the base URL part for asset() to work correctly on the path
    if (str_starts_with($pageContent['main-container-bg'] ?? '', 'http')) {
        $bgImagePath = $pageContent['main-container-bg']; // Use directly if it's already a full URL
    }
@endphp

<div class="relative min-h-screen bg-cover bg-center pt-24" style="background-image: url('{{ $bgImagePath }}');">
    <div class="absolute inset-0 bg-gray-700/50 animate-bg-overlay"></div>

    {{-- (Existing Mobile Menu code - no changes needed here) --}}
    <div class="lg:hidden fixed inset-0 z-50 bg-black bg-opacity-75" x-cloak x-show="mobileMenuOpen"
         x-transition:enter="transition ease-in-out duration-300 transform"
         x-transition:enter-start="translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in-out duration-300 transform"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="translate-x-full">
        <div class="fixed inset-y-0 right-0 w-3/4 max-w-sm bg-gray-900 p-6 shadow-lg">
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center gap-2">
                    <img src="{{ asset('storage/CoreDev.svg') }}" alt="COREDEV Logo" class="h-11 w-auto animate-logo-slide">
                </div>
                <button type="button" class="text-gray-400 hover:text-white" @click="mobileMenuOpen = false">
                    <span class="sr-only">Close menu</span>
                    <svg class="size-8" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <nav class="flex flex-col gap-4">
                <a href="#" class="block text-white text-lg font-normal font-['Questrial'] hover:text-amber-400 py-2 animate-nav-item">Home</a>
                <div x-data="{ mobileServicesOpen: false }">
                    <button type="button" class="flex items-center justify-between w-full text-white text-lg font-normal font-['Questrial'] hover:text-amber-400 py-2 animate-nav-item"
                            @click="mobileServicesOpen = !mobileServicesOpen">
                        Services
                        <svg class="size-5 transition-transform duration-200"
                             :class="{ 'rotate-180': mobileServicesOpen }" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="mobileServicesOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-1"
                          class="pl-4 mt-2 space-y-2">
                        <a href="#" class="block text-gray-300 text-base hover:text-amber-400 animate-nav-subitem">Service 1</a>
                        <a href="#" class="block text-gray-300 text-base hover:text-amber-400 animate-nav-subitem">Service 2</a>
                        <a href="#" class="block text-gray-300 text-base hover:text-amber-400 animate-nav-subitem">Service 3</a>
                    </div>
                </div>
                <div x-data="{ mobileBlogOpen: false }">
                    <button type="button" class="flex items-center justify-between w-full text-white text-lg font-normal font-['Questrial'] hover:text-amber-400 py-2 animate-nav-item"
                            @click="mobileBlogOpen = !mobileBlogOpen">
                        Blog
                        <svg class="size-5 transition-transform duration-200"
                             :class="{ 'rotate-180': mobileBlogOpen }" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="mobileBlogOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-1"
                          class="pl-4 mt-2 space-y-2">
                        <a href="#" class="block text-gray-300 text-base hover:text-amber-400 animate-nav-subitem">Article 1</a>
                        <a href="#" class="block text-gray-300 text-base hover:text-amber-400 animate-nav-subitem">Article 2</a>
                        <a href="#" class="block text-gray-300 text-base hover:text-amber-400 animate-nav-subitem">Article 3</a>
                    </div>
                </div>
                <a href="#" class="block text-white text-lg font-normal font-['Questrial'] hover:text-amber-400 py-2 animate-nav-item">Contact Us</a>
                <a href="#" class="block bg-amber-400 text-white text-lg font-normal font-['Segoe_UI'] py-2 px-8 rounded-[30px] text-center hover:bg-amber-500 transition-colors mt-4 animate-nav-item">Sign In</a>
            </nav>
        </div>
    </div>

    <div class="relative z-10 flex flex-col items-end justify-center h-[calc(100vh-theme(spacing.24))] text-left px-4">
        <div class="w-full max-w-4xl space-y-6 md:space-y-8 lg:space-y-10 pr-2 md:pr-8 lg:pr-16">
            <p class="text-white text-2xl md:text-3xl lg:text-4xl font-normal font-['Noto_Sans'] animate-hero-text" style="--delay: 0.2s">
                {!! $pageContent['hero-subtitle-1'] ?? '“DRIVEN BY INNOVATION' !!} {{-- Dynamic Header 1 --}}
            </p>
            <h1 class="text-white text-6xl md:text-7xl lg:text-7xl font-bold font-['Merriweather'] leading-tight animate-hero-text" style="--delay: 0.4s">
                {!! $pageContent['hero-main-title'] ?? 'Local Government Unit' !!} {{-- Dynamic Header 2 --}}
            </h1>
            <p class="text-white text-2xl md:text-3xl lg:text-4xl font-normal font-['Roboto'] animate-hero-text" style="--delay: 0.6s">
                {!! $pageContent['hero-paragraph'] ?? 'Serving the community with <span class="text-amber-400">transparency</span>, <span class="text-amber-400">Integrity</span>, <br class="hidden sm:inline"/>and <span class="text-amber-400">commitment</span>.' !!} {{-- Dynamic Header 3 --}}
            </p>
            <p class="text-white text-lg md:text-xl lg:text-2xl font-normal font-['Source_Sans_Pro'] animate-hero-text" style="--delay: 0.8s">
                <span class="inline-block transform rotate-90 scale-x-[-1] text-2xl relative top-1 right-1"></span>{!! $pageContent['hero-subtitle-2'] ?? '/BREAKING BOUNDARIES' !!} {{-- Dynamic Header 4 --}}
            </p>
        </div>
    </div>

    <div class="relative z-10 w-full bg-zinc-500/20 shadow-md py-4 md:py-6 lg:py-8 px-4 sm:px-8 lg:px-16 mt-auto">
        <div class="flex flex-col sm:flex-row justify-around items-center gap-6 md:gap-12 lg:gap-24">
            <div class="text-center animate-stat-item" style="--delay: 0.2s">
                <div class="text-white text-3xl md:text-4xl font-bold font-['Merriweather']" data-target="{{ intval(str_replace('+', '', $pageContent['stat-1-number'] ?? 0)) }}">{!! $pageContent['stat-1-number'] ?? 0 !!}</div> {{-- Dynamic Barangay Number --}}
                <div class="text-white text-sm md:text-lg font-light font-['Merriweather']">{!! $pageContent['stat-1-label'] ?? 'Barangay' !!}</div> {{-- Dynamic Barangay Label --}}
            </div>
            <div class="text-center animate-stat-item" style="--delay: 0.4s">
                <div class="text-white text-3xl md:text-4xl font-bold font-['Merriweather']" data-target="{{ intval(str_replace('+', '', $pageContent['stat-2-number'] ?? 0)) }}">{!! $pageContent['stat-2-number'] ?? 0 !!}</div> {{-- Dynamic Residents Number --}}
                <div class="text-white text-sm md:text-lg font-light font-['Merriweather']">{!! $pageContent['stat-2-label'] ?? 'Residents' !!}</div> {{-- Dynamic Residents Label --}}
            </div>
            <div class="text-center animate-stat-item" style="--delay: 0.6s">
                <div class="text-white text-3xl md:text-4xl font-bold font-['Merriweather']" data-target="{{ intval(str_replace('+', '', $pageContent['stat-3-number'] ?? 0)) }}">{!! $pageContent['stat-3-number'] ?? 0 !!}</div> {{-- Dynamic Projects Number --}}
                <div class="text-white text-sm md:text-lg font-light font-['Merriweather']">{!! $pageContent['stat-3-label'] ?? 'Public Projects' !!}</div> {{-- Dynamic Projects Label --}}
            </div>
            <div class="text-center animate-stat-item" style="--delay: 0.8s">
                <div class="text-white text-3xl md:text-4xl font-bold font-['Merriweather']" data-target="{{ intval(str_replace('+', '', $pageContent['stat-4-number'] ?? 0)) }}">{!! $pageContent['stat-4-number'] ?? 0 !!}</div> {{-- Dynamic Years of Service Number --}}
                <div class="text-white text-sm md:text-lg font-light font-['Merriweather']">{!! $pageContent['stat-4-label'] ?? 'Years of Service' !!}</div> {{-- Dynamic Years of Service Label --}}
            </div>
        </div>
        <div class="w-full h-px bg-white/50 my-6"></div>
        <p class="relative z-10 w-full text-center text-white text-xs md:text-sm lg:text-base font-normal font-['Questrial'] px-4 md:px-8 lg:px-16 animate-footer-text">
            {!! $pageContent['footer-paragraph'] ?? 'Default description text about Local Government Units (LGUs) in the Philippines...' !!} {{-- Dynamic Footer Paragraph --}}
        </p>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('mobileMenuState', () => ({
            mobileMenuOpen: false,
        }))
    })

    // Animation on page load
    document.addEventListener('DOMContentLoaded', () => {
        const heroItems = document.querySelectorAll('.animate-hero-text');
        const statItems = document.querySelectorAll('.animate-stat-item');
        const footerText = document.querySelector('.animate-footer-text');

        heroItems.forEach(item => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(20px)';
            setTimeout(() => {
                item.style.transition = 'opacity 0.8s ease-in-out, transform 0.8s ease-in-out';
                item.style.opacity = '1';
                item.style.transform = 'translateY(0)';
            }, parseFloat(item.style.getPropertyValue('--delay')) * 1000);
        });

        statItems.forEach(item => {
            item.style.opacity = '0';
            item.style.transform = 'scale(0.8)';
            setTimeout(() => {
                item.style.transition = 'opacity 0.8s ease-in-out, transform 0.8s ease-in-out';
                item.style.opacity = '1';
                item.style.transform = 'scale(1)';
            }, parseFloat(item.style.getPropertyValue('--delay')) * 1000);
        });

        if (footerText) { // Ensure footerText exists before trying to access its style
            footerText.style.opacity = '0';
            footerText.style.transform = 'translateY(10px)';
            setTimeout(() => {
                footerText.style.transition = 'opacity 1s ease-in-out, transform 1s ease-in-out';
                footerText.style.opacity = '1';
                footerText.style.transform = 'translateY(0)';
            }, 1000);
        }
    });


    document.addEventListener('DOMContentLoaded', () => {
        const heroItems = document.querySelectorAll('.animate-hero-text');
        const statItems = document.querySelectorAll('.animate-stat-item');
        const footerText = document.querySelector('.animate-footer-text');

        // Function to animate numbers
        function animateNumber(element, start, end, duration, addPlus = false) { // Added addPlus parameter
            let current = start;
            const increment = (end - start) / (duration / 10);
            const interval = setInterval(() => {
                current = Math.min(current + increment, end); // Ensure current doesn't overshoot end
                let displayValue = Math.floor(current);
                element.textContent = displayValue + (addPlus && displayValue > 0 ? '+' : ''); // Conditionally add '+'

                if (current >= end) {
                    clearInterval(interval);
                    element.textContent = end + (addPlus && end > 0 ? '+' : ''); // Ensure final number is exact
                }
            }, 10);
        }

        // Apply number animation to each stat item
        statItems.forEach(item => {
            const numberElement = item.querySelector('div:first-child');
            // Get target from data-target, ensure it's a number
            // Safely parse integer, handling potential '+' and ensuring a default of 0
            const targetNumber = parseInt(String(numberElement.getAttribute('data-target')).replace('+', ''), 10) || 0; 
            const textContent = numberElement.textContent; // Get initial text content
            const needsPlus = textContent.includes('+'); // Check if '+' was present

            numberElement.textContent = '0' + (needsPlus ? '+' : ''); // Start from 0 (with optional '+')
            animateNumber(numberElement, 0, targetNumber, 2000, needsPlus); // Pass needsPlus to animateNumber
        });

        heroItems.forEach(item => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(20px)';
            setTimeout(() => {
                item.style.transition = 'opacity 0.8s ease-in-out, transform 0.8s ease-in-out';
                item.style.opacity = '1';
                item.style.transform = 'translateY(0)';
            }, parseFloat(item.style.getPropertyValue('--delay')) * 1000);
        });

        if (footerText) { // Ensure footerText exists before trying to access its style
            footerText.style.opacity = '0';
            footerText.style.transform = 'translateY(10px)';
            setTimeout(() => {
                footerText.style.transition = 'opacity 1s ease-in-out, transform 1s ease-in-out';
                footerText.style.opacity = '1';
                footerText.style.transform = 'translateY(0)';
            }, 1000);
        }
    });
</script>

<style>
    /* ... (Your existing CSS animations - no changes needed here) ... */
    .animate-bg-overlay {
        opacity: 0;
        animation: fadeIn 1.5s ease-in-out forwards;
    }

    .animate-logo-slide {
        transform: translateX(-20px);
        opacity: 0;
        animation: slideIn 0.5s ease-in-out forwards;
    }

    .animate-nav-item {
        opacity: 0;
        transform: translateX(20px);
        animation: slideIn 0.5s ease-in-out forwards;
        animation-delay: calc(var(--index, 0) * 0.1s);
    }

    .animate-nav-subitem {
        opacity: 0;
        transform: translateX(10px);
        animation: slideIn 0.4s ease-in-out forwards;
        animation-delay: calc(var(--index, 0) * 0.1s);
    }

    .animate-hero-text {
        opacity: 0;
        transform: translateY(20px);
    }

    .animate-stat-item {
        opacity: 0;
        transform: scale(0.8);
    }

    .animate-footer-text {
        opacity: 0;
        transform: translateY(10px);
    }

    @keyframes fadeIn {
        to { opacity: 1; }
    }

    @keyframes slideIn {
        to { opacity: 1; transform: translateX(0); }
    }
</style>
