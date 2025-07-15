<div class="w-full min-h-screen relative overflow-hidden" style="background-color: #e2e8f0;">

    <div id="header-section" class="max-w-[1531px] mx-auto pt-20 px-4 flex flex-col lg:flex-row justify-between items-start lg:items-center relative group">
        <div class="mb-10 lg:mb-0 p-4 rounded-lg transition-all duration-300">
            <h1 id="mainTitle" 
                class="text-black text-5xl font-bold font-['Merriweather'] leading-tight"
                style="color: {{ $publicOfficialCaption->titleColor ?? '#000000' }};">
                {!! nl2br(e($publicOfficialCaption->title)) !!}
            </h1>
        </div>
        <div class="max-w-[673.50px] text-center lg:text-left text-black text-xl font-light leading-relaxed p-4 rounded-lg transition-all duration-300">
            <p id="mainParagraph">{{ $publicOfficialCaption->caption }}</p>
        </div>
    </div>

    <div class="flex flex-col md:flex-row gap-8 justify-center items-center w-full min-h-screen p-4 md:p-8">
        @foreach ($officials as $official)
            <div class="relative grid h-[40rem] w-full max-w-[28rem] flex-col items-end justify-center overflow-hidden rounded-xl bg-white bg-clip-border text-center text-gray-700
                transition-transform duration-300 ease-in-out transform hover:scale-105 hover:shadow-lg cursor-pointer">
                <div class="absolute inset-0 m-0 h-full w-full overflow-hidden" style="background-image: url('{{ $official->picture }}'); background-size: cover; background-position: center;">
                    <div class="absolute inset-0 w-full h-full to-bg-black-10 bg-gradient-to-t from-black/80 via-black/50"></div>
                </div>
                <div class="relative p-6 py-14 px-6 md:px-12">
                    <h2 class="mb-6 block font-sans text-4xl font-medium leading-[1.5] tracking-normal text-white antialiased">
                        {{ $official->position }}
                    </h2>
                    <h5 class="block mb-4 font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-gray-400">
                        {{ $official->name }}
                    </h5>
                    @if ($official->icon)
                        <img src="{{ $official->icon }}" alt="{{ $official->name }}" class="relative inline-block h-[74px] w-[74px] rounded-full border-2 border-white object-cover object-center" />
                    @endif
                </div>
            </div>
        @endforeach
    </div>


<img class="absolute bottom-[-50px] right-0 w-[736px] h-64 object-contain mb-10" src="storage/miniflagv2.svg" alt="Philippine Flag Colors Decoration" />


</div>