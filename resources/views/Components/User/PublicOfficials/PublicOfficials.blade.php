@props(['logos', 'publicOfficialCaption', 'officials'])

@php
    use Illuminate\Support\Str;

    function getImageUrl($path) {
        if (empty($path)) {
            return '';
        }
        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }
        if (Str::startsWith($path, 'public/')) {
            return asset('storage/' . substr($path, strlen('public/')));
        }
        return asset('storage/' . $path);
    }
@endphp

<div class="w-full min-h-screen relative overflow-hidden" style="background-color: #e2e8f0;">
    <div class="relative w-full overflow-hidden">
            <div id="header-section" class="max-w-[1531px] mx-auto pt-20 px-4 flex flex-col lg:flex-row justify-between items-start lg:items-center relative group">
        <div class="mb-10 lg:mb-0 p-4 rounded-lg transition-all duration-300">
            <h1 id="mainTitle" class="text-black text-5xl font-bold font-['Merriweather'] leading-tight" style="color: {{ $publicOfficialCaption->titleColor ?? '#000000' }};">
                {!! nl2br(e($publicOfficialCaption->title)) !!}
            </h1>
        </div>
        <div class="max-w-[673.50px] text-center lg:text-left text-black text-xl font-light leading-relaxed p-4 rounded-lg transition-all duration-300">
            <p id="mainParagraph">{{ $publicOfficialCaption->caption }}</p>
        </div>
    </div>
        <div class="carousel w-full flex animate-scroll gap-4 p-4 snap-x snap-mandatory" style="animation: scroll 20s linear infinite;">
            @foreach ($officials as $official)
                <div class="relative grid h-[40rem] w-full max-w-[28rem] flex-shrink-0 snap-center rounded-xl bg-white bg-clip-border text-center text-gray-700 transition-all duration-500 ease-in-out hover:scale-105 hover:shadow-xl cursor-pointer">
                    <div class="absolute inset-0 m-0 h-full w-full overflow-hidden transition-opacity duration-500 hover:opacity-90" style="background-image: url('{{ getImageUrl($official->picture) }}'); background-size: cover; background-position: center;">
                        <div class="absolute inset-0 w-full h-full to-bg-black-10 bg-gradient-to-t from-black/80 via-black/50"></div>
                    </div>
                    <div class="absolute bottom-0 left-0 w-full p-6 py-14 px-6 md:px-12 bg-gradient-to-t from-black/80 to-transparent">
                        <h2 class="mb-6 block font-sans text-4xl font-medium leading-[1.5] tracking-normal text-white antialiased">
                            {{ $official->position }}
                        </h2>
                        <h5 class="block mb-4 font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-gray-400">
                            {{ $official->name }}
                        </h5>
                        @if ($official->icon)
                            <img src="{{ getImageUrl($official->icon) }}" alt="{{ $official->name }}" class="relative inline-block h-[74px] w-[74px] rounded-full border-2 border-white object-cover object-center animate-pulse" />
                        @endif
                    </div>
                </div>
            @endforeach
            @foreach ($officials as $official)
                <div class="relative grid h-[40rem] w-full max-w-[28rem] flex-shrink-0 snap-center rounded-xl bg-white bg-clip-border text-center text-gray-700 transition-all duration-500 ease-in-out hover:scale-105 hover:shadow-xl cursor-pointer">
                    <div class="absolute inset-0 m-0 h-full w-full overflow-hidden transition-opacity duration-500 hover:opacity-90" style="background-image: url('{{ getImageUrl($official->picture) }}'); background-size: cover; background-position: center;">
                        <div class="absolute inset-0 w-full h-full to-bg-black-10 bg-gradient-to-t from-black/80 via-black/50"></div>
                    </div>
                    <div class="absolute bottom-0 left-0 w-full p-6 py-14 px-6 md:px-12 bg-gradient-to-t from-black/80 to-transparent">
                        <h2 class="mb-6 block font-sans text-4xl font-medium leading-[1.5] tracking-normal text-white antialiased">
                            {{ $official->position }}
                        </h2>
                        <h5 class="block mb-4 font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-gray-400">
                            {{ $official->name }}
                        </h5>
                        @if ($official->icon)
                            <img src="{{ getImageUrl($official->icon) }}" alt="{{ $official->name }}" class="relative inline-block h-[74px] w-[74px] rounded-full border-2 border-white object-cover object-center animate-pulse" />
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <style>
        .animate-scroll {
            display: flex;
        }
        @keyframes scroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .carousel {
            -webkit-overflow-scrolling: touch;
        }
        .carousel::-webkit-scrollbar {
            display: none;
        }
    </style>

    <img class="absolute bottom-[-50px] right-0 w-[736px] h-64 object-contain mb-10 animate-fade" src="{{ asset('storage/miniflagv2.svg') }}" alt="Philippine Flag Colors Decoration" />
</div>