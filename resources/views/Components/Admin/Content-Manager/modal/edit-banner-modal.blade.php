@props(['sectionBanner'])

<div x-show="isEditModalOpen"
     x-transition.opacity
     class="fixed inset-0 z-50 flex items-center justify-center bg-black/60"
     x-cloak
>
    <div @click.away="isEditModalOpen = false"
         class="bg-white rounded-lg shadow-lg max-w-lg w-full p-6 space-y-4"
    >
        <h2 class="text-xl font-semibold text-gray-800">
            <template x-if="editingField === 'background_image'">Edit Background Image</template>
            <template x-if="editingField === 'stats'">Edit Statistics</template>
            <template x-if="editingField !== 'stats' && editingField !== 'background_image'">
                Edit <span x-text="editingField.charAt(0).toUpperCase() + editingField.slice(1)"></span>
            </template>
        </h2>

        {{-- TEXT FIELDS --}}
        <template x-if="editingField !== 'stats' && editingField !== 'background_image'">
            <div>
                <label class="block text-sm text-gray-600 mb-1">New Value</label>
                <input type="text"
                       x-model="editingValue"
                       class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300"
                >
            </div>
        </template>

        {{-- STATS FIELDS --}}
        <template x-if="editingField === 'stats'">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-gray-600 mb-1">Barangay</label>
                    <input type="number" x-model="bannerData.barangay"
                           class="w-full px-2 py-1 border rounded-md focus:outline-none focus:ring">
                </div>
                <div>
                    <label class="block text-sm text-gray-600 mb-1">Residents</label>
                    <input type="number" x-model="bannerData.residents"
                           class="w-full px-2 py-1 border rounded-md focus:outline-none focus:ring">
                </div>
                <div>
                    <label class="block text-sm text-gray-600 mb-1">Projects</label>
                    <input type="number" x-model="bannerData.projects"
                           class="w-full px-2 py-1 border rounded-md focus:outline-none focus:ring">
                </div>
                <div>
                    <label class="block text-sm text-gray-600 mb-1">Years of Service</label>
                    <input type="number" x-model="bannerData.yrs_service"
                           class="w-full px-2 py-1 border rounded-md focus:outline-none focus:ring">
                </div>
            </div>
        </template>

        {{-- BACKGROUND IMAGE UPLOAD --}}
        <template x-if="editingField === 'background_image'">
            <form method="POST" action="{{ route('admin.section_banners.update', $sectionBanner->id) }}" enctype="multipart/form-data">
            >
                @csrf
                @method('PUT')

                {{-- Hidden to pass field_name to controller --}}
                <input type="hidden" name="field_name" value="background_image">

                <div class="mb-4">
                    <label class="block text-sm text-gray-600 mb-1">Upload New Background Image</label>
                    <input type="file" name="value"
                        required
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring">
                </div>

                <div class="flex justify-end space-x-2">
                    <button type="button"
                            @click="isEditModalOpen = false"
                            class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 text-sm">
                        Cancel
                    </button>
                    <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">
                        Save Image
                    </button>
                </div>
            </form>
        </template>

        {{-- BUTTONS --}}
        <div class="flex justify-end space-x-3" x-show="editingField !== 'background_image'">
            <button @click="isEditModalOpen = false"
                    class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400 text-sm">
                Cancel
            </button>
            <button @click="
                        if (editingField === 'stats') {
                            // already bound via x-model
                        } else {
                            updateBannerData(editingField, editingValue);
                        }
                        isEditModalOpen = false;"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm">
                Save
            </button>
        </div>
    </div>
</div>
