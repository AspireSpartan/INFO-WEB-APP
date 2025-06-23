<div class="fixed inset-0 bg-gray-600 bg-opacity-75 flex items-center justify-center z-50"
    x-show="showUploadModal"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0">
    <div class="bg-white rounded-lg shadow-xl p-8 max-w-lg w-full mx-4"
        @click.away="showUploadModal = false" {{-- Consider if you want to close the modal on click away when there are validation errors --}}
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        x-data="{ imageUrl: null }">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 font-montserrat">Upload New News Item</h2>

        {{-- Display Validation Errors --}}
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

        {{-- Display Success Message --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        {{-- The form now points to the correct resourceful route for storing news items --}}
        <form method="POST" action="{{ route('news.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- Image Upload Section --}}
            <div class="mb-6 flex flex-col items-center">
                <label for="image" class="block text-gray-700 text-sm font-bold mb-2">News Image <span class="text-red-500">*</span></label>
                <div class="relative w-full h-48 bg-gray-200 flex items-center justify-center overflow-hidden border border-gray-300 shadow-inner">
                    <img x-show="imageUrl" :src="imageUrl" alt="News Image Preview" class="absolute inset-0 w-full h-full object-cover">
                    <svg x-show="!imageUrl" class="w-32 h-32 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7 1.274 4.057 1.274 8.057 0 12-1.274 4.057-5.064 7-9.542 7-4.476 0-8.268-2.943-9.542-7-1.274-4.057-1.274-8.057 0-12z" />
                    </svg>
                </div>
                {{-- Added 'required' attribute here for client-side validation --}}
                <input type="file" id="image" name="image" accept="image/*" class="hidden" x-ref="imageInput" required
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
                @error('image')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Author Input --}}
            <div class="mb-4">
                <label for="author" class="block text-gray-700 text-sm font-bold mb-2">Author <span class="text-red-500">*</span></label>
                {{-- Added 'required' attribute here --}}
                <input type="text" id="author" name="author" class="shadow border rounded w-full py-2 px-3 @error('author') border-red-500 @enderror" placeholder="Enter author's name" value="{{ old('author') }}" required />
                @error('author')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Date Posted Input --}}
            <div class="mb-4">
                <label for="date" class="block text-gray-700 text-sm font-bold mb-2">Date Posted <span class="text-red-500">*</span></label>
                {{-- Added 'required' attribute here --}}
                <input type="date" id="date" name="date" class="shadow border rounded w-full py-2 px-3 bg-gray-100 @error('date') border-red-500 @enderror"
                       x-init="document.getElementById('date').value = '{{ old('date', date('Y-m-d')) }}'" {{-- Preserves old input or sets current date --}}
                       required />
                @error('date')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Title Input --}}
            <div class="mb-4">
                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title (Max 255 chars) <span class="text-red-500">*</span></label>
                {{-- Added 'required' attribute here --}}
                <input type="text" id="title" name="title" class="shadow border rounded w-full py-2 px-3 @error('title') border-red-500 @enderror" value="{{ old('title') }}" required />
                @error('title')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- URL Input --}}
            <div class="mb-4">
                <label for="url" class="block text-gray-700 text-sm font-bold mb-2">URL <span class="text-red-500">*</span></label>
                {{-- Added 'required' attribute here --}}
                <input type="url" id="url" name="url" class="shadow border rounded w-full py-2 px-3 @error('url') border-red-500 @enderror" placeholder="Enter URL" value="{{ old('url') }}" required />
                @error('url')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Sponsored Checkbox (not required) --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Sponsored</label>
                <div class="mt-2">
                    <label class="inline-flex items-center">
                        <input type="checkbox" class="form-checkbox h-5 w-5 text-amber-600" name="sponsored" value="1" {{ old('sponsored') ? 'checked' : '' }}>
                        <span class="ml-2 text-gray-700">Yes, this is sponsored</span>
                    </label>
                </div>
                @error('sponsored')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Action Buttons --}}
            <div class="flex justify-end gap-4">
                <button type="button" @click="showUploadModal = false" class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded">Cancel</button>
                <button type="submit" class="bg-amber-400 hover:bg-amber-500 text-white py-2 px-4 rounded">Submit</button>
            </div>
        </form>
    </div>
</div>