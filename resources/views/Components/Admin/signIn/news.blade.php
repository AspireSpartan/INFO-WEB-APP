<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin - News</title>
    <!-- Load Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts: Inter and Montserrat for consistent typography -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&family=Questrial&family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Load Alpine.js once and with defer -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        body {
            font-family: 'Inter', sans-serif; /* Default font */
        }
        .font-montserrat {
            font-family: 'Montserrat', sans-serif;
        }
        .font-questrial {
            font-family: 'Questrial', sans-serif;
        }
        .font-source-sans-pro {
            font-family: 'Source Sans Pro', sans-serif;
        }
        /* Custom styles for checkbox appearance, if using default HTML checkbox */
        input[type="checkbox"]:checked {
            background-color: #f59e0b; /* Amber-400 */
            border-color: #f59e0b;
        }
        input[type="checkbox"]:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(253, 224, 71, 0.5); /* Amber-200 with transparency */
        }
    </style>
</head>
<body class="bg-neutral-200 min-h-screen flex flex-col" x-data="{ showUploadModal: false }">

    <!-- Header Section -->
    <header class="relative w-full bg-gray-700 py-4 px-6 md:px-12 lg:px-20 flex items-center justify-between z-20">
        <!-- Logo -->
        <div class="flex items-center gap-2">
            <!-- Corrected path for CoreDev.svg using asset() helper -->
            <img src="{{ asset('storage/CoreDev.svg') }}" alt="COREDEV Logo" class="h-11 w-auto">
        </div>

        <!-- Desktop Navigation -->
        <nav class="hidden lg:flex items-center gap-x-8">
            <a href="/dashboard" class="text-white text-base font-normal font-questrial hover:text-amber-400 transition-colors">Dashboard</a>
            <a href="/news" class="text-amber-400 text-base font-normal font-questrial">News</a> <!-- Highlighted for active page -->
            <a href="/blog" class="text-white text-base font-normal font-questrial hover:text-amber-400 transition-colors">Blog</a>
            <a href="/contact" class="text-white text-base font-normal font-questrial hover:text-amber-400 transition-colors">Contact Us</a>
        </nav>

        <!-- Admin Profile with Dropdown -->
        <div class="relative flex items-center gap-4" x-data="{ open: false }" @click.away="open = false">
            <button @click="open = !open" class="flex items-center gap-4 focus:outline-none" aria-expanded="true" aria-haspopup="true" id="admin-menu-button">
                <span class="text-white text-base font-normal font-questrial hidden md:block">Admin</span>
                <img class="w-14 h-14 rounded-full object-cover" src="https://placehold.co/60x60/cccccc/white?text=Admin" alt="Admin Profile">
            </button>

            <!-- Dropdown menu -->
            <div x-show="open"
                 x-transition:enter="transition ease-out duration-100"
                 x-transition:enter-start="transform opacity-0 scale-95"
                 x-transition:enter-end="transform opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-75"
                 x-transition:leave-start="transform opacity-100 scale-100"
                 x-transition:leave-end="transform opacity-0 scale-95"
                 class="origin-top-right absolute top-full right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-30"
                 role="menu" aria-orientation="vertical" aria-labelledby="admin-menu-button" tabindex="-1">
                <div class="py-1" role="none">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">Profile</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">Settings</a>
                    <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100" role="menuitem" tabindex="-1"
                       @click.prevent="window.location.href = '/logout';">Logout</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Horizontal Line below header -->
    <div class="w-full h-px bg-neutral-400"></div>

    <!-- Main Content Area -->
    <main class="flex-grow p-4 md:p-8 lg:p-12">
        <!-- Changed text color to D4AF37 -->
        <h1 class="text-[#D4AF37] text-3xl font-semibold font-montserrat mb-8 mt-4 md:ml-8">News</h1>

        <!-- Search & Upload Bar -->
        <div class="flex flex-col md:flex-row justify-between items-center bg-transparent gap-4 mb-8">
            <div class="relative w-full md:w-auto flex-grow max-w-xl">
                <input type="text" placeholder="Search news"
                       class="w-full pl-12 pr-4 py-2 border border-amber-400 rounded-[30px] bg-white focus:outline-none focus:ring-1 focus:ring-amber-500 text-gray-700 placeholder-zinc-400 font-montserrat">
                <!-- Search Icon (SVG) -->
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="flex items-center gap-4 w-full md:w-auto justify-end">
                 <!-- Upload News Button - Added Alpine.js x-data and @click to open modal -->
                <button class="flex items-center gap-2 px-6 py-2 bg-amber-400 hover:bg-amber-500 text-white text-lg font-normal rounded-lg transition-colors shadow-md"
                        @click="showUploadModal = true;
                                $nextTick(() => {
                                    const today = new Date();
                                    const yyyy = today.getFullYear();
                                    const mm = String(today.getMonth() + 1).padStart(2, '0'); // Months start at 0!
                                    const dd = String(today.getDate()).padStart(2, '0');
                                    document.getElementById('newsDatePosted').value = `${yyyy}-${mm}-${dd}`;
                                });">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                    </svg>
                    Upload News
                </button>
                <!-- Trash/Delete Button -->
                <button class="p-2 bg-white rounded-lg shadow-md hover:bg-gray-100 transition-colors">
                    <svg class="w-6 h-6 text-amber-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 011-1h4a1 1 0 110 2H8a1 1 0 01-1-1zm2 3a1 1 0 011-1h2a1 1 0 110 2h-2a1 1 0 01-1-1zm0 3a1 1 0 011-1h2a1 1 0 110 2h-2a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Main Data Table Card -->
        <div class="bg-white rounded-xl shadow-xl overflow-hidden">
            <!-- Table Header -->
            <div class="bg-gray-200 px-6 py-4 grid grid-cols-8 gap-4 items-center text-neutral-400 text-lg font-semibold font-poppins">
                <div class="col-span-1 flex items-center gap-2">
                    <input type="checkbox" id="selectAll" class="h-4 w-4 rounded border-gray-300 text-amber-400 focus:ring-amber-400 cursor-pointer">
                    <label for="selectAll" class="text-black text-base font-light font-source-sans-pro">All</label>
                </div>
                <div class="col-span-1">Date Posted</div>
                <div class="col-span-2">Title</div>
                <div class="col-span-2">Description</div>
                <div class="col-span-1">Link</div>
                <div class="col-span-1 text-right">Actions</div> <!-- Added actions column header -->
            </div>

            <!-- Table Body Rows (Static Data) -->
            {{-- Static news data to pass to the component --}}
            @php
                $newsItems = [
                    [
                        'imageSrc' => 'storage/Department_of_Agriculture_of_the_Philippines.svg 1.svg',
                        'datePosted' => '15/06/2025',
                        'title' => 'Youth Leader Launches Park Clean-Up Drive in Cebu City',
                        'description' => 'Barangay volunteers join forces to restore green spaces.',
                        'linkHref' => 'https://cebudailynews.inquirer.net/642085/nonito-donaire-jr-flashes-brilliance-in-wba-interim-title-win'
                    ],
                    [
                        'imageSrc' => 'storage/Department_of_Agriculture_of_the_Philippines.svg 1.svg',
                        'datePosted' => '14/06/2025',
                        'title' => 'Local Government Approves New Infrastructure Projects',
                        'description' => 'New roads and bridges to improve connectivity in the region.',
                        'linkHref' => 'https://example.com/infrastructure-project'
                    ],
                    [
                        'imageSrc' => 'storage/Department_of_Agriculture_of_the_Philippines.svg 1.svg',
                        'datePosted' => '13/06/2025',
                        'title' => 'Community Workshop on Sustainable Farming Practices',
                        'description' => 'Farmers learn modern techniques for increased yield.',
                        'linkHref' => 'https://example.com/farming-workshop'
                    ],
                    [
                        'imageSrc' => 'storage/Department_of_Agriculture_of_the_Philippines.svg 1.svg',
                        'datePosted' => '12/06/2025',
                        'title' => 'Health Awareness Campaign Kicks Off in Local Schools',
                        'description' => 'Promoting healthy habits among students and faculty.',
                        'linkHref' => 'https://example.com/health-campaign'
                    ],
                    [
                        'imageSrc' => 'storage/Department_of_Agriculture_of_the_Philippines.svg 1.svg',
                        'datePosted' => '11/06/2025',
                        'title' => 'Art Festival Showcases Local Talents',
                        'description' => 'Artists from various disciplines display their masterpieces.',
                        'linkHref' => 'https://example.com/art-festival'
                    ],
                    [
                        'imageSrc' => 'storage/Department_of_Agriculture_of_the_Philippines.svg 1.svg',
                        'datePosted' => '10/06/2025',
                        'title' => 'Emergency Preparedness Drill Conducted for Residents',
                        'description' => 'Ensuring community readiness for natural disasters.',
                        'linkHref' => 'https://example.com/emergency-drill'
                    ],
                    [
                        'imageSrc' => 'storage/Department_of_Agriculture_of_the_Philippines.svg 1.svg',
                        'datePosted' => '09/06/2025',
                        'title' => 'New Public Library Opens its Doors to the Community',
                        'description' => 'A hub for learning and literacy for all ages.',
                        'linkHref' => 'https://example.com/new-library'
                    ],
                ];
            @endphp

            @foreach ($newsItems as $news)
                @include('Components.Admin.signIn.news_row', [
                    'imageSrc' => $news['imageSrc'],
                    'datePosted' => $news['datePosted'],
                    'title' => $news['title'],
                    'description' => $news['description'],
                    'linkHref' => $news['linkHref']
                ])
            @endforeach

        </div>
    </main>

    <!-- Upload News Modal (Alpine.js controlled) -->
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
            <h2 class="text-2xl font-bold text-gray-800 mb-6 font-montserrat">Upload New News Item</h2>

            <form>
                <div class="mb-4">
                    <label for="newsImage" class="block text-gray-700 text-sm font-bold mb-2">News Image</label>
                    <input type="file" id="newsImage" name="news_image" accept="image/*"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-amber-400">
                </div>
                <div class="mb-4">
                    <label for="newsDatePosted" class="block text-gray-700 text-sm font-bold mb-2">Date Posted</label>
                    <input type="date" id="newsDatePosted" name="news_date_posted" readonly
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight bg-gray-100 cursor-not-allowed">
                </div>
                <div class="mb-4">
                    <label for="newsTitle" class="block text-gray-700 text-sm font-bold mb-2">Title (Max 50 chars)</label>
                    <input type="text" id="newsTitle" name="news_title" maxlength="50"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-amber-400"
                           placeholder="Enter news title">
                </div>
                <div class="mb-4">
                    <label for="newsDescription" class="block text-gray-700 text-sm font-bold mb-2">Description (Max 100 chars)</label>
                    <textarea id="newsDescription" name="news_description" rows="3" maxlength="100"
                              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-amber-400"
                              placeholder="Write a brief description..."></textarea>
                </div>
                <div class="mb-6">
                    <label for="newsLink" class="block text-gray-700 text-sm font-bold mb-2">Link</label>
                    <input type="url" id="newsLink" name="news_link"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-amber-400"
                           placeholder="Enter news link (e.g., https://example.com/news)">
                </div>
                <div class="flex justify-end gap-4">
                    <button type="button" @click="showUploadModal = false"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded transition-colors">
                        Cancel
                    </button>
                    <button type="submit"
                            class="bg-amber-400 hover:bg-amber-500 text-white font-bold py-2 px-4 rounded transition-colors">
                        Submit News
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
