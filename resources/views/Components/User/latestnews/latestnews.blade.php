@props(['newsItems'])
<div class="bg-gray-100 min-h-screen py-8 z-10">
    <!-- Logo Carousel Section -->
    <div class="container mx-auto px-4 py-6 overflow-hidden animate-on-scroll">
        <div class="relative h-28 md:h-32 overflow-hidden">
            <div class="logos-track absolute top-0 left-0 flex items-center gap-x-8 md:gap-x-12 animate-scroll">
                <!-- First set of logos -->
                <img class="h-16 md:h-20 w-auto" src="{{ asset('storage/coat-of-arms-of-the-philippines-logo-png_seeklogo-311689 1.svg') }}" alt="DILG Logo">
                <img class="h-16 md:h-20 w-auto" src="{{ asset('storage/Department_of_Agriculture_of_the_Philippines.svg 1.svg') }}" alt="Logo 2">
                <img class="h-16 md:h-24 w-auto" src="{{ asset('storage/Department_of_the_Interior_and_Local_Government_(DILG)_Seal_-_Logo.svg 1.svg') }}" alt="Logo 3">
                <img class="h-16 md:h-20 w-auto" src="{{ asset('storage/images (5) 1.svg') }}" alt="Logo 4">
                <img class="h-16 md:h-28 w-auto" src="{{ asset('storage/images 1.svg') }}" alt="Logo 5">
                <img class="h-16 md:h-20 w-auto" src="{{ asset('storage/images__1_-removebg-preview (1) 1.svg') }}" alt="Logo 6">
                <img class="h-16 md:h-24 w-auto" src="{{ asset('storage/Logo_of_the_Bureau_of_Internal_Revenue 1.svg') }}" alt="Logo 7">
                <img class="h-16 md:h-20 w-auto" src="{{ asset('storage/png-clipart-executive-departments-of-the-philippines-department-of-health-health-care-public-health-presidents-problems-emblem-logo-thumbnail-removebg-preview 1.svg') }}" alt="Logo 8">
                <img class="h-16 md:h-20 w-auto" src="{{ asset('storage/png-clipart-philippine-national-police-academy-national-police-commission-government-of-the-philippines-police-national-text-logo-thumbnail-removebg-preview 1.svg') }}" alt="Logo 9">
                
                <!-- Duplicate set for seamless looping -->
                <img class="h-16 md:h-20 w-auto" src="{{ asset('storage/coat-of-arms-of-the-philippines-logo-png_seeklogo-311689 1.svg') }}" alt="DILG Logo">
                <img class="h-16 md:h-20 w-auto" src="{{ asset('storage/Department_of_Agriculture_of_the_Philippines.svg 1.svg') }}" alt="Logo 2">
                <img class="h-16 md:h-24 w-auto" src="{{ asset('storage/Department_of_the_Interior_and_Local_Government_(DILG)_Seal_-_Logo.svg 1.svg') }}" alt="Logo 3">
                <img class="h-16 md:h-20 w-auto" src="{{ asset('storage/images (5) 1.svg') }}" alt="Logo 4">
                <img class="h-16 md:h-28 w-auto" src="{{ asset('storage/images 1.svg') }}" alt="Logo 5">
                <img class="h-16 md:h-20 w-auto" src="{{ asset('storage/images__1_-removebg-preview (1) 1.svg') }}" alt="Logo 6">
                <img class="h-16 md:h-24 w-auto" src="{{ asset('storage/Logo_of_the_Bureau_of_Internal_Revenue 1.svg') }}" alt="Logo 7">
                <img class="h-16 md:h-20 w-auto" src="{{ asset('storage/png-clipart-executive-departments-of-the-philippines-department-of-health-health-care-public-health-presidents-problems-emblem-logo-thumbnail-removebg-preview 1.svg') }}" alt="Logo 8">
                <img class="h-16 md:h-20 w-auto" src="{{ asset('storage/png-clipart-philippine-national-police-academy-national-police-commission-government-of-the-philippines-police-national-text-logo-thumbnail-removebg-preview 1.svg') }}" alt="Logo 9">
            </div>
        </div>
    </div>

    <!-- Rest of the code remains unchanged -->
    <div class="container mx-auto px-4 py-12 flex flex-col lg:flex-row items-start lg:items-center gap-8 lg:gap-10"
      style="height: 500px; min-height: 500px; max-height: 500px; overflow: hidden;">
    <div class="w-full lg:w-1/3 flex flex-col items-start gap-6">
        <div class="space-y-4">
            <h2 class="text-indigo-900 text-3xl md:text-4xl font-bold font-['Merriweather'] font-size: 18px !important animate-title-slide">Latest News</h2>
            <p class="text-gray-700 text-sm md:text-base font-light leading-relaxed animate-text-fade" style="--delay: 0.2s">
                This page is made to show the latest local news happening here in the Philippines. It provides updates on important events, community stories, government announcements, and other news that matters to Filipinos. Stay informed and connected with what’s going on around the country through this page.
            </p>
        </div>
        <a href="/morenews" class="w-48 md:w-56 h-12 md:h-14 flex items-center justify-center rounded-full border-2 border-indigo-900 text-indigo-900 text-lg font-medium hover:bg-indigo-900 hover:text-white transition-colors duration-300 animate-button-pop" style="--delay: 0.4s">
            MORE NEWS
        </a>
    </div>

    <div class="w-full flex justify-center">
        <div class="relative flex items-center justify-center w-full max-w-6xl mx-auto" style="min-height: 350px;">
            <button id="prev-news-btn"
                class="absolute left-0 top-0 h-full w-12 flex items-center justify-center z-20 bg-white bg-opacity-50 text-indigo-900 rounded-l-lg shadow hover:bg-opacity-80 transition"
                aria-label="Previous">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <div class="w-full flex justify-center items-center overflow-hidden" id="news-carousel-inner"
                style="gap: 1.5rem; height: 400px; position: relative;">
                @foreach($newsItems as $news)
                    <a href="{{ $news->url }}" target="_blank" style="text-decoration: none;"
                        class="news-card bg-white rounded-lg shadow-md p-4 mx-auto block absolute transition-all duration-500 ease-in-out"
                        data-index="{{ $loop->index }}"
                        style="width: 320px; height: 420px; min-width: 320px; max-width: 320px; min-height: 420px; max-height: 420px; opacity: 0; pointer-events: none;">
                        <img
                            src="{{ 
                                $news->picture 
                                    ? (Str::startsWith($news->picture, ['http://', 'https://']) 
                                        ? $news->picture 
                                        : asset('storage/' . $news->picture)) 
                                    : asset('default-news.jpg') 
                            }}"
                            alt="{{ $news->title }}"
                            class="rounded-md mb-3 object-cover"
                            style="width: 288px; height: 256px; min-width: 288px; max-width: 288px; min-height: 256px; max-height: 256px;"
                        >
                        <h3 class="text-lg font-bold text-indigo-900 mb-1 line-clamp-2">
                            {{ \Illuminate\Support\Str::limit($news->title, 25, '...') }}
                        </h3>
                        <p class="text-sm text-gray-600 mb-2">
                            {{ $news->author }} | {{ $news->date->format('M d, Y') }}
                            @if($news->sponsored)
                                | <span class="text-indigo-700 text-sm">Sponsored</span>
                            @endif
                        </p>
                    </a>
                @endforeach
            </div>

            <button id="next-news-btn"
                class="absolute right-0 top-0 h-full w-12 flex items-center justify-center z-20 bg-white bg-opacity-50 text-indigo-900 rounded-r-lg shadow hover:bg-opacity-80 transition"
                aria-label="Next">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>
