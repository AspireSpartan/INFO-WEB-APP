<div class="min-h-screen w-full relative overflow-hidden"
     x-data="{ loaded: false }"
     x-init="$nextTick(() => { loaded = true })"
     :class="{ 'opacity-0': !loaded, 'opacity-100': loaded }"
     x-transition:enter="transition ease-out duration-700" {{-- Slightly faster page load --}}
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100">

    {{-- Hero Section --}}
    <div class="relative w-full h-[500px] md:h-[600px] flex items-center justify-center"> 
        <img class="absolute inset-0 w-full h-full object-cover" src="{{ asset('storage/grouppicture.svg') }}" alt="About Us Team" />
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="relative z-10 text-center px-4 max-w-4xl mx-auto"> {{-- Max width for text --}}
            <h1 class="text-white text-4xl md:text-5xl font-bold font-['Verdana'] leading-tight mb-4 md:mb-6">About Us</h1> {{-- Reduced font sizes --}}
            <p class="text-white text-2xl md:text-3xl font-normal font-['Caveat']">Serving the Community with Efficiency, Transparency, and Care</p> {{-- Reduced font sizes --}}
        </div>
    </div>

    {{-- Content Section (Introduction & What We Offer) --}}
    <div class="w-full bg-white py-16 px-4 md:px-8 lg:px-12"> {{-- Reduced vertical padding, tightened horizontal padding --}}
        <div class="max-w-6xl mx-auto flex flex-col gap-16"> {{-- Max width for main content, reduced gap --}}

            {{-- Introduction Section --}}
            <div class="flex flex-col lg:flex-row justify-between items-start gap-10 lg:gap-20"> {{-- Reduced gap --}}
                <div class="w-full lg:w-1/3">
                    <span class="text-orange-500 text-2xl md:text-3xl font-bold font-['Verdana']">Introduction</span><span class="text-black text-2xl md:text-3xl font-bold font-['Verdana']"> to Your Trusted LGU Services Hub!</span> {{-- Slightly reduced font size --}}
                </div>
                <div class="w-full lg:w-2/3 flex flex-col md:flex-row justify-between items-start gap-6 md:gap-10"> {{-- Reduced gap --}}
                    <p class="text-center md:text-left text-neutral-600 text-base md:text-lg font-medium font-['Montserrat']">At [LGUConnect], we believe in accessible and convenient public service. Our platform bridges the gap between citizens and local government units by offering fast, secure, and transparent digital services.</p> {{-- Reduced font size --}}
                    <p class="text-center md:text-left text-neutral-600 text-base md:text-lg font-medium font-['Montserrat']">We are committed to simplifying the way you access essential documents and updates—so you can focus on what matters most.</p> {{-- Reduced font size --}}
                </div>
            </div>

            {{-- Divider Line --}}
            <div class="flex justify-center">
                <div class="w-2/3 lg:w-1/2 h-1 bg-indigo-900 rounded-[20px]"></div> {{-- Slightly adjusted width of divider --}}
            </div>

            {{-- What We Offer Section --}}
            <h2 class="text-orange-500 text-5xl font-bold font-['Caveat']">What We Offer</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"> {{-- Reduced gap between boxes --}}
                {{-- Box 1: Cedula Request Made Easy --}}
                <div class="group bg-white rounded-[20px] shadow-md p-4 flex items-center gap-4
                            transition-all duration-300 ease-in-out cursor-pointer
                            hover:shadow-lg hover:scale-[1.02]
                            hover:ring-4 hover:ring-[#F18018] hover:ring-opacity-70">
                    <div class="w-16 h-16 md:w-20 md:h-20 bg-zinc-300 rounded-full flex-shrink-0 flex items-center justify-center">
                        <!-- Icon for Cedula -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A6 6 0 0118.88 6.197M12 3v1m0 16v1m8.485-8.485h-1M4.515 12.515h-1m15.364 4.95l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707" />
                        </svg>
                    </div>

                    <div class="flex flex-col items-start gap-2 text-left"> {{-- Reduced gap --}}
                        <h3 class="text-black text-lg md:text-xl font-bold font-roboto">Cedula Request Made Easy</h3> {{-- Slightly reduced font size --}}
                        <p class="text-neutral-600 text-sm md:text-base font-medium font-montserrat">Apply for your community tax certificate online with just a few clicks.</p> {{-- Slightly reduced font size --}}
                    </div>
                </div>

                {{-- Box 2: Barangay Clearance Anytime --}}
                <div class="group bg-white rounded-[20px] shadow-md p-4 flex items-center gap-4
                            transition-all duration-300 ease-in-out cursor-pointer
                            hover:shadow-lg hover:scale-[1.02]
                            hover:ring-4 hover:ring-[#F18018] hover:ring-opacity-70">
                    <div class="w-16 h-16 md:w-20 md:h-20 bg-zinc-300 rounded-full flex-shrink-0 flex items-center justify-center">
                        {{-- Icon for Barangay Clearance --}}
                        <i class="fas fa-file-signature text-white text-2xl"></i>
                    </div>

                    <div class="flex flex-col items-start gap-2 text-left">
                        <h3 class="text-black text-lg md:text-xl font-bold font-roboto">Barangay Clearance Anytime</h3>
                        <p class="text-neutral-600 text-sm md:text-base font-medium font-montserrat">Request, verify, and download your barangay clearance wherever you are.</p>
                    </div>
                </div>

                {{-- Box 3: Real-Time LGU News --}}
                <div class="group bg-white rounded-[20px] shadow-md p-4 flex items-center gap-4
                            transition-all duration-300 ease-in-out cursor-pointer
                            hover:shadow-lg hover:scale-[1.02]
                            hover:ring-4 hover:ring-[#F18018] hover:ring-opacity-70">
                    <div class="w-16 h-16 md:w-20 md:h-20 bg-zinc-300 rounded-full flex-shrink-0 flex items-center justify-center">
                        {{-- Icon for LGU News --}}
                    </div>
                    <div class="flex flex-col items-start gap-2 text-left">
                        <h3 class="text-black text-lg md:text-xl font-bold font-roboto">Real-Time LGU News</h3>
                        <p class="text-neutral-600 text-sm md:text-base font-medium font-montserrat">Get updated with the latest ordinances, barangay announcements, and emergency bulletins.</p>
                    </div>
                </div>

                {{-- Box 4: Cedula Request Made Easy (Duplicate - adjust as needed) --}}
                <div class="group bg-white rounded-[20px] shadow-md p-4 flex items-center gap-4
                            transition-all duration-300 ease-in-out cursor-pointer
                            hover:shadow-lg hover:scale-[1.02]
                            hover:ring-4 hover:ring-[#F18018] hover:ring-opacity-70">
                    <div class="w-16 h-16 md:w-20 md:h-20 bg-zinc-300 rounded-full flex-shrink-0 flex items-center justify-center">
                        {{-- Icon for Cedula --}}
                    </div>
                    <div class="flex flex-col items-start gap-2 text-left">
                        <h3 class="text-black text-lg md:text-xl font-bold font-roboto">Cedula Request Made Easy</h3>
                        <p class="text-neutral-600 text-sm md:text-base font-medium font-montserrat">Apply for your community tax certificate online with just a few clicks.</p>
                    </div>
                </div>

                {{-- Box 5: Barangay Clearance Anytime (Duplicate - adjust as needed) --}}
                <div class="group bg-white rounded-[20px] shadow-md p-4 flex items-center gap-4
                            transition-all duration-300 ease-in-out cursor-pointer
                            hover:shadow-lg hover:scale-[1.02]
                            hover:ring-4 hover:ring-[#F18018] hover:ring-opacity-70">
                    <div class="w-16 h-16 md:w-20 md:h-20 bg-zinc-300 rounded-full flex-shrink-0 flex items-center justify-center">
                        {{-- Icon for Barangay Clearance --}}
                    </div>
                    <div class="flex flex-col items-start gap-2 text-left">
                        <h3 class="text-black text-lg md:text-xl font-bold font-roboto">Barangay Clearance Anytime</h3>
                        <p class="text-neutral-600 text-sm md:text-base font-medium font-montserrat">Request, verify, and download your barangay clearance wherever you are.</p>
                    </div>
                </div>

                {{-- Box 6: Real-Time LGU News (Duplicate - adjust as needed) --}}
                <div class="group bg-white rounded-[20px] shadow-md p-4 flex items-center gap-4
                            transition-all duration-300 ease-in-out cursor-pointer
                            hover:shadow-lg hover:scale-[1.02]
                            hover:ring-4 hover:ring-[#F18018] hover:ring-opacity-70">
                    <div class="w-16 h-16 md:w-20 md:h-20 bg-zinc-300 rounded-full flex-shrink-0 flex items-center justify-center">
                        {{-- Icon for LGU News --}}
                    </div>
                    <div class="flex flex-col items-start gap-2 text-left">
                        <h3 class="text-black text-lg md:text-xl font-bold font-roboto">Real-Time LGU News</h3>
                        <p class="text-neutral-600 text-sm md:text-base font-medium font-montserrat">Get updated with the latest ordinances, barangay announcements, and emergency bulletins.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>