<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editable Banner Screen</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&family=Merriweather:wght@400;700&family=Roboto:wght@400;700&family=Source+Sans+Pro:wght@400;700&family=Questrial&family=Segoe+UI&display=swap" rel="stylesheet">

    <style>
        /* Custom Font Definitions (used with Tailwind's font-['Font Name'] syntax) */
        .font-noto-sans { font-family: 'Noto Sans', sans-serif; }
        .font-merriweather { font-family: 'Merriweather', serif; }
        .font-roboto { font-family: 'Roboto', sans-serif; }
        .font-source-sans-pro { font-family: 'Source Sans Pro', sans-serif; }
        .font-questrial { font-family: 'Questrial', sans-serif; }
        .font-segoe-ui { font-family: 'Segoe UI', sans-serif; }

        /* Modal specific styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        .modal-container {
            background-color: white;
            padding: 2.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 600px;
            position: relative;
            transform: translateY(-20px);
            opacity: 0;
            transition: all 0.3s ease-out;
        }
        .modal-container.is-open {
            transform: translateY(0);
            opacity: 1;
        }
        .close-button {
            position: absolute;
            top: 1rem;
            right: 1.2rem;
            font-size: 2rem;
            cursor: pointer;
            color: #666;
            transition: color 0.2s;
        }
        .close-button:hover {
            color: #333;
        }

        /* Editable Section Overlay */
        .editable-wrapper {
            position: relative;
        }
        .editable-overlay {
            position: absolute;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.2s ease-in-out;
            z-index: 20;
            pointer-events: none;
        }
        .editable-wrapper:hover .editable-overlay {
            opacity: 1;
            pointer-events: auto;
        }
        .edit-button-on-overlay {
            background-color: #0056b3;
            color: white;
            padding: 0.5rem 1.25rem;
            border-radius: 0.25rem;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .edit-button-on-overlay:hover {
            background-color: #004085;
        }

        /* Edit Dropdown */
        .edit-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            background-color: white;
            border: 1px solid #e0e0e0;
            border-radius: 0.25rem;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            min-width: 160px;
            padding: 0.5rem 0;
            z-index: 50;
            overflow: hidden;
        }
        .edit-dropdown-item {
            padding: 0.75rem 1.25rem;
            cursor: pointer;
            color: #444;
            font-size: 0.95rem;
            transition: background-color 0.2s, color 0.2s;
        }
        .edit-dropdown-item:hover {
            background-color: #f5f5f5;
            color: #0056b3;
        }
    </style>
