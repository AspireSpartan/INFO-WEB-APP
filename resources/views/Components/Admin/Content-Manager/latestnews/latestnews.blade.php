@props(['newsItems'])

<div class="bg-gray-100 min-h-screen py-8 z-10">
    {{-- MODIFIED: Added editable-container to the logos wrapper --}}
    <div class="container mx-auto px-4 py-6 overflow-x-auto whitespace-nowrap scrollbar-hide animate-on-scroll relative group">
        <div class="flex items-center justify-center gap-x-8 md:gap-x-12 animate-on-scroll editable-container-logos" id="logos-container">
            {{-- Initial Logos - These will be dynamically updated by JS --}}
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
        {{-- Edit Logos Button --}}
        <button id="edit-logos-button" class="edit-button absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-gray-800 text-white px-4 py-2 rounded-full text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300 hidden">Edit Logos</button>
    </div>

    <div class="container mx-auto px-4 py-12 flex flex-col lg:flex-row items-start lg:items-center gap-8 lg:gap-10"
        style="height: 500px; min-height: 500px; max-height: 500px; overflow: hidden;">
        <div class="w-full lg:w-1/3 flex flex-col items-start gap-6">
            {{-- MODIFIED: Combined editable container for title and paragraph --}}
            <div class="relative group editable-container" id="latest-news-text-container">
                <div class="space-y-4">
                    <h2 class="text-indigo-900 text-3xl md:text-4xl font-bold font-['Merriweather'] !text-[18px] animate-title-slide" id="latest-news-title">Latest News</h2>
                    <p class="text-gray-700 text-sm md:text-base font-light leading-relaxed animate-text-fade" style="--delay: 0.2s" id="latest-news-paragraph">
                        This page is made to show the latest local news happening here in the Philippines. It provides updates on important events, community stories, government announcements, and other news that matters to Filipinos. Stay informed and connected with what’s going on around the country through this page.
                    </p>
                </div>
                {{-- Single Edit Button for both title and paragraph --}}
                <button id="edit-text-button" class="edit-button absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-gray-800 text-white px-4 py-2 rounded-full text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300 hidden">Edit</button>
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

{{-- Edit Text Modal --}}
<div id="edit-text-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white p-8 rounded-lg shadow-lg w-11/12 md:w-1/2 lg:w-1/3">
        <h3 class="text-xl font-bold mb-4">Edit Content</h3>
        <div class="mb-4">
            <label for="edit-title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
            <textarea id="edit-title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
        </div>
        <div class="mb-4">
            <label for="edit-paragraph" class="block text-gray-700 text-sm font-bold mb-2">Paragraph:</label>
            <textarea id="edit-paragraph" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline h-32"></textarea>
        </div>
        <div class="flex justify-end gap-4">
            <button id="cancel-text-edit" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-full">Cancel</button>
            <button id="save-text-edit" class="bg-indigo-900 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-full">Save Changes</button>
        </div>
    </div>
</div>

