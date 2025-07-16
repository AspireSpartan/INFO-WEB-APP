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
            showNotification: false, // Added for notification
            notificationMessage: '', // Added for notification
            notificationType: '', // Added for notification ('success' or 'error')

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
                this.showNotification = false; // Hide previous notification

                if (!this.newLogoFile) {
                    this.notificationType = 'error';
                    this.notificationMessage = 'Please select a new logo file to upload.';
                    this.showNotification = true;
                    setTimeout(() => { this.showNotification = false; }, 3000);
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
                        
                        this.notificationType = 'success';
                        this.notificationMessage = 'Logo updated successfully!';
                        this.showNotification = true;

                        setTimeout(() => {
                            this.showNotification = false;
                            this.$dispatch('close-modal'); // Close modal after showing success
                        }, 2000); // Hide after 2 seconds and close modal

                    } else {
                        const errorData = await response.json();
                        this.notificationType = 'error';
                        let errorMessage = errorData.message || 'Error uploading logo: Unknown error';
                        
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
                    console.error('Fetch error:', error);
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
