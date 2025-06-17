{{-- resources/views/Components/Admin/news_row.blade.php --}}
@props([
    'picture',
    'author',
    'date',
    'title',
    'sponsored',
    'views',
    'url'
])

{{-- x-data="{ showImageModal: false, modalImageUrl: '' }" is back on the row level --}}
<div class="px-6 py-4 grid grid-cols-9 gap-4 items-center border-b border-neutral-300"
     x-data="{ showImageModal: false, modalImageUrl: '' }">

    {{-- Checkbox and Picture --}}
    <div class="col-span-1 flex items-center gap-12">
        <input type="checkbox" class="h-4 w-4 rounded border-gray-300 text-amber-400 focus:ring-amber-400 cursor-pointer">
        {{-- When image is clicked, set showImageModal to true and modalImageUrl to the current picture --}}
        <img class="w-10 h-10 object-cover transition-transform duration-300 hover:scale-[2.25] cursor-pointer"
             src="{{ $picture }}"
             alt="News Image"
             @click="showImageModal = true; modalImageUrl = '{{ $picture }}'">
    </div>
    {{-- Author --}}
    <div class="col-span-1 text-black text-base font-normal font-source-sans-pro">{{ $author }}</div>
    {{-- Date --}}
    <div class="col-span-1 text-black text-base font-normal font-source-sans-pro">{{ $date }}</div>
    {{-- Title --}}
    <div class="col-span-2 text-black text-base font-normal font-source-sans-pro">{{ $title }}</div>
    {{-- Sponsored --}}
    <div class="col-span-1 text-black text-base font-normal font-source-sans-pro">
        {{ $sponsored ? 'Yes' : 'No' }}
    </div>
    {{-- Views --}}
    <div class="col-span-1 text-black text-base font-normal font-source-sans-pro">{{ $views }}</div>
    {{-- URL --}}
    <div class="col-span-1 text-black text-base font-normal font-source-sans-pro"><a href="{{ $url }}" target="_blank" class="text-blue-500 underline">{{ $url }}</a></div>
    {{-- Actions Dropdown --}}
    <div class="col-span-2 flex justify-end items-center relative" x-data="{ open: false }" @click.away="open = false">
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
             class="absolute right-0 mt-2 w-36 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-10"
             role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
            <div class="py-1" role="none">
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">Update</a>
                <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100" role="menuitem" tabindex="-1">Delete</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">View Details</a>
            </div>
        </div>
    </div>

    {{-- Image Modal with Close Button --}}
    <div x-show="showImageModal"
         class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 p-4" {{-- Added p-4 for padding --}}
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">

        <div class="relative max-w-full max-h-full"> {{-- Added a relative container for the image and button --}}
            {{-- Close Button --}}
            <button @click="showImageModal = false"
                    class="absolute -top-6 -right-6 md:-top-8 md:-right-8 p-2 rounded-full bg-white bg-opacity-30 hover:bg-opacity-50 text-white text-lg font-bold transition-all duration-200 z-50">
                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            {{-- The Image --}}
            <img :src="modalImageUrl" alt="News Image Preview" class="max-w-full max-h-full object-contain">
        </div>
    </div>
</div>