{{-- resources/views/Components/Admin/blog/show.blade.php --}}

{{-- This component assumes it's included within a parent x-data scope that defines
     'showAdminBlogShowModal' (boolean) and 'selectedBlog' (object). --}}

<div class="fixed inset-0 bg-gray-600 bg-opacity-75 flex items-center justify-center z-50"
     x-show="showAdminBlogShowModal"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     x-cloak> {{-- x-cloak hides the element until Alpine is initialized --}}

    <div class="bg-white rounded-lg shadow-xl p-8 max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto relative"
         @click.away="showAdminBlogShowModal = false; selectedBlog = null;" {{-- Close modal if click outside --}}
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95">

        {{-- Close Button --}}
        <button type="button" @click="showAdminBlogShowModal = false; selectedBlog = null;"
                class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-3xl font-bold leading-none">&times;</button>

        {{-- Blog Title (dynamically rendered) --}}
        <h2 class="text-3xl font-bold text-gray-800 mb-6 font-montserrat text-center" x-text="selectedBlog ? selectedBlog.title : 'Loading...'"></h2>

        {{-- Main Blog Content Section --}}
        <div x-show="selectedBlog" class="blog-details-content">
            <article>
                {{-- Blog Main Image --}}
                <template x-if="selectedBlog.image_path">
                    <img :src="'/storage/' + selectedBlog.image_path" :alt="selectedBlog.title" class="mb-8 w-full h-80 sm:h-96 object-cover rounded-xl">
                </template>
                <template x-if="!selectedBlog.image_path">
                    <div class="mb-8 w-full h-80 sm:h-96 bg-gray-200 flex items-center justify-center rounded-xl text-gray-500 text-2xl">No Main Image Available</div>
                </template>

                {{-- Published Date --}}
                <div class="flex items-center gap-x-4 text-sm text-gray-500 mb-4 justify-center">
                    <time x-text="selectedBlog ? (new Date(selectedBlog.published_at)).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' }) : ''"></time>
                </div>

                {{-- Blog Content/Body --}}
                <div class="prose max-w-none text-gray-700 leading-relaxed mb-8">
                    {{-- Using x-html to render content, assuming it might contain line breaks that should be HTML. --}}
                    <p x-html="selectedBlog ? selectedBlog.content.replace(/\n/g, '<br>') : ''"></p>
                </div>

                {{-- Author Information with Icon --}}
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

                {{-- Admin-Specific Action Buttons (Edit and Delete) --}}
                <div class="mt-8 flex gap-3 justify-center">
                    <a :href="'{{ route('blogs.edit', '') }}/' + selectedBlog.id"
                       class="inline-block rounded-md bg-indigo-600 px-4 py-2 text-white font-semibold shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Edit Blog Post
                    </a>
                    <form :action="'{{ route('blogs.destroy', '') }}/' + selectedBlog.id" method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this blog post? This action cannot be undone.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-block rounded-md bg-red-600 px-4 py-2 text-white font-semibold shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                            Delete Blog Post
                        </button>
                    </form>
                </div>
            </article>
        </div>

        {{-- General Close Button --}}
        <div class="flex justify-center mt-6">
            <button type="button" @click="showAdminBlogShowModal = false; selectedBlog = null;" class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-6 rounded-lg text-lg">Close</button>
        </div>
    </div>
</div>