</head>
<body x-data="{
    openModal: null,
    currentEditableContent: '',
    currentEditableType: '',
    currentEditableTarget: null,
    editingColor: '#000000',
    editingImageSrc: '',
    editingButtonText: '',
    editingButtonLink: '',

    activeDropdown: null, // Tracks which dropdown is open

    // Function to set up the edit data based on content type
    editContent(type, targetElement, refName = null) {
        this.currentEditableType = type;
        this.currentEditableTarget = targetElement;
        this.activeDropdown = null; // Close dropdown after selection

        if (type === 'text') {
            this.currentEditableContent = targetElement.textContent.trim();
            this.openModal = 'textEdit';
        } else if (type === 'color') {
            this.editingColor = window.getComputedStyle(targetElement).color;
            this.openModal = 'colorEdit';
        } else if (type === 'image') {
            this.editingImageSrc = targetElement.src;
            this.openModal = 'imageEdit';
        } else if (type === 'button') {
            this.editingButtonText = targetElement.textContent.trim();
            this.editingButtonLink = targetElement.href;
            this.openModal = 'buttonEdit';
        }
    },

    // Save functions (placeholders for backend integration)
    saveContent() {
        if (this.currentEditableType === 'text' && this.currentEditableTarget) {
            this.currentEditableTarget.textContent = this.currentEditableContent;
        }
        // TODO: Send data to backend for persistence
        console.log('Saving Text:', this.currentEditableContent);
        this.closeModal();
    },
    saveColor() {
        if (this.currentEditableTarget) {
            this.currentEditableTarget.style.color = this.editingColor;
        }
        // TODO: Send data to backend for persistence
        console.log('Saving Color:', this.editingColor);
        this.closeModal();
    },
    saveImage() {
        if (this.currentEditableTarget && this.editingImageSrc) {
            this.currentEditableTarget.src = this.editingImageSrc;
        }
        // TODO: Send data to backend for persistence
        console.log('Saving Image URL:', this.editingImageSrc);
        this.closeModal();
    },
    saveButton() {
        if (this.currentEditableTarget) {
            this.currentEditableTarget.textContent = this.editingButtonText;
            this.currentEditableTarget.href = this.editingButtonLink;
        }
        // TODO: Send data to backend for persistence
        console.log('Saving Button Text:', this.editingButtonText, 'Link:', this.editingButtonLink);
        this.closeModal();
    },
    saveBackground() {
        // This directly applies the background image
        if (this.$refs.backgroundImageContainer && this.editingImageSrc) {
            this.$refs.backgroundImageContainer.style.backgroundImage = `url('${this.editingImageSrc}')`;
        }
        // TODO: Send data to backend for persistence
        console.log('Saving Background Image:', this.editingImageSrc);
        this.closeModal();
    },

    closeModal() {
        this.openModal = null;
        // Reset state variables
        this.currentEditableContent = '';
        this.currentEditableType = '';
        this.currentEditableTarget = null;
        this.editingColor = '#000000';
        this.editingImageSrc = '';
        this.editingButtonText = '';
        this.editingButtonLink = '';
    }
}" @click.away="activeDropdown = null">

    <div class="relative min-h-screen bg-cover bg-center pt-24" x-ref="backgroundImageContainer" style="background-image: url('{{ asset('storage/LGU_bg.png') }}');">
        <div class="absolute inset-0 bg-gray-900/60"></div>

        <button class="absolute right-5 top-12 -translate-y-1/2 z-20
                       bg-white/20 border border-white/40 text-white w-16 h-16 rounded-lg
                       flex items-center justify-center shadow-md transition-all duration-200
                       hover:bg-white/30 hover:border-white/50 transform hover:scale-105"
                @click="openModal = 'backgroundEdit'; editingImageSrc = $refs.backgroundImageContainer.style.backgroundImage.match(/url\(['"]?(.*?)['"]?\)/)?.[1] || '';"
                title="Change Background Image">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8">
                <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" />
            </svg>
        </button>

        <div class="relative z-10 flex flex-col items-end justify-center h-[calc(100vh-theme(spacing.24))] text-left px-4">
            <div class="w-full max-w-4xl space-y-6 md:space-y-8 lg:space-y-10 pr-2 md:pr-8 lg:pr-16">

                <div class="editable-wrapper group">
                    <p class="text-white text-2xl md:text-3xl lg:text-4xl font-normal font-['Noto_Sans']" x-ref="paragraph1">
                        “DRIVEN BY INNOVATION
                    </p>
                    <div class="editable-overlay">
                        <div class="relative">
                            <button @click.stop="activeDropdown = (activeDropdown === 'p1' ? null : 'p1')" class="edit-button-on-overlay">
                                Edit Content
                            </button>
                            <div x-show="activeDropdown === 'p1'" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95"
                                 class="edit-dropdown">
                                <span class="edit-dropdown-item" @click="editContent('text', $refs.paragraph1)">Edit Text</span>
                                <span class="edit-dropdown-item" @click="editContent('color', $refs.paragraph1)">Change Color</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="editable-wrapper group">
                    <h1 class="text-white text-6xl md:text-7xl lg:text-7xl font-bold font-['Merriweather'] leading-tight" x-ref="title">
                        Local Government Unit
                    </h1>
                    <div class="editable-overlay">
                        <div class="relative">
                            <button @click.stop="activeDropdown = (activeDropdown === 'title' ? null : 'title')" class="edit-button-on-overlay">
                                Edit Content
                            </button>
                            <div x-show="activeDropdown === 'title'" x-transition class="edit-dropdown">
                                <span class="edit-dropdown-item" @click="editContent('text', $refs.title)">Edit Text</span>
                                <span class="edit-dropdown-item" @click="editContent('color', $refs.title)">Change Color</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="editable-wrapper group">
                    <p class="text-white text-2xl md:text-3xl lg:text-4xl font-normal font-['Roboto']" x-ref="paragraph2">
                        Serving the community with <span class="text-amber-400" x-ref="span1">transparency</span>,
                        <span class="text-amber-400" x-ref="span2">Integrity</span>, <br class="hidden sm:inline"/>and <span class="text-amber-400" x-ref="span3">commitment</span>.
                    </p>
                    <div class="editable-overlay">
                        <div class="relative">
                            <button @click.stop="activeDropdown = (activeDropdown === 'p2' ? null : 'p2')" class="edit-button-on-overlay">
                                Edit Content
                            </button>
                            <div x-show="activeDropdown === 'p2'" x-transition class="edit-dropdown">
                                <span class="edit-dropdown-item" @click="editContent('text', $refs.paragraph2)">Edit Main Text</span>
                                <hr class="my-1 border-gray-200">
                                <span class="edit-dropdown-item" @click="editContent('color', $refs.paragraph2)">Change Main Color</span>
                                <span class="edit-dropdown-item" @click="editContent('color', $refs.span1)">Change 'Transparency' Color</span>
                                <span class="edit-dropdown-item" @click="editContent('color', $refs.span2)">Change 'Integrity' Color</span>
                                <span class="edit-dropdown-item" @click="editContent('color', $refs.span3)">Change 'Commitment' Color</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="editable-wrapper group">
                    <p class="text-white text-lg md:text-xl lg:text-2xl font-normal font-['Source_Sans_Pro']" x-ref="paragraph3">
                        <span class="inline-block transform rotate-90 scale-x-[-1] text-2xl relative top-1 right-1">/</span>BREAKING BOUNDARIES
                    </p>
                    <div class="editable-overlay">
                        <div class="relative">
                            <button @click.stop="activeDropdown = (activeDropdown === 'p3' ? null : 'p3')" class="edit-button-on-overlay">
                                Edit Content
                            </button>
                            <div x-show="activeDropdown === 'p3'" x-transition class="edit-dropdown">
                                <span class="edit-dropdown-item" @click="editContent('text', $refs.paragraph3)">Edit Text</span>
                                <span class="edit-dropdown-item" @click="editContent('color', $refs.paragraph3)">Change Color</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="relative z-10 w-full bg-zinc-500/20 shadow-md py-4 md:py-6 lg:py-8 px-4 sm:px-8 lg:px-16 mt-auto">
            <div class="flex flex-col sm:flex-row justify-around items-center gap-6 md:gap-12 lg:gap-24">
                <div class="text-center editable-wrapper group">
                    <div class="text-white text-3xl md:text-4xl font-bold font-['Merriweather']" x-ref="stat1Number">24</div>
                    <div class="text-white text-sm md:text-lg font-light font-['Merriweather']" x-ref="stat1Label">Barangay</div>
                    <div class="editable-overlay">
                        <div class="relative">
                            <button @click.stop="activeDropdown = (activeDropdown === 'stat1' ? null : 'stat1')" class="edit-button-on-overlay">
                                Edit Stat
                            </button>
                            <div x-show="activeDropdown === 'stat1'" x-transition class="edit-dropdown">
                                <span class="edit-dropdown-item" @click="editContent('text', $refs.stat1Number)">Edit Number</span>
                                <span class="edit-dropdown-item" @click="editContent('text', $refs.stat1Label)">Edit Label</span>
                                <hr class="my-1 border-gray-200">
                                <span class="edit-dropdown-item" @click="editContent('color', $refs.stat1Number)">Change Number Color</span>
                                <span class="edit-dropdown-item" @click="editContent('color', $refs.stat1Label)">Change Label Color</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center editable-wrapper group">
                    <div class="text-white text-3xl md:text-4xl font-bold font-['Merriweather']" x-ref="stat2Number">1500+</div>
                    <div class="text-white text-sm md:text-lg font-light font-['Merriweather']" x-ref="stat2Label">Residents</div>
                    <div class="editable-overlay">
                        <div class="relative">
                            <button @click.stop="activeDropdown = (activeDropdown === 'stat2' ? null : 'stat2')" class="edit-button-on-overlay">
                                Edit Stat
                            </button>
                            <div x-show="activeDropdown === 'stat2'" x-transition class="edit-dropdown">
                                <span class="edit-dropdown-item" @click="editContent('text', $refs.stat2Number)">Edit Number</span>
                                <span class="edit-dropdown-item" @click="editContent('text', $refs.stat2Label)">Edit Label</span>
                                <hr class="my-1 border-gray-200">
                                <span class="edit-dropdown-item" @click="editContent('color', $refs.stat2Number)">Change Number Color</span>
                                <span class="edit-dropdown-item" @click="editContent('color', $refs.stat2Label)">Change Label Color</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center editable-wrapper group">
                    <div class="text-white text-3xl md:text-4xl font-bold font-['Merriweather']" x-ref="stat3Number">120+</div>
                    <div class="text-white text-sm md:text-lg font-light font-['Merriweather']" x-ref="stat3Label">Public Projects</div>
                    <div class="editable-overlay">
                        <div class="relative">
                            <button @click.stop="activeDropdown = (activeDropdown === 'stat3' ? null : 'stat3')" class="edit-button-on-overlay">
                                Edit Stat
                            </button>
                            <div x-show="activeDropdown === 'stat3'" x-transition class="edit-dropdown">
                                <span class="edit-dropdown-item" @click="editContent('text', $refs.stat3Number)">Edit Number</span>
                                <span class="edit-dropdown-item" @click="editContent('text', $refs.stat3Label)">Edit Label</span>
                                <hr class="my-1 border-gray-200">
                                <span class="edit-dropdown-item" @click="editContent('color', $refs.stat3Number)">Change Number Color</span>
                                <span class="edit-dropdown-item" @click="editContent('color', $refs.stat3Label)">Change Label Color</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center editable-wrapper group">
                    <div class="text-white text-3xl md:text-4xl font-bold font-['Merriweather']" x-ref="stat4Number">75</div>
                    <div class="text-white text-sm md:text-lg font-light font-['Merriweather']" x-ref="stat4Label">Years of Service</div>
                    <div class="editable-overlay">
                        <div class="relative">
                            <button @click.stop="activeDropdown = (activeDropdown === 'stat4' ? null : 'stat4')" class="edit-button-on-overlay">
                                Edit Stat
                            </button>
                            <div x-show="activeDropdown === 'stat4'" x-transition class="edit-dropdown">
                                <span class="edit-dropdown-item" @click="editContent('text', $refs.stat4Number)">Edit Number</span>
                                <span class="edit-dropdown-item" @click="editContent('text', $refs.stat4Label)">Edit Label</span>
                                <hr class="my-1 border-gray-200">
                                <span class="edit-dropdown-item" @click="editContent('color', $refs.stat4Number)">Change Number Color</span>
                                <span class="edit-dropdown-item" @click="editContent('color', $refs.stat4Label)">Change Label Color</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full h-px bg-white/50 my-6"></div>

            <div class="editable-wrapper group">
                <p class="relative z-10 w-full text-center text-white text-xs md:text-sm lg:text-base font-normal font-['Questrial'] px-4 md:px-8 lg:px-16" x-ref="footerParagraph">
                    Local Government Units (LGUs) in the Philippines play a vital role in implementing national policies at the grassroots level while addressing the specific needs of their communities. These units, which include provinces, cities, municipalities, and barangays, are granted autonomy under the Local Government Code of 1991. LGUs are responsible for delivering basic services such as health care, education, infrastructure, and disaster response. They are also tasked with promoting local development through planning, budgeting, and legislation. Despite challenges like limited resources and political interference, many LGUs have successfully launched innovative programs to uplift their constituents and promote inclusive growth.
                </p>
                <div class="editable-overlay">
                    <div class="relative">
                        <button @click.stop="activeDropdown = (activeDropdown === 'footer' ? null : 'footer')" class="edit-button-on-overlay">
                            Edit Content
                        </button>
                        <div x-show="activeDropdown === 'footer'" x-transition class="edit-dropdown">
                            <span class="edit-dropdown-item" @click="editContent('text', $refs.footerParagraph)">Edit Text</span>
                            <span class="edit-dropdown-item" @click="editContent('color', $refs.footerParagraph)">Change Color</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <template x-if="openModal === 'textEdit'">
        <div class="modal-overlay" @click.self="closeModal()">
            <div class="modal-container" x-transition:enter="is-open">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800 font-['Merriweather']">Edit Text Content</h2>
                <span class="close-button" @click="closeModal()">&times;</span>
                <div class="modal-body mb-6">
                    <label for="editText" class="block text-sm font-medium text-gray-700 mb-2 font-['Roboto']">Text Content:</label>
                    <textarea id="editText" x-model="currentEditableContent"
                              class="w-full p-3 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-gray-800 resize-y min-h-32"
                              placeholder="Enter text here..."></textarea>
                </div>
                <div class="modal-footer flex justify-end space-x-3">
                    <button @click="closeModal()" class="px-5 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100 transition font-['Segoe_UI']">Cancel</button>
                    <button @click="saveContent()" class="px-5 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition font-['Segoe_UI']">Save Changes</button>
                </div>
            </div>
        </div>
    </template>

    <template x-if="openModal === 'colorEdit'">
        <div class="modal-overlay" @click.self="closeModal()">
            <div class="modal-container" x-transition:enter="is-open">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800 font-['Merriweather']">Change Text Color</h2>
                <span class="close-button" @click="closeModal()">&times;</span>
                <div class="modal-body mb-6">
                    <label for="colorPicker" class="block text-sm font-medium text-gray-700 mb-2 font-['Roboto']">Select Color:</label>
                    <input type="color" id="colorPicker" x-model="editingColor"
                           class="w-full h-12 border border-gray-300 rounded-md cursor-pointer">
                    <p class="text-sm text-gray-500 mt-2 font-['Roboto']">Current Color: <span x-text="editingColor" :style="{ color: editingColor }"></span></p>
                </div>
                <div class="modal-footer flex justify-end space-x-3">
                    <button @click="closeModal()" class="px-5 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100 transition font-['Segoe_UI']">Cancel</button>
                    <button @click="saveColor()" class="px-5 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition font-['Segoe_UI']">Save Color</button>
                </div>
            </div>
        </div>
    </template>

    <template x-if="openModal === 'buttonEdit'">
        <div class="modal-overlay" @click.self="closeModal()">
            <div class="modal-container" x-transition:enter="is-open">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800 font-['Merriweather']">Edit Button Properties</h2>
                <span class="close-button" @click="closeModal()">&times;</span>
                <div class="modal-body mb-6 space-y-4">
                    <div>
                        <label for="buttonText" class="block text-sm font-medium text-gray-700 mb-2 font-['Roboto']">Button Text:</label>
                        <input type="text" id="buttonText" x-model="editingButtonText"
                               class="w-full p-3 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-gray-800"
                               placeholder="e.g., Learn More">
                    </div>
                    <div>
                        <label for="buttonLink" class="block text-sm font-medium text-gray-700 mb-2 font-['Roboto']">Button Link (URL):</label>
                        <input type="url" id="buttonLink" x-model="editingButtonLink"
                               class="w-full p-3 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-gray-800"
                               placeholder="e.g., https://yourwebsite.com/about">
                    </div>
                </div>
                <div class="modal-footer flex justify-end space-x-3">
                    <button @click="closeModal()" class="px-5 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100 transition font-['Segoe_UI']">Cancel</button>
                    <button @click="saveButton()" class="px-5 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition font-['Segoe_UI']">Save Button</button>
                </div>
            </div>
        </div>
    </template>


    <template x-if="openModal === 'backgroundEdit'">
        <div class="modal-overlay" @click.self="closeModal()">
            <div class="modal-container" x-transition:enter="is-open">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800 font-['Merriweather']">Change Background Image</h2>
                <span class="close-button" @click="closeModal()">&times;</span>
                <div class="modal-body mb-6 space-y-4">
                    <div>
                        <label for="bgImageUrl" class="block text-sm font-medium text-gray-700 mb-2 font-['Roboto']">Image URL:</label>
                        <input type="text" id="bgImageUrl" x-model="editingImageSrc"
                               class="w-full p-3 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-gray-800"
                               placeholder="Enter image URL (e.g., https://example.com/image.jpg)">
                    </div>
                    <div>
                        <label for="bgImageUpload" class="block w-full text-sm font-medium text-gray-700 mb-2 font-['Roboto']">Or upload a new image:</label>
                        <input type="file" id="bgImageUpload"
                               @change="if (event.target.files.length > 0) { editingImageSrc = URL.createObjectURL(event.target.files[0]); }"
                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                        <p class="text-xs text-gray-500 mt-1 font-['Roboto']">Note: Uploaded images are temporary in this demo and will not persist on refresh.</p>
                    </div>
                </div>
                <div class="modal-footer flex justify-end space-x-3">
                    <button @click="closeModal()" class="px-5 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100 transition font-['Segoe_UI']">Cancel</button>
                    <button @click="saveBackground()" class="px-5 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition font-['Segoe_UI']">Apply Background</button>
                </div>
            </div>
        </div>
    </template>

</body>
</html>