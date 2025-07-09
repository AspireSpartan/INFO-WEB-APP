{{--
    Components/Admin/Content-Manager/latestnews/latestnews.blade.php

    Refined "Latest News" component.
    - Props:
        - `newsItems`: A collection of news article objects.
--}}

@props(['newsItems'])

@php
    // Generate a unique ID for this component instance to prevent conflicts
    $uniqueId = 'latestNews-' . uniqid();

    // --- CONFIGURATION FOR EDITABLE CONTENT ---
    // Centralize the keys used for editable content to avoid magic strings.
    // Prefix content keys with the unique ID
    $contentKeys = [
        'logos' => $uniqueId . '-logos', // ID for logo wrapper
        'title' => $uniqueId . '-title', // ID for title element
        'paragraph' => $uniqueId . '-paragraph', // ID for paragraph element
    ];

    // --- DEFAULT CONTENT ---
    // Provide sensible defaults for display. Content will come from these defaults.
    $defaultContent = [
        $contentKeys['title'] => 'Latest News',
        $contentKeys['paragraph'] => 'This page is made to show the latest local news happening here in the Philippines. It provides updates on important events, community stories, government announcements, and other news that matters to Filipinos. Stay informed and connected with what’s going on around the country through this page.',
        $contentKeys['logos'] => [
            'coat-of-arms-of-the-philippines-logo-png_seeklogo-311689 1.svg',
            'Department_of_Agriculture_of_the_Philippines.svg 1.svg',
            'Department_of_the_Interior_and_Local_Government_(DILG)_Seal_-_Logo.svg 1.svg',
            'images (5) 1.svg',
            'images 1.svg',
            'images__1_-removebg-preview (1) 1.svg',
            'Logo_of_the_Bureau_of_Internal_Revenue 1.svg',
            'png-clipart-executive-departments-of-the-philippines-department-of-health-health-care-public-health-presidents-problems-emblem-logo-thumbnail-removebg-preview 1.svg',
            'png-clipart-philippine-national-police-academy-national-police-commission-government-of-the-philippines-police-national-text-logo-thumbnail-removebg-preview 1.svg',
        ],
    ];

    // Helper function to get content (always from default for now)
    $getContent = fn($key) => $defaultContent[$key];

    // Prepare logo paths.
    $logoPaths = $getContent($contentKeys['logos']);

    // Helper function to generate the correct asset URL for a logo.
    $getLogoUrl = function($path) {
        // Provide a fallback for empty paths.
        if (empty($path)) {
            return 'https://placehold.co/150x80/e2e8f0/94a3b8?text=Logo';
        }
        // If it's a full URL (e.g., from an external source), use it directly.
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }
        // Otherwise, assume it's in public storage and build the asset URL.
        return asset('storage/' . $path);
    };
@endphp

