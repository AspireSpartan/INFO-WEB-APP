<div class="relative w-full overflow-hidden" id="visionMissionGoalSection">
    {{-- Background Image (Philippine Flag) with fade-in animation --}}
    <img src="{{ asset('storage/Ph_flag.svg') }}" class="absolute inset-0 w-full h-full object-cover opacity-90 transition-opacity duration-1500 ease-in-out lazy-animate" data-animation-class="opacity-90">

    {{-- Sun Emblem with scale-in animation --}}
    <img src="{{ asset('storage/miniflag.svg') }}" class="absolute top-[-30px] right-[50px] w-[300px] h-auto transition-all duration-1000 ease-in-out lazy-animate" style="z-index: 0;" data-animation-class="opacity-80 translate-x-0 scale-100" data-initial-class="opacity-0 translate-x-10 scale-80" data-delay="300">

    {{-- Content Container (Vision, Mission, Goal) --}}
    <div class="relative z-10 px-[100px] py-20">
        {{-- Vision Section --}}
        <div class="flex items-center mb-20">
            {{-- Vision Icon Placeholder --}}
            <img src="{{ asset('storage/Vision.svg') }}" class="flex-shrink-0 w-12 h-12 mr-6 shadow-md transition-all duration-800 ease-in-out lazy-animate"
                data-animation-class="opacity-100 translate-x-0 scale-100" data-initial-class="opacity-0 translate-x-5 scale-0" data-delay="500">
            <div class="w-[15px] h-[100px] bg-white mr-[30px] shadow-[5px_3px_5px_-2px_rgba(0,0,0,0.3)] transition-transform duration-800 ease-in-out lazy-animate" data-animation-class="scale-y-100" data-initial-class="scale-y-0 origin-bottom" data-delay="600"></div>
            <div>
                <h2 class="text-white text-3xl md:text-4xl font-bold font-serif transition-all duration-800 ease-in-out lazy-animate" data-animation-class="opacity-100 translate-x-0" data-initial-class="opacity-0 translate-x-5" data-delay="700">Vision</h2>
                <p class="text-white text-sm md:text-base font-light leading-relaxed transition-all duration-800 ease-in-out lazy-animate" data-animation-class="opacity-100 translate-x-0" data-initial-class="opacity-0 translate-x-5" data-delay="800"style="font-size: 15px !important;">
                    A digitally connected and responsive local government that ensures inclusive participation, promotes transparency, and delivers high-quality public services for a better, sustainable community.
                </p>
            </div>
        </div>

        {{-- Mission Section --}}
        <div class="flex items-center mb-20">
            {{-- Mission Icon Placeholder --}}
            <img src="{{ asset('storage/Mission.svg') }}" class="flex-shrink-0 w-12 h-12 mr-6 shadow-md transition-all duration-800 ease-in-out lazy-animate"
                data-animation-class="opacity-100 translate-x-0 scale-100" data-initial-class="opacity-0 translate-x-5 scale-0" data-delay="800">
            <div class="w-[15px] h-[100px] bg-[#37474F] mr-[30px] shadow-[5px_5px_5px_-2px_rgba(0,0,0,0.3)] transition-transform duration-800 ease-in-out lazy-animate" data-animation-class="scale-y-100" data-initial-class="scale-y-0 origin-bottom" data-delay="900"></div>
            <div>
                <h2 class="text-white text-3xl md:text-4xl font-bold font-serif transition-all duration-800 ease-in-out lazy-animate" data-animation-class="opacity-100 translate-x-0" data-initial-class="opacity-0 translate-x-5" data-delay="1000">Mission</h2>
                <p class="text-white text-sm md:text-base font-light leading-relaxed transition-all duration-800 ease-in-out lazy-animate" data-animation-class="opacity-100 translate-x-0" data-initial-class="opacity-0 translate-x-5" data-delay="1100"style="font-size: 15px !important;">
                    To provide transparent, accessible, and efficient digital services that empower citizens, support local development, and strengthen public trust through innovative governance and community engagement.
                </p>
            </div>
        </div>

        {{-- Goal Section --}}
        <div class="flex items-center">
            {{-- Goal Icon Placeholder --}}
            <img src="{{ asset('storage/goal.svg') }}" class="flex-shrink-0 w-12 h-12 mr-6 shadow-md transition-all duration-800 ease-in-out lazy-animate"
                data-animation-class="opacity-100 translate-x-0 scale-100" data-initial-class="opacity-0 translate-x-5 scale-0" data-delay="1100">
            <div class="w-[15px] h-[100px] bg-[#D4AF37] mr-[30px] shadow-[5px_5px_5px_-2px_rgba(0,0,0,0.3)] transition-transform duration-800 ease-in-out lazy-animate" data-animation-class="scale-y-100" data-initial-class="scale-y-0 origin-bottom" data-delay="1200"></div>
            <div>
                <h2 class="text-white text-3xl md:text-4xl font-bold font-serif transition-all duration-800 ease-in-out lazy-animate" data-animation-class="opacity-100 translate-x-0" data-initial-class="opacity-0 translate-x-5" data-delay="1300">Goal</h2>
                <p class="text-white text-sm md:text-base font-light leading-relaxed transition-all duration-800 ease-in-out lazy-animate" data-animation-class="opacity-100 translate-x-0" data-initial-class="opacity-0 translate-x-5" data-delay="1400"style="font-size: 15px !important;">
                    To create a centralized digital platform that enhances public service delivery, promotes transparency, and fosters active citizen participation in local governance.
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const section = document.getElementById('visionMissionGoalSection');
        const animatedElements = section.querySelectorAll('.lazy-animate');

        // Apply initial styles using data attributes
        animatedElements.forEach(el => {
            const initialClasses = el.dataset.initialClass;
            if (initialClasses) {
                el.classList.add(...initialClasses.split(' '));
            }
        });

        const observerOptions = {
            root: null, // Use the viewport as the root
            rootMargin: '0px',
            threshold: 0.1 // Trigger when 10% of the section is visible
        };

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animatedElements.forEach(el => {
                        const animationClasses = el.dataset.animationClass;
                        const initialClasses = el.dataset.initialClass;
                        const delay = parseInt(el.dataset.delay) || 0; // Get delay from data attribute

                        setTimeout(() => {
                            if (initialClasses) {
                                el.classList.remove(...initialClasses.split(' '));
                            }
                            if (animationClasses) {
                                el.classList.add(...animationClasses.split(' '));
                            }
                        }, delay);
                    });
                    observer.unobserve(entry.target); // Stop observing once animated
                }
            });
        }, observerOptions);

        observer.observe(section);
    });
</script>