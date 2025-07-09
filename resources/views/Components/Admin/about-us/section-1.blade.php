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
            heroTitle: 'About Us',
            heroSubtitle: 'Serving the Community with Efficiency, Transparency, and Care',
            heroImage: 'https://placehold.co/1200x600/0A2647/FFFFFF?text=Team+Picture', // New: Hero image state
            introTitlePart1: 'Introduction',
            introTitlePart2: ' to Your Trusted LGU Services Hub!',
            introParagraph1: 'At [LGUConnect], we believe in accessible and convenient public service. Our platform bridges the gap between citizens and local government units by offering fast, secure, and transparent digital services.',
            introParagraph2: 'We are committed to simplifying the way you access essential documents and updates—so you can focus on what matters most.',
            offers: [
                { id: 1, title: 'Cedula Request Made Easy', description: 'Apply for your community tax certificate online with just a few clicks.', icon: 'fas fa-id-card' },
                { id: 2, title: 'Barangay Clearance Anytime', description: 'Request, verify, and download your barangay clearance wherever you are.', icon: 'fas fa-file-signature' },
                { id: 3, title: 'Real-Time LGU News', description: 'Get updated with the latest ordinances, barangay announcements, and emergency bulletins.', icon: 'fas fa-newspaper' },
                { id: 4, title: 'Public Service Announcements', description: 'Stay informed about important public service announcements and events.', icon: 'fas fa-bullhorn' },
                { id: 5, title: 'Online Payment Options', description: 'Conveniently pay for various government services online.', icon: 'fas fa-money-bill-wave' },
                { id: 6, title: 'Community Feedback Portal', description: 'Share your feedback and suggestions to improve local services.', icon: 'fas fa-comments' },
            ],
            nextOfferId: 7, // To generate unique IDs for new offers

            // Modal states
            showImageModal: false,
            currentImageTarget: null, // 'hero' or 'offer-[id]'
            tempImageUrl: '', // Used for previewing image in modal

            // Function to update content from editable fields
            updateContent(newValue, field) {
                this[field] = newValue;
            },

            // Function to add a new offer tile
            addOffer() {
                this.offers.push({
                    id: this.nextOfferId++,
                    title: 'New Offer Title',
                    description: 'Description for the new offer.',
                    icon: 'fas fa-plus-circle' // Default icon for new offers
                });
            },

            // Function to delete an offer tile
            deleteOffer(idToDelete) {
                this.offers = this.offers.filter(offer => offer.id !== idToDelete);
            },

            // Handle image file selection
            handleImageUpload(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.tempImageUrl = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            },

            // Apply the chosen image URL
            applyImage() {
                if (this.currentImageTarget === 'hero') {
                    this.heroImage = this.tempImageUrl;
                } else if (this.currentImageTarget && this.currentImageTarget.startsWith('offer-')) {
                    const id = parseInt(this.currentImageTarget.split('-')[1]);
                    const offerIndex = this.offers.findIndex(o => o.id === id);
                    if (offerIndex !== -1) {
                        this.offers[offerIndex].icon = this.tempImageUrl;
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
            openOfferIconModal(offerId, currentIcon) {
                this.currentImageTarget = `offer-${offerId}`;
                this.tempImageUrl = currentIcon; // Set current icon for preview
                this.showImageModal = true;
            },
        }"
        x-init="$nextTick(() => { loaded = true })"
        :class="{ 'opacity-0': !loaded, 'opacity-100': loaded }"
        x-transition:enter="transition ease-out duration-700"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100">

        <button
            @click="isEditing = !isEditing"
            class="fixed bottom-6 right-6 z-50 p-4 rounded-full shadow-lg
                   bg-orange-500 text-white font-bold text-lg
                   hover:bg-orange-600 focus:outline-none focus:ring-4 focus:ring-orange-300
                   transition-all duration-300 ease-in-out transform hover:scale-105"
        >
            <span x-text="isEditing ? 'Done Editing' : 'Edit Page'"></span>
        </button>

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
                    <template x-for="offer in offers" :key="offer.id">
                        <div class="group bg-white rounded-[20px] shadow-md p-4 flex items-center gap-4
                                     transition-all duration-300 ease-in-out cursor-pointer
                                     hover:shadow-lg hover:scale-[1.02]
                                     hover:ring-4 hover:ring-[#F18018] hover:ring-opacity-70 relative"
                             :class="{'edit-mode-border': isEditing}">

                            <button x-show="isEditing" @click.stop="deleteOffer(offer.id)"
                                    class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold
                                           hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">
                                &times;
                            </button>

                            <div class="w-16 h-16 md:w-20 md:h-20 bg-zinc-300 rounded-full flex-shrink-0 flex items-center justify-center relative overflow-hidden">
                                <template x-if="offer.icon && offer.icon.startsWith('fas fa-')">
                                    <i :class="offer.icon" class="text-white text-2xl"></i>
                                </template>
                                <template x-if="offer.icon && !offer.icon.startsWith('fas fa-')">
                                    <img :src="offer.icon" alt="Offer Icon" class="w-full h-full object-cover rounded-full">
                                </template>

                                <button x-show="isEditing" @click.stop="openOfferIconModal(offer.id, offer.icon)"
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

                <div class="mb-4">
                    <label for="image-url-input" class="block text-gray-700 text-sm font-bold mb-2">Image URL:</label>
                    <input type="text" id="image-url-input" x-model="tempImageUrl" placeholder="Enter image URL"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-4 text-center text-gray-600">OR</div>

                <div class="mb-6">
                    <label for="image-upload-input" class="block text-gray-700 text-sm font-bold mb-2">Upload File:</label>
                    <input type="file" id="image-upload-input" @change="handleImageUpload($event)" accept="image/*"
                           class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                    <p class="mt-1 text-sm text-gray-500">PNG, JPG, or GIF (Max 5MB)</p>
                </div>

                <div x-show="tempImageUrl" class="mb-6">
                    <p class="block text-gray-700 text-sm font-bold mb-2">Image Preview:</p>
                    <img :src="tempImageUrl" alt="Image Preview" class="max-w-full h-auto max-h-48 object-contain mx-auto border border-gray-300 rounded">
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