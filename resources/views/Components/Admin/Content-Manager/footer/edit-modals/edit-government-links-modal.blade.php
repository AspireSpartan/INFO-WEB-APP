<div
    x-show="activeSubModal === 'governmentLinks'"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-100"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
    class="fixed inset-0 bg-black bg-opacity-40 flex justify-center items-center z-50 p-4"
    @click.self="$dispatch('close-modal')"
>
    <div
        class="bg-white rounded-2xl shadow-2xl max-w-lg w-full m-4 relative flex flex-col max-h-[90vh]"
        @keydown.escape.window="$dispatch('close-modal')"
        x-trap.noscroll
        x-data="{
            governmentLinksTitle: 'Government Links', // Editable title for the section
            govLinks: [
                //{ id: 1, title: 'Office of the President', url: 'https://op.gov.ph/' },
                //{ id: 2, title: 'Office of the Vice-President', url: 'https://ovp.gov.ph/' },
                //{ id: 3, title: 'Senate of the Philippines', url: 'https://senate.gov.ph/' },
                //{ id: 4, title: 'House of Representatives', url: 'https://congress.gov.ph/' },
                //{ id: 5, title: 'Supreme Court', url: 'https://sc.judiciary.gov.ph/' },
                //{ id: 6, title: 'Court of Appeals', url: 'https://ca.judiciary.gov.ph/' },
                //{ id: 7, title: 'Sandiganbayan', url: 'https://sb.judiciary.gov.ph/' }
            ],
            nextGovLinkId: 8, // For unique keys for new links
            addGovLink() {
                this.govLinks.push({ id: this.nextGovLinkId++, title: '', url: '' });
            },
            removeGovLink(idToRemove) {
                this.govLinks = this.govLinks.filter(link => link.id !== idToRemove);
            },
            saveGovernmentLinksChanges() {
                // Here you would typically send this.governmentLinksTitle and this.govLinks
                // to your backend or update your global state.
                console.log('Government Links Title:', this.governmentLinksTitle);
                console.log('Government Links:', this.govLinks);
                $dispatch('close-modal');
            }
        }"
    >
        <div class="flex items-center justify-between p-6 pb-4 border-b border-gray-200">
            <h2 class="text-xl font-medium text-gray-900" x-text="`Edit ${governmentLinksTitle} Area`"></h2>
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

        <form @submit.prevent="saveGovernmentLinksChanges" class="flex-grow overflow-y-auto p-6">
            <div class="mb-5">
                <label for="governmentLinksTitle" class="block text-gray-700 font-medium mb-2 text-sm">Section Title</label>
                <input
                    type="text"
                    id="governmentLinksTitle"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                    placeholder="e.g., Government Links"
                    x-model="governmentLinksTitle"
                    style="color: black;"
                />
            </div>

            <div class="mb-5">
                <label class="block text-gray-700 font-medium mb-3 text-sm">Links</label>

                <template x-for="link in govLinks" :key="link.id">
                    <div class="flex flex-col sm:flex-row items-end gap-2 mb-3 last:mb-0 transition-all duration-200 ease-out"
                         x-transition:enter="opacity-0 translate-y-2" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="opacity-0 -translate-y-2" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2"
                    >
                        <div class="flex-1 w-full">
                            <label :for="`govLinkTitle_${link.id}`" class="sr-only">Link Title</label>
                            <input
                                type="text"
                                :id="`govLinkTitle_${link.id}`"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                placeholder="Link Title (e.g., Supreme Court)"
                                x-model="link.title"
                                style="color: black;"
                            />
                        </div>
                        <div class="flex-1 w-full">
                            <label :for="`govLinkUrl_${link.id}`" class="sr-only">Link URL</label>
                            <input
                                type="url"
                                :id="`govLinkUrl_${link.id}`"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                placeholder="Link URL (e.g., https://sc.judiciary.gov.ph/)"
                                x-model="link.url"
                                style="color: black;"
                            />
                        </div>
                        <button
                            type="button"
                            @click="removeGovLink(link.id)"
                            class="p-2 rounded-full text-gray-500 hover:bg-red-100 hover:text-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors duration-200 flex-shrink-0"
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
                    @click="addGovLink()"
                    class="mt-4 w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg text-blue-600 hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200 text-sm font-medium"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Add Another Government Link
                </button>
            </div>
        </form>

        <div class="px-6 py-4 border-t border-gray-200 flex justify-end gap-3">
            <button
                type="button"
                @click="$dispatch('close-modal')"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200"
            >
                Cancel
            </button>
            <button
                type="submit"
                @click="saveGovernmentLinksChanges()"
                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200"
            >
                Save Changes
            </button>
        </div>
    </div>
</div>
