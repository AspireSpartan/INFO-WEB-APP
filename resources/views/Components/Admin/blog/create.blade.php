{{-- resources/views/Components/Admin/blog/create.blade.php --}}

<div class="fixed inset-0 bg-gray-600 bg-opacity-75 flex items-center justify-center z-50"
    x-show="showCreateModal" {{-- Changed from showUploadModal to showCreateModal --}}
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0">
    <div class="bg-white rounded-lg shadow-xl p-8 max-w-3xl w-full mx-4 max-h-[90vh] overflow-y-auto" {{-- CHANGED: max-w-3xl for wider, max-h-[90vh] for max height and overflow-y-auto for scrolling --}}
        @click.away="showCreateModal = false" {{-- Changed from showUploadModal to showCreateModal --}}
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95">

        <h2 class="text-2xl font-bold text-gray-800 mb-6 font-montserrat">Create New Blog Post</h2>

        {{-- Display Validation Errors from the store method --}}
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

        {{-- Success Message (Optional, could also be handled as a flash message on redirect to index) --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('blogs.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="md:grid md:grid-cols-2 md:gap-6"> {{-- ADDED: Grid container for a two-column layout --}}

                {{-- Left Column for Images and Author details --}}
                <div>
                    {{-- Image Upload Section --}}
                    <div class="mb-6 flex flex-col items-center">
                        <label for="image_upload" class="block text-gray-700 text-sm font-bold mb-2">Blog Image <span class="text-red-500">*</span> (Max 8MB)</label>
                        <div class="relative w-full h-48 bg-gray-200 flex items-center justify-center overflow-hidden border border-gray-300 shadow-inner">
                            <img x-show="imageUrl" :src="imageUrl" alt="Blog Image Preview" class="absolute inset-0 w-full h-full object-cover">
                            <svg x-show="!imageUrl" class="w-32 h-32 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7 1.274 4.057 1.274 8.057 0 12-1.274 4.057-5.064 7-9.542 7-4.476 0-8.268-2.943-9.542-7-1.274-4.057-1.274-8.057 0-12z" />
                            </svg>
                        </div>
                        <input type="file" id="image_upload" name="image_upload" accept="image/*" class="hidden" x-ref="imageInput"
                            @change="
                                const file = $event.target.files[0];
                                if (file) {
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        imageUrl = e.target.result;
                                    };
                                    reader.readAsDataURL(file);
                                } else {
                                    imageUrl = null;
                                }
                            "
                        />
                        <button type="button" @click="$refs.imageInput.click()" class="mt-4 bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg shadow-md">
                            Choose File
                        </button>
                        @error('image_upload')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Icon Upload Section --}}
                    <div class="mb-6 flex flex-col items-center">
                        <label for="icon_upload" class="block text-gray-700 text-sm font-bold mb-2">Author Icon (Max 999KB)</label>
                        <div class="relative w-24 h-24 bg-gray-200 flex items-center justify-center overflow-hidden border border-gray-300 shadow-inner rounded-full">
                            <img x-show="iconUrl" :src="iconUrl" alt="Icon Preview" class="absolute inset-0 w-full h-full object-cover rounded-full">
                            <svg x-show="!iconUrl" class="w-12 h-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <input type="file" id="icon_upload" name="icon_upload" accept="image/*" class="hidden" x-ref="iconInput"
                            @change="
                                const file = $event.target.files[0];
                                if (file) {
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        iconUrl = e.target.result;
                                    };
                                    reader.readAsDataURL(file);
                                } else {
                                    iconUrl = null;
                                }
                            "
                        />
                        <button type="button" @click="$refs.iconInput.click()" class="mt-4 bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg shadow-md">
                            Choose Icon
                        </button>
                        @error('icon_upload')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Author Input --}}
                    <div class="mb-4">
                        <label for="author" class="block text-gray-700 text-sm font-bold mb-2">Author <span class="text-red-500">*</span></label>
                        <input type="text" id="author" name="author" class="shadow border rounded w-full py-2 px-3 @error('author') border-red-500 @enderror" placeholder="Enter author's name" value="{{ old('author') }}" required />
                        @error('author')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Author Title Input --}}
                    <div class="mb-4">
                        <label for="authortitle" class="block text-gray-700 text-sm font-bold mb-2">Author Title</label>
                        <input type="text" id="authortitle" name="authortitle" class="shadow border rounded w-full py-2 px-3 @error('authortitle') border-red-500 @enderror" placeholder="Enter author's title" value="{{ old('authortitle') }}" />
                        @error('authortitle')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Published Date Input --}}
                    <div class="mb-4">
                        <label for="published_at" class="block text-gray-700 text-sm font-bold mb-2">Published Date <span class="text-red-500">*</span></label>
                        <input type="date" id="published_at" name="published_at" class="shadow border rounded w-full py-2 px-3 bg-gray-100 @error('published_at') border-red-500 @enderror"
                                x-init="document.getElementById('published_at').value = '{{ old('published_at', date('Y-m-d')) }}'"
                                required />
                        @error('published_at')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Right Column for Title and Content --}}
                <div>
                    {{-- Title Input --}}
                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title (Max 255 chars) <span class="text-red-500">*</span></label>
                        <input type="text" id="title" name="title" class="shadow border rounded w-full py-2 px-3 @error('title') border-red-500 @enderror" placeholder="Enter blog title" value="{{ old('title') }}" required />
                        @error('title')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Content Input --}}
                    <div class="mb-4">
                        <label for="content" class="block text-gray-700 text-sm font-bold mb-2">Content <span class="text-red-500">*</span></label>
                        <textarea id="content" name="content" rows="18" class="shadow border rounded w-full py-2 px-3 @error('content') border-red-500 @enderror" placeholder="Enter blog content" required>{{ old('content') }}</textarea> {{-- Increased rows --}}
                        @error('content')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex justify-end gap-4 mt-6"> {{-- Adjusted margin-top --}}
                <button type="button" @click="showCreateModal = false" class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded">Cancel</button>
                <button type="submit" class="bg-amber-400 hover:bg-amber-500 text-white py-2 px-4 rounded">Submit</button>
            </div>
        </form>
    </div>
</div>
