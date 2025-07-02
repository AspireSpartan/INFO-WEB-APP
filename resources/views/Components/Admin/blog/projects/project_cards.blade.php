@props(['project', 'indexContent'])

<div class="bg-white rounded-xl shadow-lg overflow-hidden flex flex-col justify-between transform transition-all duration-300 hover:scale-[1.02] hover:shadow-xl">
    {{-- Image --}}
    @if($project->image_url)
        <img src="{{ asset('storage/' . $project->image_url) }}" alt="{{ $project->title }}" class="w-full h-48 object-cover rounded-t-xl">
    @else
        <div class="w-full h-48 bg-gray-200 flex items-center justify-center rounded-t-xl text-gray-500 text-sm">No Image Available</div>
    @endif

    <div class="p-6 flex flex-col flex-grow​">
        {{-- Title --}}
        <h2 class="text-2xl font-bold font-['Merriweather'] text-gray-800 mb-2 truncate leading-tight">
            {{ $project->title }}
        </h2>

        {{-- Site, Scope, Outcome --}}
        <div class="text-gray-600 text-sm mb-4 flex-grow overflow-hidden leading-relaxed">
            <p><span class="font-bold text-amber-500">Site:</span> {{ $project->site }}</p>
            <p><span class="font-bold text-amber-500">Scope:</span> {{ $project->scope }}</p>
            <p><span class="font-bold text-amber-500">Outcome:</span> {{ $project->outcome }}</p>
        </div>

        {{-- Action Buttons --}}
        <div class="flex flex-col sm:flex-row justify-end gap-2 mt-auto pt-4 border-t border-gray-100">
            <a href="{{ $project->url }}" target="_blank" rel="noopener noreferrer" class="px-4 py-2 text-sm bg-amber-500 text-white font-semibold rounded-md hover:bg-amber-600 transition-colors shadow-sm w-auto text-center whitespace-nowrap">
                Read More
            </a>
            <a href="{{ route('projects.edit', $project->id) }}" class="px-4 py-2 text-sm border border-gray-300 hover:bg-gray-100 text-gray-700 rounded-md transition-colors shadow-sm w-auto text-center whitespace-nowrap">
                Edit
            </a>

            <form action="{{ route('projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this project?');" class="w-auto">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 text-sm border border-gray-300 hover:bg-gray-100 text-gray-700 rounded-md transition-colors shadow-sm w-auto text-center whitespace-nowrap">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>