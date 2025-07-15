{{-- resources/views/Components/Admin/about-us/section-3.blade.php --}}
<div class="font-roboto bg-[#fdfdff] py-16 text-[#333] overflow-hidden" x-data="communityManager()">
    {{-- Main Container with Alpine.js state management --}}

    {{-- Header Section --}}
    <div class="text-center px-8 mb-12 relative">
        <div class="max-w-4xl mx-auto">
            <div class="flex items-center justify-center gap-4 mb-4">
                <div class="w-[50px] h-[50px] flex items-center justify-center bg-gradient-to-br from-[#ff7f50] to-[#ff6347] rounded-full shadow-lg shadow-[#ff7f50]/30">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-[30px] h-[30px] text-white">
                        <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0 .75.75 0 0 1-.416.67c-.941.256-1.809.56-2.652.94a1.5 1.5 0 0 0-.878 1.23l-.02.101a.75.75 0 0 1-.47.658L12 23.25l-1.426-.363a.75.75 0 0 1-.47-.658l-.02-.101a1.5 1.5 0 0 0-.877-1.23c-.844-.38-1.712-.684-2.653-.94a.75.75 0 0 1-.416-.671ZM12 7.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z" clip-rule="evenodd" />
                    </svg>
                </div>
                {{-- Dynamic Title --}}
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold font-open-sans text-[#222]">
                    <span data-key="main_title_part1" :contenteditable="isEditMode" class="editable-text text-[#ff6347]">{{ $communityContent['main_title_part1'] ?? 'Community' }}</span>
                    <span data-key="main_title_part2" :contenteditable="isEditMode" class="editable-text">{{ $communityContent['main_title_part2'] ?? ' at Work' }}</span>
                </h1>
            </div>
            {{-- Dynamic Subtitle --}}
            <p data-key="subtitle_paragraph" :contenteditable="isEditMode" class="editable-text text-base sm:text-lg text-[#555] leading-relaxed max-w-2xl mx-auto">
                {{ $communityContent['subtitle_paragraph'] ?? 'We work hand-in-hand with barangay officials and municipal departments to ensure streamlined digital services and community development.' }}
            </p>
        </div>

        {{-- Edit/Save Buttons --}}
        <div class="absolute top-0 right-8 flex gap-2">
            <button @click="saveAllChanges" x-show="isEditMode" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-blue-700 transition-colors flex items-center justify-center gap-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M.028 3.322a1.5 1.5 0 0 1 2.101-.028L6 6.162V4.5a1.5 1.5 0 0 1 3 0v4.5a1.5 1.5 0 0 1-1.5 1.5H3a1.5 1.5 0 0 1 0-3h1.662l-2.83-2.83a1.5 1.5 0 0 1-.004-2.101ZM23.972 20.678a1.5 1.5 0 0 1-2.101.028L18 17.838v1.662a1.5 1.5 0 0 1-3 0v-4.5a1.5 1.5 0 0 1 1.5-1.5H21a1.5 1.5 0 0 1 0 3h-1.662l2.83 2.83a1.5 1.5 0 0 1 .004 2.101Z" /></svg>
                Save
            </button>
            <button @click="toggleEditMode" class="bg-orange-600 text-white p-2 rounded-full shadow-lg hover:bg-orange-700 transition-colors flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-orange-500" style="width: 40px; height: 40px;" title="Toggle Edit Mode">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.09l-.334 1.679a.75.75 0 0 0 .983.983l1.679-.334a5.25 5.25 0 0 0 2.09-1.32l8.4-8.4Z" /><path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" /></svg>
            </button>
        </div>
    </div>

    {{-- Carousel/Grid Section --}}
    <div class="relative mb-12 py-4">
        <div x-ref="carouselContainer" class="overflow-hidden cursor-grab select-none" :class="{'!overflow-visible !cursor-default': isEditMode}">
            <div x-ref="carouselTrack" class="flex will-change-transform" :class="{'flex-wrap justify-center gap-6 p-4': isEditMode, '!transform-none': isEditMode}">
                {{-- Dynamic Carousel Images --}}
                @foreach($communityCarouselImages as $image)
                <div class="flex-shrink-0 w-[min(calc(40vw),380px)] h-[min(calc(25vw),240px)] mx-6 rounded-xl shadow-xl relative transform transition-all duration-300 ease-in-out opacity-80 carousel-item group"
                    :class="{'!mx-0 w-[min(calc(90vw),400px)]': isEditMode}" {{-- Adjust size in grid mode --}}
                    data-id="{{ $image->id }}">
                    <img src="{{ asset($image->image_path) }}" alt="{{ $image->title }}" class="w-full h-full object-cover block rounded-xl pointer-events-none" />
                    <div :contenteditable="isEditMode" class="carousel-item-title absolute bottom-0 left-0 right-0 p-6 text-center text-white font-semibold text-lg bg-gradient-to-t from-black/80 to-black/0 opacity-0 translate-y-5 transition-all duration-300 ease-in-out z-10">
                        {{ $image->title }}
                    </div>
                    <button @click="deleteImage($event.currentTarget)" x-show="isEditMode" class="remove-image-button absolute top-2 right-2 bg-red-600 text-white rounded-full p-1 text-xs opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-red-500 z-20" style="width: 24px; height: 24px;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M16.5 4.478c.02.092.032.185.032.278v.75A2.25 2.25 0 0 1 14.25 8.25h-2.25v2.25a.75.75 0 0 1-1.5 0V8.25H8.25A2.25 2.25 0 0 1 6 6V5.25a.75.75 0 0 1 .032-.278c.01-.044.02-.087.033-.13l.354-1.294a3 3 0 0 1 2.656-2.102h3.5c1.233 0 2.258.857 2.656 2.102l.353 1.294ZM16.5 5.25V6A.75.75 0 0 0 17.25 6.75h-.75a.75.75 0 0 0-.75.75v6a.75.75 0 0 0 .75.75h.75v3.75c0 .414-.336.75-.75.75H7.5c-.414 0-.75-.336-.75-.75v-3.75h.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-.75-.75H6.75A.75.75 0 0 0 6 6v-.75ZM4.5 15.75a.75.75 0 0 0-.75.75v3c0 .414.336.75.75.75h15c.414 0 .75-.336.75-.75v-3a.75.75 0 0 0-.75-.75H4.5Z" clip-rule="evenodd" /></svg>
                    </button>
                </div>
                @endforeach
            </div>
        </div>

        <button @click="showModal = true" x-show="isEditMode" class="absolute bottom-0 left-1/2 -translate-x-1/2 mb-4 px-6 py-3 bg-orange-600 text-white rounded-lg shadow-lg hover:bg-orange-700 transition-colors flex items-center justify-center gap-2 font-semibold focus:outline-none focus:ring-2 focus:ring-orange-500">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6"><path d="M1.5 6h21v12h-21v-12Zm2.25 2.25v7.5h16.5v-7.5h-16.5ZM12 9a.75.75 0 0 0-.75.75v2.25h-2.25a.75.75 0 0 0 0 1.5h2.25v2.25a.75.75 0 0 0 1.5 0v-2.25h2.25a.75.75 0 0 0 0-1.5h-2.25v-2.25A.75.75 0 0 0 12 9Z" /></svg>
            Add New Image
        </button>
    </div>

    {{-- Progress Bar --}}
    <div class="w-11/12 max-w-md mx-auto mt-10 h-1.5 bg-[#e9e9e9] rounded-full overflow-hidden">
        <div x-ref="progressBar" class="h-full bg-gradient-to-r from-[#ff7f50] to-[#ff6347] w-0 rounded-full transition-all duration-200 ease-out"></div>
    </div>

    {{-- Footer Section --}}
    <div class="mt-12 text-center text-[#777] text-sm px-8 pt-4 border-t border-[#eee] max-w-4xl mx-auto">
        {{-- Dynamic Footer --}}
        <div data-key="footer_text" :contenteditable="isEditMode" class="editable-text">
            {!! $communityContent['footer_text'] ?? 'Building stronger communities through <span class="text-[#ff6347] font-semibold">collaboration</span> and <span class="text-[#ff6347] font-semibold">innovation</span> since 2023' !!}
        </div>
    </div>

    <div x-show="showModal" @keydown.escape.window="showModal = false" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center p-4 z-50" style="display: none;">
        <div @click.outside="showModal = false" class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md mx-auto relative">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Add Carousel Image</h2>
            <button @click="showModal = false" class="absolute top-4 right-4 text-gray-600 hover:text-gray-800"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg></button>
            <div class="mb-4">
                <label for="modalImageTitle" class="block text-gray-700 text-sm font-semibold mb-2">Image Title:</label>
                <input type="text" x-ref="modalImageTitle" class="shadow-sm border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-500">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-semibold mb-2">Select Image:</label>
                <input type="file" x-ref="modalImageUpload" @change="previewImage" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                <img x-show="imagePreviewUrl" :src="imagePreviewUrl" class="mt-4 max-w-full h-auto rounded-md">
            </div>
            <div class="flex justify-end gap-3">
                <button @click="showModal = false" class="px-5 py-2 border rounded-md text-gray-700 hover:bg-gray-100">Cancel</button>
                <button @click="addNewImage" class="px-5 py-2 bg-orange-600 text-white rounded-md hover:bg-orange-700">Add Image</button>
            </div>
        </div>
    </div>

</div>

{{-- Toast Notification --}}
<div id="community-toast" class="fixed bottom-5 right-5 bg-gray-800 text-white px-6 py-3 rounded-lg shadow-lg z-[100] transition-opacity duration-300 opacity-0 pointer-events-none">
    <span>Message</span>
</div>


<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

<script>
    function communityManager() {
        return {
            isEditMode: false,
            showModal: false,
            imagePreviewUrl: null,
            sortable: null,

            init() {
                this.$watch('isEditMode', (isEditing) => {
                    this.toggleSortable(isEditing);
                    document.querySelectorAll('.editable-text').forEach(el => {
                        el.classList.toggle('focus:outline-dashed', isEditing);
                        el.classList.toggle('focus:outline-2', isEditing);
                        el.classList.toggle('focus:outline-offset-4', isEditing);
                        el.classList.toggle('focus:outline-[#4299e1]', isEditing);
                    });
                    document.querySelectorAll('.carousel-item-title').forEach(el => {
                        el.classList.toggle('focus:outline-white', isEditing);
                    });
                    // Re-initialize carousel or grid behavior
                    this.setupCarouselOrGrid();
                });

                // Initialize carousel on page load (non-edit mode)
                this.$nextTick(() => this.setupCarouselOrGrid());

                // Re-setup carousel on window resize to adjust dynamically
                window.addEventListener('resize', () => {
                    if (!this.isEditMode) {
                        this.setupCarousel();
                    }
                });
            },

            toggleEditMode() {
                this.isEditMode = !this.isEditMode;
            },

            setupCarouselOrGrid() {
                if (this.isEditMode) {
                    if (this.sortable) this.sortable.destroy(); // Destroy sortable if it exists
                    this.initSortable(); // Initialize sortable for grid
                } else {
                    if (this.sortable) {
                        this.sortable.destroy(); // Destroy sortable if it exists
                        this.sortable = null;
                    }
                    this.setupCarousel(); // Initialize carousel behavior
                }
            },

            initSortable() {
                if (this.sortable) this.sortable.destroy(); // Destroy existing instance if any
                this.sortable = new Sortable(this.$refs.carouselTrack, {
                    animation: 150,
                    ghostClass: 'opacity-50',
                    handle: '.carousel-item',
                    // The onEnd event is crucial for updating the order on the backend
                    onEnd: (evt) => {
                        this.saveImageOrder();
                    }
                });
            },

            setupCarousel() {
                const carouselContainer = this.$refs.carouselContainer;
                const carouselTrack = this.$refs.carouselTrack;
                let isDragging = false;
                let startPos = 0;
                let currentScroll = 0;

                // Reset styles from grid mode
                carouselTrack.style.transform = '';
                carouselTrack.style.transition = '';

                // Enable overflow and grab cursor
                carouselContainer.classList.remove('!overflow-visible', '!cursor-default');
                carouselContainer.classList.add('overflow-hidden', 'cursor-grab');

                // Reset flex-wrap and gap from grid mode
                carouselTrack.classList.remove('flex-wrap', 'justify-center', 'gap-6', 'p-4', '!transform-none');
                carouselTrack.classList.add('flex'); // Ensure flex is applied

                const updateProgressBar = () => {
                    const scrollWidth = carouselTrack.scrollWidth - carouselContainer.clientWidth;
                    if (scrollWidth > 0) {
                        const progress = (carouselContainer.scrollLeft / scrollWidth) * 100;
                        this.$refs.progressBar.style.width = `${progress}%`;
                    } else {
                        this.$refs.progressBar.style.width = '0%';
                    }
                };

                carouselContainer.addEventListener('mousedown', (e) => {
                    if (this.isEditMode) return; // Prevent dragging in edit mode
                    isDragging = true;
                    startPos = e.pageX - carouselContainer.offsetLeft;
                    currentScroll = carouselContainer.scrollLeft;
                    carouselContainer.style.cursor = 'grabbing';
                });

                carouselContainer.addEventListener('mouseleave', () => {
                    isDragging = false;
                    if (!this.isEditMode) carouselContainer.style.cursor = 'grab';
                });

                carouselContainer.addEventListener('mouseup', () => {
                    isDragging = false;
                    if (!this.isEditMode) carouselContainer.style.cursor = 'grab';
                });

                carouselContainer.addEventListener('mousemove', (e) => {
                    if (!isDragging) return;
                    e.preventDefault();
                    const x = e.pageX - carouselContainer.offsetLeft;
                    const walk = (x - startPos) * 2; // The higher the number, the faster the scroll
                    carouselContainer.scrollLeft = currentScroll - walk;
                    updateProgressBar();
                });

                // Update progress bar on scroll
                carouselContainer.addEventListener('scroll', updateProgressBar);
                // Initial update
                updateProgressBar();

                 // Add hover effects for carousel items
                 carouselTrack.querySelectorAll('.carousel-item').forEach(item => {
                    item.addEventListener('mouseenter', () => {
                        if (!this.isEditMode) {
                            item.classList.remove('opacity-80');
                            item.classList.add('opacity-100', 'scale-105');
                            item.querySelector('.carousel-item-title').classList.remove('opacity-0', 'translate-y-5');
                            item.querySelector('.carousel-item-title').classList.add('opacity-100', 'translate-y-0');
                        }
                    });
                    item.addEventListener('mouseleave', () => {
                        if (!this.isEditMode) {
                            item.classList.remove('opacity-100', 'scale-105');
                            item.classList.add('opacity-80');
                            item.querySelector('.carousel-item-title').classList.remove('opacity-100', 'translate-y-0');
                            item.querySelector('.carousel-item-title').classList.add('opacity-0', 'translate-y-5');
                        }
                    });
                });
            },

            async apiCall(url, options) {
                try {
                    const headers = {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                    };

                    // Only set Content-Type for JSON payloads.
                    // Let browser set for FormData (multipart/form-data)
                    if (!(options.body instanceof FormData)) {
                        headers['Content-Type'] = 'application/json';
                    }

                    const response = await fetch(url, {
                        headers: headers,
                        ...options
                    });
                    if (!response.ok) {
                        const errorData = await response.json();
                        throw new Error(errorData.message || 'An API error occurred.');
                    }
                    return await response.json();
                } catch (error) {
                    console.error('API Call Failed:', error);
                    this.showToast(error.message || 'An unexpected error occurred.', 'error');
                    throw error; // Re-throw to be caught by the caller
                }
            },

            async saveAllChanges() {
                const promises = [];

                // 1. Save Text Content
                document.querySelectorAll('.editable-text[data-key]').forEach(el => {
                    const payload = {
                        key: el.dataset.key,
                        content: el.innerHTML.trim()
                    };
                    promises.push(this.apiCall('{{ route('admin.community.updateContent') }}', {
                        method: 'POST',
                        body: JSON.stringify(payload)
                    }));
                });

                // 2. Save Image Titles
                document.querySelectorAll('.carousel-item[data-id]').forEach(el => {
                    const existingId = el.dataset.id;
                    const existingTitle = el.querySelector('.carousel-item-title').textContent.trim();
                    const existingImagePath = el.querySelector('img').getAttribute('src'); // Get the image source.

                    const payload = {
                        id: existingId,
                        title: existingTitle,
                        current_image_path: existingImagePath,
                    };

                    // This route should handle both creating new images and updating existing ones (titles)
                    promises.push(this.apiCall('{{ route('admin.community.storeCarouselImage') }}', {
                        method: 'POST',
                        body: JSON.stringify(payload)
                    }));
                });

                // 3. Save Image Order (if sortable is active)
                if (this.sortable) {
                    promises.push(this.saveImageOrder());
                }

                try {
                    await Promise.all(promises);
                    this.showToast('All changes saved successfully!');
                    this.isEditMode = false;
                    // Re-setup carousel after saving changes and exiting edit mode
                    this.setupCarouselOrGrid();
                } catch (error) {
                    // Error is already shown by apiCall helper
                }
            },

            async saveImageOrder() {
                if (this.sortable) {
                    const orderPayload = {
                        images: this.sortable.toArray().map((id, index) => ({
                            id: id,
                            order: index + 1
                        }))
                    };
                    return this.apiCall('{{ route('admin.community.updateImageOrder') }}', {
                        method: 'POST',
                        body: JSON.stringify(orderPayload)
                    });
                }
                return Promise.resolve(); // Resolve immediately if sortable is not active
            },

            async deleteImage(button) {
                if (!confirm('Are you sure you want to delete this image?')) return;

                const item = button.closest('.carousel-item');
                const id = item.dataset.id;
                try {
                    const result = await this.apiCall(`{{ url('admin/community/delete-image') }}/${id}`, {
                        method: 'DELETE'
                    });
                    item.remove();
                    this.showToast(result.message);
                    // Re-initialize sortable to update the order if in edit mode
                    if (this.isEditMode) {
                        this.saveImageOrder(); // Save the new order immediately after deletion
                    }
                } catch (error) {
                    // Error toast is handled by apiCall
                }
            },

            previewImage(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.imagePreviewUrl = e.target.result;
                    };
                    reader.readAsDataURL(file);
                } else {
                    this.imagePreviewUrl = null;
                }
            },

            async addNewImage() {
                const title = this.$refs.modalImageTitle.value;
                const file = this.$refs.modalImageUpload.files[0];

                if (!file) {
                    this.showToast('Please select an image file.', 'error');
                    return;
                }

                const formData = new FormData();
                formData.append('title', title);
                formData.append('image', file);
                formData.append('order', this.$refs.carouselTrack.children.length + 1);
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

                try {
                    const result = await this.apiCall('{{ route('admin.community.storeCarouselImage') }}', {
                        method: 'POST',
                        body: formData
                    });

                    this.showToast(result.message);

                    // --- START: Dynamic addition of new image to frontend ---
                    const newImage = result.data;
                    const carouselTrack = this.$refs.carouselTrack;

                    const newDiv = document.createElement('div');
                    newDiv.className = 'flex-shrink-0 w-[min(calc(40vw),380px)] h-[min(calc(25vw),240px)] mx-6 rounded-xl shadow-xl relative transform transition-all duration-300 ease-in-out opacity-80 carousel-item group';
                    // Adjust class for edit mode if it's currently active
                    if (this.isEditMode) {
                        newDiv.classList.add('!mx-0', 'w-[min(calc(90vw),400px)]');
                    }
                    newDiv.setAttribute('data-id', newImage.id);

                    newDiv.innerHTML = `
                        <img src="${newImage.image_path}" alt="${newImage.title}" class="w-full h-full object-cover block rounded-xl pointer-events-none" />
                        <div contenteditable="${this.isEditMode}" class="carousel-item-title absolute bottom-0 left-0 right-0 p-6 text-center text-white font-semibold text-lg bg-gradient-to-t from-black/80 to-black/0 opacity-0 translate-y-5 transition-all duration-300 ease-in-out z-10">
                            ${newImage.title}
                        </div>
                        <button @click="deleteImage($event.currentTarget)" x-show="isEditMode" class="remove-image-button absolute top-2 right-2 bg-red-600 text-white rounded-full p-1 text-xs opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-red-500 z-20" style="width: 24px; height: 24px;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M16.5 4.478c.02.092.032.185.032.278v.75A2.25 2.25 0 0 1 14.25 8.25h-2.25v2.25a.75.75 0 0 1-1.5 0V8.25H8.25A2.25 2.25 0 0 1 6 6V5.25a.75.75 0 0 1 .032-.278c.01-.044.02-.087.033-.13l.354-1.294a3 3 0 0 1 2.656-2.102h3.5c1.233 0 2.258.857 2.656 2.102l.353 1.294ZM16.5 5.25V6A.75.75 0 0 0 17.25 6.75h-.75a.75.75 0 0 0-.75.75v6a.75.75 0 0 0 .75.75h.75v3.75c0 .414-.336.75-.75.75H7.5c-.414 0-.75-.336-.75-.75v-3.75h.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-.75-.75H6.75A.75.75 0 0 0 6 6v-.75ZM4.5 15.75a.75.75 0 0 0-.75.75v3c0 .414.336.75.75.75h15c.414 0 .75-.336.75-.75v-3a.75.75 0 0 0-.75-.75H4.5Z" clip-rule="evenodd" /></svg>
                        </button>
                    `;

                    carouselTrack.appendChild(newDiv);

                    this.$nextTick(() => {
                        this.$root.__alpine.evaluate(newDiv);
                        if (this.isEditMode) {
                            newDiv.querySelector('.carousel-item-title').setAttribute('contenteditable', 'true');
                            newDiv.querySelector('.carousel-item-title').classList.add('focus:outline-white');
                        }
                        // Re-initialize Sortable.js to include the new item for drag-and-drop
                        this.toggleSortable(this.isEditMode);
                    });
                    // --- END: Dynamic addition ---

                    // Reset form fields and close modal
                    this.$refs.modalImageTitle.value = '';
                    this.$refs.modalImageUpload.value = '';
                    this.imagePreviewUrl = null;
                    this.showModal = false;

                } catch (error) {
                    // Error toast is handled by apiCall
                }
            },

            showToast(message, type = 'success') {
                const toast = document.getElementById('community-toast');
                toast.querySelector('span').textContent = message;
                toast.classList.toggle('bg-red-600', type === 'error');
                toast.classList.toggle('bg-gray-800', type !== 'error');
                toast.classList.remove('opacity-0');
                setTimeout(() => toast.classList.add('opacity-0'), 3000);
            }
        }
    }
</script>

<style>
    [contenteditable="true"].editable-text:focus {
        outline-style: dashed;
        outline-width: 2px;
        outline-offset: 4px;
        border-radius: 0.375rem;
    }
    .carousel-item-title[contenteditable="true"]:focus {
        outline-color: white;
        outline-style: dashed;
        outline-width: 2px;
        outline-offset: 2px;
    }
</style>