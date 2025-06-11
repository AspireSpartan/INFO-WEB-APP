<!-- HERO SECTION: Background image, gradients, and intro -->
<div class="relative min-h-screen bg-cover bg-center pt-24" style="background-image: url('{{ asset('storage/lgu_bg.svg') }}');">
    {{-- Background Overlay --}} 
    <div class="absolute inset-0 bg-gray-700/50"></div>

    {{-- Mobile Menu (Hidden by default, shown with Alpine.js) --}}
    <div class="lg:hidden fixed inset-0 z-50 bg-black bg-opacity-75" x-cloak x-show="mobileMenuOpen"
         x-transition:enter="transition ease-in-out duration-300 transform"
         x-transition:enter-start="translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in-out duration-300 transform"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="translate-x-full">
        <div class="fixed inset-y-0 right-0 w-3/4 max-w-sm bg-gray-900 p-6 shadow-lg">
            <div class="flex justify-between items-center mb-6">
                {{-- Logo for mobile menu --}}
                <div class="flex items-center gap-2">
                    <img src="{{ asset('images/coredev-logo.png') }}" alt="COREDEV Logo" class="h-10 w-auto">
                </div>
                <button type="button" class="text-gray-400 hover:text-white" @click="mobileMenuOpen = false">
                    <span class="sr-only">Close menu</span>
                    <svg class="size-8" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <nav class="flex flex-col gap-4">
                <a href="#" class="block text-white text-lg font-normal font-['Questrial'] hover:text-amber-400 py-2">Home</a>

                {{-- Mobile Services Dropdown --}}
                <div x-data="{ mobileServicesOpen: false }">
                    <button type="button" class="flex items-center justify-between w-full text-white text-lg font-normal font-['Questrial'] hover:text-amber-400 py-2"
                            @click="mobileServicesOpen = !mobileServicesOpen">
                        Services
                        <svg class="size-5 transition-transform duration-200"
                             :class="{ 'rotate-180': mobileServicesOpen }" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="mobileServicesOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-1"
                         class="pl-4 mt-2 space-y-2">
                        <a href="#" class="block text-gray-300 text-base hover:text-amber-400">Service 1</a>
                        <a href="#" class="block text-gray-300 text-base hover:text-amber-400">Service 2</a>
                        <a href="#" class="block text-gray-300 text-base hover:text-amber-400">Service 3</a>
                    </div>
                </div>

                {{-- Mobile Blog Dropdown --}}
                <div x-data="{ mobileBlogOpen: false }">
                    <button type="button" class="flex items-center justify-between w-full text-white text-lg font-normal font-['Questrial'] hover:text-amber-400 py-2"
                            @click="mobileBlogOpen = !mobileBlogOpen">
                        Blog
                        <svg class="size-5 transition-transform duration-200"
                             :class="{ 'rotate-180': mobileBlogOpen }" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="mobileBlogOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-1"
                         class="pl-4 mt-2 space-y-2">
                        <a href="#" class="block text-gray-300 text-base hover:text-amber-400">Article 1</a>
                        <a href="#" class="block text-gray-300 text-base hover:text-amber-400">Article 2</a>
                        <a href="#" class="block text-gray-300 text-base hover:text-amber-400">Article 3</a>
                    </div>
                </div>

                <a href="#" class="block text-white text-lg font-normal font-['Questrial'] hover:text-amber-400 py-2">Contact Us</a>
                <a href="#" class="block bg-amber-400 text-white text-lg font-normal font-['Segoe_UI'] py-2 px-8 rounded-[30px] text-center hover:bg-amber-500 transition-colors mt-4">Sign In</a>
            </nav>
        </div>
    </div>

    {{-- Hero Content --}}
    <div class="relative z-10 flex flex-col items-center justify-center h-[calc(100vh-theme(spacing.24))] text-center px-4">
        <div class="max-w-3xl space-y-4 md:space-y-6 lg:space-y-8">
            <p class="text-white text-lg md:text-xl font-normal font-['Noto_Sans']">“DRIVEN BY INNOVATION</p>
            <h1 class="text-white text-4xl md:text-5xl lg:text-6xl font-bold font-['Merriweather'] leading-tight">Local Government Unit</h1>
            <p class="text-white text-xl md:text-2xl lg:text-3xl font-normal font-['Roboto']">
                Serving the community with <span class="text-amber-400">transparency</span>,
                <span class="text-amber-400">Integrity</span>, <br class="hidden sm:inline"/>and <span class="text-amber-400">commitment</span>.
            </p>
            <p class="text-white text-base md:text-lg font-normal font-['Source_Sans_Pro']">
                <span class="inline-block transform rotate-90 scale-x-[-1] text-2xl relative top-1 right-1">/</span>BREAKING BOUNDARIES
            </p>
        </div>
    </div>

    {{-- Bottom Bar with Statistics --}}
    <div class="relative z-10 w-full bg-zinc-500/20 shadow-md py-4 md:py-6 lg:py-8 px-4 sm:px-8 lg:px-16 mt-auto">
        <div class="flex flex-col sm:flex-row justify-around items-center gap-6 md:gap-12 lg:gap-24">
            <div class="text-center">
                <div class="text-white text-3xl md:text-4xl font-bold font-['Montserrat']">24</div>
                <div class="text-white text-sm md:text-lg font-light font-['Source_Sans_Pro']">barangay</div>
            </div>
            <div class="text-center">
                <div class="text-white text-3xl md:text-4xl font-bold font-['Montserrat']">1500+</div>
                <div class="text-white text-sm md:text-lg font-light font-['Source_Sans_Pro']">Residents</div> {{-- Changed from barangay based on common website stats --}}
            </div>
            <div class="text-center">
                <div class="text-white text-3xl md:text-4xl font-bold font-['Montserrat']">120+</div>
                <div class="text-white text-sm md:text-lg font-light font-['Source_Sans_Pro']">Public Projects</div>
            </div>
            <div class="text-center">
                <div class="text-white text-3xl md:text-4xl font-bold font-['Montserrat']">75</div>
                <div class="text-white text-sm md:text-lg font-light font-['Source_Sans_Pro']">Years of Service</div>
            </div>
        </div>
        {{-- Horizontal Line above the bottom text --}}
        <div class="w-full h-px bg-white/50 my-6"></div>
        {{-- Bottom Description --}}
        <p class="relative z-10 text-center text-white text-xs md:text-sm lg:text-base font-light font-['Montserrat'] max-w-5xl mx-auto px-4 md:px-0">
            Local Government Units (LGUs) in the Philippines play a vital role in implementing national policies at the grassroots level while addressing the specific needs of their communities. These units, which include provinces, cities, municipalities, and barangays, are granted autonomy under the Local Government Code of 1991. LGUs are responsible for delivering basic services such as health care, education, infrastructure, and disaster response. They are also tasked with promoting local development through planning, budgeting, and legislation. Despite challenges like limited resources and political interference, many LGUs have successfully launched innovative programs to uplift their constituents and promote inclusive growth.
        </p>
    </div>
</div>

  <script>
      document.addEventListener('alpine:init', () => {
          Alpine.data('mobileMenuState', () => ({
              mobileMenuOpen: false,
          }))
      })
  </script>