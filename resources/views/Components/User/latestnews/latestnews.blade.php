@props(['newsItems'])
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
    <div class="container mx-auto px-4 py-12 flex flex-col lg:flex-row items-start lg:items-center gap-8 lg:gap-12"
     style="height: 500px; min-height: 500px; max-height: 500px; overflow: hidden;">
    <!-- Left Content: Latest News Title and Description -->
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

<div class="relative flex items-center justify-center py-4" style="min-height: 350px;">
    <!-- Previous Arrow Button -->
    <button id="prev-news-btn"
        class="absolute left-0 top-0 h-full w-12 flex items-center justify-center z-10 bg-white bg-opacity-50 text-indigo-900 rounded-l-lg shadow hover:bg-opacity-80 transition"
        aria-label="Previous">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>

    <!-- News Carousel (Fixed Size) -->
    <div class="w-full flex justify-center items-center" id="news-carousel"
         style="gap: 1.5rem; height: 400px; min-height: 400px; max-height: 400px; width: 1320px; max-width: 100%;">
       @foreach($newsItems as $news)
    <a href="{{ $news->url }}" target="_blank" style="text-decoration: none;"
        class="news-card bg-white rounded-lg shadow-md p-4 animate-card-slide mx-auto block"
        style="width: 320px; height: 420px; min-width: 320px; max-width: 320px; min-height: 420px; max-height: 420px; display: none;">
        <img 
            src="{{ $news->picture ? asset('storage/' . $news->picture) : asset('default-news.jpg') }}"
            alt="{{ $news->title }}"
            class="w-full h-64 object-cover rounded-md mb-3"
            style="width: 288px; height: 256px;"
        >
        <h3 class="text-lg font-bold text-indigo-900 mb-1 line-clamp-2">{{ $news->title }}</h3>
        <p class="text-sm text-gray-600 mb-2">{{ $news->author }} | {{ $news->date->format('M d, Y') }}</p>
        <span class="text-indigo-700 text-sm">
            {{ $news->sponsored ? 'Sponsored' : 'Not Sponsored' }}
        </span>
    </a>
@endforeach
    </div>

    <!-- Next Arrow Button -->
    <button id="next-news-btn"
        class="absolute right-0 top-0 h-full w-12 flex items-center justify-center z-10 bg-white bg-opacity-50 text-indigo-900 rounded-r-lg shadow hover:bg-opacity-80 transition"
        aria-label="Next">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </button>
</div>

</div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('#news-carousel .news-card');
    const prevBtn = document.getElementById('prev-news-btn');
    const nextBtn = document.getElementById('next-news-btn');
    const visibleCount = 4;
    let start = 0;

    function showCards(startIdx) {
        cards.forEach((card, i) => {
            card.style.display = (i >= startIdx && i < startIdx + visibleCount) ? '' : 'none';
        });
    }

    prevBtn.addEventListener('click', function() {
        if (start > 0) {
            start--;
        } else {
            // Loop to the end
            start = Math.max(cards.length - visibleCount, 0);
        }
        showCards(start);
    });

    nextBtn.addEventListener('click', function() {
        if (start + visibleCount < cards.length) {
            start++;
        } else {
            // Loop to the start
            start = 0;
        }
        showCards(start);
    });

    showCards(start); // Show first 4 cards on load
});     
</script>


<style>
.news-card {
    transition: box-shadow 0.3s;
}
.news-card:hover {
    box-shadow: 0 8px 24px rgba(60,72,88,0.15);
}
</style>





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