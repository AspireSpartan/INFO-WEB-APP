@props(['contentMlogos', 'vmgEditableContentData', 'strategicPlans'])
<div class="relative w-full overflow-hidden" id="visionMissionGoalSection">
    {{-- Background Image (Philippine Flag) with fade-in animation --}}
    @foreach($contentMlogos as $logo)
        @if($logo->id == 1)
            <img src="{{ asset($logo->image_path) }}" class="absolute inset-0 w-full h-full object-cover opacity-90 transition-opacity duration-1500 ease-in-out lazy-animate" data-animation-class="opacity-90">
        @endif
    @endforeach

    {{-- Sun Emblem with scale-in animation --}}
    @foreach($contentMlogos as $logo)
        @if($logo->id == 2)
            <img src="{{ asset($logo->image_path) }}" class="absolute top-[-30px] right-[50px] w-[300px] h-auto transition-all duration-1000 ease-in-out lazy-animate" style="z-index: 0;" data-animation-class="opacity-80 translate-x-0 scale-100" data-initial-class="opacity-0 translate-x-10 scale-80" data-delay="300">
        @endif
    @endforeach

    {{-- Content Container (Vision, Mission, Goal) --}}
    <div class="relative z-10 px-[100px] py-20">
        {{-- Vision Section --}}
        <div class="flex items-center mb-20">
            <img src="{{ asset($vmgEditableContentData['vision']['icon']) }}" class="flex-shrink-0 w-12 h-12 mr-6 shadow-md transition-all duration-800 ease-in-out lazy-animate"
                data-animation-class="opacity-100 translate-x-0 scale-100" data-initial-class="opacity-0 translate-x-5 scale-0" data-delay="500" alt="Vision Icon">
            <div class="w-[15px] h-[100px] bg-white mr-[30px] shadow-[5px_3px_5px_-2px_rgba(0,0,0,0.3)] transition-transform duration-800 ease-in-out lazy-animate" data-animation-class="scale-y-100" data-initial-class="scale-y-0 origin-bottom" data-delay="600"></div>
            <div>
                <h2 class="text-white text-3xl md:text-4xl font-bold font-serif transition-all duration-800 ease-in-out lazy-animate" data-animation-class="opacity-100 translate-x-0" data-initial-class="opacity-0 translate-x-5" data-delay="700">{{ $vmgEditableContentData['vision']['title'] }}</h2>
                <p class="text-white text-sm md:text-base font-light leading-relaxed transition-all duration-800 ease-in-out lazy-animate" data-animation-class="opacity-100 translate-x-0" data-initial-class="opacity-0 translate-x-5" data-delay="800" style="font-size: 15px !important;">
                    {{ $vmgEditableContentData['vision']['paragraph'] }}
                </p>
            </div>
        </div>

        {{-- Mission Section --}}
        <div class="flex items-center mb-20">
            <img src="{{ asset($vmgEditableContentData['mission']['icon']) }}" class="flex-shrink-0 w-12 h-12 mr-6 shadow-md transition-all duration-800 ease-in-out lazy-animate"
                data-animation-class="opacity-100 translate-x-0 scale-100" data-initial-class="opacity-0 translate-x-5 scale-0" data-delay="800" alt="Mission Icon">
            <div class="w-[15px] h-[100px] bg-[#37474F] mr-[30px] shadow-[5px_5px_5px_-2px_rgba(0,0,0,0.3)] transition-transform duration-800 ease-in-out lazy-animate" data-animation-class="scale-y-100" data-initial-class="scale-y-0 origin-bottom" data-delay="900"></div>
            <div>
                <h2 class="text-white text-3xl md:text-4xl font-bold font-serif transition-all duration-800 ease-in-out lazy-animate" data-animation-class="opacity-100 translate-x-0" data-initial-class="opacity-0 translate-x-5" data-delay="1000">{{ $vmgEditableContentData['mission']['title'] }}</h2>
                <p class="text-white text-sm md:text-base font-light leading-relaxed transition-all duration-800 ease-in-out lazy-animate" data-animation-class="opacity-100 translate-x-0" data-initial-class="opacity-0 translate-x-5" data-delay="1100" style="font-size: 15px !important;">
                    {{ $vmgEditableContentData['mission']['paragraph'] }}
                </p>
            </div>
        </div>

        {{-- Goal Section --}}
        <div class="flex items-center">
            <img src="{{ asset($vmgEditableContentData['goal']['icon']) }}" class="flex-shrink-0 w-12 h-12 mr-6 shadow-md transition-all duration-800 ease-in-out lazy-animate"
                data-animation-class="opacity-100 translate-x-0 scale-100" data-initial-class="opacity-0 translate-x-5 scale-0" data-delay="1100" alt="Goal Icon">
            <div class="w-[15px] h-[100px] bg-[#D4AF37] mr-[30px] shadow-[5px_5px_5px_-2px_rgba(0,0,0,0.3)] transition-transform duration-800 ease-in-out lazy-animate" data-animation-class="scale-y-100" data-initial-class="scale-y-0 origin-bottom" data-delay="1200"></div>
            <div>
                <h2 class="text-white text-3xl md:text-4xl font-bold font-serif transition-all duration-800 ease-in-out lazy-animate" data-animation-class="opacity-100 translate-x-0" data-initial-class="opacity-0 translate-x-5" data-delay="1300">{{ $vmgEditableContentData['goal']['title'] }}</h2>
                <p class="text-white text-sm md:text-base font-light leading-relaxed transition-all duration-800 ease-in-out lazy-animate" data-animation-class="opacity-100 translate-x-0" data-initial-class="opacity-0 translate-x-5" data-delay="1400" style="font-size: 15px !important;">
                    {{ $vmgEditableContentData['goal']['paragraph'] }}
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