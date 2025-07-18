{{-- resources/views/Components/Admin/dashboard_content.blade.php --}}
@props(['concerns', 'reports', 'applications'])

<div class="p-4 md:p-6 lg:p-8 "> {{-- Outer container for consistent padding --}}
    <!-- Dashboard Header Area -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
        <h1 class="text-[#37474F] text-3xl font-semibold font-montserrat mb-4 sm:mb-0">LGU Dashboard</h1>
        <div class="flex flex-wrap items-center gap-3">
            <!-- Day/Week/Month/Year Toggle -->
            <div class="bg-white rounded-lg p-1 flex shadow-sm">
                <button class="px-4 py-2 text-sm rounded-md font-medium text-[#37474F] hover:bg-gray-100 transition-colors">Day</button>
                <button class="px-4 py-2 text-sm rounded-md font-medium text-[#37474F] hover:bg-gray-100 transition-colors">Week</button>
                <button class="px-4 py-2 text-sm rounded-md font-medium text-white bg-[#37474F] transition-colors">Month</button>
                <button class="px-4 py-2 text-sm rounded-md font-medium text-[#37474F] hover:bg-gray-100 transition-colors">Year</button>
            </div>
            <!-- Date Range Picker Placeholder -->
            <div class="relative">
                <input type="text" value="1 Jan 2025 - 30 Jun 2025" readonly
                       class="bg-white border border-gray-200 rounded-lg py-2 px-4 pl-10 text-sm text-[#37474F] focus:outline-none focus:ring-1 focus:ring-amber-400 shadow-sm">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h.01M7 16h.01M17 16h.01M21 12V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2h4m2-4h4m-4 0v4"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Key Metric Cards Section -->
    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Registered Citizens Card (Dark) -->
        <div class="bg-[#37474F] p-6 rounded-xl shadow-lg flex flex-col justify-between text-white">
            <h3 class="font-medium text-lg mb-1">Total Registered Citizens</h3>
            <p class="text-4xl font-bold mb-1">125,400</p>
            <div class="flex items-center text-sm text-green-400">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
                <span>1.5 % from last month</span>
            </div>
        </div>

        <!-- Completed Infrastructure Projects Card (Light) -->
        <div class="bg-white p-6 rounded-xl shadow-lg flex flex-col justify-between">
            <h3 class="font-medium text-lg text-[#37474F] mb-1">Completed Infra Projects</h3>
            <p class="text-4xl font-bold text-[#37474F] mb-1">17</p>
            <div class="flex items-center text-sm text-green-500">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
                <span>+2 new this quarter</span>
            </div>
        </div>

        <!-- Active Community Programs Card (Light) -->
        <div class="bg-white p-6 rounded-xl shadow-lg flex flex-col justify-between">
            <h3 class="font-medium text-lg text-[#37474F] mb-1">Active Community Programs</h3>
            <p class="text-4xl font-bold text-[#37474F] mb-1">8</p>
            <div class="flex items-center text-sm text-green-500">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
                <span>New program launched</span>
            </div>
        </div>

        <!-- Public Service Requests Card (Light) -->
        <div class="bg-white p-6 rounded-xl shadow-lg flex flex-col justify-between">
            <h3 class="font-medium text-lg text-[#37474F] mb-1">Public Service Requests</h3>
            <p class="text-4xl font-bold text-[#37474F] mb-1">45</p>
            <div class="flex items-center text-sm text-red-500">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 112 0v7.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
                <span>-10% from last month</span>
            </div>
        </div>
    </section>

    <!-- Charts and Calendar/Growth -->
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- News Post Views by Month (Bar Chart) -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-semibold font-montserrat text-[#37474F] mb-6">News Post Views by Month</h2>
            <div class="w-full h-64 bg-[#F3F3F3] rounded-lg p-4 flex items-end justify-around text-xs text-[#37474F]">
                <!-- Static Bar Chart - Heights adapted for news views -->
                <div class="flex flex-col items-center group relative cursor-pointer" style="height: 100%; width: 15%;">
                    <div class="bg-[#D4AF37] w-6 rounded-t-sm transition-all duration-300 ease-in-out hover:bg-amber-500" style="height: 60%;"></div>
                    <span class="mt-2 text-center">Jan</span>
                    <span class="absolute -top-6 bg-[#37474F] text-white text-xs px-2 py-1 rounded hidden group-hover:block">1200 Views</span>
                </div>
                <div class="flex flex-col items-center group relative cursor-pointer" style="height: 100%; width: 15%;">
                    <div class="bg-[#D4AF37] w-6 rounded-t-sm transition-all duration-300 ease-in-out hover:bg-amber-500" style="height: 75%;"></div>
                    <span class="mt-2 text-center">Feb</span>
                    <span class="absolute -top-6 bg-[#37474F] text-white text-xs px-2 py-1 rounded hidden group-hover:block">1500 Views</span>
                </div>
                <div class="flex flex-col items-center group relative cursor-pointer" style="height: 100%; width: 15%;">
                    <div class="bg-[#D4AF37] w-6 rounded-t-sm transition-all duration-300 ease-in-out hover:bg-amber-500" style="height: 50%;"></div>
                    <span class="mt-2 text-center">Mar</span>
                    <span class="absolute -top-6 bg-[#37474F] text-white text-xs px-2 py-1 rounded hidden group-hover:block">1000 Views</span>
                </div>
                <div class="flex flex-col items-center group relative cursor-pointer" style="height: 100%; width: 15%;">
                    <div class="bg-[#D4AF37] w-6 rounded-t-sm transition-all duration-300 ease-in-out hover:bg-amber-500" style="height: 90%;"></div>
                    <span class="mt-2 text-center">Apr</span>
                    <span class="absolute -top-6 bg-[#37474F] text-white text-xs px-2 py-1 rounded hidden group-hover:block">1800 Views</span>
                </div>
                <div class="flex flex-col items-center group relative cursor-pointer" style="height: 100%; width: 15%;">
                    <div class="bg-[#D4AF37] w-6 rounded-t-sm transition-all duration-300 ease-in-out hover:bg-amber-500" style="height: 80%;"></div>
                    <span class="mt-2 text-center">May</span>
                    <span class="absolute -top-6 bg-[#37474F] text-white text-xs px-2 py-1 rounded hidden group-hover:block">1600 Views</span>
                </div>
                <div class="flex flex-col items-center group relative cursor-pointer" style="height: 100%; width: 15%;">
                    <div class="bg-[#D4AF37] w-6 rounded-t-sm transition-all duration-300 ease-in-out hover:bg-amber-500" style="height: 70%;"></div>
                    <span class="mt-2 text-center">Jun</span>
                    <span class="absolute -top-6 bg-[#37474F] text-white text-xs px-2 py-1 rounded hidden group-hover:block">1400 Views</span>
                </div>
            </div>
        </div>

        <!-- Citizen Engagement Calendar and Community Outreach -->
        <div class="bg-white rounded-xl shadow-lg p-6 flex flex-col justify-between">
            <!-- Citizen Engagement Calendar (Static) -->
            <div class="flex flex-col items-center mb-6">
                <div class="flex justify-between w-full items-center mb-4">
                    <button class="text-[#37474F] p-2 rounded-full hover:bg-gray-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </button>
                    <span class="text-xl font-semibold text-[#37474F]">June 2025</span>
                    <button class="text-[#37474F] p-2 rounded-full hover:bg-gray-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                </div>
                <div class="grid grid-cols-7 gap-2 text-center text-sm text-[#37474F] w-full">
                    <span class="font-bold">Mon</span>
                    <span class="font-bold">Tue</span>
                    <span class="font-bold">Wed</span>
                    <span class="font-bold">Thu</span>
                    <span class="font-bold">Fri</span>
                    <span class="font-bold">Sat</span>
                    <span class="font-bold">Sun</span>
                    <!-- Placeholder days with LGU events -->
                    <span class="py-2"></span>
                    <span class="py-2"></span>
                    <span class="py-2"></span>
                    <span class="py-2"></span>
                    <span class="py-2 bg-blue-100 rounded-lg text-blue-800 font-medium cursor-pointer">13</span> <!-- Public Hearing -->
                    <span class="py-2">14</span>
                    <span class="py-2">15</span>
                    <span class="py-2">16</span>
                    <span class="py-2 bg-green-100 rounded-lg text-green-800 font-medium cursor-pointer">17</span> <!-- Community Clean-up -->
                    <span class="py-2">18</span>
                    <span class="py-2">19</span>
                    <span class="py-2">20</span>
                    <span class="py-2">21</span>
                    <span class="py-2 bg-amber-100 rounded-lg text-amber-800 font-medium cursor-pointer">22</span> <!-- LGU Meeting -->
                    <span class="py-2">23</span>
                    <span class="py-2">24</span>
                    <span class="py-2">25</span>
                    <span class="py-2">26</span>
                    <span class="py-2">27</span>
                    <span class="py-2">28</span>
                    <span class="py-2">29</span>
                    <span class="py-2">30</span>
                </div>
            </div>

            <!-- Community Outreach Reach (Static Donut Chart) -->
            <div class="bg-[#F3F3F3] rounded-xl p-4 flex items-center justify-between mt-auto">
                <div class="flex flex-col">
                    <h3 class="font-medium text-lg text-[#37474F]">Community Outreach Reach</h3>
                    <div class="flex items-center text-sm text-green-500">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>+5% last quarter</span>
                    </div>
                </div>
                <div class="relative w-24 h-24">
                    <!-- Simple SVG for static donut/progress circle (80% example) -->
                    <svg class="w-full h-full" viewBox="0 0 100 100">
                        <circle class="text-gray-200 stroke-current" stroke-width="10" cx="50" cy="50" r="40" fill="transparent"></circle>
                        <circle class="text-[#D4AF37] progress-ring__circle stroke-current" stroke-width="10" stroke-linecap="round" cx="50" cy="50" r="40" fill="transparent"
                                stroke-dasharray="251.2" stroke-dashoffset="50.24"> {{-- 251.2 = circumference (2*PI*40), 50.24 = (1-0.8)*251.2 for 80% --}}
                        </circle>
                        <text x="50" y="55" font-family="Inter, sans-serif" font-size="20" fill="#37474F" text-anchor="middle" alignment-baseline="middle" font-weight="bold">80%</text>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <!--Tables -->
    <section class="mb-8">
        <x-Admin.dashboard.tables
        :concerns="$concerns"
        :reports="$reports"
        :applications="$applications"
    ></x-Admin.dashboard.tables>
        
    </section>
</div>


