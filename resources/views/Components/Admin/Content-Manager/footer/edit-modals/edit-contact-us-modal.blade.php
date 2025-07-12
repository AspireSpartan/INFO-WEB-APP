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
        x-data="{
            contactUsTitle: 'Contact Us!', // Added title for consistency
            phoneNumbers: [
                { id: 1, number: '(63+) 910 495 8419' }
            ],
            nextPhoneNumberId: 2,
            addPhoneNumber() {
                this.phoneNumbers.push({ id: this.nextPhoneNumberId++, number: '' });
            },
            removePhoneNumber(idToRemove) {
                this.phoneNumbers = this.phoneNumbers.filter(phone => phone.id !== idToRemove);
            },
            emailAddresses: [
                { id: 1, email: 'government@gmail.com' }
            ],
            nextEmailAddressId: 2,
            addEmailAddress() {
                this.emailAddresses.push({ id: this.nextEmailAddressId++, email: '' });
            },
            removeEmailAddress(idToRemove) {
                this.emailAddresses = this.emailAddresses.filter(email => email.id !== idToRemove);
            },
            contactAddress: 'Malacañang Complex, J.P. Laurel Sr. St., San Miguel, Manila, 1000 Metro Manila', // Added for potential future use or if there's a physical address
            saveContactChanges() {
                // Here you would typically send this.contactUsTitle, this.phoneNumbers,
                // this.emailAddresses, and this.contactAddress to your backend.
                console.log('Contact Us Title:', this.contactUsTitle);
                console.log('Phone Numbers:', this.phoneNumbers);
                console.log('Email Addresses:', this.emailAddresses);
                console.log('Contact Address:', this.contactAddress);
                $dispatch('close-modal');
            }
        }"
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
                <label class="block text-gray-700 font-medium mb-3 text-sm">Phone Numbers</label>

                <template x-for="phone in phoneNumbers" :key="phone.id">
                    <div class="flex items-end gap-2 mb-3 last:mb-0 transition-all duration-200 ease-out"
                         x-transition:enter="opacity-0 translate-y-2" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="opacity-0 -translate-y-2" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2"
                    >
                        <div class="flex-grow">
                            <label :for="`phoneNumber_${phone.id}`" class="sr-only">Phone Number</label>
                            <input
                                type="text"
                                :id="`phoneNumber_${phone.id}`"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                placeholder="(+63) XXX XXX XXXX"
                                x-model="phone.number"
                                style="color: black;"
                            />
                        </div>
                        <button
                            type="button"
                            @click="removePhoneNumber(phone.id)"
                            class="p-2 rounded-full text-gray-500 hover:bg-red-100 hover:text-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors duration-200 flex-shrink-0"
                            aria-label="Remove phone number"
                        >
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                </template>

                <button
                    type="button"
                    @click="addPhoneNumber()"
                    class="mt-4 w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg text-blue-600 hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200 text-sm font-medium"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Add Another Phone Number
                </button>
            </div>

            <div class="mb-5">
                <label class="block text-gray-700 font-medium mb-3 text-sm">Email Addresses</label>

                <template x-for="email in emailAddresses" :key="email.id">
                    <div class="flex items-end gap-2 mb-3 last:mb-0 transition-all duration-200 ease-out"
                         x-transition:enter="opacity-0 translate-y-2" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="opacity-0 -translate-y-2" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2"
                    >
                        <div class="flex-grow">
                            <label :for="`emailAddress_${email.id}`" class="sr-only">Email Address</label>
                            <input
                                type="email"
                                :id="`emailAddress_${email.id}`"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                placeholder="name@example.com"
                                x-model="email.email"
                                style="color: black;"
                            />
                        </div>
                        <button
                            type="button"
                            @click="removeEmailAddress(email.id)"
                            class="p-2 rounded-full text-gray-500 hover:bg-red-100 hover:text-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors duration-200 flex-shrink-0"
                            aria-label="Remove email address"
                        >
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                </template>

                <button
                    type="button"
                    @click="addEmailAddress()"
                    class="mt-4 w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg text-blue-600 hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200 text-sm font-medium"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Add Another Email Address
                </button>
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
