

<div class="font-inter">
    <!-- Main container for the full page, ensuring it takes full viewport height -->
    <!-- Flexbox is used to center the content both horizontally and vertically -->
    <div class="relative w-screen h-screen flex items-center justify-center overflow-hidden">
        <!-- Background image -->
        <!-- Replace '/storage/phart.svg' with your actual image path if it's served from Laravel's storage. -->
        <!-- Otherwise, for a direct static asset, use '/phart.svg' or full URL. -->
        <img class="absolute inset-0 w-full h-full object-cover opacity-100" src="/storage/phart.svg" alt="Background pattern">

        <!-- Centering container for the form card -->
        <div class="navAndContent_feed mx-auto w-full max-w-lg md:max-w-xl lg:max-w-2xl xl:max-w-7xl flex items-center justify-center z-10 p-4 sm:p-6 md:p-8 flex-grow">
            <!-- Alpine.js data for toggling between Sign In and Sign Up forms -->
            <!-- Removed relative from here, it's handled by the parent card -->
            <div x-data="{ showSignIn: true }"
                 class="w-11/12 sm:w-96 max-w-sm bg-white rounded-lg shadow-lg py-8 px-6 sm:px-8 flex flex-col items-center justify-center"
                 style="background-color: rgb(247 247 247 /1); border-radius: 12px; box-shadow: rgb(0 0 0 / 40%) 0px 0px 50px 8px;">

                <!-- Sign In Form -->
                <div x-show="showSignIn"
                     x-transition:enter="transition-all duration-700 ease-out"
                     x-transition:enter-start="opacity-0 transform translate-x-full scale-95"
                     x-transition:enter-end="opacity-100 transform translate-x-0 scale-100"
                     x-transition:leave="transition-all duration-500 ease-in"
                     x-transition:leave-start="opacity-100 transform translate-x-0 scale-100"
                     x-transition:leave-end="opacity-0 transform -translate-x-full scale-95"
                     class="flex flex-col items-center w-full"> <!-- Added w-full for consistent width -->

                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-6 sm:mb-8 font-['Segoe_UI'] transform transition-all duration-300 hover:scale-105">Sign In</h2>

                    <div class="w-full mb-4">
                        <input
                            type="text"
                            placeholder="Email or mobile number"
                            class="w-full h-12 sm:h-14 px-4 bg-gray-200/70 rounded border border-gray-400/70 text-gray-700 placeholder-gray-700 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:bg-white transition-all duration-300 ease-out transform focus:scale-[1.02] focus:-translate-y-0.5 font-['Segoe_UI']"
                            aria-label="Email or mobile number"
                        />
                    </div>

                    <div class="w-full mb-6 sm:mb-8">
                        <input
                            type="password"
                            placeholder="Password"
                            class="w-full h-12 sm:h-14 px-4 bg-gray-200/70 rounded border border-gray-400/70 text-gray-700 placeholder-gray-700 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:bg-white transition-all duration-300 ease-out transform focus:scale-[1.02] focus:-translate-y-0.5 font-['Segoe_UI']"
                            aria-label="Password"
                        />
                    </div>

                    <!-- Sign In Button - This is the button that should navigate to /admin -->
                    <button type="button"
                            @click="window.location.href = '/admin';"
                            class="w-full h-10 bg-amber-400 hover:bg-amber-500 rounded flex items-center justify-center text-white text-base font-normal mb-4 font-['Segoe_UI'] transition-all duration-300 ease-out transform hover:scale-105 hover:-translate-y-1 hover:shadow-xl active:scale-95 active:translate-y-0">
                        Sign In
                    </button>

                    <div class="text-gray-600 text-base font-normal font-['Segoe_UI'] mb-4 transition-all duration-300">OR</div>

                    <button type="button"
                            class="w-full h-10 bg-gray-300 hover:bg-gray-400 rounded flex items-center justify-center text-gray-800 text-base font-normal mb-6 font-['Segoe_UI'] transition-all duration-300 ease-out transform hover:scale-[1.02] hover:-translate-y-0.5 hover:shadow-lg active:scale-95">
                        Use a Sign-In Code
                    </button>

                    <a href="/adminv2" class="text-neutral-600 hover:text-blue-600 text-base font-normal underline mb-4 font-['Segoe_UI'] transition-all duration-200 ease-out transform hover:translate-x-1">
                        Forgot password?
                    </a>

                    <div class="w-full flex items-center mb-6">
                        <!-- Custom checkbox styling using Tailwind's peer classes and SVG for checkmark -->
                        <input type="checkbox" id="rememberMe" class="hidden peer">
                        <label for="rememberMe" class="relative flex items-center cursor-pointer select-none text-neutral-600 hover:text-gray-800 text-base font-normal font-['Segoe_UI'] transition-all duration-200">
                            <span class="w-5 h-5 border border-zinc-300 rounded-sm bg-zinc-300 mr-2 flex items-center justify-center peer-checked:bg-blue-500 peer-checked:border-blue-500 transition-all duration-300 ease-out transform peer-checked:scale-110">
                                <svg class="w-3 h-3 text-white opacity-0 peer-checked:opacity-100 transition-all duration-300 transform peer-checked:scale-100 scale-50" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </span>
                            Remember me
                        </label>
                    </div>

                    <div class="w-full text-left mb-6">
                        <a @click.prevent="showSignIn = false" href="#" class="text-neutral-600 hover:text-blue-600 text-base font-normal font-['Segoe_UI'] cursor-pointer transition-all duration-200 ease-out transform hover:translate-x-1">Sign up now.</a>
                    </div>

                    <div class="text-center text-neutral-600/50 text-xs font-normal leading-normal mb-1 font-['Segoe_UI'] transition-all duration-300">
                        This page is protected by Google reCAPTCHA to<br/>ensure you're not a bot.
                    </div>
                    <a href="#" class="text-blue-500 hover:text-blue-700 text-xs font-normal underline font-['Segoe_UI'] transition-all duration-200 transform hover:translate-x-0.5">
                        Learn more.
                    </a>
                </div>

                <!-- Sign Up Form -->
                <div x-show="!showSignIn"
                     x-transition:enter="transition-all duration-700 ease-out"
                     x-transition:enter-start="opacity-0 transform -translate-x-full scale-95"
                     x-transition:enter-end="opacity-100 transform translate-x-0 scale-100"
                     x-transition:leave="transition-all duration-500 ease-in"
                     x-transition:leave-start="opacity-100 transform translate-x-0 scale-100"
                     x-transition:leave-end="opacity-0 transform translate-x-full scale-95"
                     class="flex flex-col items-center w-full"> <!-- Added w-full for consistent width -->
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-6 sm:mb-8 font-['Segoe_UI'] transform transition-all duration-300 hover:scale-105">Sign Up</h2>

                    <div class="w-full mb-4">
                        <input
                            type="text"
                            placeholder="Full Name"
                            class="w-full h-12 sm:h-14 px-4 bg-gray-200/70 rounded border border-gray-400/70 text-gray-700 placeholder-gray-700 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:bg-white transition-all duration-300 ease-out transform focus:scale-[1.02] focus:-translate-y-0.5 font-['Segoe_UI']"
                        />
                    </div>
                    <div class="w-full mb-4">
                        <input
                            type="email"
                            placeholder="Email Address"
                            class="w-full h-12 sm:h-14 px-4 bg-gray-200/70 rounded border border-gray-400/70 text-gray-700 placeholder-gray-700 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:bg-white transition-all duration-300 ease-out transform focus:scale-[1.02] focus:-translate-y-0.5 font-['Segoe_UI']"
                        />
                    </div>
                    <div class="w-full mb-4">
                        <input
                            type="password"
                            placeholder="Password"
                            class="w-full h-12 sm:h-14 px-4 bg-gray-200/70 rounded border border-gray-400/70 text-gray-700 placeholder-gray-700 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:bg-white transition-all duration-300 ease-out transform focus:scale-[1.02] focus:-translate-y-0.5 font-['Segoe_UI']"
                        />
                    </div>
                    <div class="w-full mb-6 sm:mb-8">
                        <input
                            type="password"
                            placeholder="Confirm Password"
                            class="w-full h-12 sm:h-14 px-4 bg-gray-200/70 rounded border border-gray-400/70 text-gray-700 placeholder-gray-700 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:bg-white transition-all duration-300 ease-out transform focus:scale-[1.02] focus:-translate-y-0.5 font-['Segoe_UI']"
                        />
                    </div>

                    <button type="button"
                            class="w-full h-10 bg-blue-600 hover:bg-blue-700 rounded flex items-center justify-center text-white text-base font-normal mb-4 font-['Segoe_UI'] transition-all duration-300 ease-out transform hover:scale-105 hover:-translate-y-1 hover:shadow-xl active:scale-95 active:translate-y-0">
                        Sign Up
                    </button>

                    <div class="text-center text-neutral-600/50 text-xs font-normal leading-normal mb-1 font-['Segoe_UI'] transition-all duration-300">
                        This page is protected by Google reCAPTCHA to<br/>ensure you're not a bot.
                    </div>
                    <a href="#" class="text-blue-500 hover:text-blue-700 text-xs font-normal underline font-['Segoe_UI'] transition-all duration-200 transform hover:translate-x-0.5">
                        Learn more.
                    </a>

                    <div class="w-full text-center mt-6">
                        <a @click.prevent="showSignIn = true" href="#" class="text-neutral-600 hover:text-blue-600 text-base font-normal font-['Segoe_UI'] cursor-pointer transition-all duration-200 ease-out transform hover:translate-x-1">Already have an account? Sign In.</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