<div class="bg-gray-100 min-h-screen py-8">
    <div class="container mx-auto px-4 py-6 overflow-x-auto whitespace-nowrap scrollbar-hide">
        <div class="relative editable-container">
            {{-- Use the unique ID for the logo wrapper --}}
            <div id="{{ $contentKeys['logos'] }}" class="flex items-center justify-center gap-x-8 md:gap-x-12">
                @foreach($logoPaths as $index => $logoPath)
                    <img class="h-16 md:h-20 w-auto animate-on-load"
                         style="--delay: {{ $index * 0.1 }}s"
                         src="{{ $getLogoUrl($logoPath) }}"
                         alt="Partner Logo {{ $index + 1 }}"
                         data-logo-filename="{{ basename($logoPath) }}"> {{-- Add filename for identification --}}
                @endforeach
            </div>
            {{-- Edit button for logos --}}
            <button class="edit-button"
                    data-content-key="{{ $contentKeys['logos'] }}"
                    data-edit-type="group-image"
                    data-component-id="{{ $uniqueId }}"> {{-- Add component ID to button --}}
                Edit Logos
            </button>
        </div>
    </div>

    <div class="container mx-auto px-4 py-12 flex flex-col lg:flex-row items-start lg:items-center gap-8 lg:gap-12 min-h-[500px]">
        <div class="w-full lg:w-1/3 flex flex-col items-start gap-6">
            <div class="space-y-4">
                <div class="relative editable-container">
                    {{-- Use the unique ID for the title --}}
                    <h2 id="{{ $contentKeys['title'] }}"
                        class="text-indigo-900 text-3xl md:text-4xl font-bold font-['Merriweather'] animate-on-load"
                        style="--delay: 0.2s">
                        {!! $getContent($contentKeys['title']) !!}
                    </h2>
                    {{-- Edit button for title --}}
                    <button class="edit-button"
                            data-content-key="{{ $contentKeys['title'] }}"
                            data-edit-type="text"
                            data-component-id="{{ $uniqueId }}"> {{-- Add component ID to button --}}
                        Edit
                    </button>
                </div>
                <div class="relative editable-container">
                    {{-- Use the unique ID for the paragraph --}}
                    <p id="{{ $contentKeys['paragraph'] }}"
                       class="text-gray-700 text-sm md:text-base font-light leading-relaxed animate-on-load"
                       style="--delay: 0.3s">
                        {!! $getContent($contentKeys['paragraph']) !!}
                    </p>
                    {{-- Edit button for paragraph --}}
                    <button class="edit-button"
                            data-content-key="{{ $contentKeys['paragraph'] }}"
                            data-edit-type="text"
                            data-component-id="{{ $uniqueId }}"> {{-- Add component ID to button --}}
                        Edit
                    </button>
                </div>
            </div>
            <a href="/morenews"
               class="w-48 md:w-56 h-12 md:h-14 flex items-center justify-center rounded-full border-2 border-indigo-900 text-indigo-900 text-lg font-medium hover:bg-indigo-900 hover:text-white transition-colors duration-300 animate-on-load"
               style="--delay: 0.4s">
                MORE NEWS
            </a>
        </div>

        <div class="w-full lg:w-2/3 flex justify-center">
            {{-- Use unique IDs for carousel elements --}}
            <div id="{{ $uniqueId }}-news-carousel-wrapper" class="relative flex items-center justify-center w-full max-w-6xl mx-auto min-h-[420px]">
                <button id="{{ $uniqueId }}-prev-news-btn" aria-label="Previous News"
                        class="absolute left-0 top-1/2 -translate-y-1/2 z-10 h-12 w-12 flex items-center justify-center bg-white/50 text-indigo-900 rounded-full shadow-md hover:bg-white/80 transition disabled:opacity-50 disabled:cursor-not-allowed">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                </button>

                <div id="{{ $uniqueId }}-news-carousel" class="w-full flex justify-center items-center gap-6 overflow-hidden">
                    @forelse($newsItems as $news)
                        <a href="{{ $news->url }}" target="_blank" rel="noopener noreferrer"
                           class="news-card group bg-white rounded-lg shadow-lg p-4 flex-shrink-0 w-[320px] h-[420px] transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 animate-on-load"
                           style="--delay: {{ ($loop->index * 0.1) + 0.5 }}s">
                            <img src="{{ $news->picture ? asset('storage/' . $news->picture) : asset('images/default-news.jpg') }}"
                                 alt="Image for {{ $news->title }}"
                                 class="w-full h-56 object-cover rounded-md mb-3"
                                 onerror="this.onerror=null;this.src='https://placehold.co/320x224/e2e8f0/94a3b8?text=News+Image';">
                            <h3 class="text-lg font-bold text-indigo-900 mb-1 line-clamp-2 group-hover:text-blue-600 transition-colors">{{ $news->title }}</h3>
                            <p class="text-sm text-gray-600 mb-2 truncate">{{ $news->author }} | {{ $news->date->format('M d, Y') }}</p>
                            <span class="text-indigo-700 text-sm font-semibold">
                                {{ $news->sponsored ? 'Sponsored' : 'Organic' }}
                            </span>
                        </a>
                    @empty
                        <div class="text-center text-gray-500">No news items available.</div>
                    @endforelse
                </div>

                <button id="{{ $uniqueId }}-next-news-btn" aria-label="Next News"
                        class="absolute right-0 top-1/2 -translate-y-1/2 z-10 h-12 w-12 flex items-center justify-center bg-white/50 text-indigo-900 rounded-full shadow-md hover:bg-white/80 transition disabled:opacity-50 disabled:cursor-not-allowed">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Modal for Editing (still global, but its content will be controlled by specific JS instances) --}}
{{-- For true uniqueness, each component could have its own modal, but often modals are singular and shared --}}
<div id="edit-modal" class="fixed inset-0 z-[999] flex items-center justify-center p-4 modal-backdrop hidden">
    <div id="modal-content" class="bg-white rounded-xl shadow-2xl w-full max-w-md transform transition-all duration-300 scale-95 opacity-0">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 id="modal-title" class="text-2xl font-bold text-gray-800">Edit Content</h3>
                <button id="close-modal" aria-label="Close modal" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <div id="modal-body" class="space-y-4">
                {{-- Dynamic content will be injected here by JavaScript --}}
            </div>
            <div class="mt-6 flex justify-end gap-3">
                <button id="cancel-button" class="bg-gray-200 text-gray-700 font-semibold py-2 px-6 rounded-lg hover:bg-gray-300 transition-all">Cancel</button>
                <button id="save-button" class="bg-blue-600 text-white font-semibold py-2 px-6 rounded-lg hover:bg-blue-700 transition-all flex items-center gap-2">
                    <span id="save-button-text">Save Changes (Not Functional)</span>
                    <div id="save-spinner" class="spinner-sm hidden"></div>
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Loading Overlay and Toast (kept for potential future use, though not used by current "save") --}}
<div id="loading-overlay" class="loading-overlay">
    <div class="spinner"></div>
