
<div
    x-show="showMainModal"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-100"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
    class="fixed inset-0 bg-black bg-opacity-40 flex justify-center items-center z-50 p-4"
    @click.self="showMainModal = false; activeSubModal = null"
>
    <div
        class="bg-white rounded-2xl shadow-2xl max-w-md w-full m-4 relative flex flex-col max-h-[90vh]"
        @keydown.escape.window="showMainModal = false; activeSubModal = null"
        x-trap.noscroll
    >
        <div class="flex items-center justify-between p-6 pb-4">
            <h2 class="text-xl font-medium text-gray-900">Edit Content</h2>
            <button
                @click="showMainModal = false; activeSubModal = null"
                class="text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 rounded-full p-1 transition-colors duration-200"
                aria-label="Close"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="flex-grow overflow-y-auto px-6 py-2">
            <p class="text-gray-600 mb-6 text-sm">Select an area to edit its content.</p>

            <div class="grid grid-cols-1 gap-3">
                <button
                    @click="window.dispatchEvent(new CustomEvent('open-sub-modal', { detail: 'keepInTouch' }))"
                    class="group flex items-center w-full text-left p-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2
                           transition-all duration-200 ease-out transform
                           hover:bg-gray-50 hover:shadow-sm hover:scale-[1.01]"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 mr-3 transition-colors duration-200 group-hover:text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <span class="text-gray-800 font-medium transition-colors duration-200 group-hover:text-gray-900">Edit Keep In Touch Area</span>
                </button>

                <button
                    @click="window.dispatchEvent(new CustomEvent('open-sub-modal', { detail: 'aboutGovph' }))"
                    class="group flex items-center w-full text-left p-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2
                           transition-all duration-200 ease-out transform
                           hover:bg-gray-50 hover:shadow-sm hover:scale-[1.01]"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600 mr-3 transition-colors duration-200 group-hover:text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-gray-800 font-medium transition-colors duration-200 group-hover:text-gray-900">Edit About GOVPH Area</span>
                </button>

                <button
                    @click="window.dispatchEvent(new CustomEvent('open-sub-modal', { detail: 'governmentLinks' }))"
                    class="group flex items-center w-full text-left p-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2
                           transition-all duration-200 ease-out transform
                           hover:bg-gray-50 hover:shadow-sm hover:scale-[1.01]"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600 mr-3 transition-colors duration-200 group-hover:text-purple-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                    <span class="text-gray-800 font-medium transition-colors duration-200 group-hover:text-gray-900">Edit Government Links Area</span>
                </button>

                <button
                    @click="window.dispatchEvent(new CustomEvent('open-sub-modal', { detail: 'contactUs' }))"
                    class="group flex items-center w-full text-left p-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2
                           transition-all duration-200 ease-out transform
                           hover:bg-gray-50 hover:shadow-sm hover:scale-[1.01]"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-600 mr-3 transition-colors duration-200 group-hover:text-orange-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684L10.25 2l2.365 2.365a1 1 0 01.684.948V21a2 2 0 01-2 2H5a2 2 0 01-2-2V5z" />
                    </svg>
                    <span class="text-gray-800 font-medium transition-colors duration-200 group-hover:text-gray-900">Edit Contact Us! Area</span>
                </button>

                <button
                    @click="window.dispatchEvent(new CustomEvent('open-sub-modal', { detail: 'logo' }))"
                    class="group flex items-center w-full text-left p-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2
                           transition-all duration-200 ease-out transform
                           hover:bg-gray-50 hover:shadow-sm hover:scale-[1.01]"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600 mr-3 transition-colors duration-200 group-hover:text-red-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="text-gray-800 font-medium transition-colors duration-200 group-hover:text-gray-900">Edit Logo Area</span>
                </button>
            </div>
        </div>
    </div>
</div>