</div>
</div>

<style>
    /* Logo carousel styles */
    .logos-container {
        overflow: hidden;
        position: relative;
    }
    
    .logos-track {
        display: flex;
        position: absolute;
        animation: scrollLogos 30s linear infinite;
        will-change: transform;
    }
    
    @keyframes scrollLogos {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    
    .logos-track:hover {
        animation-play-state: paused;
    }
    
    /* Existing styles */
    .news-card {
        transition: box-shadow 0.3s;
    }
    .news-card:hover {
        box-shadow: 0 8px 24px rgba(60,72,88,0.15);
    }
    
    .animate-on-scroll {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.8s ease-out, transform 0.8s ease-out;
    }
    
    .start-animation {
        opacity: 1;
        transform: translateY(0);
    }
    
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
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Logo carousel animation
    const track = document.querySelector('.logos-track');
    const logos = document.querySelectorAll('.logos-track img');
    
    // Calculate total width for proper looping
    let totalWidth = 0;
    logos.forEach(logo => {
        totalWidth += logo.offsetWidth + 32; // 32px for gap (2rem)
    });
    totalWidth = totalWidth / 2; // Since we have duplicate set
    
    // Set track width to double for seamless looping
    track.style.width = `${totalWidth * 2}px`;
    
    // Existing news carousel code
    const cards = document.querySelectorAll('#news-carousel-inner .news-card');
    const prevBtn = document.getElementById('prev-news-btn');
    const nextBtn = document.getElementById('next-news-btn');
    const newsCarouselInner = document.getElementById('news-carousel-inner');
    const cardWidth = 320 + 24;
    const visibleCount = 4;
    let start = 0;

    function positionCards() {
        cards.forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateX(0)';
            card.style.zIndex = '1';
            card.style.pointerEvents = 'none';
        });

        const carouselWidth = newsCarouselInner.offsetWidth;
        const totalCardsWidth = visibleCount * cardWidth;
        const startX = (carouselWidth - totalCardsWidth) / 2;

        for (let i = 0; i < visibleCount; i++) {
            const cardIndex = (start + i) % cards.length;
            const card = cards[cardIndex];
            const targetX = startX + i * cardWidth;

            card.style.left = `${targetX}px`;
            card.style.opacity = '1';
            card.style.transform = 'translateX(0)';
            card.style.zIndex = '10';
            card.style.pointerEvents = 'auto';
        }
    }

    function animateCarousel(direction) {
        for (let i = 0; i < visibleCount; i++) {
            const cardIndex = (start + i) % cards.length;
            const card = cards[cardIndex];
            card.style.opacity = '0';
            if (direction === 'next') {
                card.style.transform = 'translateX(-50px)';
            } else {
                card.style.transform = 'translateX(50px)';
            }
            card.style.zIndex = '1';
            card.style.pointerEvents = 'none';
        }

        if (direction === 'next') {
            start = (start + 1) % cards.length;
        } else {
            start = (start - 1 + cards.length) % cards.length;
        }

        setTimeout(() => {
            const carouselWidth = newsCarouselInner.offsetWidth;
            const totalCardsWidth = visibleCount * cardWidth;
            const startX = (carouselWidth - totalCardsWidth) / 2;

            for (let i = 0; i < visibleCount; i++) {
                const cardIndex = (start + i) % cards.length;
                const card = cards[cardIndex];
                const targetX = startX + i * cardWidth;

                if (direction === 'next') {
                    card.style.left = `${targetX + 50}px`;
                } else {
                    card.style.left = `${targetX - 50}px`;
                }
                card.style.opacity = '0';
                card.style.zIndex = '10';

                requestAnimationFrame(() => {
                    card.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out, left 0.5s ease-out';
                    card.style.left = `${targetX}px`; 
                    card.style.opacity = '1'; 
                    card.style.transform = 'translateX(0)'; 
                    card.style.pointerEvents = 'auto'; 
                });
            }
        }, 100);
    }

    prevBtn.addEventListener('click', function() {
        animateCarousel('prev');
    });

    nextBtn.addEventListener('click', function() {
        animateCarousel('next');
    });

    // Initial positioning of cards on load
    positionCards();
    
    // Existing scroll animations
    const logoItems = document.querySelectorAll('.animate-logo-slide');
    const title = document.querySelector('.animate-title-slide');
    const text = document.querySelector('.animate-text-fade');
    const button = document.querySelector('.animate-button-pop');

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

    // Scroll-based animations
    const elementsToAnimate = document.querySelectorAll('.animate-on-scroll');
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('start-animation');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    elementsToAnimate.forEach(element => {
        observer.observe(element);
    });
});
</script>