{{-- resources/views/Components/Admin/newss/news_row.blade.php --}}
@props([
    'newsItem',
    'picture',
    'author',
    'date',
    'title',
    'sponsored',
    'views',
    'url'
])

<div class="px-6 py-4 grid grid-cols-9 gap-4 items-center border-b border-neutral-300 relative"
     x-data="{ showImageModal: false, modalImageUrl: '' }">

    {{-- Checkbox and Picture --}}
    <div class="col-span-1 flex items-center gap-12">
    {{-- This is the checkbox you need to verify --}}
        <input type="checkbox" name="selected_news_items[]" class="news-checkbox h-4 w-4 rounded border-gray-300 text-amber-400 focus:ring-amber-400 cursor-pointer" value="{{ $newsItem->id }}">

        <img class="w-10 h-10 object-cover rounded-md transition-transform duration-300 hover:scale-[1.5] cursor-pointer"
            src="{{ asset('storage/' . $newsItem->picture) }}"
            alt="News Image"
            @click="showImageModal = true; modalImageUrl = '{{ asset('storage/' . $newsItem->picture) }}'">
    </div>

    {{-- Author --}}
    <div class="col-span-1 flex justify-center items-center text-black text-base font-normal font-source-sans-pro truncate">
        {{ $newsItem->author }}
    </div>

    {{-- Date --}}
    <div class="col-span-1 flex justify-center items-center text-black text-base font-normal font-source-sans-pro whitespace-nowrap">
        {{ $newsItem->date->format('d/m/Y') }}
    </div>

    {{-- Title --}}
    <div class="col-span-2 flex justify-center items-center text-black text-base font-normal font-source-sans-pro truncate">
        {{ $newsItem->title }}
    </div>

    {{-- Sponsored --}}
    <div class="col-span-1 flex justify-center items-center text-black text-base font-normal font-source-sans-pro whitespace-nowrap">
        {{ $newsItem->sponsored ? 'Yes' : 'No'}}
    </div>

    {{-- Views --}}
    <div class="col-span-1 flex justify-center items-center text-black text-base font-normal font-source-sans-pro whitespace-nowrap">
        {{ number_format($newsItem->views) }}
    </div>

    {{-- URL --}}
    <div class="col-span-1 flex justify-center items-center">
        <a href="{{ $newsItem->url }}" target="_blank" class="text-blue-500 hover:underline text-sm px-3 py-1 rounded-md bg-blue-50 border border-blue-200 transition-colors">View URL</a>
    </div>

        {{-- Actions Dropdown --}}
        <div class="col-span-1 flex justify-center items-center relative" x-data="{ open: false }" @click.away="open = false">
            <button class="p-2 rounded-full hover:bg-gray-200" @click="open = !open">
                <img src='{{ asset('storage/three_doted.svg') }}' alt="Actions" class="w-5 h-5 text-gray-500">
            </button>
            <div x-show="open"
                x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95"
                class="fixed z-[9999] right-8 top-auto mt-2 w-36 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                <div class="py-1" role="none">
                    {{-- Update Link --}}
                    <a href="{{ route('news.edit', $newsItem->id) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Update</a>

                    {{-- Delete Form (using a form for DELETE request) --}}
                    <form action="{{ route('news.destroy', $newsItem->id) }}" method="POST" class="block" onsubmit="return confirm('Are you sure you want to delete this news item?');" role="none">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100" role="menuitem">Delete</button>
                    </form>

                    {{-- View Details Link (assuming you want to use the show method) --}}
                    <a href="{{ route('news.show', $newsItem->id) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">View Details</a>
                </div>
            </div>
        </div>

    {{-- Image Modal --}}
    <div x-show="showImageModal"
         class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 p-4"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">

        <div class="relative max-w-full max-h-full">
            <button @click="showImageModal = false"
                    class="absolute -top-6 -right-6 md:-top-8 md:-right-8 p-2 rounded-full bg-white bg-opacity-30 hover:bg-opacity-50 text-white text-lg font-bold transition-all duration-200 z-50">
                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <img :src="modalImageUrl" alt="News Image Preview" class="max-w-full max-h-full object-contain">
        </div>
    </div>

</div>
