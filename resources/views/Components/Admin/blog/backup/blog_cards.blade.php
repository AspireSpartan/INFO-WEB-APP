{{-- resources/views/Components/Admin/blog/blog_card_item.blade.php --}}
@props(['image', 'name', 'description', 'job_title'])

<div class="bg-white rounded-xl shadow-lg overflow-hidden flex flex-col justify-between transform transition-all duration-300 hover:scale-[1.02] hover:shadow-xl">
    <img src="{{ $image }}" alt="{{ $name }} Image" class="w-full h-48 object-cover">
    <div class="p-6 flex flex-col flex-grow">
        <h2 class="text-xl font-semibold font-montserrat text-gray-800 mb-2 truncate leading-tight">{{ $name }}</h2>
        <p class="text-gray-600 text-sm mb-4 flex-grow overflow-hidden line-clamp-3 leading-snug">{{ $description }}</p>
        <p class="text-gray-500 text-xs font-source-sans-pro mb-4">Job Title: {{ $job_title }}</p>
        <div class="flex flex-col sm:flex-row justify-end gap-2 mt-auto pt-4 border-t border-gray-100">
            <button class="px-4 py-2 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded-md transition-colors shadow-sm flex-grow sm:flex-none">Edit</button>
            <button class="px-4 py-2 text-sm border border-gray-300 hover:bg-gray-100 text-gray-700 rounded-md transition-colors shadow-sm flex-grow sm:flex-none">Delete</button>
            <button class="px-4 py-2 text-sm border border-gray-300 hover:bg-gray-100 text-gray-700 rounded-md transition-colors shadow-sm flex-grow sm:flex-none">View</button>
        </div>
    </div>
</div>

