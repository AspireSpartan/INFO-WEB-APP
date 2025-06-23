@props(['blogfeeds']) {{-- Make sure this prop is defined --}}

<div class="bg-white py-12 sm:py-16"
     x-data="{
         showBlogModal: false, // State for the show modal
         selectedBlog: null    // Holds the data for the blog post to display
     }"
     @open-user-blog-show-modal.window="showBlogModal = true; selectedBlog = $event.detail"> {{-- Listen for the event --}}

    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl lg:mx-0 text-center lg:text-left">
            <h2 class="text-5xl font-bold tracking-tight text-gray-900 sm:text-6xl mb-2">Our Blog Posts</h2>
            <p class="text-lg text-gray-600">Discover the latest articles, insights, and stories from our team.</p>

            {{-- Success/Error Messages (Optional, but good practice) --}}
            @if (session('success'))
                <div class="mt-4 p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mt-4 p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                    {{ session('error') }}
                </div>
            @endif
        </div>

        <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-4">
            @forelse($blogfeeds as $blogfeed)
                <article class="bg-white rounded-xl shadow-lg overflow-hidden flex flex-col justify-between transform transition-all duration-300 hover:scale-[1.02] hover:shadow-xl">
                    {{-- Image Section --}}
                    @if($blogfeed->image_path)
                        <img src="{{ asset('storage/' . $blogfeed->image_path) }}" alt="{{ $blogfeed->title }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center rounded-t-xl text-gray-500 text-sm">No Image Available</div>
                    @endif

                    <div class="p-6 flex flex-col flex-grow">
                        {{-- Date --}}
                        <div class="flex items-center gap-x-4 text-xs mb-2 text-gray-500">
                            <time datetime="{{ $blogfeed->published_at ? \Carbon\Carbon::parse($blogfeed->published_at)->toIso8601String() : '' }}">
                                {{ $blogfeed->published_at ? \Carbon\Carbon::parse($blogfeed->published_at)->format('F d, Y') : 'N/A Date' }}
                            </time>
                        </div>

                        {{-- Title --}}
                        <h2 class="text-xl font-semibold font-montserrat text-gray-800 mb-2 truncate leading-tight">
                            {{-- CHANGED: @click to open modal and assign current blogfeed --}}
                            <a href="#" @click.prevent="$dispatch('open-user-blog-show-modal', {{ json_encode($blogfeed) }})" class="hover:text-indigo-600 transition-colors">
                                {{ $blogfeed->title }}
                            </a>
                        </h2>

                        {{-- Content Description --}}
                        <p class="text-gray-600 text-sm mb-4 flex-grow overflow-hidden line-clamp-3 leading-snug">{{ $blogfeed->content }}</p>

                        {{-- Author and Icon --}}
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

                        {{-- Optional: "Read More" button to open modal --}}
                        <div class="mt-auto pt-4 border-t border-gray-100">
                             <button type="button" @click="$dispatch('open-user-blog-show-modal', {{ json_encode($blogfeed) }})"
                                class="w-full inline-block rounded-md bg-indigo-600 px-4 py-2 text-white font-semibold shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 text-center">
                                 Read More
                             </button>
                        </div>
                    </div>
                </article>
            @empty
                <p class="col-span-full text-center text-gray-500">No blog posts found.</p>
            @endforelse
        </div>
    </div>

    {{-- NEW: User-Side Blog Show Modal --}}
    <div class="fixed inset-0 bg-gray-600 bg-opacity-75 flex items-center justify-center z-50"
         x-show="showBlogModal"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         x-cloak {{-- Hide on page load before Alpine initializes --}}>

        <div class="bg-white rounded-lg shadow-xl p-8 max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto relative" {{-- Added relative for close button positioning --}}
             @click.away="showBlogModal = false; selectedBlog = null;"
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95">

            {{-- Close Button --}}
            <button type="button" @click="showBlogModal = false; selectedBlog = null;"
                    class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-3xl font-bold leading-none">&times;</button>

            <h2 class="text-3xl font-bold text-gray-800 mb-6 font-montserrat text-center" x-text="selectedBlog ? selectedBlog.title : 'Loading...'"></h2>

            <div x-show="selectedBlog" class="blog-details-content">
                <article>
                    <template x-if="selectedBlog.image_path">
                        <img :src="'/storage/' + selectedBlog.image_path" :alt="selectedBlog.title" class="mb-8 w-full h-80 sm:h-96 object-cover rounded-xl">
                    </template>
                    <template x-if="!selectedBlog.image_path">
                        <div class="mb-8 w-full h-80 sm:h-96 bg-gray-200 flex items-center justify-center rounded-xl text-gray-500 text-2xl">No Main Image Available</div>
                    </template>

                    <div class="flex items-center gap-x-4 text-sm text-gray-500 mb-4 justify-center">
                        <time x-text="selectedBlog ? (new Date(selectedBlog.published_at)).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' }) : ''"></time>
                    </div>

                    <div class="prose max-w-none text-gray-700 leading-relaxed mb-8">
                        <p x-html="selectedBlog ? selectedBlog.content.replace(/\n/g, '<br>') : ''"></p>
                    </div>

                    <div class="flex items-center gap-x-4 justify-center">
                        <template x-if="selectedBlog.icon_path">
                            <img :src="'/storage/' + selectedBlog.icon_path" :alt="selectedBlog.author + ' icon'" class="w-12 h-12 rounded-full bg-gray-50 object-cover">
                        </template>
                        <template x-if="!selectedBlog.icon_path">
                            <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 text-xs">NI</div>
                        </template>
                        <div>
                            <p class="font-semibold text-gray-900" x-text="selectedBlog ? selectedBlog.author : ''"></p>
                            <p class="text-gray-600 text-sm" x-text="selectedBlog ? selectedBlog.authortitle : ''"></p>
                        </div>
                    </div>
                </article>
            </div>

            <div class="flex justify-center mt-8">
                <button type="button" @click="showBlogModal = false; selectedBlog = null;" class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-6 rounded-lg text-lg">Close</button>
            </div>
        </div>
    </div>
</div>