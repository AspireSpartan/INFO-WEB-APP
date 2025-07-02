<div class="w-full min-h-screen bg-gray-700 relative overflow-hidden flex flex-col items-center">
    <div class="absolute w-[1312px] h-[1287px] left-[21px] top-0 hidden lg:block">
        <img src='storage/Vector.svg' alt="Background Image" class="w-full h-full object-cover" />
    </div>
    <div class="absolute w-[500px] h-[500px] left-[-200px] top-[100px] bg-amber-400 rounded-full opacity-5 hidden lg:block"></div>
    <div class="absolute w-[800px] h-[800px] right-[-400px] bottom-[-200px] bg-indigo-900 rounded-full opacity-5 hidden lg:block"></div>

    <div class="relative w-full max-w-[1379px] mx-auto mt-14 px-4 text-center">
        <h1 class="text-white text-5xl font-bold font-['Merriweather'] mb-8">
            Our <span class="text-amber-400">Complete Projects</span>
        </h1>
        <p class="text-white text-xl font-light font-['Source_Sans_Pro'] leading-relaxed">
            The government proudly presents a collection of completed projects that embody progress, resilience, and service to the Filipino people. From modern infrastructure and safer roads to revitalized heritage sites and sustainable community spaces, these accomplishments reflect our unwavering commitment to national development and inclusive growth. Explore how each project contributes to a stronger, more connected, and culturally enriched Philippines.
        </p>
    </div>

    <div class="w-full max-w-[1428px] mx-auto mt-24 px-4 flex flex-col items-center gap-14 pb-20">
        @foreach ($projects as $project)
        <div class="relative w-full bg-white rounded-[20px] shadow-lg flex flex-col lg:flex-row items-center p-8 lg:p-0 min-h-[320px]">
            <div class="lg:w-2/3 p-6 order-2 lg:order-1">
                <h2 class="text-black text-3xl font-bold font-['Merriweather'] mb-4">{{ $project->title }}</h2>
                <p class="text-neutral-600 text-xl font-['Source_Sans_Pro'] leading-relaxed">
                    <span class="text-amber-400 font-bold">Site:</span> {{ $project->site }}<br/>
                    <span class="text-amber-400 font-bold">Scope:</span> {{ $project->scope }}<br/>
                    <span class="text-amber-400 font-bold">Outcome:</span> {{ $project->outcome }}
                </p>
            </div>
            <div class="lg:w-1/3 flex justify-center items-center p-6 order-1 lg:order-2">
                <img class="w-[571px] h-80 rounded-[20px] object-cover shadow-[-17px_8px_18px_-1px_rgba(0,0,0,0.25)]" src="{{ $project->image_url }}" alt="{{ $project->title }}" />
            </div>
        </div>
        @endforeach
    </div>

    <a href="/showallproject" class="relative w-80 h-12 mb-20 rounded-[50px] border-2 border-amber-400 flex justify-center items-center cursor-pointer hover:bg-amber-50 transition">
        <div class="text-amber-400 text-lg font-normal font-['Sans_Serif_Collection']">SHOW ALL PROJECTS</div>
    </a>
</div>