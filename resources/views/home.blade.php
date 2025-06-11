<x-layout>
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

      

      {{-- 
    TEAM SECTION: Static team members, not dynamic
    --}}
<div class="bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
          <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">Meet Your LGU Team</h2>
            <p class="mt-6 text-lg leading-8 text-gray-600">
              Our dedicated LGU officials and staff are committed to serving the people of our municipality. Together, we strive for progress, transparency, and inclusive growth for every Filipino family.
            </p>
          </div>
          <ul role="list" class="mx-auto mt-20 grid max-w-4xl grid-cols-1 gap-x-8 gap-y-16 sm:grid-cols-2 lg:grid-cols-3">
            <!-- Team Member 1 -->
            <li class="flex flex-col items-center">
              <img class="w-full h-56 object-cover rounded-2xl" src="https://scontent.fceb3-1.fna.fbcdn.net/v/t39.30808-6/495261489_2871703749669777_6522045126610493016_n.jpg?_nc_cat=109&ccb=1-7&_nc_sid=6ee11a&_nc_eui2=AeH_g-w0RLHevJk6nfqaTj4pEnxHZJBTAqYSfEdkkFMCppz2lmIJQ3s0EMvtQhooCb6O1IQT2q_rZbXHGSIHM9Wm&_nc_ohc=NFu2vwgFPDcQ7kNvwHRFEjQ&_nc_oc=AdmOrviEPCDPSsRtjQ5NB-zh6E6CLHKr_MBtBaR_9Ay0N0BtFK5UenG3Rh9yomxoBQA&_nc_zt=23&_nc_ht=scontent.fceb3-1.fna&_nc_gid=5d6tl63VW7VJ55wETsu5Cg&oh=00_AfOIyd3h88CVkmyXqiOtb1lvvGMY9y1o5nXEq-Ww0Vqk-Q&oe=68472B40" alt="">
              <div class="mt-6 text-center">
                <h3 class="text-lg font-semibold text-gray-900">Janpaul Bustillo</h3>
                <p class="text-gray-600">Municipal Administrator</p>
                <div class="mt-4 flex justify-center gap-x-4">
                  <!-- Social Links -->
                  <a href="#" class="text-gray-400 hover:text-gray-500">
                    <span class="sr-only">Facebook</span>
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg>
                  </a>
                  <a href="#" class="text-gray-400 hover:text-gray-500">
                    <span class="sr-only">LinkedIn</span>
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M16 8a6 6 0 01-12 0 6 6 0 0112 0zm-6 8a8 8 0 100-16 8 8 0 000 16zm-2-7h2v6H8v-6zm1-1a1 1 0 110-2 1 1 0 010 2zm4 1h2v3.5a1.5 1.5 0 01-3 0V10h1v1.5a.5.5 0 001 0V10z"/></svg>
                  </a>
                </div>
              </div>
            </li>
            <!-- Team Member 2 -->
            <li class="flex flex-col items-center">
              <img class="w-full h-56 object-cover rounded-2xl" src="https://scontent.fceb3-1.fna.fbcdn.net/v/t39.30808-6/439979555_8425004204192885_23963868889279716_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=6ee11a&_nc_eui2=AeH0U-Pj3hxQAzBvEnJgxIruFNYu4MGlHV4U1i7gwaUdXvUeN7T4iLdxMiU0_Zh9qgjKDCgCiQmkRE8jFOZ0t4oj&_nc_ohc=v27J0bsB-uUQ7kNvwFo1Am2&_nc_oc=AdlK77MB2TJUtnLVPRfMHQY2yH2Q9iBeObcXQeqSvmvXnjmZWqYcSu3idPuad0CgVbs&_nc_zt=23&_nc_ht=scontent.fceb3-1.fna&_nc_gid=nQPDVOqq6q_Ac-767_ZV4A&oh=00_AfMqpYbhDNI3YHVb2DI-Lc2BbzqK_oYnAPpfEkP95wseag&oe=68473B0E" alt="">
              <div class="mt-6 text-center">
                <h3 class="text-lg font-semibold text-gray-900">Kerstan Zam Davide</h3>
                <p class="text-gray-600">Public Information Officer</p>
                <div class="mt-4 flex justify-center gap-x-4">
                  <!-- Social Links -->
                  <a href="#" class="text-gray-400 hover:text-gray-500">
                    <span class="sr-only">Facebook</span>
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg>
                  </a>
                  <a href="#" class="text-gray-400 hover:text-gray-500">
                    <span class="sr-only">LinkedIn</span>
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M16 8a6 6 0 01-12 0 6 6 0 0112 0zm-6 8a8 8 0 100-16 8 8 0 000 16zm-2-7h2v6H8v-6zm1-1a1 1 0 110-2 1 1 0 010 2zm4 1h2v3.5a1.5 1.5 0 01-3 0V10h1v1.5a.5.5 0 001 0V10z"/></svg>
                  </a>
                </div>
              </div>
            </li>
            <!-- Team Member 3 -->
            <li class="flex flex-col items-center">
              <img class="w-full h-56 object-cover rounded-2xl" src="https://scontent.fceb3-1.fna.fbcdn.net/v/t39.30808-6/432407394_1645695422631958_4371129882617179964_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=6ee11a&_nc_eui2=AeGZfkfQnY1M1Fgs01fgbasTG1J3clYceBIbUndyVhx4EgqI4qUwzsmAjH33ssUXAUgc6a4UOxAyME4pYGoPhRit&_nc_ohc=3ZIJimNdEPsQ7kNvwFvuAYK&_nc_oc=Adm24XhLhdi6XdXje7oDX80AKlfefXNalvEwAeH1FDkp-_IefMKELRBYB5OSiQ5OUdU&_nc_zt=23&_nc_ht=scontent.fceb3-1.fna&_nc_gid=DENrHTPYSJU_ZM8gCie36A&oh=00_AfNa1sibCwsI6taPkRlHv998Yy6XEUR8wdIujLaIS537Mg&oe=68472D4A" alt="">
              <div class="mt-6 text-center">
                <h3 class="text-lg font-semibold text-gray-900">Jaspher Lawrence Siloy</h3>
                <p class="text-gray-600">LGU Web Administrator</p>
                <div class="mt-4 flex justify-center gap-x-4">
                  <!-- Social Links -->
                  <a href="#" class="text-gray-400 hover:text-gray-500">
                    <span class="sr-only">Facebook</span>
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg>
                  </a>
                  <a href="#" class="text-gray-400 hover:text-gray-500">
                    <span class="sr-only">LinkedIn</span>
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M16 8a6 6 0 01-12 0 6 6 0 0112 0zm-6 8a8 8 0 100-16 8 8 0 000 16zm-2-7h2v6H8v-6zm1-1a1 1 0 110-2 1 1 0 010 2zm4 1h2v3.5a1.5 1.5 0 01-3 0V10h1v1.5a.5.5 0 001 0V10z"/></svg>
                  </a>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>

    </div>
</x-layout>