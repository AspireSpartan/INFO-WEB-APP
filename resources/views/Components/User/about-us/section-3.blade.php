{{-- resources/views/components/User/about-us/section-3.blade.php --}}
@props(['communityContent', 'carouselImages'])

<div class="font-roboto bg-[#fdfdff] py-16 text-[#333] overflow-hidden">
    {{-- Header Section --}}
    <div class="text-center px-8 mb-12">
        <div class="max-w-4xl mx-auto">
            <div class="flex items-center justify-center gap-4 mb-4">
                <div
                    class="w-[50px] h-[50px] flex items-center justify-center bg-gradient-to-br from-[#ff7f50] to-[#ff6347] rounded-full shadow-lg shadow-[#ff7f50]/30"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="currentColor"
                        class="w-[30px] h-[30px] text-white"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0 .75.75 0 0 1-.416.67c-.941.256-1.809.56-2.652.94a1.5 1.5 0 0 0-.878 1.23l-.02.101a.75.75 0 0 1-.47.658L12 23.25l-1.426-.363a.75.75 0 0 1-.47-.658l-.02-.101a1.5 1.5 0 0 0-.877-1.23c-.844-.38-1.712-.684-2.653-.94a.75.75 0 0 1-.416-.671ZM12 7.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </div>
                <h1
                    class="text-3xl sm:text-4xl lg:text-5xl font-extrabold font-open-sans text-[#222]"
                >
                    <span class="text-[#ff6347]">{{ $communityContent['main_title_part1'] ?? 'Community' }}</span> {{ $communityContent['main_title_part2'] ?? 'at Work' }}
                </h1>
            </div>
            <p class="text-base sm:text-lg text-[#555] leading-relaxed max-w-2xl mx-auto">
                {{ $communityContent['subtitle_paragraph'] ?? 'We work hand-in-hand with barangay officials and municipal departments to ensure streamlined digital services and community development.' }}
            </p>
        </div>
    </div>

    {{-- Carousel Section --}}
    <div class="relative mb-12 py-4">
        <div class="overflow-hidden cursor-grab select-none community-carousel-container">
            <div class="flex will-change-transform community-carousel-track">
                @foreach($carouselImages as $image)
                <div
                    class="flex-shrink-0 w-[min(calc(40vw),380px)] h-[min(calc(25vw),240px)] mx-6 rounded-xl shadow-xl relative transform transition-transform duration-300 ease-in-out carousel-item group"
                >
                    {{-- REFINED IMAGE SRC: IMPORTANT! --}}
                    {{-- This assumes $image->image_path stores a path like 'images/your_image.jpg' --}}
                    {{-- If your $image->image_path already starts with '/storage/', just use src="{{ $image->image_path }}" --}}
                    <img
                          src="{{ $image->image_path }}" {{-- Use the full URL directly from the database --}}
                          alt="{{ $image->title }}"
                          class="w-full h-full object-cover block rounded-xl pointer-events-none"
                      />
                    <div
                        class="carousel-item-title absolute bottom-0 left-0 right-0 p-6 text-center text-white font-semibold text-lg bg-gradient-to-t from-black/80 to-black/0 transition-all duration-300 ease-in-out z-10"
                    >
                        {{ $image->title }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Progress Bar --}}
    <div class="w-11/12 max-w-md mx-auto mt-10 h-1.5 bg-[#e9e9e9] rounded-full overflow-hidden">
        <div
            class="h-full bg-gradient-to-r from-[#ff7f50] to-[#ff6347] w-0 rounded-full transition-all duration-200 ease-out community-progress-bar"
        ></div>
    </div>

    {{-- Footer Section --}}
    <div
        class="mt-12 text-center text-[#777] text-sm px-8 pt-4 border-t border-[#eee] max-w-4xl mx-auto"
    >
        <p>
            {!! $communityContent['footer_text'] ?? 'Building stronger communities through <span class="text-[#ff6347] font-semibold">collaboration</span> and <span class="text-[#ff6347] font-semibold">innovation</span> since 2023' !!}
        </p>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const container = document.querySelector('.community-carousel-container');
        const track = document.querySelector('.community-carousel-track');
        const originalItems = Array.from(track.children); // Get the initial items rendered by PHP
        const progressBar = document.querySelector('.community-progress-bar');

        if (!container || !track || originalItems.length === 0) {
            console.warn('Carousel elements not found or no original items to display.');
            if (container) container.style.display = 'none'; // Hide if no items
            return;
        }

        // --- Config ---
        const TRANSITION_SPEED_MS = 400; // Smoother transition
        const AUTOPLAY_DELAY_MS = 3500; // Standard autoplay speed
        // Number of clones on each side to create a seamless loop
        const CLONE_SETS = 2; // Clone the entire set of original items 2 times on each side

        // --- State ---
        // Start index adjusted for the prepended clones.
        // This makes the first "real" item (after the initial clones) the starting point.
        let currentIndex = originalItems.length * CLONE_SETS;
        let autoplayInterval;
        let isDragging = false;
        let startPos = 0;
        let currentTranslate = 0;
        let prevTranslate = 0;
        let animationID = 0;
        let animationFrameRequested = false;

        // --- Setup ---
        const setup = () => {
            cloneItems(); // Create the clones for seamless looping
            setupEventListeners();
            updatePosition(false); // Set initial position without transition
            startAutoplay();

            // Re-calculate position on resize to maintain centering
            window.addEventListener('resize', () => {
                stopAutoplay();
                // Clear existing clones, re-clone, and reset position to avoid layout issues
                track.innerHTML = '';
                cloneItems();
                currentIndex = originalItems.length * CLONE_SETS; // Reset to the first 'real' item
                updatePosition(false);
                startAutoplay();
            });
        };

        const cloneItems = () => {
            const tempClonesStart = [];
            const tempClonesEnd = [];

            // Create clones for the end (appended after original items)
            for (let i = 0; i < CLONE_SETS; i++) {
                originalItems.forEach(item => tempClonesEnd.push(item.cloneNode(true)));
            }
            // Create clones for the start (prepended before original items)
            // Need to reverse the order for prepending to maintain visual flow.
            for (let i = 0; i < CLONE_SETS; i++) {
                for (let j = originalItems.length - 1; j >= 0; j--) {
                    tempClonesStart.unshift(originalItems[j].cloneNode(true));
                }
            }
            // Append all parts to the track: start clones, original items, end clones
            track.append(...tempClonesStart, ...originalItems.map(item => item.cloneNode(true)), ...tempClonesEnd);
        };

        const setupEventListeners = () => {
            track.addEventListener('transitionend', handleTransitionEnd);
            container.addEventListener('mouseenter', stopAutoplay);
            container.addEventListener('mouseleave', startAutoplay);

            // Touch and Mouse events for dragging
            container.addEventListener('mousedown', dragStart);
            container.addEventListener('touchstart', dragStart, { passive: true });
            container.addEventListener('mouseup', dragEnd);
            container.addEventListener('mouseleave', dragEnd); // Stop drag if mouse leaves container
            container.addEventListener('touchend', dragEnd);
            container.addEventListener('mousemove', drag);
            container.addEventListener('touchmove', drag, { passive: true });
        };

        // --- Event Handlers (Drag & Snap) ---
        const dragStart = (event) => {
            isDragging = true;
            startPos = getPositionX(event);
            prevTranslate = currentTranslate;
            track.style.transition = 'none'; // Disable transition during drag
            container.classList.add('is-dragging'); // Add a class for styling if needed
            stopAutoplay();
            // Start animation loop to update position continuously
            animationID = requestAnimationFrame(animationLoop);
            animationFrameRequested = true;
        };

        const drag = (event) => {
            if (!isDragging) return;
            const currentPosition = getPositionX(event);
            currentTranslate = prevTranslate + currentPosition - startPos;
            if (!animationFrameRequested) {
                 animationID = requestAnimationFrame(animationLoop);
                 animationFrameRequested = true;
            }
        };

        const dragEnd = () => {
            if (!isDragging) return;
            isDragging = false;
            cancelAnimationFrame(animationID);
            animationFrameRequested = false;
            container.classList.remove('is-dragging');

            // Calculate which item to snap to
            const firstTrackItem = track.children[0];
            if (!firstTrackItem) {
                updatePosition(true);
                startAutoplay();
                return;
            }
            const itemWidth = firstTrackItem.offsetWidth;
            const style = getComputedStyle(firstTrackItem);
            const marginLeft = parseFloat(style.marginLeft) || 0;
            const marginRight = parseFloat(style.marginRight) || 0;
            const totalItemWidth = itemWidth + marginLeft + marginRight;

            // Determine which item is closest to the center
            const carouselOffset = (container.clientWidth / 2) - (totalItemWidth / 2);
            const rawIndex = -(currentTranslate - carouselOffset) / totalItemWidth;
            currentIndex = Math.round(rawIndex); // Snap to the nearest integer index

            updatePosition(true); // Snap to the new index with transition
            startAutoplay();
        };

        const animationLoop = () => {
            setTransform(currentTranslate);
            if (isDragging) {
                animationID = requestAnimationFrame(animationLoop);
                animationFrameRequested = true;
            } else {
                animationFrameRequested = false;
            }
        };

        const getPositionX = (event) => (event.touches ? event.touches[0].clientX : event.clientX);

        const handleTransitionEnd = () => {
            // Check if we are in a cloned section and need to jump back
            if (currentIndex < originalItems.length * CLONE_SETS) {
                // If we've moved into the start clones, jump to the corresponding real items
                currentIndex = originalItems.length * CLONE_SETS + (currentIndex % originalItems.length);
                updatePosition(false); // No transition for the jump
            } else if (currentIndex >= originalItems.length * (CLONE_SETS + 1)) {
                // If we've moved into the end clones, jump to the corresponding real items
                currentIndex = originalItems.length * CLONE_SETS + (currentIndex % originalItems.length);
                updatePosition(false); // No transition for the jump
            }
            updateUI(); // Ensure UI is updated after the transition (especially for clone jumps)
        };


        // --- Core Logic ---
        const updatePosition = (enableTransition = true) => {
            if (originalItems.length === 0) return; // Prevent error if no items

            const firstTrackItem = track.children[0]; // Get the first item in the track for measurements
            if (!firstTrackItem) return; // Safety check

            const itemWidth = firstTrackItem.offsetWidth;
            const style = getComputedStyle(firstTrackItem);
            const marginLeft = parseFloat(style.marginLeft) || 0;
            const marginRight = parseFloat(style.marginRight) || 0;
            const totalItemWidth = itemWidth + marginLeft + marginRight;

            // Calculate offset to center the current item.
            const offset = (container.clientWidth / 2) - (totalItemWidth / 2);

            currentTranslate = -currentIndex * totalItemWidth + offset;
            prevTranslate = currentTranslate; // Keep prevTranslate updated for next drag start

            track.style.transition = enableTransition
                ? `transform ${TRANSITION_SPEED_MS}ms cubic-bezier(0.65, 0, 0.35, 1)` // Using a cubic-bezier for smoother feel
                : 'none';
            setTransform(currentTranslate);

            updateUI(); // Always update UI after position change
        };

        // --- UI Updates ---
        const updateUI = () => {
            const allItems = Array.from(track.children);
            // Calculate the "real" index within the original set of items for visual effects
            // This is the index (0 to originalItems.length - 1) of the item conceptually in view
            const realActiveIndex = (currentIndex % originalItems.length + originalItems.length) % originalItems.length;


            allItems.forEach((item, index) => {
                const imageLabel = item.querySelector('.carousel-item-title');

                // Determine the "conceptual" index of the current item, accounting for clones
                let conceptualIndex = index % originalItems.length;

                // Reset all previous classes
                item.classList.remove('scale-105', 'opacity-100', 'z-10', 'scale-95', 'opacity-80', 'z-5', 'scale-90', 'opacity-60', 'z-1');
                if (imageLabel) {
                    imageLabel.classList.remove('opacity-100', 'translate-y-0', 'opacity-0', 'translate-y-5');
                }

                if (index === currentIndex) { // The truly centered item
                    item.classList.add('scale-105', 'opacity-100', 'z-10');
                    if (imageLabel) {
                        imageLabel.classList.add('opacity-100', 'translate-y-0');
                    }
                } else {
                    // Apply different styles for nearby items vs. far items
                    const distance = Math.abs(index - currentIndex);
                    if (distance === 1) { // Items immediately next to the active one
                        item.classList.add('scale-95', 'opacity-80', 'z-5');
                    } else { // All other items (further away or hidden)
                        item.classList.add('scale-90', 'opacity-60', 'z-1');
                    }
                    if (imageLabel) {
                        imageLabel.classList.add('opacity-0', 'translate-y-5');
                    }
                }
            });

            // Progress Bar: Calculate real index considering clones
            // Normalize current index to reflect position within the original set of items
            const normalizedProgressBarIndex = (currentIndex - (originalItems.length * CLONE_SETS)) % originalItems.length;
            progressBar.style.width = `${((normalizedProgressBarIndex + 1) / originalItems.length) * 100}%`;
        };


        const setTransform = (x) => {
            track.style.transform = `translateX(${x}px)`;
        };

        // --- Autoplay ---
        const startAutoplay = () => {
            stopAutoplay(); // Clear any existing interval
            autoplayInterval = setInterval(() => {
                currentIndex++;
                updatePosition(true);
            }, AUTOPLAY_DELAY_MS);
        };

        const stopAutoplay = () => {
            clearInterval(autoplayInterval);
        };

        // --- Initialize the Carousel ---
        setup();
    });
</script>

<style>
    /* Add specific styles for the carousel animation and interaction feedback */
    .community-carousel-container.is-dragging {
        cursor: grabbing;
    }
    /* Ensure the carousel track itself is flexible to hold items */
    .community-carousel-track {
        display: flex; /* Tailwind's flex class already does this, but explicit for clarity */
        will-change: transform;
    }
    /* Set a consistent z-index for items so scale doesn't overlap weirdly */
    .carousel-item {
        z-index: 1; /* Default lower z-index */
    }
    .carousel-item.z-5 { /* For items next to active */
        z-index: 5;
    }
    .carousel-item.z-10 { /* For the active item */
        z-index: 10;
    }
    /* Ensure transitions for transform are not overridden by utilities */
    .carousel-item {
        transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
    }
    /* Make sure the title is hidden by default and appears on hover for non-active items */
    .carousel-item .carousel-item-title {
        opacity: 0;
        transform: translateY(20px); /* Slightly off-screen by default */
        transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
    }

    /* Hover effect for titles on user-facing carousel items */
    /* This will apply to all items, even if not the currently active one */
    .carousel-item:hover .carousel-item-title {
        opacity: 100;
        transform: translateY(0);
    }
</style>