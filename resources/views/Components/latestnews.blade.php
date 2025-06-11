
<div class="bg-gray-100 min-h-screen py-8">
    <!-- Top Logos Section -->
    <div class="container mx-auto px-4 py-6 overflow-x-auto whitespace-nowrap scrollbar-hide">
        <div class="flex items-center justify-center gap-x-8 md:gap-x-12">
            <img class="h-16 md:h-20 w-auto" src="{{ asset('storage/logos/coat-of-arms-of-the-philippines-logo-png_seeklogo-311689 1.svg') }}" alt="DILG Logo">
            <img class="h-16 md:h-20 w-auto" src="{{ asset('storage/logos/Department_of_Agriculture_of_the_Philippines.svg 1.svg') }}" alt="Logo 2">
            <img class="h-16 md:h-24 w-auto" src="{{ asset('storage/logos/Department_of_the_Interior_and_Local_Government_(DILG)_Seal_-_Logo.svg 1.svg') }}" alt="Logo 3">
            <img class="h-16 md:h-20 w-auto" src="{{ asset('storage/logos/images (5) 1.svg') }}" alt="Logo 4">
            <img class="h-16 md:h-28 w-auto" src="{{ asset('storage/logos/images 1.svg') }}" alt="Logo 5">
            <img class="h-16 md:h-20 w-auto" src="{{ asset('storage/logos/images__1_-removebg-preview (1) 1.svg') }}" alt="Logo 6">
            <img class="h-16 md:h-24 w-auto" src="{{ asset('storage/logos/Logo_of_the_Bureau_of_Internal_Revenue 1.svg') }}" alt="Logo 7">
            <img class="h-16 md:h-20 w-auto" src="{{ asset('storage/logos/png-clipart-executive-departments-of-the-philippines-department-of-health-health-care-public-health-presidents-problems-emblem-logo-thumbnail-removebg-preview 1.svg') }}" alt="Logo 8">
            <img class="h-16 md:h-20 w-auto" src="{{ asset('storage/logos/png-clipart-philippine-national-police-academy-national-police-commission-government-of-the-philippines-police-national-text-logo-thumbnail-removebg-preview 1.svg') }}" alt="Logo 9">
        </div>
    </div>

    <!-- News Section Container -->
    <div class="container mx-auto px-4 py-12 flex flex-col lg:flex-row items-start lg:items-center gap-8 lg:gap-12">
        <!-- Left Content: Latest News Title and Description -->
        <div class="w-full lg:w-1/3 flex flex-col items-start gap-6">
            <div class="space-y-4">
                <h2 class="text-indigo-900 text-3xl md:text-4xl font-bold font-serif">Latest News</h2>
                <p class="text-gray-700 text-sm md:text-base font-light leading-relaxed">
                    This page is made to show the latest local news happening here in the Philippines. It provides updates on important events, community stories, government announcements, and other news that matters to Filipinos. Stay informed and connected with what’s going on around the country through this page.
                </p>
            </div>
            <a href="{{ route('morenews') }}" class="w-48 md:w-56 h-12 md:h-14 flex items-center justify-center rounded-full border-2 border-indigo-900 text-indigo-900 text-lg font-medium hover:bg-indigo-900 hover:text-white transition-colors duration-300">
                MORE NEWS
            </a>
        </div>

        <!-- Right Content: News Carousel -->
        <div class="w-full lg:w-2/3 relative">
            <div class="flex items-center gap-4 md:gap-6 overflow-x-auto scrollbar-hide py-4" id="news-carousel">
                <!-- News Card 1 -->
                <div class="flex-none w-64 md:w-72 h-80 md:h-96 relative bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ asset('storage/Screenshot 2025-06-10 002831.png') }}" alt="Youth Leader Launches Park Clean-Up Drive in Cebu City" class="w-full h-2/3 object-cover">
                    <div class="absolute inset-x-0 bottom-0 h-1/3 bg-gradient-to-t from-indigo-900 via-indigo-900/80 to-transparent"></div>
                    <div class="absolute inset-x-0 bottom-0 p-3 md:p-4 flex flex-col justify-end">
                        <h3 class="text-white text-sm md:text-base font-bold leading-tight">Youth Leader Launches Park Clean-Up Drive in Cebu City</h3>
                        <p class="text-white text-xs font-light">Barangay volunteers join forces to restore green spaces</p>
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 h-1 bg-indigo-900"></div>
                </div>

                <!-- News Card 2 -->
                <div class="flex-none w-64 md:w-72 h-80 md:h-96 relative bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ asset('storage/Screenshot 2025-06-10 002831.png') }}" alt="Summer Style Takes Over: Youths Embrace Local Straw Hats" class="w-full h-2/3 object-cover">
                    <div class="absolute inset-x-0 bottom-0 h-1/3 bg-gradient-to-t from-indigo-900 via-indigo-900/80 to-transparent"></div>
                    <div class="absolute inset-x-0 bottom-0 p-3 md:p-4 flex flex-col justify-end">
                        <h3 class="text-white text-sm md:text-base font-bold leading-tight">Summer Style Takes Over: Youths Embrace Local Straw Hats</h3>
                        <p class="text-white text-xs font-light">Fashion meets tradition under the Philippine sun</p>
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 h-1 bg-indigo-900"></div>
                </div>

                <!-- News Card 3 -->
                <div class="flex-none w-64 md:w-72 h-80 md:h-96 relative bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ asset('storage/Screenshot 2025-06-10 002831.png') }}" alt="Urban Gardening Gains Popularity Among Gen Z" class="w-full h-2/3 object-cover">
                    <div class="absolute inset-x-0 bottom-0 h-1/3 bg-gradient-to-t from-indigo-900 via-indigo-900/80 to-transparent"></div>
                    <div class="absolute inset-x-0 bottom-0 p-3 md:p-4 flex flex-col justify-end">
                        <h3 class="text-white text-sm md:text-base font-bold leading-tight">Urban Gardening Gains Popularity Among Gen Z</h3>
                        <p class="text-white text-xs font-light">Green thumbs and good vibes fill city spaces</p>
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 h-1 bg-indigo-900"></div>
                </div>
            </div>

            <!-- Navigation Arrows -->
            <button class="absolute left-0 top-1/2 -translate-y-1/2 bg-white rounded-full p-2 md:p-3 shadow-lg z-10" onclick="scrollCarousel('news-carousel', -300)">
                <svg class="w-5 h-5 md:w-6 md:h-6 text-indigo-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <button class="absolute right-0 top-1/2 -translate-y-1/2 bg-white rounded-full p-2 md:p-3 shadow-lg z-10" onclick="scrollCarousel('news-carousel', 300)">
                <svg class="w-5 h-5 md:w-6 md:h-6 text-indigo-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        </div>
    </div>
</div>

<script>
    function scrollCarousel(id, scrollAmount) {
        const carousel = document.getElementById(id);
        carousel.scrollBy({
            left: scrollAmount,
            behavior: 'smooth'
        });
    }
</script>

<style>
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>