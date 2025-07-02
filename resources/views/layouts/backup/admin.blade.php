<!DOCTYPE html>
<html lang="en" x-data="screenTransition()" x-init="init()">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title')</title> 

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&family=Questrial&family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Questrial&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Merriweather&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="{{ asset('js/screentransition.js') }}" defer></script>
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- Add other global stylesheets and scripts here -->

    {{-- Include the banner-specific styles here --}}
    @include('Components.Admin.Content-Manager.banner.banner-styles')
    
</head>
<body class="bg-neutral-200 min-h-screen flex flex-col">

    <!-- Header -->

    <div class="w-full h-px bg-neutral-400"></div>

    <!-- Main Screen Transitions -->
    <main>
        @yield('content')
    </main>

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
