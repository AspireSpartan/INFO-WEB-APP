<!-- Components/User/about-us/section-1.blade.php -->
@props(['contentManager', 'contentOffer'])

<style>
    /* Custom font families (if not directly supported by Tailwind's default font stack) */
    .font-['Verdana'] { font-family: Verdana, sans-serif; }
    .font-['Caveat'] { font-family: 'Caveat', cursive; }
    .font-roboto { font-family: 'Roboto', sans-serif; }
    .font-montserrat { font-family: 'Montserrat', sans-serif; }

    /* General body font */
    body {
        font-family: 'Inter', sans-serif; /* Default font as per instructions */
    }
</style>

<div class="min-h-screen w-full relative overflow-hidden"
     x-data="{ loaded: false }"
     x-init="$nextTick(() => { loaded = true })"
     :class="{ 'opacity-0': !loaded, 'opacity-100': loaded }"
     x-transition:enter="transition ease-out duration-700"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100">

    {{-- Hero Section --}}
    <div class="relative w-full h-[500px] md:h-[600px] flex items-center justify-center">
        {{-- Use dynamic heroImage from contentManager --}}
        <img class="absolute inset-0 w-full h-full object-cover" src="{{ $contentManager['heroImage'] ?? asset('storage/default_hero_image.svg') }}" alt="About Us Team" />
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="relative z-10 text-center px-4 max-w-4xl mx-auto">
            {{-- Use dynamic heroTitle from contentManager --}}
            <h1 class="text-white text-4xl md:text-5xl font-bold font-['Verdana'] leading-tight mb-4 md:mb-6">
                {{ $contentManager['heroTitle'] ?? 'About Us' }}
            </h1>
            {{-- Use dynamic heroSubtitle from contentManager --}}
            <p class="text-white text-2xl md:text-3xl font-normal font-['Caveat']">
                {{ $contentManager['heroSubtitle'] ?? 'Serving the Community with Efficiency, Transparency, and Care' }}
            </p>
        </div>
    </div>

    {{-- Content Section (Introduction & What We Offer) --}}
    <div class="w-full bg-white py-16 px-4 md:px-8 lg:px-12">
        <div class="max-w-6xl mx-auto flex flex-col gap-16">

            {{-- Introduction Section --}}
            <div class="flex flex-col lg:flex-row justify-between items-start gap-10 lg:gap-20">
                <div class="w-full lg:w-1/3">
                    {{-- Use dynamic introTitlePart1 and introTitlePart2 from contentManager --}}
                    <span class="text-orange-500 text-2xl md:text-3xl font-bold font-['Verdana']">
                        {{ $contentManager['introTitlePart1'] ?? 'Introduction' }}
                    </span>
                    <span class="text-black text-2xl md:text-3xl font-bold font-['Verdana']">
                        {{ $contentManager['introTitlePart2'] ?? ' to Your Trusted LGU Services Hub!' }}
                    </span>
                </div>
                <div class="w-full lg:w-2/3 flex flex-col md:flex-row justify-between items-start gap-6 md:gap-10">
                    {{-- Use dynamic introParagraph1 from contentManager --}}
                    <p class="text-center md:text-left text-neutral-600 text-base md:text-lg font-medium font-['Montserrat']">
                        {{ $contentManager['introParagraph1'] ?? 'At [LGUConnect], we believe in accessible and convenient public service. Our platform bridges the gap between citizens and local government units by offering fast, secure, and transparent digital services.' }}
                    </p>
                    {{-- Use dynamic introParagraph2 from contentManager --}}
                    <p class="text-center md:text-left text-neutral-600 text-base md:text-lg font-medium font-['Montserrat']">
                        {{ $contentManager['introParagraph2'] ?? 'We are committed to simplifying the way you access essential documents and updates—so you can focus on what matters most.' }}
                    </p>
                </div>
            </div>

            {{-- Divider Line --}}
            <div class="flex justify-center">
                <div class="w-2/3 lg:w-1/2 h-1 bg-indigo-900 rounded-[20px]"></div>
            </div>

            {{-- What We Offer Section --}}
            <h2 class="text-orange-500 text-5xl font-bold font-['Caveat']">What We Offer</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {{-- Loop through contentOffer to display dynamic offer boxes --}}
                @forelse($contentOffer as $offer)
                    <div class="group bg-white rounded-[20px] shadow-md p-4 flex items-center gap-4
                                 transition-all duration-300 ease-in-out cursor-pointer
                                 hover:shadow-lg hover:scale-[1.02]
                                 hover:ring-4 hover:ring-[#F18018] hover:ring-opacity-70">
                        <div class="w-16 h-16 md:w-20 md:h-20 bg-zinc-300 rounded-full flex-shrink-0 flex items-center justify-center overflow-hidden">
                            {{-- Conditionally render icon or image based on content --}}
                            @if(isset($offer->icon) && Str::startsWith($offer->icon, 'fas fa-'))
                                <i class="{{ $offer->icon }} text-white text-2xl"></i>
                            @elseif(isset($offer->icon))
                                <img src="{{ $offer->icon }}" alt="Offer Icon" class="w-full h-full object-cover rounded-full">
                            @else
                                {{-- Default icon if none provided --}}
                                <i class="fas fa-question-circle text-white text-2xl"></i>
                            @endif
                        </div>

                        <div class="flex flex-col items-start gap-2 text-left">
                            <h3 class="text-black text-lg md:text-xl font-bold font-roboto">
                                {{ $offer->title ?? 'Default Offer Title' }}
                            </h3>
                            <p class="text-neutral-600 text-sm md:text-base font-medium font-montserrat">
                                {{ $offer->description ?? 'Default offer description.' }}
                            </p>
                        </div>
                    </div>
                @empty
                    {{-- Message if no offers are available --}}
                    <p class="col-span-full text-center text-gray-500">No offers available at the moment.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>