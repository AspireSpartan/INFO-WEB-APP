{{-- resources/views/Components/Admin/blog/edit.blade.php --}}
@props(['blogfeed'])

<div
    x-show="showEditModal" {{-- This x-show is controlled by the parent blog_content.blade.php --}}
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-100"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
    class="fixed inset-0 bg-black bg-opacity-40 flex justify-center items-center z-50 p-4"
    @click.self="$dispatch('close-admin-blog-edit-modal')" {{-- Close modal when clicking outside --}}
    x-cloak {{-- Hide until Alpine is initialized --}}
    x-data="blogEditModalComponent()" {{-- Initialize with no data, will be populated by event --}}
    @keydown.escape.window="$dispatch('close-admin-blog-edit-modal')" {{-- Close on Escape key --}}
    @open-admin-blog-edit-modal.window="initModal($event.detail)" {{-- Listen for event to populate data --}}
    x-trap.noscroll {{-- Prevent scrolling on body when modal is open --}}
>
    <div
        class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full m-4 relative flex flex-col max-h-[90vh]"
    >
        <div class="flex items-center justify-between p-6 pb-4 border-b border-gray-200">
            <h2 class="text-xl font-medium text-gray-900">Edit Blog Post</h2>
            <button
                @click="$dispatch('close-admin-blog-edit-modal')"
                class="text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 rounded-full p-1 transition-colors duration-200"
                aria-label="Close"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form @submit.prevent="updateBlogPost" enctype="multipart/form-data" class="flex-grow overflow-y-auto p-6">
            @csrf
            @method('PUT') {{-- Essential for update method --}}

            {{-- Notification Pop-up --}}
            <div
                x-show="showNotification"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-2"
                :class="{
                    'bg-green-100 border-green-400 text-green-700': notificationType === 'success',
                    'bg-red-100 border-red-400 text-red-700': notificationType === 'error'
                }"
                class="border px-4 py-3 rounded relative mb-4"
                role="alert"
                style="display: none;"
            >
                <strong class="font-bold" x-text="notificationType === 'success' ? 'Success!' : 'Error!'"></strong>
                <span class="block sm:inline" x-html="notificationMessage"></span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3" @click="showNotification = false">
                    <svg class="fill-current h-6 w-6" :class="{ 'text-green-500': notificationType === 'success', 'text-red-500': notificationType === 'error' }" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 2.65a1.2 1.2 0 1 1-1.697-1.697L8.303 10l-2.651-2.651a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-2.651a1.2 1.2 0 1 1 1.697 1.697L11.697 10l2.651 2.651a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
            </div>

            <div class="mb-4">
                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                <input type="text" name="title" id="title" x-model="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label for="content" class="block text-gray-700 text-sm font-bold mb-2">Content:</label>
                <textarea name="content" id="content" rows="10" x-model="content" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
            </div>

            <div class="mb-4">
                <label for="author" class="block text-gray-700 text-sm font-bold mb-2">Author:</label>
                <input type="text" name="author" id="author" x-model="author" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label for="authortitle" class="block text-gray-700 text-sm font-bold mb-2">Author Title:</label>
                <input type="text" name="authortitle" id="authortitle" x-model="authortitle" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="published_at" class="block text-gray-700 text-sm font-bold mb-2">Published Date:</label>
                <input type="date" name="published_at" id="published_at" x-model="published_at" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Main Image (Current):</label>
                <template x-if="currentImagePath">
                    <img :src="currentImagePath" alt="Current Blog Image" class="mb-2 max-w-xs h-auto">
                </template>
                <template x-if="!currentImagePath">
                    <p>No current main image.</p>
                </template>
                <label for="image" class="block text-gray-700 text-sm font-bold mb-2 mt-2">Upload New Main Image (Optional):</label>
                <input type="file" name="image" id="image" @change="handleImageUpload" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <p class="text-xs text-gray-500 mt-1">Max file size: 8MB. Allowed formats: jpeg, png, jpg, gif, svg.</p>
            </div>

            <div class="mb-4">
                <label for="icon" class="block text-gray-700 text-sm font-bold mb-2">Author Icon (Current):</label>
                <template x-if="currentIconPath">
                    <img :src="currentIconPath" alt="Current Icon" class="mb-2 w-16 h-16 rounded-full object-cover">
                </template>
                <template x-if="!currentIconPath">
                    <p>No current icon.</p>
                </template>
                <label for="icon" class="block text-gray-700 text-sm font-bold mb-2 mt-2">Upload New Icon (Optional):</label>
                <input type="file" name="icon" id="icon" @change="handleIconUpload" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <p class="text-xs text-gray-500 mt-1">Max file size: 999KB. Allowed formats: jpeg, png, jpg, gif, svg.</p>
            </div>

            <div class="flex items-center justify-end gap-3 mt-6">
                <button type="button" @click="$dispatch('close-admin-blog-edit-modal')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200">
                    Update Blog Post
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function blogEditModalComponent() { // No initial data passed here
        return {
            blogId: null, // Initialize as null
            title: '',
            content: '',
            author: '',
            authortitle: '',
            published_at: '',
            currentImagePath: null,
            currentIconPath: null,
            newImageFile: null,
            newIconFile: null,
            showNotification: false,
            notificationMessage: '',
            notificationType: '',

            initModal(blogfeed) {
                // This function is called when the 'open-admin-blog-edit-modal' event is dispatched
                this.blogId = blogfeed.id;
                this.title = blogfeed.title;
                this.content = blogfeed.content;
                this.author = blogfeed.author;
                this.authortitle = blogfeed.authortitle;
                this.published_at = blogfeed.published_at ? new Date(blogfeed.published_at).toISOString().split('T')[0] : '';
                this.currentImagePath = blogfeed.image_path ? '{{ asset('storage') }}/' + blogfeed.image_path : null;
                this.currentIconPath = blogfeed.icon_path ? '{{ asset('storage') }}/' + blogfeed.icon_path : null;
                this.newImageFile = null; // Reset file inputs
                this.newIconFile = null; // Reset file inputs
                this.showNotification = false; // Hide any previous notifications
            },

            handleImageUpload(event) {
                const file = event.target.files[0];
                if (file) {
                    this.newImageFile = file;
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.currentImagePath = e.target.result; // Update preview
                    };
                    reader.readAsDataURL(file);
                } else {
                    this.newImageFile = null;
                    // When clearing input, revert to original image if available
                    this.currentImagePath = this.blogId ? '{{ asset('storage') }}/' + this.blogfeed.image_path : null;
                }
            },

            handleIconUpload(event) {
                const file = event.target.files[0];
                if (file) {
                    this.newIconFile = file;
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.currentIconPath = e.target.result; // Update preview
                    };
                    reader.readAsDataURL(file);
                } else {
                    this.newIconFile = null;
                    // When clearing input, revert to original icon if available
                    this.currentIconPath = this.blogId ? '{{ asset('storage') }}/' + this.blogfeed.icon_path : null;
                }
            },

            async updateBlogPost() {
                this.showNotification = false; // Hide previous notification
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                const formData = new FormData();
                formData.append('_method', 'PUT'); // Laravel requires this for PUT requests
                formData.append('title', this.title);
                formData.append('content', this.content);
                formData.append('author', this.author);
                formData.append('authortitle', this.authortitle || ''); // Handle nullable
                formData.append('published_at', this.published_at);
                if (this.newImageFile) {
                    formData.append('image', this.newImageFile);
                }
                if (this.newIconFile) {
                    formData.append('icon', this.newIconFile);
                }

                try {
                    // Ensure blogId is valid before making the fetch request
                    if (!this.blogId) {
                        this.notificationType = 'error';
                        this.notificationMessage = 'Error: Blog ID is missing. Cannot update.';
                        this.showNotification = true;
                        setTimeout(() => { this.showNotification = false; }, 5000);
                        return;
                    }

                    const response = await fetch(`/admin/blogs/${this.blogId}`, { // Use dynamic route
                        method: 'POST', // Fetch API uses POST for FormData with _method PUT
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                        },
                        body: formData
                    });

                    if (response.ok) {
                        const result = await response.json();
                        this.notificationType = 'success';
                        this.notificationMessage = result.message || 'Blog post updated successfully!';
                        this.showNotification = true;

                        // Dispatch event to parent to update list or refresh
                        window.dispatchEvent(new CustomEvent('blog-post-updated', { detail: result }));

                        setTimeout(() => {
                            this.showNotification = false;
                            this.$dispatch('close-admin-blog-edit-modal'); // Close modal after success
                        }, 2000);

                    } else {
                        const errorData = await response.json();
                        this.notificationType = 'error';
                        let errorMessage = errorData.message || 'An error occurred. Please check the console.';

                        if (errorData.errors) {
                            let errorHtml = '<ul>';
                            for (const key in errorData.errors) {
                                if (errorData.errors.hasOwnProperty(key)) {
                                    errorData.errors[key].forEach(msg => {
                                        errorHtml += `<li>${msg}</li>`;
                                    });
                                }
                            }
                            errorHtml += '</ul>';
                            errorMessage = `Please fix the following issues: ${errorHtml}`;
                        }
                        this.notificationMessage = errorMessage;
                        this.showNotification = true;

                        setTimeout(() => {
                            this.showNotification = false;
                        }, 5000);
                    }
                } catch (error) {
                    console.error('Fetch error:', error);
                    this.notificationType = 'error';
                    this.notificationMessage = 'A network error occurred. Please try again.';
                    this.showNotification = true;

                    setTimeout(() => {
                        this.showNotification = false;
                    }, 5000);
                }
            }
        }
    }
</script>
