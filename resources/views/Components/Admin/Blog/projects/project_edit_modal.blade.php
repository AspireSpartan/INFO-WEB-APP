{{-- resources/views/Components/Admin/blog/projects/project_edit_modal.blade.php --}}
@props(['project']) {{-- Prop for initial data, but Alpine will manage it --}}

<div
    x-show="showProjectEditModal" {{-- This x-show is controlled by the parent project_content.blade.php --}}
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-100"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
    class="fixed inset-0 bg-black bg-opacity-40 flex justify-center items-center z-50 p-4"
    @click.self="$dispatch('close-admin-project-edit-modal')" {{-- Close modal when clicking outside --}}
    x-cloak {{-- Hide until Alpine is initialized --}}
    x-data="projectEditModalComponent()" {{-- Initialize with no data, will be populated by event --}}
    @keydown.escape.window="$dispatch('close-admin-project-edit-modal')" {{-- Close on Escape key --}}
    @open-admin-project-edit-modal.window="initModal($event.detail)" {{-- Listen for event to populate data --}}
    x-trap.noscroll {{-- Prevent scrolling on body when modal is open --}}
>
    <div
        class="bg-white rounded-2xl shadow-2xl max-w-lg w-full m-4 relative flex flex-col max-h-[90vh]"
    >
        <div class="flex items-center justify-between p-6 pb-4 border-b border-gray-200">
            <h2 class="text-xl font-medium text-gray-900">Edit Project</h2>
            <button
                @click="$dispatch('close-admin-project-edit-modal')"
                class="text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 rounded-full p-1 transition-colors duration-200"
                aria-label="Close"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form @submit.prevent="updateProject" enctype="multipart/form-data" class="flex-grow overflow-y-auto p-6">
            @csrf
            @method('PUT') {{-- Essential for update method --}}

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

            <div class="mb-4">
                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title (Max 255 chars) <span class="text-red-500">*</span></label>
                <input type="text" name="title" id="title" x-model="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label for="site" class="block text-gray-700 text-sm font-bold mb-2">Site <span class="text-red-500">*</span></label>
                <input type="text" name="site" id="site" x-model="site" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label for="scope" class="block text-gray-700 text-sm font-bold mb-2">Scope <span class="text-red-500">*</span></label>
                <input type="text" name="scope" id="scope" x-model="scope" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label for="outcome" class="block text-gray-700 text-sm font-bold mb-2">Outcome <span class="text-red-500">*</span></label>
                <input type="text" name="outcome" id="outcome" x-model="outcome" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label for="url" class="block text-gray-700 text-sm font-bold mb-2">Project URL</label>
                <input type="url" name="url" id="url" x-model="url" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="image_url" class="block text-gray-700 text-sm font-bold mb-2">Current Project Image:</label>
                <template x-if="currentImageUrl">
                    <img :src="currentImageUrl" alt="Current Project Image" class="mb-2 max-w-xs h-auto">
                </template>
                <template x-if="!currentImageUrl">
                    <p>No current image.</p>
                </template>
                <label for="image_url" class="block text-gray-700 text-sm font-bold mb-2 mt-2">Upload New Project Image (Optional):</label>
                <input type="file" name="image_url" id="image_url" @change="handleImageUpload" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <p class="text-xs text-gray-500 mt-1">Max file size: 8MB. Allowed formats: jpeg, png, jpg, gif, svg.</p>
            </div>

            <div class="flex items-center justify-end gap-3 mt-6">
                <button type="button" @click="$dispatch('close-admin-project-edit-modal')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200">
                    Update Project
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function projectEditModalComponent() {
        return {
            projectId: null,
            title: '',
            site: '',
            scope: '',
            outcome: '',
            url: '',
            currentImageUrl: null,
            newImageFile: null,
            showNotification: false,
            notificationMessage: '',
            notificationType: '',

            initModal(project) {
                this.projectId = project.id;
                this.title = project.title;
                this.site = project.site;
                this.scope = project.scope;
                this.outcome = project.outcome;
                this.url = project.url;
                // Determine the correct image path for preview
                this.currentImageUrl = project.image_url ? (project.image_url.startsWith('http') ? project.image_url : '{{ asset('storage') }}/' + project.image_url) : null;
                this.newImageFile = null; // Reset file input
                this.showNotification = false; // Hide any previous notifications
            },

            handleImageUpload(event) {
                const file = event.target.files[0];
                if (file) {
                    this.newImageFile = file;
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.currentImageUrl = e.target.result; // Update preview
                    };
                    reader.readAsDataURL(file);
                } else {
                    this.newImageFile = null;

                    this.currentImageUrl = this.projectId ? (this.currentImageUrl && this.currentImageUrl.startsWith('data:') ? null : (this.editingProject && this.editingProject.image_url ? (this.editingProject.image_url.startsWith('http') ? this.editingProject.image_url : '{{ asset('storage') }}/' + this.editingProject.image_url) : null)) : null;
                }
            },

            async updateProject() {
                this.showNotification = false; // Hide previous notification
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                const formData = new FormData();
                formData.append('_method', 'PUT'); // Laravel requires this for PUT requests
                formData.append('title', this.title);
                formData.append('site', this.site);
                formData.append('scope', this.scope);
                formData.append('outcome', this.outcome);
                formData.append('url', this.url);
                if (this.newImageFile) {
                    formData.append('image_url', this.newImageFile); // Use 'image_url' as the field name for the controller
                }

                try {
                    if (!this.projectId) {
                        this.notificationType = 'error';
                        this.notificationMessage = 'Error: Project ID is missing. Cannot update.';
                        this.showNotification = true;
                        setTimeout(() => { this.showNotification = false; }, 5000);
                        return;
                    }

                    const response = await fetch(`/admin/projects/${this.projectId}`, { // Use dynamic route
                        method: 'POST', // Fetch API uses POST for FormData with _method PUT
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                        },
                        body: formData
                    });

                    if (response.ok) {
                        const result = await response.json();
                        this.notificationType = 'success';
                        this.notificationMessage = result.message || 'Project updated successfully!';
                        this.showNotification = true;

                        // Dispatch event to parent to update list or refresh
                        window.dispatchEvent(new CustomEvent('project-updated', { detail: result }));

                        setTimeout(() => {
                            this.showNotification = false;
                            this.$dispatch('close-admin-project-edit-modal'); // Close modal after success
                        }, 2000);

                    } else {
                        const errorData = await response.json();
                        this.notificationType = 'error';
                        let errorMessage = errorData.message || 'An error occurred. Please check the console.';

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
                        }, 5000);
                    }
                } catch (error) {
                    console.error('Fetch error:', error);
                    this.notificationType = 'error';
                    this.notificationMessage = 'A network error occurred. Please try again.';
                    this.showNotification = true;

                    setTimeout(() => {
                        this.showNotification = false;
                    }, 5000);
                }
            }
        }
    }
</script>
