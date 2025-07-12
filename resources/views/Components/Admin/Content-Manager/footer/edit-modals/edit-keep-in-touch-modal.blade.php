    <div
        x-show="activeSubModal === 'keepInTouch'"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="fixed inset-0 bg-black bg-opacity-40 flex justify-center items-center z-50 p-4"
        @click.self="activeSubModal = ''"
        x-cloak
        x-data="keepInTouchComponent({
            title: '{{ $keepInTouch->title }}', 
            text_content: '{{ $keepInTouch->text_content }}',
            social_links: {{ Js::from($keepInTouch->socialLinks) }}
        })"
    >
        <div
            class="bg-white rounded-2xl shadow-2xl max-w-lg w-full m-4 relative flex flex-col max-h-[90vh]"
            @keydown.escape.window="activeSubModal = ''"
            x-trap.noscroll
        >
            <div class="flex items-center justify-between p-6 pb-4 border-b border-gray-200">
                <h2 class="text-xl font-medium text-gray-900" x-text="`Edit ${title} Area`"></h2>
                <button
                    @click="activeSubModal = ''"
                    class="text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 rounded-full p-1 transition-colors duration-200"
                    aria-label="Close"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- The form now submits via the saveChanges() method -->
            <form @submit.prevent="saveChanges" class="flex-grow overflow-y-auto p-6">
                <!-- Laravel CSRF token field -->
                @csrf

                <!-- Title Input -->
                <div class="mb-5">
                    <label for="keepInTouchTitle" class="block text-gray-700 font-medium mb-2 text-sm">Title</label>
                    <input
                        type="text"
                        id="keepInTouchTitle"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                        placeholder="e.g., Keep In Touch"
                        x-model="title"
                        style="color: black;"
                    />
                </div>

                <!-- Text Content Input -->
                <div class="mb-5">
                    <label for="keepInTouchText" class="block text-gray-700 font-medium mb-2 text-sm">Text Content</label>
                    <textarea
                        id="keepInTouchText"
                        rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 resize-y"
                        placeholder="Edit the Keep In Touch text here..."
                        x-model="textContent"
                        style="color: black;"
                    ></textarea>
                </div>

                <!-- Social Links Section -->
                <div class="mb-5">
                    <label class="block text-gray-700 font-medium mb-3 text-sm">Social Links</label>

                    <template x-for="link in socialLinks" :key="link.id">
                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 mb-3 last:mb-0 transition-all duration-200 ease-out">
                            <!-- Platform Input -->
                            <div class="w-full sm:w-auto sm:flex-1">
                                <label :for="`socialPlatform_${link.id}`" class="sr-only">Platform Name</label>
                                <input
                                    type="text"
                                    :id="`socialPlatform_${link.id}`"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                    placeholder="Platform (e.g., Facebook)"
                                    x-model="link.platform"
                                    style="color: black;"
                                />
                            </div>
                            <!-- URL Input -->
                            <div class="w-full sm:w-auto sm:flex-[2]">
                                <label :for="`socialUrl_${link.id}`" class="sr-only">Link URL</label>
                                <input
                                    type="url"
                                    :id="`socialUrl_${link.id}`"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                    placeholder="URL (e.g., https://facebook.com/yourpage)"
                                    x-model="link.url"
                                    style="color: black;"
                                />
                            </div>
                            <!-- Remove Button -->
                            <button
                                type="button"
                                @click="removeSocialLink(link.id)"
                                class="p-2 rounded-full text-gray-500 hover:bg-red-100 hover:text-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors duration-200 flex-shrink-0 self-end sm:self-center"
                                aria-label="Remove social link"
                            >
                               <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                               </svg>
                            </button>
                        </div>
                    </template>

                    <!-- Add New Link Button -->
                    <button
                        type="button"
                        @click="addSocialLink()"
                        class="mt-4 w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg text-blue-600 hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200 text-sm font-medium"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add Another Link
                    </button>
                </div>
            </form>

            <div class="px-6 py-4 border-t border-gray-200 flex justify-end gap-3">
                <button
                    type="button"
                    @click="activeSubModal = ''"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200"
                >
                    Cancel
                </button>
                <button
                    type="button"
                    @click="saveChanges()"
                    class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200"
                >
                    Save Changes
                </button>
            </div>
        </div>
    </div>

<script>
    function keepInTouchComponent(initialData) {
        return {
            // Initialize state from the data passed from Laravel
            title: initialData.title || '',
            textContent: initialData.text_content || '',
            // Create a deep copy to avoid modifying the original data directly
            socialLinks: JSON.parse(JSON.stringify(initialData.social_links || [])), 
            // Calculate the next ID to avoid collisions
            nextSocialId: initialData.social_links.length > 0
                ? Math.max(...initialData.social_links.map(l => l.id)) + 1 
                : 1,

            addSocialLink() {
                this.socialLinks.push({ id: this.nextSocialId++, platform: '', url: '' });
            },

            removeSocialLink(id) {
                this.socialLinks = this.socialLinks.filter(link => link.id !== id);
            },

            async saveChanges() {
                // Get the CSRF token from the meta tag
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                // Prepare the payload in the format expected by the Laravel controller
                const payload = {
                    title: this.title,
                    text_content: this.textContent,
                    // Ensure the social_links array doesn't contain the 'id' field
                    social_links: this.socialLinks.map(({ platform, url }) => ({ platform, url }))
                };

                try {
                    const response = await fetch("{{ route('keep-in-touch.update') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json' // Important for receiving JSON error responses
                        },
                        body: JSON.stringify(payload)
                    });

                    if (response.ok) {
                        const updatedData = await response.json();
                        
                        // Dispatch a custom event with the updated data
                        window.dispatchEvent(new CustomEvent('keep-in-touch-updated', {
                            detail: {
                                title: updatedData.keepInTouch.title,
                                text_content: updatedData.keepInTouch.text_content,
                                social_links: updatedData.keepInTouch.social_links
                            }
                        }));
                        
                        alert(updatedData.message);

                        // Close the modal
                        this.activeSubModal = '';

                    } else {
                        // Handle validation errors or other server issues
                        const errorData = await response.json();
                        let errorMessage = 'An error occurred. Please check the console.';
                        if (errorData.errors) {
                            // Format validation errors from Laravel
                            errorMessage = Object.values(errorData.errors).map(e => e.join('\n')).join('\n');
                        }
                        alert(errorMessage);
                        console.error('Save failed:', errorData);
                    }
                } catch (error) {
                    alert('A network error occurred. Please try again.');
                    console.error('Fetch error:', error);
                }
            }
        }
    }
</script>
