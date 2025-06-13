<div class="bg-gray-100 min-h-screen py-8 z-10">
    <!-- Top Logos Section with staggered slide-in animations -->
    <div class="container mx-auto px-4 py-6 overflow-x-auto whitespace-nowrap scrollbar-hide animate-on-scroll">
        <div class="flex items-center justify-center gap-x-8 md:gap-x-12 animate-on-scroll">
            <img class="h-16 md:h-20 w-auto animate-logo-slide" style="--delay: 0.1s" src="{{ asset('storage/coat-of-arms-of-the-philippines-logo-png_seeklogo-311689 1.svg') }}" alt="DILG Logo">
            <img class="h-16 md:h-20 w-auto animate-logo-slide" style="--delay: 0.2s" src="{{ asset('storage/Department_of_Agriculture_of_the_Philippines.svg 1.svg') }}" alt="Logo 2">
            <img class="h-16 md:h-24 w-auto animate-logo-slide" style="--delay: 0.3s" src="{{ asset('storage/Department_of_the_Interior_and_Local_Government_(DILG)_Seal_-_Logo.svg 1.svg') }}" alt="Logo 3">
            <img class="h-16 md:h-20 w-auto animate-logo-slide" style="--delay: 0.4s" src="{{ asset('storage/images (5) 1.svg') }}" alt="Logo 4">
            <img class="h-16 md:h-28 w-auto animate-logo-slide" style="--delay: 0.5s" src="{{ asset('storage/images 1.svg') }}" alt="Logo 5">
            <img class="h-16 md:h-20 w-auto animate-logo-slide" style="--delay: 0.6s" src="{{ asset('storage/images__1_-removebg-preview (1) 1.svg') }}" alt="Logo 6">
            <img class="h-16 md:h-24 w-auto animate-logo-slide" style="--delay: 0.7s" src="{{ asset('storage/Logo_of_the_Bureau_of_Internal_Revenue 1.svg') }}" alt="Logo 7">
            <img class="h-16 md:h-20 w-auto animate-logo-slide" style="--delay: 0.8s" src="{{ asset('storage/png-clipart-executive-departments-of-the-philippines-department-of-health-health-care-public-health-presidents-problems-emblem-logo-thumbnail-removebg-preview 1.svg') }}" alt="Logo 8">
            <img class="h-16 md:h-20 w-auto animate-logo-slide" style="--delay: 0.9s" src="{{ asset('storage/png-clipart-philippine-national-police-academy-national-police-commission-government-of-the-philippines-police-national-text-logo-thumbnail-removebg-preview 1.svg') }}" alt="Logo 9">
        </div>
    </div>

    <!-- News Section Container -->
    <div class="container mx-auto px-4 py-12 flex flex-col lg:flex-row items-start lg:items-center gap-8 lg:gap-12">
        <!-- Left Content: Latest News Title and Description -->
        <div class="w-full lg:w-1/3 flex flex-col items-start gap-6">
            <div class="space-y-4">
                <h2 class="text-indigo-900 text-3xl md:text-4xl font-bold font-serif animate-title-slide">Latest News</h2>
                <p class="text-gray-700 text-sm md:text-base font-light leading-relaxed animate-text-fade" style="--delay: 0.2s">
                    This page is made to show the latest local news happening here in the Philippines. It provides updates on important events, community stories, government announcements, and other news that matters to Filipinos. Stay informed and connected with what’s going on around the country through this page.
                </p>
            </div>
            <a href="{{ route('morenews') }}" class="w-48 md:w-56 h-12 md:h-14 flex items-center justify-center rounded-full border-2 border-indigo-900 text-indigo-900 text-lg font-medium hover:bg-indigo-900 hover:text-white transition-colors duration-300 animate-button-pop" style="--delay: 0.4s">
                MORE NEWS
            </a>
        </div>

        <!-- Right Content: News Carousel -->
        <div class="w-full lg:w-2/3 relative">
            <div class="flex items-center gap-4 md:gap-6 overflow-x-auto scrollbar-hide py-4" id="news-carousel">
                <!-- News Card 1 -->
                <div class="flex-none w-64 md:w-72 h-80 md:h-96 relative bg-white rounded-lg shadow-md overflow-hidden animate-card-slide" style="--delay: 0.2s">
                    <img src="{{ asset('storage/Screenshot 2025-06-10 002831.png') }}" alt="Youth Leader Launches Park Clean-Up Drive in Cebu City" class="w-full h-2/3 object-cover transition-transform duration-300 hover:scale-105">
                    <div class="absolute inset-x-0 bottom-0 h-1/3 bg-gradient-to-t from-indigo-900 via-indigo-900/80 to-transparent"></div>
                    <div class="absolute inset-x-0 bottom-0 p-3 md:p-4 flex flex-col justify-end">
                        <h3 class="text-white text-sm md:text-base font-bold leading-tight">Youth Leader Launches Park Clean-Up Drive in Cebu City</h3>
                        <p class="text-white text-xs font-light">Barangay volunteers join forces to restore green spaces</p>
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 h-1 bg-indigo-900"></div>
                </div>

                <!-- News Card 2 -->
                <div class="flex-none w-64 md:w-72 h-80 md:h-96 relative bg-white rounded-lg shadow-md overflow-hidden animate-card-slide" style="--delay: 0.4s">
                    <img src="{{ asset('storage/Screenshot 2025-06-10 002831.png') }}" alt="Summer Style Takes Over: Youths Embrace Local Straw Hats" class="w-full h-2/3 object-cover transition-transform duration-300 hover:scale-105">
                    <div class="absolute inset-x-0 bottom-0 h-1/3 bg-gradient-to-t from-indigo-900 via-indigo-900/80 to-transparent"></div>
                    <div class="absolute inset-x-0 bottom-0 p-3 md:p-4 flex flex-col justify-end">
                        <h3 class="text-white text-sm md:text-base font-bold leading-tight">Summer Style Takes Over: Youths Embrace Local Straw Hats</h3>
                        <p class="text-white text-xs font-light">Fashion meets tradition under the Philippine sun</p>
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 h-1 bg-indigo-900"></div>
                </div>

                <!-- News Card 3 -->
                <div class="flex-none w-64 md:w-72 h-80 md:h-96 relative bg-white rounded-lg shadow-md overflow-hidden animate-card-slide" style="--delay: 0.6s">
                    <img src="{{ asset('storage/Screenshot 2025-06-10 002831.png') }}" alt="Urban Gardening Gains Popularity Among Gen Z" class="w-full h-2/3 object-cover transition-transform duration-300 hover:scale-105">
                    <div class="absolute inset-x-0 bottom-0 h-1/3 bg-gradient-to-t from-indigo-900 via-indigo-900/80 to-transparent"></div>
                    <div class="absolute inset-x-0 bottom-0 p-3 md:p-4 flex flex-col justify-end">
                        <h3 class="text-white text-sm md:text-base font-bold leading-tight">Urban Gardening Gains Popularity Among Gen Z</h3>
                        <p class="text-white text sputex-xs font-light">Green thumbs and good vibes fill city spaces</p>
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 h-1 bg-indigo-900"></div>
                </div>
            </div>

            <!-- Navigation Arrows with hover animation -->
            <button class="absolute left-0 top-1/2 -translate-y-1/2 bg-white rounded-full p-2 md:p-3 shadow-lg z-10 hover:scale-110 transition-transform duration-200" onclick="scrollCarousel('news-carousel', -300)">
                <svg class="w-5 h-5 md:w-6 md:h-6 text-indigo-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <button class="absolute right-0 top-1/2 -translate-y-1/2 bg-white rounded-full p-2 md:p-3 shadow-lg z-10 hover:scale-110 transition-transform duration-200" onclick="scrollCarousel('news-carousel', 300)">
                <svg class="w-5 h-5 md:w-6 md:h-6 text-indigo-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const logoItems = document.querySelectorAll('.animate-logo-slide');
        const title = document.querySelector('.animate-title-slide');
        const text = document.querySelector('.animate-text-fade');
        const button = document.querySelector('.animate-button-pop');
        const cards = document.querySelectorAll('.animate-card-slide');

        logoItems.forEach((item, index) => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(20px)';
            setTimeout(() => {
                item.style.transition = 'opacity 0.6s ease-in-out, transform 0.6s ease-in-out';
                item.style.opacity = '1';
                item.style.transform = 'translateY(0)';
            }, parseFloat(item.style.getPropertyValue('--delay')) * 1000);
        });

        title.style.opacity = '0';
        title.style.transform = 'translateX(-20px)';
        setTimeout(() => {
            title.style.transition = 'opacity 0.8s ease-in-out, transform 0.8s ease-in-out';
            title.style.opacity = '1';
            title.style.transform = 'translateX(0)';
        }, 200);

        text.style.opacity = '0';
        text.style.transform = 'translateY(20px)';
        setTimeout(() => {
            text.style.transition = 'opacity 0.8s ease-in-out, transform 0.8s ease-in-out';
            text.style.opacity = '1';
            text.style.transform = 'translateY(0)';
        }, parseFloat(text.style.getPropertyValue('--delay')) * 1000);

        button.style.opacity = '0';
        button.style.transform = 'scale(0.8)';
        setTimeout(() => {
            button.style.transition = 'opacity 0.6s ease-in-out, transform 0.6s ease-in-out';
            button.style.opacity = '1';
            button.style.transform = 'scale(1)';
        }, parseFloat(button.style.getPropertyValue('--delay')) * 1000);

        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            setTimeout(() => {
                card.style.transition = 'opacity 0.7s ease-in-out, transform 0.7s ease-in-out';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, parseFloat(card.style.getPropertyValue('--delay')) * 1000);
        });
    });

    function scrollCarousel(id, scrollAmount) {
        const carousel = document.getElementById(id);
        carousel.scrollBy({
            left: scrollAmount,
            behavior: 'smooth'
        });
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const elementsToAnimate = document.querySelectorAll('.animate-on-scroll');

        const observerOptions = {
            root: null, // Use the viewport as the root
            rootMargin: '0px',
            threshold: 0.1 // Trigger when 10% of the element is visible
        };

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('start-animation');
                    observer.unobserve(entry.target); // Stop observing once animated
                }
            });
        }, observerOptions);

        elementsToAnimate.forEach(element => {
            observer.observe(element);
        });
    });
</script>

<style>
    .animate-on-scroll {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.8s ease-out, transform 0.8s ease-out;
    }

    .start-animation {
        opacity: 1;
        transform: translateY(0);
    }
</style>

<style>
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    .animate-logo-slide {
        opacity: 0;
        transform: translateY(20px);
    }

    .animate-title-slide {
        opacity: 0;
        transform: translateX(-20px);
    }

    .animate-text-fade {
        opacity: 0;
        transform: translateY(20px);
    }

    .animate-button-pop {
        opacity: 0;
        transform: scale(0.8);
    }

    .animate-card-slide {
        opacity: 0;
        transform: translateY(30px);
    }
</style>