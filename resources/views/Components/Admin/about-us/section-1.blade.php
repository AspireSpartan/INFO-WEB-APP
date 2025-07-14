@php
    // $contentManager and $contentOffer are passed from the controller
@endphp

<style>
    /* Custom font families (if not directly supported by Tailwind's default font stack) */
    .font-['Verdana'] { font-family: Verdana, sans-serif; }
    .font-['Caveat'] { font-family: 'Caveat', cursive; }
    .font-roboto { font-family: 'Roboto', sans-serif; }
    .font-montserrat { font-family: 'Montserrat', sans-serif; }

    /* General body font */
    body {
        font-family: 'Inter', sans-serif; /* Default font as per instructions */
    }

    /* Styles for editable content */
    [contenteditable="true"]:focus {
        outline: 2px solid #F18018; /* Orange border on focus */
        outline-offset: 2px;
        background-color: #fffbeb; /* Light orange background */
        border-radius: 4px;
    }

    /* NEW: Text color for editable elements when focused in the hero section */
    .hero-editable-text[contenteditable="true"]:focus {
        color: #333; /* Darker text color when focused */
    }

    .edit-mode-border {
        border: 1px dashed #F18018;
        padding: 4px;
        margin: -4px;
    }

    /* Modal specific styles */
    .modal-overlay {
        background-color: rgba(75, 75, 75, 0.5);
    }
    .modal-content {
        background-color: white;
    }
