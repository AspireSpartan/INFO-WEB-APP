<div
    x-show="activeSubModal === 'contactUs'"
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
        x-data="contactUsModal()" {{-- Call the function defined in the script block --}}
        @init-contact-us-modal.window="initData($event.detail)"
    >
        <div class="flex items-center justify-between p-6 pb-4 border-b border-gray-200">
            <h2 class="text-xl font-medium text-gray-900" x-text="`Edit ${contactUsTitle} Area`"></h2>
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

        <form @submit.prevent="saveContactChanges" class="flex-grow overflow-y-auto p-6">
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
                <label for="contactUsTitle" class="block text-gray-700 font-medium mb-2 text-sm">Section Title</label>
                <input
                    type="text"
                    id="contactUsTitle"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                    placeholder="e.g., Contact Us!"
                    x-model="contactUsTitle"
                    style="color: black;"
                />
            </div>

            <div class="mb-5">
                <label for="phoneNumber" class="block text-gray-700 font-medium mb-3 text-sm">Phone Number</label>
                <input
                    type="text"
                    id="phoneNumber"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                    placeholder="(+63) XXX XXX XXXX"
                    x-model="phoneNumber" {{-- Bind to single phoneNumber string --}}
                    style="color: black;"
                />
            </div>

            <div class="mb-5">
                <label for="emailAddress" class="block text-gray-700 font-medium mb-3 text-sm">Email Address</label>
                <input
                    type="email"
                    id="emailAddress"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                    placeholder="name@example.com"
                    x-model="emailAddress" {{-- Bind to single emailAddress string --}}
                    style="color: black;"
                />
            </div>

            <div class="mb-5">
                <label for="contactAddress" class="block text-gray-700 font-medium mb-2 text-sm">Physical Address (Optional)</label>
                <textarea
                    id="contactAddress"
                    rows="3"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 resize-y"
                    placeholder="Enter physical address here..."
                    x-model="contactAddress"
                    style="color: black;"
                ></textarea>
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
                @click="saveContactChanges()"
                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200"
            >
                Save Changes
            </button>
        </div>
    </div>
</div>

{{-- Alpine.js component logic --}}
<script>
    function contactUsModal() {
        return {
            contactUsTitle: '',
            phoneNumber: '', // Changed to single string
            emailAddress: '', // Changed to single string
            contactAddress: '',
            showNotification: false,
            notificationMessage: '',
            notificationType: '', // 'success' or 'error'

            initData(data) {
                this.contactUsTitle = String(data.contactUsTitle || 'CONTACT US!');
                this.phoneNumber = String(data.phoneNumbers || ''); // Expect single string
                this.emailAddress = String(data.emailAddresses || ''); // Expect single string
                this.contactAddress = String(data.contactAddress || '');
                this.showNotification = false; // Reset notification on init
            },

            saveContactChanges() {
                this.showNotification = false; // Hide previous notification

                const data = {
                    contactUsTitle: this.contactUsTitle,
                    phoneNumbers: this.phoneNumber, // Send single string
                    emailAddresses: this.emailAddress, // Send single string
                    contactAddress: this.contactAddress,
                };

                fetch('/admin/contact-us-api', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(data)
                })
                .then(response => {
                    if (!response.ok) {
                        // If response is not OK, parse error and throw
                        return response.json().then(err => { throw new Error(err.message || 'Failed to save changes', { cause: err.errors }); });
                    }
                    return response.json();
                })
                .then(result => {
                    console.log('Contact Us information updated:', result);
                    this.notificationType = 'success';
                    this.notificationMessage = result.message || 'Changes saved successfully!';
                    this.showNotification = true;

                    // Dispatch an event to update the footer display
                    this.$dispatch('contact-us-updated', {
                        contactUsTitle: this.contactUsTitle,
                        phoneNumbers: this.phoneNumber,
                        emailAddresses: this.emailAddress,
                        contactAddress: this.contactAddress
                    });

                    setTimeout(() => {
                        this.showNotification = false;
                        this.$dispatch('close-modal'); // Close modal after showing success
                    }, 2000); // Hide after 2 seconds and close modal
                })
                .catch(error => {
                    console.error('Error updating contact us information:', error);
                    this.notificationType = 'error';
                    // Check if the error has specific validation errors
                    if (error.cause && typeof error.cause === 'object') {
                        let errorHtml = '<ul>';
                        for (const key in error.cause) {
                            if (error.cause.hasOwnProperty(key)) {
                                error.cause[key].forEach(msg => {
                                    errorHtml += `<li>${msg}</li>`;
                                });
                            }
                        }
                        errorHtml += '</ul>';
                        this.notificationMessage = `Please fix the following issues: ${errorHtml}`;
                    } else {
                        this.notificationMessage = error.message || 'Failed to save changes. Please try again.';
                    }
                    this.showNotification = true;

                    setTimeout(() => {
                        this.showNotification = false;
                    }, 5000); // Hide error after 5 seconds
                });
            }
        }
    }
</script>
