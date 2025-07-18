{{-- resources/views/Components/Admin/blog/blog_content.blade.php --}}
@props(['blogfeeds'])

{{-- Add x-data for modal state. Re-open modal if there are errors or a session flag. --}}
<div class="bg-neutral-100 rounded-xl shadow-inner p-4 md:p-6 lg:p-8 mt-4 mx-4 md:mx-8 lg:mx-12 overflow-y-auto"
     x-data="{
        showCreateModal: {{ $errors->any() || session('showCreateBlogModal') ? 'true' : 'false' }},
        showEditModal: false, // New state for edit modal
        editingBlog: {}, // New property to hold the blog data for editing
        imageUrl: null,
        iconUrl: null
     }"
     @open-admin-blog-edit-modal.window="editingBlog = $event.detail; showEditModal = true;"
     @close-admin-blog-edit-modal.window="showEditModal = false;"
     @blog-post-updated.window="() => {
        // Optionally, re-fetch blogfeeds or update the specific card in the list
        // For simplicity, you might just close the modal and rely on a page refresh
        // or a more sophisticated Alpine.js data update.
        // For now, we'll just close the modal and let the user see the change on next load/refresh.
        showEditModal = false;
        // You might want to dispatch a success message here or handle it in the modal itself
        // alert('Blog post updated successfully!'); // Use a custom notification system instead of alert
        window.location.reload(); // Simple reload to reflect changes
     }"
>
    <main class="p-4 md:p-8 lg:p-12 bg-white rounded-lg shadow-sm">
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 mt-4 md:ml-8 gap-4">
            <h1 class="text-[#D4AF37] text-3xl font-semibold font-montserrat w-full md:w-auto">Manage Blog Posts</h1>
            {{-- CHANGED: Button now triggers the modal --}}
            <button type="button" class="flex items-center justify-center gap-2 px-6 py-2 bg-[#D4AF37] hover:bg-amber-500 text-white text-lg font-normal rounded-lg transition-colors shadow-md w-full md:w-auto"
                    @click="showCreateModal = true; imageUrl = null; iconUrl = null;"> {{-- Reset image/icon preview on open --}}
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add New Blog Post
            </button>
        </div>

        {{-- Search Bar (keep as is, for future implementation) --}}
        <div class="flex flex-col md:flex-row justify-between items-center bg-transparent gap-4 mb-8">
            <div class="relative w-full md:w-auto flex-grow max-w-xl">
                <input type="text" placeholder="Search blog posts"
                       class="w-full pl-12 pr-4 py-2 border border-[#D4AF37] rounded-[30px] bg-white focus:outline-none focus:ring-1 focus:ring-amber-500 text-gray-700 placeholder-zinc-400 font-montserrat">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-[#D4AF37]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                </svg>
            </div>
        </div>

        {{-- Success/Error Messages for LISTING (can be from creation or update/delete) --}}
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

        {{-- Grid to display blog cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($blogfeeds as $blogfeed)
                <x-Admin.blog.blog_cards :blogfeed="$blogfeed"></x-Admin.blog.blog_cards >
            @empty
                <p class="col-span-full text-center text-gray-500">No blog posts found.</p>
            @endforelse
        </div>
    </main>

    {{-- INCLUDE THE CREATE MODAL HERE --}}
    @include('Components.Admin.blog.create')

    {{-- INCLUDE THE EDIT MODAL HERE (the content of edit.blade.php) --}}
    <x-Admin.blog.edit x-show="showEditModal" :blogfeed="$blogfeed" @close-admin-blog-edit-modal.window="showEditModal = false;" style="display: none;"/>
    
</div>