</div>

<div id="toast-notification" class="fixed top-5 right-5 z-[100] p-4 rounded-lg text-white transition-all duration-300 translate-x-[120%]">
    <p id="toast-message"></p>
</div>
{{-- Main JavaScript Module --}}
<script type="module">
(() => {
    // This self-executing anonymous function creates a private scope
    // so variables and functions inside it don't conflict globally.

    // Initialize an array to hold instances of LatestNewsManager
    window.latestNewsManagers = window.latestNewsManagers || {};

    class LatestNewsManager {
        constructor(componentId) {
            this.componentId = componentId; // Store the unique ID for this instance

            this.selectors = {
                // Selectors now use the unique componentId to target specific elements
                editButtons: `[data-component-id="${this.componentId}"][data-edit-type]`,
                modal: '#edit-modal', // Modal is still global, but its content is managed
                modalContent: '#modal-content',
                modalTitle: '#modal-title',
                modalBody: '#modal-body',
                closeModalBtn: '#close-modal',
                saveBtn: '#save-button',
                cancelBtn: '#cancel-button',
                saveSpinner: '#save-spinner',
                saveBtnText: '#save-button-text',
                carousel: `#${this.componentId}-news-carousel`, // Unique carousel ID
                carouselWrapper: `#${this.componentId}-news-carousel-wrapper`, // Unique carousel wrapper ID
                prevBtn: `#${this.componentId}-prev-news-btn`, // Unique prev button ID
                nextBtn: `#${this.componentId}-next-news-btn`, // Unique next button ID
            };

            this.state = {
                contentKey: null,
                editType: null,
                currentButton: null,
                carouselIndex: 0,
                logoCount: 0, // Used for new logo input IDs
            };

            // Dynamically get DOM elements specific to this component instance
            this.dom = new Proxy({}, {
                get: (target, key) => {
                    if (!target[key]) {
                        target[key] = document.querySelector(this.selectors[key]);
                    }
                    return target[key];
                }
            });
        }

        _handleImagePreview(e, id) {
            const file = e.target.files[0];
            const img = document.getElementById(id); // Use direct ID as it's generated unique for inputs
            if (file && img) {
                const reader = new FileReader();
                reader.onload = evt => {
                    img.src = evt.target.result;
                    img.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        }

        _addNewLogoInput() {
            this.state.logoCount++;
            // Generate IDs for new logo inputs that are unique within the modal's context
            const inputId = `${this.componentId}-new-logo-${this.state.logoCount}`;
            const previewId = `${this.componentId}-preview-${this.state.logoCount}`;

            const wrapper = document.createElement('div');
            wrapper.className = 'logo-item space-y-2 mb-4 p-3 border border-gray-200 rounded-lg flex flex-col items-start';
            wrapper.innerHTML = `
                <img id="${previewId}" class="hidden h-24 object-contain mb-2 border border-gray-300 rounded-md p-1" />
                <input type="file" id="${inputId}" accept="image/*" class="w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-blue-50 file:text-blue-700
                    hover:file:bg-blue-100 cursor-pointer" />
                <button type="button" class="remove-logo-btn mt-2 inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Remove
                </button>
            `;

            // Use direct ID for the logos container within the modal
            const modalLogosContainer = document.getElementById(`${this.componentId}-modal-logos-container`);
            modalLogosContainer?.appendChild(wrapper);

            document.getElementById(inputId)?.addEventListener('change', e => this._handleImagePreview(e, previewId));
            wrapper.querySelector('.remove-logo-btn')?.addEventListener('click', () => wrapper.remove());
        }

        _openModal(e) {
    const btn = e.currentTarget;
    // Only open modal if the clicked button belongs to THIS component instance
    if (btn.dataset.componentId !== this.componentId) {
        return;
    }

    this.state.currentButton = btn;
    this.state.contentKey = btn.dataset.contentKey;
    this.state.editType = btn.dataset.editType;

    const target = document.getElementById(this.state.contentKey);
    if (!target) return;

    let html = '';
    this.dom.modalTitle.textContent = this.state.editType === 'text' ? 'Edit Text' : 'Edit Logos';

    if (this.state.editType === 'text') {
        html = `
            <div class="modal-body">
                <label for="${this.componentId}-text-input" class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                <textarea id="${this.componentId}-text-input" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm h-32">${target.textContent.trim()}</textarea>
            </div>
        `;
    } else if (this.state.editType === 'group-image') {
        // Use a unique ID for the logos container within the modal
        html = `
            <div class="modal-body">
                <div id="${this.componentId}-modal-logos-container" class="max-h-60 overflow-y-auto pr-2"></div>
                <button id="${this.componentId}-add-new-logo-btn" class="mt-4 w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Add New Logo
                </button>
            </div>
        `;
    }

    this.dom.modalBody.innerHTML = html;

    if (this.state.editType === 'group-image') {
        document.getElementById(`${this.componentId}-add-new-logo-btn`)?.addEventListener('click', () => this._addNewLogoInput());

        // Populate existing logos in the modal
        const existingLogos = document.querySelectorAll(`#${this.state.contentKey} img[data-logo-filename]`);
        existingLogos.forEach((img, index) => {
            const currentLogoFilename = img.dataset.logoFilename;
            const wrapper = document.createElement('div');
            wrapper.className = 'logo-item space-y-2 mb-4 p-3 border border-gray-200 rounded-lg flex flex-col items-start';
            wrapper.innerHTML = `
                <img src="${img.src}" class="h-24 object-contain mb-2 border border-gray-300 rounded-md p-1" />
                <span class="text-xs text-gray-500">${currentLogoFilename}</span>
                <input type="file" id="${this.componentId}-existing-logo-${index}" accept="image/*" class="w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-blue-50 file:text-blue-700
                    hover:file:bg-blue-100 cursor-pointer" />
                <button type="button" class="remove-logo-btn mt-2 inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Remove
                </button>
            `;
            document.getElementById(`${this.componentId}-modal-logos-container`)?.appendChild(wrapper);
            document.getElementById(`${this.componentId}-existing-logo-${index}`)?.addEventListener('change', e => this._handleImagePreview(e, img.id));
            wrapper.querySelector('.remove-logo-btn')?.addEventListener('click', () => wrapper.remove());
        });
    }

    // --- FIX STARTS HERE ---

    // 1. Make the modal container (backdrop) visible first.
    this.dom.modal.classList.remove('hidden');

    // 2. Use requestAnimationFrame to ensure the browser has time to render
    //    the 'display: flex' state *before* we remove the transition classes.
    requestAnimationFrame(() => {
        // Force a reflow/re-render by accessing an offset property.
        // This ensures the browser "sees" the initial opacity:0/scale-95 state
        // BEFORE it applies the transition.
        this.dom.modalContent.offsetWidth; // This line forces reflow

        // Now remove the transition classes, allowing the animation to play.
        this.dom.modalContent.classList.remove('scale-95', 'opacity-0');
    });

    // --- FIX ENDS HERE ---
}

        _closeModal() {
            this.dom.modalContent.classList.add('scale-95', 'opacity-0');
            setTimeout(() => this.dom.modal.classList.add('hidden'), 200);
            this.state.contentKey = null;
            this.state.editType = null;
            this.state.currentButton = null;
            this.state.logoCount = 0; // Reset logo count for next modal open
        }

        _saveChanges() {
            // This is where you would typically send an AJAX request to save changes.
            // For this example, we'll just update the DOM directly.
            // The "Not Functional" text on the button should be removed if this were live.

            // Simulate saving
            this.dom.saveBtnText.textContent = 'Saving...';
            this.dom.saveSpinner.classList.remove('hidden');
            this.dom.saveBtn.disabled = true;

            setTimeout(() => {
                if (this.state.editType === 'text') {
                    const newText = document.getElementById(`${this.componentId}-text-input`)?.value;
                    const target = document.getElementById(this.state.contentKey);
                    if (target) target.textContent = newText;
                } else if (this.state.editType === 'group-image') {
                    // In a real application, you'd handle file uploads here.
                    // For now, we'll just log the changes or simulate an update.
                    console.log('Simulating saving group images...');

                    // Example: Clear existing logos and add new ones (conceptual, won't handle actual files)
                    const currentLogoContainer = document.getElementById(this.state.contentKey);
                    if (currentLogoContainer) {
                        currentLogoContainer.innerHTML = ''; // Clear existing logos

                        const logoItemsInModal = document.querySelectorAll(`#${this.componentId}-modal-logos-container .logo-item`);
                        logoItemsInModal.forEach((item, index) => {
                            const imgElement = item.querySelector('img');
                            const fileInput = item.querySelector('input[type="file"]');
                            if (imgElement && imgElement.src && !imgElement.classList.contains('hidden')) {
                                // Simulate adding the new image to the main display
                                const newImg = document.createElement('img');
                                newImg.className = 'h-16 md:h-20 w-auto animate-on-load';
                                newImg.src = imgElement.src;
                                newImg.alt = `Partner Logo ${index + 1}`;
                                // If you have a way to get the actual filename from a new upload, you'd use it here.
                                // For simulation, just use a generic name or the preview name.
                                newImg.dataset.logoFilename = fileInput?.files[0]?.name || `simulated-logo-${index}.png`;
                                currentLogoContainer.appendChild(newImg);
                            }
                        });
                    }
                }

                this.dom.saveBtnText.textContent = 'Save Changes (Not Functional)';
                this.dom.saveSpinner.classList.add('hidden');
                this.dom.saveBtn.disabled = false;
                this._closeModal();
            }, 1000); // Simulate network delay
        }

        _initCarousel() {
            const carousel = this.dom.carousel;
            const prevBtn = this.dom.prevBtn;
            const nextBtn = this.dom.nextBtn;
            const carouselWrapper = this.dom.carouselWrapper;

            if (!carousel || !prevBtn || !nextBtn || !carouselWrapper) {
                console.warn('Carousel elements not found for component:', this.componentId);
                return;
            }

            const cards = carousel.querySelectorAll('.news-card');
            const gap = 24; // Defined in Tailwind (gap-6)

            const updateCarousel = () => {
                if (cards.length === 0) {
                    prevBtn.disabled = true;
                    nextBtn.disabled = true;
                    return;
                }

                const cardW = cards[0]?.offsetWidth || 0;
                const containerW = carouselWrapper.offsetWidth;

                // Calculate how many cards can be fully visible
                // Note: This assumes all cards have the same width.
                let visibleCards = Math.floor((containerW + gap) / (cardW + gap));
                if (visibleCards === 0 && containerW > 0 && cardW > 0) {
                     // If no full cards fit, ensure at least one is considered if container has space
                     visibleCards = 1;
                }

                const maxIndex = cards.length - visibleCards;

                // Ensure carouselIndex does not exceed bounds
                if (this.state.carouselIndex < 0) {
                    this.state.carouselIndex = 0;
                } else if (this.state.carouselIndex > maxIndex) {
                    this.state.carouselIndex = maxIndex > 0 ? maxIndex : 0; // Ensure it's not negative
                }


                const offset = -this.state.carouselIndex * (cardW + gap);
                carousel.style.transform = `translateX(${offset}px)`;

                prevBtn.disabled = this.state.carouselIndex === 0;
                nextBtn.disabled = this.state.carouselIndex >= maxIndex;

                // If all cards fit or there's only one, disable both buttons
                if (cards.length <= visibleCards) {
                    prevBtn.disabled = true;
                    nextBtn.disabled = true;
                }
            };

            nextBtn.addEventListener('click', () => {
                this.state.carouselIndex++;
                updateCarousel();
            });

            prevBtn.addEventListener('click', () => {
                this.state.carouselIndex--;
                updateCarousel();
            });

            window.addEventListener('resize', updateCarousel);
            updateCarousel(); // Initial update
        }

        _bindEvents() {
            // Find edit buttons specifically for this component
            document.querySelectorAll(this.selectors.editButtons).forEach(btn => {
                btn.addEventListener('click', (e) => this._openModal(e));
            });

            // Modal event listeners (these are global since the modal is global,
            // but the _openModal and _saveChanges methods ensure context)
            this.dom.closeModalBtn?.addEventListener('click', () => this._closeModal());
            this.dom.cancelBtn?.addEventListener('click', () => this._closeModal());
            this.dom.saveBtn?.addEventListener('click', () => this._saveChanges());
            this.dom.modal?.addEventListener('click', (e) => {
                if (e.target === this.dom.modal) this._closeModal();
            });
        }

        init() {
            this._initCarousel();
            this._bindEvents();
        }
    }

    // Initialize all LatestNewsManager components on the page
    document.addEventListener('DOMContentLoaded', () => {
        // Find all unique component IDs on the page
        document.querySelectorAll('.edit-button[data-component-id]').forEach(button => {
            const componentId = button.dataset.componentId;
            // If an instance for this component ID doesn't already exist, create it
            if (!window.latestNewsManagers[componentId]) {
                const manager = new LatestNewsManager(componentId);
                manager.init();
                window.latestNewsManagers[componentId] = manager; // Store the instance
            }
        });
    });
})();
</script>