@props(['concerns'])
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6" style="color: black;">Manage Reported Concerns</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b border-gray-300 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Reporter</th>
                    <th class="px-6 py-3 border-b border-gray-300 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 border-b border-gray-300 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Location</th>
                    <th class="px-6 py-3 border-b border-gray-300 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Description</th>
                    <th class="px-6 py-3 border-b border-gray-300 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 border-b border-gray-300 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Action</th>
                    <th class="px-6 py-3 border-b border-gray-300 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($concerns as $concern)
                <tr>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">
                        <div class="text-sm leading-5 font-medium text-gray-900">{{ $concern->reporter_name }}</div>
                        <div class="text-sm leading-5 text-gray-500">{{ $concern->reporter_email }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">
                        <div class="text-sm leading-5 text-gray-900">{{ $concern->concern_date }}</div>
                        <div class="text-sm leading-5 text-gray-500">{{ $concern->concern_time }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">
                        <div class="text-sm leading-5 text-gray-900">{{ $concern->concern_barangay }}</div>
                        <div class="text-sm leading-5 text-gray-500">{{ $concern->concern_barangay_details }}</div>
                    </td>
                    <td class="px-6 py-4 border-b border-gray-300">
                        <div class="text-sm leading-5 text-gray-900">{{ Str::limit($concern->concern_description, 100) }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $concern->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                               ($concern->status == 'working' ? 'bg-blue-100 text-blue-800' : 
                               'bg-green-100 text-green-800') }}">
                            {{ ucfirst($concern->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $concern->action == 'priority' ? 'bg-orange-100 text-orange-800' : 'bg-red-100 text-red-800' }}">
                            {{ ucfirst($concern->action) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-300 text-sm leading-5 font-medium">
                        <div x-data="{ showModal: false, concernId: '{{ $concern->id }}' }">
    <button @click="showModal = true" class="text-indigo-600 hover:text-indigo-900">Edit</button>
    <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                <div class="hidden sm:block absolute top-0 right-0 pt-4 pr-4">
                    <button @click="showModal = false" type="button" class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <template x-if="showModal">
                    @include('Components.Admin.reported_concerns.edit', ['concern' => $concerns->find($concern->id)])
                </template>
            </div>
        </div>
    </div>
</div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="mt-4">
         @if ($concerns instanceof \Illuminate\Pagination\LengthAwarePaginator)
            {{ $concerns->links() }}
        @else
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">The concerns variable is not a paginator instance.</span>
            </div>
        @endif
    </div>
</div>