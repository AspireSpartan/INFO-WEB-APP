{{-- resources/views/Components/Admin/news_row.blade.php --}}
@props([
    'imageSrc',
    'datePosted',
    'title',
    'description',
    'linkHref'
])

<div class="px-6 py-4 grid grid-cols-8 gap-4 items-center border-b border-neutral-300">
    <div class="col-span-1 flex items-center gap-12"> {{-- Adjusted gap from 12 to 2 for better alignment based on previous requests --}}
        <input type="checkbox" class="h-4 w-4 rounded border-gray-300 text-amber-400 focus:ring-amber-400 cursor-pointer">
        <img class="w-10 h-10 rounded-full object-cover" src="{{ $imageSrc }}" alt="User Image">
    </div>
    <div class="col-span-1 text-black text-base font-normal font-source-sans-pro">{{ $datePosted }}</div>
    <div class="col-span-2 text-black text-base font-normal font-source-sans-pro">{{ $title }}</div>
    <div class="col-span-2 text-black text-base font-light font-source-sans-pro">{{ $description }}</div>
    <div class="col-span-1">
        <a href="{{ $linkHref }}" target="_blank" class="text-blue-600 hover:underline text-sm font-source-sans-pro truncate block">
            Link
        </a>
    </div>
    <div class="col-span-1 flex justify-end items-center relative" x-data="{ open: false }" @click.away="open = false">
        <button class="p-2 rounded-full hover:bg-gray-200" @click="open = !open">
            <img src='storage/three_doted.svg' alt="Actions" class="w-5 h-5 text-gray-500">
        </button>
        <!-- Dropdown Content -->
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
</div>
