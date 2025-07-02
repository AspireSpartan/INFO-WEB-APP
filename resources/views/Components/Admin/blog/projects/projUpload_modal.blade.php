<div class="fixed inset-0 bg-gray-600 bg-opacity-75 flex items-center justify-center z-50"
    x-show="showUploadModal" {{-- Control visibility with Alpine.js state, assuming 'showUploadModal' is used for projects too --}}
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0">
    <div class="bg-white rounded-lg shadow-xl p-8 max-w-3xl w-full mx-4 max-h-[90vh] overflow-y-auto"
        @click.away="showUploadModal = false" {{-- Closes modal on click outside --}}
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95">

        <h2 class="text-2xl font-bold text-gray-800 mb-6 font-montserrat">Create New Project</h2>

        {{-- Display Validation Errors from the store method (for projects) --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">Please fix the following errors:</span>
                <ul class="mt-3 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Success Message (Optional) --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('projects.store') }}" enctype="multipart/form-data"
            x-data="{ projectImageUrl: null }"> {{-- Alpine.js for image preview --}}
            @csrf

            <div class="md:grid md:grid-cols-2 md:gap-6">

                {{-- Left Column for Images and Project Details --}}
                <div>
                    {{-- Project Image Upload Section --}}
                    <div class="mb-6 flex flex-col items-center">
                        <label for="image_upload" class="block text-gray-700 text-sm font-bold mb-2">Project Image <span class="text-red-500">*</span> (Max 8MB)</label>
                        <div class="relative w-full h-48 bg-gray-200 flex items-center justify-center overflow-hidden border border-gray-300 shadow-inner">
                            <img x-show="projectImageUrl" :src="projectImageUrl" alt="Project Image Preview" class="absolute inset-0 w-full h-full object-cover">
                            <svg x-show="!projectImageUrl" class="w-32 h-32 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <input type="file" id="image_upload" name="image_upload" accept="image/*" class="hidden" x-ref="projectImageInput"
                            @change="
                                const file = $event.target.files[0];
                                if (file) {
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        projectImageUrl = e.target.result;
                                    };
                                    reader.readAsDataURL(file);
                                } else {
                                    projectImageUrl = null;
                                }
                            "
                        />
                        <button type="button" @click="$refs.projectImageInput.click()" class="mt-4 bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg shadow-md">
                            Choose Image
                        </button>
                        @error('image_upload')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Site Input --}}
                    <div class="mb-4">
                        <label for="site" class="block text-gray-700 text-sm font-bold mb-2">Site <span class="text-red-500">*</span></label>
                        <input type="text" id="site" name="site" class="shadow border rounded w-full py-2 px-3 @error('site') border-red-500 @enderror" placeholder="Enter project site" value="{{ old('site') }}" required />
                        @error('site')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Scope Input --}}
                    <div class="mb-4">
                        <label for="scope" class="block text-gray-700 text-sm font-bold mb-2">Scope <span class="text-red-500">*</span></label>
                        <input type="text" id="scope" name="scope" class="shadow border rounded w-full py-2 px-3 @error('scope') border-red-500 @enderror" placeholder="Enter project scope" value="{{ old('scope') }}" required />
                        @error('scope')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Outcome Input --}}
                    <div class="mb-4">
                        <label for="outcome" class="block text-gray-700 text-sm font-bold mb-2">Outcome <span class="text-red-500">*</span></label>
                        <input type="text" id="outcome" name="outcome" class="shadow border rounded w-full py-2 px-3 @error('outcome') border-red-500 @enderror" placeholder="Enter project outcome" value="{{ old('outcome') }}" required />
                        @error('outcome')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Right Column for Title and URL --}}
                <div>
                    {{-- Title Input --}}
                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title (Max 255 chars) <span class="text-red-500">*</span></label>
                        <input type="text" id="title" name="title" class="shadow border rounded w-full py-2 px-3 @error('title') border-red-500 @enderror" placeholder="Enter project title" value="{{ old('title') }}" required />
                        @error('title')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- URL Input --}}
                    <div class="mb-4">
                        <label for="url" class="block text-gray-700 text-sm font-bold mb-2">Project URL</label>
                        <input type="url" id="url" name="url" class="shadow border rounded w-full py-2 px-3 @error('url') border-red-500 @enderror" placeholder="Enter external URL (optional)" value="{{ old('url') }}" />
                        @error('url')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Note about image and icon sizes (referencing previous conversation) --}}
                    <div class="bg-blue-50 border-l-4 border-blue-200 text-blue-700 p-4" role="alert">
                        <p class="font-bold">Upload Limits:</p>
                        <p>Project Image: Maximum 8MB</p>
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex justify-end gap-4 mt-6">
                <button type="button" @click="showUploadModal = false" class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded">Cancel</button>
                <button type="submit" class="bg-amber-400 hover:bg-amber-500 text-white py-2 px-4 rounded">Submit</button>
            </div>
        </form>
    </div>
</div>