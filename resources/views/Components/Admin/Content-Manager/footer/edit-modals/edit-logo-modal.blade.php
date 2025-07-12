<div
    x-show="activeSubModal === 'logo'"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-100"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
    class="fixed inset-0 bg-black bg-opacity-40 flex justify-center items-center z-50 p-4"
    @click.self="$dispatch('close-modal')"
    x-data="logoModalComponent('{{ $footerLogo && $footerLogo->logo_path ? Illuminate\Support\Facades\Storage::url($footerLogo->logo_path) : asset('storage/CorDev_footer.svg') }}')"
     
>
    <div
        class="bg-white rounded-2xl shadow-2xl max-w-md w-full m-4 relative flex flex-col max-h-[90vh]"
        @keydown.escape.window="$dispatch('close-modal')"
        x-trap.noscroll
    >
        <div class="flex items-center justify-between p-6 pb-4 border-b border-gray-200">
            <h2 class="text-xl font-medium text-gray-900">Edit Logo Area</h2>
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

        <div class="flex-grow overflow-y-auto p-6">
            <div class="mb-5">
                <label class="block text-gray-700 font-medium mb-2 text-sm">Current/Preview Logo</label>
                <div class="w-full h-32 border border-gray-300 rounded-lg flex items-center justify-center overflow-hidden bg-gray-50 p-2 relative">
                    <img :src="previewLogoUrl" alt="Current Logo Preview" class="max-w-full max-h-full object-contain" />
                    <template x-if="!currentLogoUrl && !newLogoFile">
                        <span class="text-gray-400 text-sm absolute">No logo uploaded yet</span>
                    </template>
                </div>
                <p class="text-gray-500 text-xs mt-1">Recommended size: 150x50px for best display.</p>
            </div>

            <div class="mb-5">
                <label for="logoFileInput" class="block text-gray-700 font-medium mb-2 text-sm">Upload New Logo (Max 2MB)</label>
                <div class="relative">
                    <input
                        type="file"
                        id="logoFileInput"
                        accept="image/png, image/jpeg, image/svg+xml"
                        @change="handleFileUpload($event)"
                        class="absolute inset-0 opacity-0 cursor-pointer w-full h-full"
                        aria-describedby="logoHelpText"
                    />
                    <div class="flex items-center justify-between px-4 py-2 border border-gray-300 rounded-lg bg-white shadow-sm hover:border-blue-500 focus-within:ring-2 focus-within:ring-blue-500 transition-all duration-200 cursor-pointer">
                        <span class="text-gray-700" x-text="newLogoFile ? newLogoFile.name : 'Choose file...'"></span>
                        <span class="bg-gray-100 text-gray-700 text-sm px-3 py-1 rounded-md border border-gray-200 ml-3">Browse</span>
                    </div>
                </div>
                <p id="logoHelpText" class="text-gray-500 text-xs mt-1">Accepted formats: PNG, JPG, SVG.</p>
            </div>
        </div>

        <div class="px-6 py-4 border-t border-gray-200 flex justify-end gap-3">
            <button
                type="button"
                @click="$dispatch('close-modal')"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200"
            >
                Cancel
            </button>
            <button
                type="button"
                @click="saveLogoChanges()"
                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200"
            >
                Save Changes
            </button>
        </div>
    </div>
</div>

<script>
    function logoModalComponent(initialLogoUrl) {
        return {
            currentLogoUrl: initialLogoUrl,
            newLogoFile: null,
            previewLogoUrl: initialLogoUrl,

            handleFileUpload(event) {
                const file = event.target.files[0];
                if (file) {
                    this.newLogoFile = file;
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.previewLogoUrl = e.target.result;
                    };
                    reader.readAsDataURL(file);
                } else {
                    this.newLogoFile = null;
                    this.previewLogoUrl = this.currentLogoUrl;
                }
            },

            async saveLogoChanges() {
                if (!this.newLogoFile) {
                    alert('Please select a new logo file to upload.');
                    return;
                }

                const formData = new FormData();
                formData.append('logo', this.newLogoFile);

                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                try {
                    const response = await fetch("{{ route('footer.logo.update') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                        },
                        body: formData
                    });

                    if (response.ok) {
                        const result = await response.json();
                        window.dispatchEvent(new CustomEvent('logo-updated', { detail: { logo_path: result.logo_path } }));
                        this.$dispatch('close-modal');
                        alert('Logo updated successfully!');
                    } else {
                        const errorData = await response.json();
                        alert('Error uploading logo: ' + (errorData.message || 'Unknown error'));
                    }
                } catch (error) {
                    alert('A network error occurred. Please try again.');
                    console.error('Fetch error:', error);
                }
            }
        }
    }
</script>
