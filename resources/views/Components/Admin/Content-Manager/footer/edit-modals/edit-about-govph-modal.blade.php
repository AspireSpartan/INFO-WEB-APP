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

            addLink() {
                this.links.push({ id: this.nextLinkId++, title: '', url: '' });
            },

            removeLink(id) {
                this.links = this.links.filter(link => link.id !== id);
            },

            async saveChanges() {
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
                        alert(result.message);
                        this.$dispatch('close-modal');
                    } else {
                        const errorData = await response.json();
                        let errorMessage = 'An error occurred. Please check the console.';
                        if (errorData.errors) {
                            errorMessage = Object.values(errorData.errors).map(e => e.join('\\n')).join('\\n');
                        }
                        alert(errorMessage);
                    }
                } catch (error) {
                    alert('A network error occurred. Please try again.');
                }
            }
        }
    }
</script>
