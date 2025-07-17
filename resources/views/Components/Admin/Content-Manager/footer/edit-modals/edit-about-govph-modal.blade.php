@props(['aboutGovph', 'govphLinks'])

<div
    x-show="activeSubModal === 'aboutGovph'"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-100"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
    class="fixed inset-0 bg-black bg-opacity-40 flex justify-center items-center z-50 p-4"
    @click.self="$dispatch('close-modal')"
    x-data="aboutGovphComponent({
        aboutGovph: {{ Js::from($aboutGovph) }},
        govphLinks: {{ Js::from($govphLinks) }}
    })"
    x-cloak
>
    <div
        class="bg-white rounded-2xl shadow-2xl max-w-lg w-full m-4 relative flex flex-col max-h-[90vh]"
        @keydown.escape.window="$dispatch('close-modal')"
        x-trap.noscroll
    >
        <div class="flex items-center justify-between p-6 pb-4 border-b border-gray-200">
            <h2 class="text-xl font-medium text-gray-900" x-text="`Edit ${title} Area`"></h2>
            <button
                @click="$dispatch('close-modal')"
                class="text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 rounded-full p-1 transition-colors duration-200"
                aria-label="Close"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form @submit.prevent="saveChanges" class="flex-grow overflow-y-auto p-6">
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

            <div class="mb-5">
                <label for="aboutGovphTitle" class="block text-gray-700 font-medium mb-2 text-sm">Section Title</label>
                <input
                    type="text"
                    id="aboutGovphTitle"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                    placeholder="e.g., About GOVPH"
                    x-model="title"
                    style="color: black;"
                />
            </div>

            <div class="mb-5">
                <label for="aboutGovphDescription" class="block text-gray-700 font-medium mb-2 text-sm">Description</label>
                <textarea
                    id="aboutGovphDescription"
                    rows="5"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 resize-y"
                    placeholder="Edit the About GOVPH description here..."
                    x-model="description"
                    style="color: black;"
                ></textarea>
            </div>

            <div class="mb-5">
                <label class="block text-gray-700 font-medium mb-3 text-sm">GOVPH Links</label>

                <template x-for="link in links" :key="link.id">
                    <div class="flex flex-col sm:flex-row items-end gap-2 mb-3 last:mb-0">
                        <div class="flex-1 w-full">
                            <label :for="`govphLinkTitle_${link.id}`" class="sr-only">Link Title</label>
                            <input
                                type="text"
                                :id="`govphLinkTitle_${link.id}`"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Link Title"
                                x-model="link.title"
                                style="color: black;"
                            />
                        </div>
                        <div class="flex-1 w-full">
                            <label :for="`govphLinkUrl_${link.id}`" class="sr-only">Link URL</label>
                            <input
                                type="url"
                                :id="`govphLinkUrl_${link.id}`"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Link URL"
                                x-model="link.url"
                                style="color: black;"
                            />
                        </div>
                        <button
                            type="button"
                            @click="removeLink(link.id)"
                            class="p-2 rounded-full text-gray-500 hover:bg-red-100 hover:text-red-600 focus:outline-none focus:ring-2 focus:ring-red-500"
                            aria-label="Remove link"
                        >
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                </template>

                <button
                    type="button"
                    @click="addLink()"
                    class="mt-4 w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg text-blue-600 hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500"
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
                @click="$dispatch('close-modal')"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                Cancel
            </button>
            <button
                type="button"
                @click="saveChanges()"
                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                Save Changes
            </button>
        </div>
    </div>
</div>

<script>
    function aboutGovphComponent(data) {
        return {
            title: data.aboutGovph.title || '',
            description: data.aboutGovph.description || '',
            links: JSON.parse(JSON.stringify(data.govphLinks || [])),
            nextLinkId: data.govphLinks.length > 0 ? Math.max(...data.govphLinks.map(l => l.id)) + 1 : 1,
            showNotification: false, // Added for notification
            notificationMessage: '', // Added for notification
            notificationType: '', // Added for notification ('success' or 'error')

            addLink() {
                this.links.push({ id: this.nextLinkId++, title: '', url: '' });
            },

            removeLink(id) {
                this.links = this.links.filter(link => link.id !== id);
            },

            async saveChanges() {
                this.showNotification = false; // Hide previous notification

                const payload = {
                    title: this.title,
                    description: this.description,
                    links: this.links.map(({ title, url }) => ({ title, url })),
                };

                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                try {
                    const response = await fetch("{{ route('about-govph.update') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify(payload)
                    });

                    if (response.ok) {
                        const result = await response.json();
                        window.dispatchEvent(new CustomEvent('about-govph-updated', { detail: { aboutGovph: result.aboutGovph, links: result.links } }));

                        this.notificationType = 'success';
                        this.notificationMessage = result.message || 'Changes saved successfully!';
                        this.showNotification = true;

                        setTimeout(() => {
                            this.showNotification = false;
                            this.$dispatch('close-modal'); // Close modal after showing success
                        }, 2000); // Hide after 2 seconds and close modal

                    } else {
                        const errorData = await response.json();
                        this.notificationType = 'error';
                        let errorMessage = 'An error occurred. Please check the console.';

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
                        }, 5000); // Hide error after 5 seconds
                    }
                } catch (error) {
                    console.error('Network error:', error);
                    this.notificationType = 'error';
                    this.notificationMessage = 'A network error occurred. Please try again.';
                    this.showNotification = true;

                    setTimeout(() => {
                        this.showNotification = false;
                    }, 5000); // Hide error after 5 seconds
                }
            }
        }
    }
</script>