</style>
<div class="min-h-screen w-full relative overflow-hidden"
    x-data="{
        loaded: false,
        isEditing: false,
        // Initialize reactive properties directly with PHP values
        heroTitle: @js($contentManager['heroTitle'] ?? ''),
        heroSubtitle: @js($contentManager['heroSubtitle'] ?? ''),
        heroImage: @js($contentManager['heroImage'] ?? ''),
        introTitlePart1: @js($contentManager['introTitlePart1'] ?? ''),
        introTitlePart2: @js($contentManager['introTitlePart2'] ?? ''),
        introParagraph1: @js($contentManager['introParagraph1'] ?? ''),
        introParagraph2: @js($contentManager['introParagraph2'] ?? ''),
        // Ensure offers is always an array for Alpine.js iteration
        // Deep copy the offers to avoid direct mutation of initial PHP data if it's referenced
        offers: JSON.parse(JSON.stringify(@js($contentOffer ?? []))),

        // Store IDs of offers marked for deletion
        offersToDelete: [],

        // Modal states
        showImageModal: false,
        currentImageTarget: null, // 'hero' or 'offer-[index]' or 'offer-new-[temp_id]'
        tempImageUrl: '', // Used for previewing image in modal, will hold URL or Base64

        // Notification states
        notification: {
            show: false,
            message: '',
            type: '', // 'loading', 'success', 'error'
            timeoutId: null
        },

        // API URLs for updating content and offers
        updateContentUrl: '{{ route('admin.about-us.updateContent') }}',
        storeOfferUrl: '{{ route('admin.about-us.storeOffer') }}',
        deleteOfferBaseUrl: '{{ url('/admin/about-us/delete-offer') }}', // Base URL for deletion without ID

        // Function to update content from editable fields (local state only)
        updateContent(newValue, field) {
            this[field] = newValue;
        },

        // Function to add a new offer tile
        addOffer() {
            // Assign a temporary unique ID for new offers in Alpine.js
            const tempId = Date.now();
            this.offers.push({
                id: null, // This will be the actual DB ID
                temp_id: tempId, // Temporary ID for Alpine's internal tracking
                title: 'New Offer Title',
                description: 'Description for the new offer.',
                // Default icon for new offers should be empty to force upload, or a default placeholder image URL if desired
                icon: ''
            });
        },

        // Function to delete an offer tile (local state only, actual deletion happens on save)
        deleteOffer(offerId, tempId) {
            if (confirm('Are you sure you want to delete this offer?')) {
                // If it's an existing offer with a real ID, add it to offersToDelete
                if (offerId !== null) {
                    this.offersToDelete.push(offerId);
                }
                // Filter out the offer from the local array using either real ID or temp_id
                this.offers = this.offers.filter(offer =>
                    (offer.id !== offerId) || (offer.temp_id !== tempId)
                );
            }
        },

        // Handle image file selection
        handleImageUpload(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.tempImageUrl = e.target.result; // This will be a Base64 string
                };
                reader.readAsDataURL(file);
            }
        },

        // Apply the chosen image URL/Base64
        applyImage() {
            if (this.currentImageTarget === 'hero') {
                this.heroImage = this.tempImageUrl;
            } else if (this.currentImageTarget && this.currentImageTarget.startsWith('offer-')) {
                const parts = this.currentImageTarget.split('-');
                const type = parts[1]; // 'real' or 'new'
                const idValue = parseInt(parts[2]); // real ID or temp_id

                const offerIndex = this.offers.findIndex(o => {
                    if (type === 'real') {
                        return o.id === idValue;
                    } else if (type === 'new') {
                        return o.temp_id === idValue;
                    }
                    return false;
                });

                if (offerIndex !== -1) {
                    this.offers[offerIndex].icon = this.tempImageUrl; // Assign Base64 string
                }
            }
            this.showImageModal = false;
            this.tempImageUrl = ''; // Clear temp image
            document.getElementById('image-upload-input').value = ''; // Clear file input
        },

        // Cancel image upload
        cancelImageUpload() {
            this.showImageModal = false;
            this.tempImageUrl = ''; // Clear temp image
            document.getElementById('image-upload-input').value = ''; // Clear file input
        },

        // Open modal for hero image
        openHeroImageModal() {
            this.currentImageTarget = 'hero';
            this.tempImageUrl = this.heroImage; // Set current hero image for preview
            this.showImageModal = true;
        },

        // Open modal for offer icon
        openOfferIconModal(offerId, tempId) { // Removed currentIcon as we always want new upload
            this.currentImageTarget = offerId !== null ? `offer-real-${offerId}` : `offer-new-${tempId}`;
            this.tempImageUrl = ''; // Clear tempImageUrl as we only want to accept new uploads
            document.getElementById('image-upload-input').value = ''; // Clear file input for a fresh start
            this.showImageModal = true;
        },

        // Function to show the notification message
        showNotification(message, type, duration = 3000) {
            // Clear any existing timeout
            if (this.notification.timeoutId) {
                clearTimeout(this.notification.timeoutId);
            }

            this.notification.message = message;
            this.notification.type = type;
            this.notification.show = true;

            // Hide the notification after a duration if it's not a 'loading' type
            if (type !== 'loading') {
                this.notification.timeoutId = setTimeout(() => {
                    this.notification.show = false;
                }, duration);
            }
        },

        // --- Save Changes to Database ---
        async saveChanges() {
            this.showNotification('Saving changes...', 'loading'); // Show loading notification
            try {
                // 1. Update static content
                const staticContentUpdates = [
                    { key: 'heroTitle', content: this.heroTitle },
                    { key: 'heroSubtitle', content: this.heroSubtitle },
                    { key: 'heroImage', content: this.heroImage },
                    { key: 'introTitlePart1', content: this.introTitlePart1 },
                    { key: 'introTitlePart2', content: this.introTitlePart2 },
                    { key: 'introParagraph1', content: this.introParagraph1 },
                    { key: 'introParagraph2', content: this.introParagraph2 },
                ];

                for (const item of staticContentUpdates) {
                    await fetch(this.updateContentUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(item)
                    });
                }

                // 2. Delete offers marked for deletion
                for (const offerId of this.offersToDelete) {
                    await fetch(`${this.deleteOfferBaseUrl}/${offerId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });
                }
                this.offersToDelete = []; // Clear the deletion queue after processing

                // 3. Update or create offers
                const updatedOffers = [];
                for (let i = 0; i < this.offers.length; i++) {
                    let offer = this.offers[i];

                    const payload = {
                        id: offer.id,
                        title: offer.title,
                        description: offer.description,
                        icon: offer.icon // This will be the Base64 string (for new uploads) or URL (for existing)
                    };

                    const offerResponse = await fetch(this.storeOfferUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(payload)
                    });
                    const responseData = await offerResponse.json();

                    if (!offerResponse.ok) {
                        throw new Error(`Failed to save offer: ${responseData.message || offerResponse.statusText}`);
                    }

                    if (offer.id === null && responseData.data && responseData.data.id) {
                        offer.id = responseData.data.id;
                    }
                    // IMPORTANT: If the icon was a Base64 string, the backend will return the new public URL.
                    // Update the Alpine state with this new URL.
                    if (responseData.data && responseData.data.icon) {
                        offer.icon = responseData.data.icon;
                    }

                    updatedOffers.push(offer);
                }
                this.offers = updatedOffers;

                this.showNotification('Content and offers updated successfully!', 'success'); // Show success notification
            } catch (error) {
                console.error('Error saving changes:', error);
                this.showNotification('Failed to save changes.', 'error', 5000); // Show error notification
            }
        },

        // Toggle editing mode and save if done editing
        async toggleEditing() {
            if (this.isEditing) {
                await this.saveChanges();
            }
            this.isEditing = !this.isEditing;
        }
    }"
    x-init="$nextTick(() => { loaded = true })"
    :class="{ 'opacity-0': !loaded, 'opacity-100': loaded }"
    x-transition:enter="transition ease-out duration-700"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100">

    <button
        @click="toggleEditing()"
        class="fixed bottom-6 right-6 z-50 p-4 rounded-full shadow-lg
               bg-orange-500 text-white font-bold text-lg
               hover:bg-orange-600 focus:outline-none focus:ring-4 focus:ring-orange-300
               transition-all duration-300 ease-in-out transform hover:scale-105"
    >
        <span x-text="isEditing ? 'Done Editing' : 'Edit Page'"></span>
    </button>

    {{-- Notification UI --}}
    <div x-show="notification.show"
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="opacity-0 translate-y-full translate-x-full"
         x-transition:enter-end="opacity-100 translate-y-0 translate-x-0"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="opacity-100 translate-y-0 translate-x-0"
         x-transition:leave-end="opacity-0 translate-y-full translate-x-full"
         class="fixed top-4 right-4 z-[100] p-4 rounded-lg shadow-lg text-white max-w-xs w-full flex items-center space-x-3"
         :class="{
             'bg-blue-500': notification.type === 'loading',
             'bg-green-500': notification.type === 'success',
             'bg-red-500': notification.type === 'error'
         }">
        <template x-if="notification.type === 'loading'">
            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </template>
        <template x-if="notification.type === 'success'">
            <i class="fas fa-check-circle h-5 w-5"></i>
        </template>
        <template x-if="notification.type === 'error'">
            <i class="fas fa-exclamation-triangle h-5 w-5"></i>
        </template>
        <span x-text="notification.message" class="font-semibold"></span>
    </div>


    <div class="relative w-full h-[500px] md:h-[600px] flex items-center justify-center">
        <img class="absolute inset-0 w-full h-full object-cover" :src="heroImage" alt="About Us Team" />
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="relative z-10 text-center px-4 max-w-4xl mx-auto">
            <h1 class="text-white text-4xl md:text-5xl font-bold font-['Verdana'] leading-tight mb-4 md:mb-6 hero-editable-text"
                :contenteditable="isEditing"
                x-text="heroTitle"
                @blur="updateContent($event.target.innerText, 'heroTitle')"
                :class="{'edit-mode-border': isEditing}">
            </h1>
            <p class="text-white text-2xl md:text-3xl font-normal font-['Caveat'] hero-editable-text"
               :contenteditable="isEditing"
               x-text="heroSubtitle"
               @blur="updateContent($event.target.innerText, 'heroSubtitle')"
               :class="{'edit-mode-border': isEditing}">
            </p>
        </div>
        <button
            x-show="isEditing"
            @click="openHeroImageModal()"
            class="absolute top-4 left-4 z-20 px-4 py-2 bg-orange-600 text-white rounded-md shadow-md
                   hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 transition-colors duration-200"
        >
            <i class="fas fa-image mr-2"></i>Import Background
        </button>
    </div>

    <div class="w-full bg-white py-16 px-4 md:px-8 lg:px-12">
        <div class="max-w-6xl mx-auto flex flex-col gap-16">

            <div class="flex flex-col lg:flex-row justify-between items-start gap-10 lg:gap-20">
                <div class="w-full lg:w-1/3">
                    <span class="text-orange-500 text-2xl md:text-3xl font-bold font-['Verdana']"
                                :contenteditable="isEditing"
                                x-text="introTitlePart1"
                                @blur="updateContent($event.target.innerText, 'introTitlePart1')"
                                :class="{'edit-mode-border': isEditing}">
                    </span>
                    <span class="text-black text-2xl md:text-3xl font-bold font-['Verdana']"
                                :contenteditable="isEditing"
                                x-text="introTitlePart2"
                                @blur="updateContent($event.target.innerText, 'introTitlePart2')"
                                :class="{'edit-mode-border': isEditing}">
                    </span>
                </div>
                <div class="w-full lg:w-2/3 flex flex-col md:flex-row justify-between items-start gap-6 md:gap-10">
                    <p class="text-center md:text-left text-neutral-600 text-base md:text-lg font-medium font-['Montserrat']"
                       :contenteditable="isEditing"
                       x-text="introParagraph1"
                       @blur="updateContent($event.target.innerText, 'introParagraph1')"
                       :class="{'edit-mode-border': isEditing}">
                    </p>
                    <p class="text-center md:text-left text-neutral-600 text-base md:text-lg font-medium font-['Montserrat']"
                       :contenteditable="isEditing"
                       x-text="introParagraph2"
                       @blur="updateContent($event.target.innerText, 'introParagraph2')"
                       :class="{'edit-mode-border': isEditing}">
                    </p>
                </div>
            </div>

            <div class="flex justify-center">
                <div class="w-2/3 lg:w-1/2 h-1 bg-indigo-900 rounded-[20px]"></div>
            </div>

            <h2 class="text-orange-500 text-5xl font-bold font-['Caveat']">What We Offer</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <template x-for="(offer, index) in offers" :key="offer.id === null ? `new-${offer.temp_id}` : offer.id">
                    <div class="group bg-white rounded-[20px] shadow-md p-4 flex items-center gap-4
                                 transition-all duration-300 ease-in-out cursor-pointer
                                 hover:shadow-lg hover:scale-[1.02]
                                 hover:ring-4 hover:ring-[#F18018] hover:ring-opacity-70 relative"
                               :class="{'edit-mode-border': isEditing}">

                        <button x-show="isEditing" @click.stop="deleteOffer(offer.id, offer.temp_id)"
                                class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold
                                       hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">
                            &times;
                        </button>

                        <div class="w-16 h-16 md:w-20 md:h-20 bg-zinc-300 rounded-full flex-shrink-0 flex items-center justify-center relative overflow-hidden">
                            {{-- Now, all icons are expected to be image URLs, so we only use img tag --}}
                            <template x-if="offer.icon">
                                <img x-bind:src="offer.icon" alt="Offer Icon" class="w-full h-full object-cover rounded-full"
                                     onerror="this.onerror=null;this.src='https://via.placeholder.com/80?text=Error';">
                            </template>
                            {{-- Fallback if no icon is set --}}
                            <template x-if="!offer.icon">
                                <i class="fas fa-question-circle text-white text-2xl"></i>
                            </template>

                            <button x-show="isEditing" @click.stop="openOfferIconModal(offer.id, offer.temp_id)"
                                    class="absolute inset-0 bg-black/50 text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                <i class="fas fa-edit text-xl"></i>
                            </button>
                        </div>

                        <div class="flex flex-col items-start gap-2 text-left">
                            <h3 class="text-black text-lg md:text-xl font-bold font-roboto"
                                :contenteditable="isEditing"
                                x-text="offer.title"
                                @blur="offer.title = $event.target.innerText"
                                :class="{'edit-mode-border': isEditing}">
                            </h3>
                            <p class="text-neutral-600 text-sm md:text-base font-medium font-montserrat"
                               :contenteditable="isEditing"
                               x-text="offer.description"
                               @blur="offer.description = $event.target.innerText"
                               :class="{'edit-mode-border': isEditing}">
                            </p>
                        </div>
                    </div>
                </template>

                <div x-show="isEditing" class="flex items-center justify-center p-4 border-2 border-dashed border-gray-300 rounded-[20px]
                                         hover:border-orange-500 hover:text-orange-500 transition-colors duration-300 cursor-pointer"
                     @click="addOffer()">
                    <div class="flex flex-col items-center gap-2">
                        <i class="fas fa-plus-circle text-4xl text-gray-400 group-hover:text-orange-500"></i>
                        <span class="text-lg font-semibold text-gray-600 group-hover:text-orange-500">Add New Offer</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div x-show="showImageModal"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         class="fixed inset-0 z-50 flex items-center justify-center p-4"
         @click.away="cancelImageUpload">
        <div class="fixed inset-0 modal-overlay"></div> <div class="modal-content relative bg-white rounded-lg shadow-xl max-w-lg mx-auto p-6 w-full z-50">
            <h3 class="text-2xl font-bold mb-4 text-neutral-700">Import Image</h3>

            <div class="mb-6">
                <label for="image-upload-input" class="block text-gray-700 text-sm font-bold mb-2">Upload File:</label>
                <input type="file" id="image-upload-input" @change="handleImageUpload($event)" accept="image/*"
                       class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                <p class="mt-1 text-sm text-gray-500">PNG, JPG, or GIF (Max 5MB)</p>
            </div>

            <div x-show="tempImageUrl" class="mb-6">
                <p class="block text-gray-700 text-sm font-bold mb-2">Image Preview:</p>
                <img x-bind:src="tempImageUrl" alt="Image Preview" class="max-w-full h-auto max-h-48 object-contain mx-auto border border-gray-300 rounded">
            </div>

            <div class="flex justify-end gap-3">
                <button @click="cancelImageUpload()"
                        class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Cancel
                </button>
                <button @click="applyImage()"
                        :disabled="!tempImageUrl"
                        class="px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-300 disabled:opacity-50 disabled:cursor-not-allowed">
                    Apply
                </button>
            </div>
        </div>
    </div>
</div>