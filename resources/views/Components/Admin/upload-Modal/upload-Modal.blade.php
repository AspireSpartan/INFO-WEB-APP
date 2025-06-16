<div class="fixed inset-0 bg-gray-600 bg-opacity-75 flex items-center justify-center z-50"
    x-show="showUploadModal"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0">
    <div class="bg-white rounded-lg shadow-xl p-8 max-w-lg w-full mx-4"
        @click.away="showUploadModal = false"
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        x-data="{ imageUrl: null }">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 font-montserrat">Upload New News Item</h2>
        <form>
            <div class="mb-6 flex flex-col items-center">
                <label for="image" class="block text-gray-700 text-sm font-bold mb-2">News Image</label>
                <div class="relative w-72 h-72 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden border border-gray-300 shadow-inner">
                    <img x-show="imageUrl" :src="imageUrl" alt="News Image Preview" class="absolute inset-0 w-full h-full object-cover">
                    <svg x-show="!imageUrl" class="w-32 h-32 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7 1.274 4.057 1.274 8.057 0 12-1.274 4.057-5.064 7-9.542 7-4.476 0-8.268-2.943-9.542-7-1.274-4.057-1.274-8.057 0-12z" />
                    </svg>
                </div>
                <input type="file" id="image" name="image" accept="image/*" class="hidden" x-ref="imageInput"
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
            </div>

            <div class="mb-4">
                <label for="author" class="block text-gray-700 text-sm font-bold mb-2">Author</label>
                <input type="text" id="author" name="author" class="shadow border rounded w-full py-2 px-3" placeholder="Enter author's name" />
            </div>

            <div class="mb-4">
                <label for="currentDate" class="block text-gray-700 text-sm font-bold mb-2">Date Posted</label>
                <input type="date" id="currentDate" name="current_date" class="shadow border rounded w-full py-2 px-3 bg-gray-100 cursor-not-allowed" readonly x-init="document.getElementById('currentDate').value = new Date().toISOString().slice(0,10)" />
            </div>
            <div class="mb-4">
                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title (Max 50 chars)</label>
                <input type="text" id="title" name="title" maxlength="50" class="shadow border rounded w-full py-2 px-3" />
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Sponsored</label>
                <div class="mt-2">
                    <label class="inline-flex items-center">
                        <input type="radio" class="form-radio" name="sponsored" value="true">
                        <span class="ml-2">True</span>
                    </label>
                    <label class="inline-flex items-center ml-6">
                        <input type="radio" class="form-radio" name="sponsored" value="false" checked>
                        <span class="ml-2">False</span>
                    </label>
                </div>
            </div>
            <div class="flex justify-end gap-4">
                <button type="button" @click="showUploadModal = false" class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded">Cancel</button>
                <button type="submit" class="bg-amber-400 hover:bg-amber-500 text-white py-2 px-4 rounded">Submit</button>
            </div>
        </form>
    </div>
</div>