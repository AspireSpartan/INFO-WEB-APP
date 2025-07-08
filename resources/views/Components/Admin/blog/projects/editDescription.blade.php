@props(['description'])
<div
    x-cloak
    x-show="openModal" {{-- Show/hide modal based on Alpine state --}}
    @keydown.escape.window="$dispatch('close')"
    @click.away="$dispatch('close')"
    @close.window="openModal = false" {{-- Listen for close event to hide modal --}}
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
>
    <div class="bg-white rounded-lg shadow-lg max-w-3xl w-full p-6 relative" @click.stop>
        <button @click="$dispatch('close')" class="absolute top-3 right-3 text-gray-600 hover:text-gray-900">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <h3 class="text-xl font-semibold mb-4">Edit Project Description</h3>
        <form method="POST" action="{{ route('project-description.update') }}">
            @csrf
            <textarea name="description" rows="6" class="w-full border rounded p-2" required>{{ old('description', $description->description ?? '') }}</textarea>
            <div class="mt-4 flex justify-end gap-2">
                <button type="button" @click="$dispatch('close')" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-amber-500 text-white rounded hover:bg-amber-600">Save Changes</button>
            </div>
        </form>
    </div>
</div>