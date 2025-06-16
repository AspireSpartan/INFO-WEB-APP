{{-- resources/views/Components/Admin/blog_content.blade.php --}}

<div class="bg-neutral-100 rounded-xl shadow-inner p-4 md:p-6 lg:p-8 mt-4 mx-4 md:mx-8 lg:mx-12 overflow-y-auto"> {{-- New outer container with overflow-y-auto --}}
    <main class="p-4 md:p-8 lg:p-12 bg-white rounded-lg shadow-sm"> {{-- Added a background and shadow to the main content for better visual separation --}}
        <!-- Header with Add New Button -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 mt-4 md:ml-8 gap-4">
            <h1 class="text-[#D4AF37] text-3xl font-semibold font-montserrat w-full md:w-auto">Blog Posts</h1>
            <button class="flex items-center justify-center gap-2 px-6 py-2 bg-[#D4AF37] hover:bg-amber-500 text-white text-lg font-normal rounded-lg transition-colors shadow-md w-full md:w-auto">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add New Post
            </button>
        </div>

        <!-- Search/Filter Bar -->
        <div class="flex flex-col md:flex-row justify-between items-center bg-transparent gap-4 mb-8">
            <div class="relative w-full md:w-auto flex-grow max-w-xl">
                <input type="text" placeholder="Search blog posts"
                       class="w-full pl-12 pr-4 py-2 border border-[#D4AF37] rounded-[30px] bg-white focus:outline-none focus:ring-1 focus:ring-amber-500 text-gray-700 placeholder-zinc-400 font-montserrat">
                <!-- Search Icon (SVG) -->
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-[#D4AF37]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                </svg>
            </div>
            {{-- Placeholder for additional filter options if needed later --}}
            {{--
            <select class="px-4 py-2 border border-gray-300 rounded-md bg-white text-gray-700 focus:outline-none focus:ring-1 focus:ring-amber-500">
                <option>All Categories</option>
                <option>Technology</option>
                <option>Design</option>
                <option>Security</option>
            </select>
            --}}
        </div>

        <!-- Blog Posts Grid (Cards/Tiles) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @php
                $blogPosts = [
                    [
                        'image' => 'https://placehold.co/400x250/D4AF37/ffffff?text=Future+of+Web',
                        'title' => 'The Future of Web Development in 2025',
                        'description' => 'A comprehensive look at upcoming technologies and trends shaping the web, focusing on performance, security, and user experience.',
                        'date' => 'June 10, 2025',
                    ],
                    [
                        'image' => 'https://placehold.co/400x250/D4AF37/ffffff?text=AI+in+Design',
                        'title' => 'AI\'s Role in Modern UI/UX Design Workflow',
                        'description' => 'Exploring how artificial intelligence is transforming design processes, from prototyping to user testing and personalization, enhancing efficiency.',
                        'date' => 'June 08, 2025',
                    ],
                    [
                        'image' => 'https://placehold.co/400x250/D4AF37/ffffff?text=Cloud+Security',
                        'title' => 'Securing Your Cloud Infrastructure: Best Practices',
                        'description' => 'Essential tips and strategies to protect your data in the cloud, including access control, encryption, and continuous monitoring.',
                        'date' => 'June 05, 2025',
                    ],
                    [
                        'image' => 'https://placehold.co/400x250/D4AF37/ffffff?text=Mobile+First',
                        'title' => 'Mobile-First Development: A Necessity, Not an Option',
                        'description' => 'Understanding why prioritizing mobile experience is crucial for success in today\'s digital landscape and improving accessibility for all users.',
                        'date' => 'June 03, 2025',
                    ],
                     [
                        'image' => 'https://placehold.co/400x250/D4AF37/ffffff?text=VR+Gaming',
                        'title' => 'The Rise of VR Gaming: What to Expect Next',
                        'description' => 'A deep dive into the immersive world of virtual reality entertainment, discussing new hardware, game releases, and industry growth.',
                        'date' => 'May 29, 2025',
                    ],
                    [
                        'image' => 'https://placehold.co/400x250/D4AF37/ffffff?text=Blockchain+Basics',
                        'title' => 'Blockchain Explained: Beyond the Hype',
                        'description' => 'Demystifying the core concepts and real-world applications of blockchain technology, covering its impact on finance, supply chain, and more.',
                        'date' => 'May 25, 2025',
                    ],
                    [
                        'image' => 'https://placehold.co/400x250/D4AF37/ffffff?text=Cybersecurity',
                        'title' => 'Cybersecurity Threats in 2025: A Proactive Approach',
                        'description' => 'Identifying emerging cyber threats and offering proactive measures to protect individuals and organizations from evolving risks and attacks.',
                        'date' => 'May 20, 2025',
                    ],
                    [
                        'image' => 'https://placehold.co/400x250/D4AF37/ffffff?text=Green+Tech',
                        'title' => 'Green Technology Innovations for a Sustainable Future',
                        'description' => 'Highlighting advancements in eco-friendly technologies, including renewable energy, sustainable manufacturing, and smart environmental solutions.',
                        'date' => 'May 18, 2025',
                    ],
                ];
            @endphp

            @foreach($blogPosts as $post)
                @include('Components.Admin.blog.blog_cards', [
                    'image' => $post['image'],
                    'title' => $post['title'],
                    'description' => $post['description'],
                    'date' => $post['date']
                ])
            @endforeach
        </div>
    </main>
</div>