{{-- MODIFIED: Edit Logos Modal with file input and preview --}}
<div id="edit-logos-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white p-8 rounded-lg shadow-lg w-11/12 md:w-3/4 lg:w-2/3 xl:w-1/2 max-h-[90vh] flex flex-col">
        <h3 class="text-2xl font-bold mb-6 text-gray-800">Manage Logos</h3>

        <div class="mb-6 border-b pb-4 border-gray-200">
            <label for="new-logo-file" class="block text-gray-700 text-sm font-bold mb-2">Upload New Logo (PNG, SVG, JPG, GIF):</label>
            <input type="file" id="new-logo-file" accept=".png, .svg, .jpg, .jpeg, .gif" class="block w-full text-sm text-gray-500
                file:mr-4 file:py-2 file:px-4
                file:rounded-full file:border-0
                file:text-sm file:font-semibold
                file:bg-indigo-50 file:text-indigo-700
                hover:file:bg-indigo-100 cursor-pointer">

            <div id="logo-preview-container" class="mt-4 flex items-center justify-center border border-gray-300 rounded-lg p-4 bg-gray-50 hidden" style="height: 150px;">
                <img id="new-logo-preview" src="#" alt="Logo Preview" class="max-h-full max-w-full object-contain">
                <p id="no-preview-text" class="text-gray-500 text-sm">No image selected</p>
            </div>
            <button id="add-logo-button" class="mt-4 w-full bg-indigo-900 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-full transition-colors">Add Logo</button>
        </div>

        <h4 class="text-lg font-bold mb-4 text-gray-800">Current Logos:</h4>
        <div class="flex-grow overflow-y-auto grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 pb-4" id="modal-logos-list">
            {{-- Logos will be rendered here --}}
        </div>
        <div class="flex justify-end gap-4 mt-6">
            <button id="cancel-logos-edit" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-full transition-colors">Close</button>
        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', () => {
    // --- News Carousel ---
    const cards = document.querySelectorAll('#news-carousel-inner .news-card');
    const prevBtn = document.getElementById('prev-news-btn');
    const nextBtn = document.getElementById('next-news-btn');
    const newsCarouselInner = document.getElementById('news-carousel-inner');
    const cardWidth = 320 + 24; // Card width + gap (1.5rem = 24px)
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
            card.style.transform = direction === 'next' ? 'translateX(-50px)' : 'translateX(50px)';
            card.style.zIndex = '1';
            card.style.pointerEvents = 'none';
        }

        start = direction === 'next' ? (start + 1) % cards.length : (start - 1 + cards.length) % cards.length;

        setTimeout(() => {
            const carouselWidth = newsCarouselInner.offsetWidth;
            const totalCardsWidth = visibleCount * cardWidth;
            const startX = (carouselWidth - totalCardsWidth) / 2;

            for (let i = 0; i < visibleCount; i++) {
                const cardIndex = (start + i) % cards.length;
                const card = cards[cardIndex];
                const targetX = startX + i * cardWidth;

                card.style.left = direction === 'next' ? `${targetX + 50}px` : `${targetX - 50}px`;
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

    prevBtn.addEventListener('click', () => animateCarousel('prev'));
    nextBtn.addEventListener('click', () => animateCarousel('next'));
    positionCards();

    // --- Initial Page Load Animations ---
    const logoItems = document.querySelectorAll('.animate-logo-slide');
    const title = document.querySelector('.animate-title-slide');
    const text = document.querySelector('.animate-text-fade');
    const button = document.querySelector('.animate-button-pop');

    logoItems.forEach(item => {
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

    // --- Animate on Scroll ---
    const elementsToAnimate = document.querySelectorAll('.animate-on-scroll');
    const observerOptions = { root: null, rootMargin: '0px', threshold: 0.1 };
    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('start-animation');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    elementsToAnimate.forEach(element => observer.observe(element));

    // --- Editing Functionality ---

    // Text modal elements
    const editTextModal = document.getElementById('edit-text-modal');
    const editTitleInput = document.getElementById('edit-title');
    const editParagraphInput = document.getElementById('edit-paragraph');
    const saveTextEditBtn = document.getElementById('save-text-edit');
    const cancelTextEditBtn = document.getElementById('cancel-text-edit');
    const latestNewsTitle = document.getElementById('latest-news-title');
    const latestNewsParagraph = document.getElementById('latest-news-paragraph');
    const latestNewsTextContainer = document.getElementById('latest-news-text-container');
    const editTextButton = document.getElementById('edit-text-button');

    // Logos modal elements
    const editLogosModal = document.getElementById('edit-logos-modal');
    const editLogosButton = document.getElementById('edit-logos-button');
    const newLogoFileInput = document.getElementById('new-logo-file');
    const newLogoPreview = document.getElementById('new-logo-preview');
    const logoPreviewContainer = document.getElementById('logo-preview-container');
    const noPreviewText = document.getElementById('no-preview-text');
    const addLogoButton = document.getElementById('add-logo-button');
    const modalLogosList = document.getElementById('modal-logos-list');
    const cancelLogosEditBtn = document.getElementById('cancel-logos-edit');
    const logosContainer = document.getElementById('logos-container');

    let currentLogos = [
        '{{ asset('storage/coat-of-arms-of-the-philippines-logo-png_seeklogo-311689 1.svg') }}',
        '{{ asset('storage/Department_of_Agriculture_of_the_Philippines.svg 1.svg') }}',
        '{{ asset('storage/Department_of_the_Interior_and_Local_Government_(DILG)_Seal_-_Logo.svg 1.svg') }}',
        '{{ asset('storage/images (5) 1.svg') }}',
        '{{ asset('storage/images 1.svg') }}',
        '{{ asset('storage/images__1_-removebg-preview (1) 1.svg') }}',
        '{{ asset('storage/Logo_of_the_Bureau_of_Internal_Revenue 1.svg') }}',
        '{{ asset('storage/png-clipart-executive-departments-of-the-philippines-department-of-health-health-care-public-health-presidents-problems-emblem-logo-thumbnail-removebg-preview 1.svg') }}',
        '{{ asset('storage/png-clipart-philippine-national-police-academy-national-police-commission-government-of-the-philippines-police-national-text-logo-thumbnail-removebg-preview 1.svg') }}',
    ];

    let scrollBarWidth = window.innerWidth - document.documentElement.clientWidth;
    const body = document.body;

    function openModal(modal) {
        modal.classList.remove('hidden');
        body.style.overflow = 'hidden';
        body.style.paddingRight = `${scrollBarWidth}px`;
    }

    function closeModal(modal) {
        modal.classList.add('hidden');
        body.style.overflow = '';
        body.style.paddingRight = '';
    }

    latestNewsTextContainer.addEventListener('mouseenter', () => {
        editTextButton.classList.remove('hidden');
    });
    latestNewsTextContainer.addEventListener('mouseleave', () => {
        editTextButton.classList.add('hidden');
    });

    editTextButton.addEventListener('click', () => {
        editTitleInput.value = latestNewsTitle.innerText.trim();
        editParagraphInput.value = latestNewsParagraph.innerText.trim();
        openModal(editTextModal);
    });

    saveTextEditBtn.addEventListener('click', () => {
        latestNewsTitle.innerText = editTitleInput.value;
        latestNewsParagraph.innerText = editParagraphInput.value;
        closeModal(editTextModal);
    });

    cancelTextEditBtn.addEventListener('click', () => {
        closeModal(editTextModal);
    });

    const logosContainerWrapper = document.querySelector('.container.mx-auto.px-4.py-6.overflow-x-auto.whitespace-nowrap.scrollbar-hide.animate-on-scroll.relative.group');
    const actualLogosDiv = document.getElementById('logos-container');

    logosContainerWrapper.addEventListener('mouseenter', () => {
        editLogosButton.classList.remove('hidden');
        editLogosButton.classList.add('block');
        actualLogosDiv.classList.add('hover-active');
    });
    logosContainerWrapper.addEventListener('mouseleave', () => {
        editLogosButton.classList.add('hidden');
        actualLogosDiv.classList.remove('hover-active');
    });

    editLogosButton.addEventListener('click', () => {
        renderLogosInModal();
        newLogoFileInput.value = '';
        newLogoPreview.src = '#';
        logoPreviewContainer.classList.add('hidden');
        noPreviewText.classList.remove('hidden');
        openModal(editLogosModal);
    });

    newLogoFileInput.addEventListener('change', (event) => {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                newLogoPreview.src = e.target.result;
                logoPreviewContainer.classList.remove('hidden');
                noPreviewText.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            newLogoPreview.src = '#';
            logoPreviewContainer.classList.add('hidden');
            noPreviewText.classList.remove('hidden');
        }
    });

    function renderLogosInModal() {
        modalLogosList.innerHTML = '';
        if (currentLogos.length === 0) {
            modalLogosList.innerHTML = '<p class="text-gray-500 col-span-full text-center">No logos added yet.</p>';
            return;
        }
        currentLogos.forEach((logoUrl, index) => {
            const logoWrapper = document.createElement('div');
            logoWrapper.classList.add('relative', 'group', 'bg-gray-100', 'rounded-lg', 'p-2', 'flex', 'flex-col', 'items-center', 'justify-center', 'aspect-square');

            const img = document.createElement('img');
            img.src = logoUrl;
            img.alt = `Logo ${index + 1}`;
            img.classList.add('h-full', 'w-full', 'object-contain', 'rounded-md');

            const removeBtn = document.createElement('button');
            removeBtn.innerText = 'Remove';
            removeBtn.classList.add('absolute', 'inset-0', 'flex', 'items-center', 'justify-center', 'bg-black', 'bg-opacity-60', 'text-white', 'px-2', 'py-1', 'rounded-lg', 'text-sm', 'opacity-0', 'group-hover:opacity-100', 'transition-opacity', 'duration-200');
            removeBtn.addEventListener('click', () => {
                removeLogo(index);
            });

            logoWrapper.appendChild(img);
            logoWrapper.appendChild(removeBtn);
            modalLogosList.appendChild(logoWrapper);
        });
    }

    function updateDisplayedLogos() {
        logosContainer.innerHTML = '';
        currentLogos.forEach((logoUrl, index) => {
            const img = document.createElement('img');
            img.src = logoUrl;
            img.alt = `Logo ${index + 1}`;
            img.classList.add('h-16', 'md:h-20', 'w-auto', 'animate-logo-slide');
            img.style.setProperty('--delay', `${(index + 1) * 0.1}s`);
            logosContainer.appendChild(img);
        });
    }

    addLogoButton.addEventListener('click', () => {
        const file = newLogoFileInput.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                const newUrl = e.target.result;
                currentLogos.push(newUrl);
                newLogoFileInput.value = '';
                newLogoPreview.src = '#';
                logoPreviewContainer.classList.add('hidden');
                noPreviewText.classList.remove('hidden');
                renderLogosInModal();
                updateDisplayedLogos();
            };
            reader.readAsDataURL(file);
        } else {
            alert('Please select a logo file to upload.');
        }
    });

    function removeLogo(indexToRemove) {
        currentLogos = currentLogos.filter((_, index) => index !== indexToRemove);
        renderLogosInModal();
        updateDisplayedLogos();
    }

    cancelLogosEditBtn.addEventListener('click', () => {
        closeModal(editLogosModal);
    });
});
</script>