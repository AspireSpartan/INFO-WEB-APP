<div class="community-section">
        <div class="community-header-container">
            <div class="community-header-content">
                <div class="community-icon-and-title">
                    <div class="community-icon-container">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0 .75.75 0 0 1-.416.67c-.941.256-1.809.56-2.652.94a1.5 1.5 0 0 0-.878 1.23l-.02.101a.75.75 0 0 1-.47.658L12 23.25l-1.426-.363a.75.75 0 0 1-.47-.658l-.02-.101a1.5 1.5 0 0 0-.877-1.23c-.844-.38-1.712-.684-2.653-.94a.75.75 0 0 1-.416-.671ZM12 7.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h1 class="community-title">
                        <span class="community-orange">Community</span> at Work
                    </h1>
                </div>
                <p class="community-description">
                    We work hand-in-hand with barangay officials and municipal departments to ensure streamlined digital services and community development.
                </p>
            </div>
        </div>

        <div class="community-carousel-section">
            <div class="community-carousel-container">
                <div class="community-carousel-track">
                    <div class="community-carousel-item">
                        <img src="https://images.unsplash.com/photo-1543269865-cbf427effbad?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&h=500&q=80" alt="Community meeting">
                        <div class="community-image-label">MATAZAC</div>
                    </div>
                    <div class="community-carousel-item">
                        <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&h=500&q=80" alt="Digital workshop">
                        <div class="community-image-label">NANGLATIYON</div>
                    </div>
                    <div class="community-carousel-item">
                        <img src="https://images.unsplash.com/photo-1568992687947-868a62a9f521?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&h=500&q=80" alt="Town planning">
                        <div class="community-image-label">JULIANA</div>
                    </div>
                    <div class="community-carousel-item">
                        <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&h=500&q=80" alt="Digital workshop">
                        <div class="community-image-label">NANGLATIYON</div>
                    </div>
                    <div class="community-carousel-item">
                        <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&h=500&q=80" alt="Education program">
                        <div class="community-image-label">MAGAZINE</div>
                    </div>
                    <div class="community-carousel-item">
                        <img src="https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&h=500&q=80" alt="Environment project">
                        <div class="community-image-label">SALVIN</div>
                    </div>
                    <div class="community-carousel-item">
                        <img src="https://images.unsplash.com/photo-1543269865-cbf427effbad?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&h=500&q=80" alt="Community meeting">
                        <div class="community-image-label">MATAZAC</div>
                    </div>
                    <div class="community-carousel-item">
                        <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&h=500&q=80" alt="Digital workshop">
                        <div class="community-image-label">NANGLATIYON</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="community-progress-container">
            <div class="community-progress-bar"></div>
        </div>
        
        <div class="community-footer">
            <p>Building stronger communities through <span class="community-highlight">collaboration</span> and <span class="community-highlight">innovation</span> since 2023</p>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const container = document.querySelector('.community-carousel-container');
        const track = document.querySelector('.community-carousel-track');
        const originalItems = Array.from(track.children);
        const progressBar = document.querySelector('.community-progress-bar');

        if (!container || !track || originalItems.length === 0) return;

        // --- Config ---
        const TRANSITION_SPEED_MS = 300; // Faster transition
        const AUTOPLAY_DELAY_MS = 2000; // Faster autoplay
        const CLONE_COUNT = Math.max(originalItems.length, 5);

        // --- State ---
        let currentIndex = CLONE_COUNT;
        let autoplayInterval;
        let isDragging = false;
        let startPos = 0;
        let currentTranslate = 0;
        let prevTranslate = 0;
        let animationID = 0;

        // --- Setup ---
        const setup = () => {
            cloneItems();
            setupEventListeners();
            startAutoplay();
            updatePosition(false); // Set initial position
            window.addEventListener('resize', () => updatePosition(false));
        };

        const cloneItems = () => {
            const clonesEnd = originalItems.map(item => item.cloneNode(true));
            const clonesStart = originalItems.map(item => item.cloneNode(true)).reverse();
            track.append(...clonesEnd);
            track.prepend(...clonesStart);
        };
        
        const setupEventListeners = () => {
            track.addEventListener('transitionend', handleTransitionEnd);
            container.addEventListener('mouseenter', stopAutoplay);
            container.addEventListener('mouseleave', startAutoplay);
            
            // Touch and Mouse events for dragging
            container.addEventListener('mousedown', dragStart);
            container.addEventListener('touchstart', dragStart, { passive: true });
            container.addEventListener('mouseup', dragEnd);
            container.addEventListener('mouseleave', dragEnd);
            container.addEventListener('touchend', dragEnd);
            container.addEventListener('mousemove', drag);
            container.addEventListener('touchmove', drag, { passive: true });
        };
        
        // --- Event Handlers (Drag & Snap) ---
        const dragStart = (event) => {
            isDragging = true;
            startPos = getPositionX(event);
            prevTranslate = currentTranslate;
            animationID = requestAnimationFrame(animationLoop);
            track.style.transition = 'none';
            container.classList.add('is-dragging');
            stopAutoplay();
        };

        const drag = (event) => {
            if (!isDragging) return;
            const currentPosition = getPositionX(event);
            currentTranslate = prevTranslate + currentPosition - startPos;
        };

        const dragEnd = () => {
            if (!isDragging) return;
            isDragging = false;
            cancelAnimationFrame(animationID);
            container.classList.remove('is-dragging');
            
            const movedBy = currentTranslate - prevTranslate;
            if (movedBy < -50) {
                currentIndex++;
            } else if (movedBy > 50) {
                currentIndex--;
            }
            
            updatePosition(true); // Snap to the new index
            startAutoplay();
        };

        const animationLoop = () => {
            setTransform(currentTranslate);
            if (isDragging) requestAnimationFrame(animationLoop);
        };
        
        const getPositionX = (event) => (event.touches ? event.touches[0].clientX : event.clientX);
        
        const handleTransitionEnd = () => {
            if (currentIndex < CLONE_COUNT) {
                currentIndex += originalItems.length;
                updatePosition(false);
            } else if (currentIndex >= CLONE_COUNT + originalItems.length) {
                currentIndex -= originalItems.length;
                updatePosition(false);
            }
        };

        // --- Core Logic ---
        const updatePosition = (enableTransition = true) => {
            const itemWidth = originalItems[0].offsetWidth;
            const margin = parseFloat(getComputedStyle(originalItems[0]).marginRight) * 2;
            const totalItemWidth = itemWidth + margin;
            const offset = (container.clientWidth / 2) - (totalItemWidth / 2);
            
            currentTranslate = -currentIndex * totalItemWidth + offset;
            prevTranslate = currentTranslate;
            
            track.style.transition = enableTransition ? `transform ${TRANSITION_SPEED_MS}ms cubic-bezier(0.65, 0, 0.35, 1)` : 'none';
            setTransform(currentTranslate);
            
            updateUI();
        };

        // --- UI Updates ---
        const updateUI = () => {
            // Scale and Opacity
            const allItems = Array.from(track.children);
            allItems.forEach((item, index) => {
                const isActive = Math.abs(index - currentIndex) < 1;
                const isNearby = Math.abs(index - currentIndex) < 2;
                
                if (isActive) {
                    item.style.transform = `scale(1.05)`;
                    item.style.opacity = '1';
                    item.style.zIndex = '10';
                } else if (isNearby) {
                    item.style.transform = `scale(0.95)`;
                    item.style.opacity = '0.8';
                    item.style.zIndex = '5';
                } else {
                    item.style.transform = `scale(0.9)`;
                    item.style.opacity = '0.6';
                    item.style.zIndex = '1';
                }
            });
            
            // Progress Bar
            const realIndex = (currentIndex - CLONE_COUNT + originalItems.length) % originalItems.length;
            progressBar.style.width = `${((realIndex + 1) / originalItems.length) * 100}%`;
        };

        const setTransform = (x) => {
            track.style.transform = `translateX(${x}px)`;
        };

        // --- Autoplay ---
        const startAutoplay = () => {
            stopAutoplay();
            autoplayInterval = setInterval(() => {
                currentIndex++;
                updatePosition(true);
            }, AUTOPLAY_DELAY_MS);
        };

        const stopAutoplay = () => {
            clearInterval(autoplayInterval);
        };

        // --- Start the show ---
        setup();
    });
    </script>