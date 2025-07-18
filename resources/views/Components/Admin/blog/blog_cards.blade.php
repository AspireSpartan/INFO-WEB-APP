{{-- resources/views/Components/Admin/blog/blog_card_item.blade.php --}}
@props(['blogfeed']) {{-- We pass the entire blogfeed object --}}

<div class="bg-white rounded-xl shadow-lg overflow-hidden flex flex-col justify-between transform transition-all duration-300 hover:scale-[1.02] hover:shadow-xl">
    {{-- Main Image --}}
    @if($blogfeed->image_path)
        <img src="{{ asset('storage/' . $blogfeed->image_path) }}" alt="{{ $blogfeed->title }} Image" class="w-full h-48 object-cover">
    @else
        {{-- Placeholder if no image --}}
        <div class="w-full h-48 bg-gray-200 flex items-center justify-center rounded-t-xl text-gray-500 text-sm">No Image Available</div>
    @endif

    <div class="p-6 flex flex-col flex-grow">
        {{-- Date section --}}
        <div class="flex items-center gap-x-4 text-xs mb-2 text-gray-500">
            <time datetime="{{ $blogfeed->published_at ? \Carbon\Carbon::parse($blogfeed->published_at)->toIso8601String() : '' }}">
                {{ $blogfeed->published_at ? \Carbon\Carbon::parse($blogfeed->published_at)->format('F d, Y') : 'N/A Date' }}
            </time>
        </div>

        {{-- Title --}}
        <h2 class="text-xl font-semibold font-montserrat text-gray-800 mb-2 truncate leading-tight">
            {{-- OPTIONAL: Add @click to title for another way to open the view modal --}}
            <a href="#" @click.prevent="$dispatch('open-admin-blog-show-modal', {{ json_encode($blogfeed) }})" class="hover:text-indigo-600 transition-colors">
                 {{ $blogfeed->title }}
            </a>
        </h2>

        {{-- Content (description) --}}
        <p class="text-gray-600 text-sm mb-4 flex-grow overflow-hidden line-clamp-3 leading-snug">{{ $blogfeed->content }}</p>

        {{-- Author/Author Title with Icon --}}
        <div class="flex items-center gap-x-3 text-sm mb-4">
            @if($blogfeed->icon_path)
                <img src="{{ asset('storage/' . $blogfeed->icon_path) }}" alt="{{ $blogfeed->author }}'s icon" class="w-8 h-8 rounded-full bg-gray-50 object-cover">
            @else
                <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 text-xs">NI</div>
            @endif
            <div>
                <p class="font-semibold text-gray-900">{{ $blogfeed->author }}</p>
                <p class="text-gray-600 text-xs">{{ $blogfeed->authortitle }}</p>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="flex flex-col sm:flex-row justify-end gap-2 mt-auto pt-4 border-t border-gray-100">
            {{-- Edit Button: Changed to a button that dispatches an Alpine.js event --}}
            <button type="button"
               @click="$dispatch('open-admin-blog-edit-modal', {{ json_encode($blogfeed) }})"
               class="px-4 py-2 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded-md transition-colors shadow-sm flex-grow sm:flex-none text-center">
                Edit
            </button>

            {{-- Delete Button --}}
            <form action="{{ route('blogs.destroy', $blogfeed->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this blog post?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 text-sm border border-gray-300 hover:bg-gray-100 text-gray-700 rounded-md transition-colors shadow-sm flex-grow sm:flex-none w-full">
                    Delete
                </button>
            </form>

            {{-- NEW: View Button to open modal --}}
            <button type="button" @click="$dispatch('open-admin-blog-show-modal', {{ json_encode($blogfeed) }})"
               class="px-4 py-2 text-sm border border-gray-300 hover:bg-gray-100 text-gray-700 rounded-md transition-colors shadow-sm flex-grow sm:flex-none text-center">
                View
            </button>
            
        </div>
    </div>
</div>
