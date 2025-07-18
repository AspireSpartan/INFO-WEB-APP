{{-- resources/views/Components/Admin/newss/news_content.blade.php --}}
@props(['projects', 'description'])

<div class="bg-neutral-100 rounded-xl shadow-inner p-4 md:p-6 lg:p-8 mt-4 mx-4 md:mx-8 lg:mx-12 overflow-y-auto"
     x-data="{
        showUploadModal: false,
        openModal: false, // For editDescription modal
        showProjectEditModal: false, // New state for project edit modal
        editingProject: {}, // New property to hold the project data for editing
        currentProjectImageUrl: null // To manage image preview in project edit modal
     }"
     @open-admin-project-edit-modal.window="
         editingProject = $event.detail;
         showProjectEditModal = true;
         currentProjectImageUrl = editingProject.image_url ? (editingProject.image_url.startsWith('http') ? editingProject.image_url : '{{ asset('storage') }}/' + editingProject.image_url) : null;
     "
     @close-admin-project-edit-modal.window="showProjectEditModal = false;"
     @project-updated.window="() => {
         showProjectEditModal = false;
         window.location.reload(); // Simple reload to reflect changes
     }"
>
    <div class="min-h-screen bg-white font-sans text-gray-800 rounded-lg shadow-sm p-6">

        <div class="container mx-auto px-4 pt-20 pb-10 text-center relative"
            x-data="{ hover: false, openModal: false }"
            @mouseenter="hover = true"
            @mouseleave="hover = false"
            id="description-container"
        >
            <h1 class="text-5xl font-bold font-['Merriweather'] mb-8">
                Our <span class="text-amber-500">Complete Projects</span>
            </h1>
            <p class="text-xl font-light font-['Source_Sans_Pro'] leading-relaxed max-w-8xl mx-auto">
                {{ is_array($description->description) ? implode(', ', $description->description) : ($description->description ?? '') }}
            </p>

            <!-- Edit button shown on hover, centered overlay -->
            <button
                x-show="hover"
                @click="openModal = true"
                class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-30 text-white text-lg font-semibold rounded transition opacity-0 hover:opacity-100"
                aria-label="Edit description"
                id="edit-description-btn"
            >
                Edit
            </button>

            <!-- edit description modal component -->
            <x-Admin.blog.projects.editDescription
                :description="$description"
                x-show="openModal"
                @close="openModal = false"
                x-transition
                id="edit-description-modal"
            ></x-Admin.blog.projects.editDescription>
        </div>
        

        {{-- Container for Search, Upload, and Sort buttons --}}
        <div class="container mx-auto px-12 my-14 flex flex-col md:flex-row justify-between items-center gap-4 z-10">
            <form action="{{ route('projects.indexAdmin') }}" method="GET" class="relative w-full md:w-auto flex-grow max-w-xl flex items-center">
                <input type="text" name="search" placeholder="Search for a project..."
                    class="w-full pl-12 pr-4 py-2 border border-amber-400 rounded-[30px] bg-white focus:outline-none focus:ring-1 focus:ring-amber-500 text-gray-700 placeholder-zinc-400 font-montserrat"
                    value="{{ request('search') }}"
                    onkeydown="if(event.keyCode == 13) this.form.submit();">
                <button type="submit" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-amber-400">
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </form>

            <div class="flex flex-col sm:flex-row items-center gap-4 w-full md:w-auto justify-end">
                <div class="relative" x-data="{ sortByOpen: false }" @click.away="sortByOpen = false">
                    <button @click="sortByOpen = !sortByOpen" class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg shadow-sm hover:bg-gray-100 transition-colors">
                        <span>{{ match(request('sort_by')) { 'date_asc' => 'Date (Oldest)', default => 'Date (Newest)' } }}</span>
                        <svg class="w-4 h-4 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" :class="{'rotate-180': sortByOpen}">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="sortByOpen"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-36 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-10"
                        role="menu">
                        <div class="py-1">
                            <a href="{{ route('projects.indexAdmin', array_merge(request()->except('sort_by'), ['sort_by' => 'date_desc'])) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ request('sort_by', 'date_desc') == 'date_desc' ? 'bg-gray-100 font-semibold' : '' }}">Date (Newest)</a>
                            <a href="{{ route('projects.indexAdmin', array_merge(request()->except('sort_by'), ['sort_by' => 'date_asc'])) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ request('sort_by') == 'date_asc' ? 'bg-gray-100 font-semibold' : '' }}">Date (Oldest)</a>
                        </div>
                    </div>
                </div>

                {{-- Upload Project Button --}}
                <button class="flex items-center gap-2 px-6 py-2 bg-amber-400 hover:bg-amber-500 text-white text-lg font-normal rounded-lg transition-colors shadow-md"
                        @click="showUploadModal = true">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                    </svg>
                    Upload New Project
                </button>
            </div>
        </div>

        @if(session('success'))
            <div class="mt-4 p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mt-4 p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                {{ session('error') }}
            </div>
        @endif
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($projects as $project)
                {{-- Make sure this path is correct for your project cards --}}
                <x-Admin.blog.projects.project_cards :project="$project" :indexContent="$loop->index" />
            @endforeach
        </div>
    </div>

    {{-- Include the Project Upload Modal --}}
    @include('Components.Admin.blog.projects.projUpload_modal')

    {{-- Include the Project Edit Modal --}}
    <x-Admin.blog.projects.project_edit_modal x-show="showProjectEditModal" :project="$projects" @close-admin-project-edit-modal.window="showProjectEditModal = false;" style="display: none;"/>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editBtn = document.getElementById('edit-description-btn');
        const modal = document.getElementById('edit-description-modal');

        if (editBtn && modal) {
            editBtn.addEventListener('click', function () {
                // Show the modal by setting Alpine.js openModal to true
                // Since Alpine controls visibility, we can dispatch an event or toggle a class
                // Here we toggle the x-show attribute manually by dispatching a custom event
                modal.__x.$data.openModal = true; // Access Alpine component data directly
            });
        }
    });
</script>
