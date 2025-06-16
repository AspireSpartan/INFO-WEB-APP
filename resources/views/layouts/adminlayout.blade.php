<!DOCTYPE html>
<html lang="en" x-data="screenTransition()" x-init="init()">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&family=Questrial&family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet" />

    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            overflow-y: scroll;               /* Always allow scroll */
            -ms-overflow-style: none;         /* IE and Edge */
            scrollbar-width: none;            /* Firefox */
        }
        body::-webkit-scrollbar {
            display: none;                    /* Chrome, Safari, Edge */
        }
        .font-montserrat { font-family: 'Montserrat', sans-serif; }
        .font-questrial { font-family: 'Questrial', sans-serif; }
        .font-source-sans-pro { font-family: 'Source Sans Pro', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>

<body class="bg-neutral-200 min-h-screen flex flex-col">

    <!-- Header -->
    <header class="relative w-full bg-gray-700 py-4 px-6 md:px-12 lg:px-20 flex items-center justify-between z-20">
        <div class="flex items-center gap-2">
            <img src="{{ asset('storage/CoreDev.svg') }}" alt="COREDEV Logo" class="h-11 w-auto" />
        </div>

        <!-- Navigation -->
        <nav class="hidden lg:flex items-center gap-x-8">
            <template x-for="screen in ['dashboard', 'news', 'blog', 'contact']">
                <a href="#"
                   @click.prevent="switchScreen(screen)"
                   :class="{'text-amber-400': activeScreen === screen, 'text-white': activeScreen !== screen}"
                   class="text-base font-normal font-questrial hover:text-amber-400 transition-colors capitalize"
                   x-text="screen">
                </a>
            </template>
        </nav>

        <!-- Admin Profile -->
        <div class="relative flex items-center gap-4" x-data="{ open: false }" @click.away="open = false">
            <button @click="open = !open" class="flex items-center gap-4 focus:outline-none">
                <span class="text-white text-base font-normal font-questrial hidden md:block">Admin</span>
                <img class="w-14 h-14 rounded-full object-cover" src="https://placehold.co/60x60/cccccc/white?text=Admin" alt="Admin Profile" />
            </button>

            <!-- Dropdown -->
            <div x-show="open"
                 x-transition:enter="transition ease-out duration-100"
                 x-transition:enter-start="transform opacity-0 scale-95"
                 x-transition:enter-end="transform opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-75"
                 x-transition:leave-start="transform opacity-100 scale-100"
                 x-transition:leave-end="transform opacity-0 scale-95"
                 class="origin-top-right absolute top-full right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-30"
                 role="menu">
                <div class="py-1">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                    <a href="/logout" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Logout</a>
                </div>
            </div>
        </div>
    </header>

    <div class="w-full h-px bg-neutral-400"></div>

    <!-- Main Screen Transitions -->
    <main class="flex-grow relative bg-white">
        <template x-for="screen in ['dashboard', 'news', 'blog', 'contact']" :key="screen">
            <div
                x-show="activeScreen === screen"
                x-transition:enter="transition-opacity duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity duration-300"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                x-cloak
                class="absolute top-0 left-0 w-full h-full"
            >
                <template x-if="screen === 'dashboard'">
                    <div>@include('Components.Admin.dashboard.dashboard_content')</div>
                </template>
                <template x-if="screen === 'news'">
                    <div>@include('Components.Admin.newss.news_content')</div>
                </template>
                <template x-if="screen === 'blog'">
                    <div>@include('Components.Admin.blog.blog_content')</div>
                </template>
                <template x-if="screen === 'contact'">
                    <div class="p-8 text-gray-700">This is the Contact Us content area.</div>
                </template>
            </div>
        </template>
    </main>

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

    <!-- Alpine.js Screen Switch Logic -->
    <script>
        function screenTransition() {
            return {
                activeScreen: 'dashboard',
                isTransitioning: false,
                showUploadModal: false,

                async switchScreen(target) {
                    if (this.isTransitioning || this.activeScreen === target) return;
                    this.isTransitioning = true;

                    const oldScreenElement = this.$el.querySelector(`.absolute.w-full.h-full[x-show="activeScreen === '${this.activeScreen}'"]`);
                    if (oldScreenElement) {
                        oldScreenElement.classList.add('opacity-0');
                        await new Promise(resolve => setTimeout(resolve, 300));
                    }
                    this.activeScreen = null;
                    await new Promise(resolve => setTimeout(resolve, 10));
                    this.activeScreen = target;
                    await new Promise(resolve => setTimeout(resolve, 300));
                    this.isTransitioning = false;
                },

                init() {
                    this.activeScreen = 'dashboard';
                    this.$watch('showUploadModal', (value) => {
                        if (value) {
                            this.$nextTick(() => {
                                const today = new Date();
                                const yyyy = today.getFullYear();
                                const mm = String(today.getMonth() + 1).padStart(2, '0');
                                const dd = String(today.getDate()).padStart(2, '0');
                                const dateInput = document.getElementById('newsDatePosted');
                                if (dateInput) {
                                    dateInput.value = `${yyyy}-${mm}-${dd}`;
                                }
                            });
                        }
                    });
                }
            };
        }
    </script>
</body>
</html>
