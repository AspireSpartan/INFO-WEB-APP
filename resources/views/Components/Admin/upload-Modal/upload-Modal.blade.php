<!-- Upload Modal (Optional) -->
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
             x-transition:leave-end="opacity-0 scale-95">
            <!-- Modal Form Content -->
            <h2 class="text-2xl font-bold text-gray-800 mb-6 font-montserrat">Upload New News Item</h2>
            <form>
                <div class="mb-4">
                    <label for="newsImage" class="block text-gray-700 text-sm font-bold mb-2">News Image</label>
                    <input type="file" id="newsImage" name="news_image" accept="image/*" class="shadow border rounded w-full py-2 px-3" />
                </div>
                <div class="mb-4">
                    <label for="newsDatePosted" class="block text-gray-700 text-sm font-bold mb-2">Date Posted</label>
                    <input type="date" id="newsDatePosted" name="news_date_posted" class="shadow border rounded w-full py-2 px-3 bg-gray-100 cursor-not-allowed" readonly />
                </div>
                <div class="mb-4">
                    <label for="newsTitle" class="block text-gray-700 text-sm font-bold mb-2">Title (Max 50 chars)</label>
                    <input type="text" id="newsTitle" name="news_title" maxlength="50" class="shadow border rounded w-full py-2 px-3" />
                </div>
                <div class="mb-4">
                    <label for="newsDescription" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                    <textarea id="newsDescription" name="news_description" rows="3" maxlength="100" class="shadow border rounded w-full py-2 px-3"></textarea>
                </div>
                <div class="mb-6">
                    <label for="newsLink" class="block text-gray-700 text-sm font-bold mb-2">Link</label>
                    <input type="url" id="newsLink" name="news_link" class="shadow border rounded w-full py-2 px-3" />
                </div>
                <div class="flex justify-end gap-4">
                    <button type="button" @click="showUploadModal = false" class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded">Cancel</button>
                    <button type="submit" class="bg-amber-400 hover:bg-amber-500 text-white py-2 px-4 rounded">Submit</button>
                </div>
            </form>
        </div>
    </div>