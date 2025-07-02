<div class="min-h-screen bg-white font-sans text-gray-800">

    <div class="container mx-auto px-4 py-32 text-center">
        <h1 class="text-5xl font-bold font-['Merriweather'] mb-8">
            Our <span class="text-amber-500">Complete Projects</span>
        </h1>
        <p class="text-xl font-light font-['Source_Sans_Pro'] leading-relaxed max-w-8xl mx-auto">
            {{ $description->description ?? '' }}
        </p>
    </div>
    <div class="container mx-auto px-4 pb-20 grid grid-cols-1 lg:grid-cols-2 gap-x-16 gap-y-24">

        @foreach ($projects as $project)
        {{-- For alternating layout, you can use $loop->iteration or $loop->index --}}
        <div class="flex flex-col lg:flex-row items-center lg:items-start gap-8
                    {{ $loop->index % 2 == 0 ? 'lg:flex-row' : 'lg:flex-row-reverse' }}"> {{-- Alternates image/text order --}}
            
            {{-- Image Container --}}
            <div class="flex-shrink-0 w-full lg:w-1/2 flex justify-center items-center">
                <img src="{{ asset('storage/' . $project->image_url) }}" alt="{{ $project->title }}
                     class="max-w-full h-auto max-h-96 rounded-xl shadow-lg object-contain"> {{-- Dynamic sizing --}}
            </div>

            {{-- Text Content --}}
            <div class="flex-1 max-w-xs md:max-w-md lg:max-w-none text-center lg:text-left">
                <!--TITLE--> 
                <h2 class="text-3xl font-bold font-['Merriweather'] mb-4">{{ $project->title }}</h2>
                <div class="text-lg font-['Source_Sans_Pro'] leading-relaxed">
                    <!--SITE--> 
                    <p><span class="font-['Merriweather'] font-bold text-amber-500">Site:</span> {{ $project->site }}</p>
                    <!--SCOPE--> 
                    <p><span class="font-['Merriweather'] font-bold text-amber-500">Scope:</span> {{ $project->scope }}</p>
                    <!--OUTCOME--> 
                    <p><span class="font-['Merriweather'] font-bold text-amber-500">Outcome:</span> {{ $project->outcome }}</p>
                </div>
                <!--READ MORE BUTTON-->
                <a href="{{ $project->url }}" target="_blank" class="inline-block mt-4 px-6 py-2 bg-amber-500 text-white font-semibold rounded-lg hover:bg-amber-600 transition">
                    Read More
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
