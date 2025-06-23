{{-- resources/views/Components/Admin/blog_content.blade.php --}}

<div class="bg-neutral-100 rounded-xl shadow-inner p-4 md:p-6 lg:p-8 mt-4 mx-4 md:mx-8 lg:mx-12 overflow-y-auto">
    <main class="p-4 md:p-8 lg:p-12 bg-white rounded-lg shadow-sm">
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 mt-4 md:ml-8 gap-4">
            <h1 class="text-[#D4AF37] text-3xl font-semibold font-montserrat w-full md:w-auto">Personnel Directory</h1>
            <button class="flex items-center justify-center gap-2 px-6 py-2 bg-[#D4AF37] hover:bg-amber-500 text-white text-lg font-normal rounded-lg transition-colors shadow-md w-full md:w-auto">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add New Personnel
            </button>
        </div>

        <div class="flex flex-col md:flex-row justify-between items-center bg-transparent gap-4 mb-8">
            <div class="relative w-full md:w-auto flex-grow max-w-xl">
                <input type="text" placeholder="Search personnel"
                       class="w-full pl-12 pr-4 py-2 border border-[#D4AF37] rounded-[30px] bg-white focus:outline-none focus:ring-1 focus:ring-amber-500 text-gray-700 placeholder-zinc-400 font-montserrat">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-[#D4AF37]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                </svg>
            </div>
            {{-- Placeholder for additional filter options if needed later --}}
            {{--
            <select class="px-4 py-2 border border-gray-300 rounded-md bg-white text-gray-700 focus:outline-none focus:ring-1 focus:ring-amber-500">
                <option>All Departments</option>
                <option>Executive</option>
                <option>Operations</option>
                <option>Human Resources</option>
            </select>
            --}}
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @php
                $personnel = [
                    [
                        'image' => 'https://placehold.co/400x250/D4AF37/ffffff?text=Gov.+Image',
                        'name' => 'Governor John Doe',
                        'description' => 'Serving the province with dedication and a vision for sustainable growth and community development. Focused on improving public services.',
                        'job_title' => 'Governor',
                    ],
                    [
                        'image' => 'https://placehold.co/400x250/D4AF37/ffffff?text=Vice+Gov.+Image',
                        'name' => 'Vice Governor Jane Smith',
                        'description' => 'Works closely with the Governor to implement policies and programs, with a focus on legislative initiatives and local governance.',
                        'job_title' => 'Vice Governor',
                    ],
                    [
                        'image' => 'https://placehold.co/400x250/D4AF37/ffffff?text=Councilor+Image',
                        'name' => 'Councilor Mark Johnson',
                        'description' => 'A dedicated public servant committed to urban planning and infrastructure development, ensuring efficient and modern public facilities.',
                        'job_title' => 'City Councilor',
                    ],
                    [
                        'image' => 'https://placehold.co/400x250/D4AF37/ffffff?text=Secretary+Image',
                        'name' => 'Secretary Emily White',
                        'description' => 'Oversees administrative functions and ensures effective communication within the provincial government and with external partners.',
                        'job_title' => 'Provincial Secretary',
                    ],
                    [
                        'image' => 'https://placehold.co/400x250/D4AF37/ffffff?text=Dept.+Head+Image',
                        'name' => 'Department Head David Green',
                        'description' => 'Leads the Department of Agriculture, implementing initiatives to boost agricultural productivity and support local farmers.',
                        'job_title' => 'Head of Agriculture Dept.',
                    ],
                    [
                        'image' => 'https://placehold.co/400x250/D4AF37/ffffff?text=Finance+Image',
                        'name' => 'Treasurer Olivia Brown',
                        'description' => 'Manages the provincial treasury, ensuring sound financial management and transparent allocation of public funds.',
                        'job_title' => 'Provincial Treasurer',
                    ],
                    [
                        'image' => 'https://placehold.co/400x250/D4AF37/ffffff?text=Health+Image',
                        'name' => 'Dr. Robert Black',
                        'description' => 'Heads the Provincial Health Office, focusing on public health programs, disease prevention, and improving healthcare access for all.',
                        'job_title' => 'Provincial Health Officer',
                    ],
                    [
                        'image' => 'https://placehold.co/400x250/D4AF37/ffffff?text=Tourism+Image',
                        'name' => 'Tourism Officer Sarah Davis',
                        'description' => 'Promotes local tourism and cultural heritage, developing strategies to attract visitors and create economic opportunities.',
                        'job_title' => 'Provincial Tourism Officer',
                    ],
                ];
            @endphp

            @foreach($personnel as $person)
                @include('Components.Admin.blog.blog_cards', [
                    'image' => $person['image'],
                    'name' => $person['name'],
                    'description' => $person['description'],
                    'job_title' => $person['job_title']
                ])
            @endforeach
        </div>
    </main>
</div>