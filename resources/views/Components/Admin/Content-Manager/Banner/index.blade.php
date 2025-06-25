@props(['sectionBanner'])

@php
    $bgImagePath = $sectionBanner->background_image
                    ? asset('storage/' . $sectionBanner->background_image)
                    : asset('storage/LGU_bg.png');

    $isAdmin = true; // Still true for testing
@endphp

<div class="relative min-h-screen bg-cover bg-center pt-24"
     style="background-image: url('{{ $bgImagePath }}');"
     x-data="{
         isEditModalOpen: false,
         editingField: '',
         editingValue: '',
         bannerData: {{ json_encode($sectionBanner->toArray()) }},

         openEditModal(field, initialValue = '') {
             this.editingField = field;
             if (field !== 'stats' && field !== 'background_image') {
                 this.editingValue = initialValue;
             }
             this.isEditModalOpen = true;
         },
         updateBannerData(field, newValue) {
             this.bannerData[field] = newValue;
         },
         updateAllStats(newStats) {
             this.bannerData.barangay = newStats.barangay_number;
             this.bannerData.residents = newStats.residents_number;
             this.bannerData.projects = newStats.projects_number;
             this.bannerData.yrs_service = newStats.yrs_service_number;
         }
     }"
>

    {{-- Overlay tint --}}
    <div class="absolute inset-0 bg-gray-700/50 animate-bg-overlay z-0"></div>

    {{-- SMALL FIXED BUTTON TO EDIT BACKGROUND IMAGE --}}
@if($isAdmin)
    <div class="absolute top-4 right-4 z-30">
        <button @click="openEditModal('background_image')"
                class="flex items-center justify-center p-2 bg-black/50 text-white rounded-full shadow hover:bg-black/70 transition"
                title="Edit Background Image">
            {{-- Pencil Icon --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15.232 5.232l3.536 3.536M9 13h3l9-9-3-3-9 9v3z" />
            </svg>
        </button>
    </div>
@endif

    {{-- Main content section --}}
    <div class="relative z-10 flex flex-col items-end justify-center h-[calc(100vh-theme(spacing.24))] text-left px-4">
        <div class="w-full max-w-4xl space-y-6 md:space-y-8 lg:space-y-10 pr-2 md:pr-8 lg:pr-16">

            {{-- HEADER 1 --}}
            <div class="group relative inline-block">
                <p class="text-white text-2xl md:text-3xl lg:text-4xl font-normal font-['Noto_Sans'] animate-hero-text" style="--delay: 0.2s">
                    <span x-text="bannerData.header1"></span>
                </p>
                @if($isAdmin)
                    <button @click="openEditModal('header1', bannerData.header1)"
                            class="absolute inset-0 flex items-center justify-center
                                   opacity-0 group-hover:opacity-100 transition-opacity duration-300
                                   bg-blue-600/70 text-white px-4 py-2 rounded-lg text-sm
                                   hover:bg-blue-700/70 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        Edit
                    </button>
                @endif
            </div>

            {{-- HEADER 2 --}}
            <div class="group relative inline-block">
                <h1 class="text-white text-6xl md:text-7xl lg:text-7xl font-bold font-['Merriweather'] leading-tight animate-hero-text" style="--delay: 0.4s">
                    <span x-text="bannerData.header2"></span>
                </h1>
                @if($isAdmin)
                    <button @click="openEditModal('header2', bannerData.header2)"
                            class="absolute inset-0 flex items-center justify-center
                                   opacity-0 group-hover:opacity-100 transition-opacity duration-300
                                   bg-blue-600/70 text-white px-4 py-2 rounded-lg text-sm
                                   hover:bg-blue-700/70 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        Edit
                    </button>
                @endif
            </div>

            {{-- HEADER 3 --}}
            <div class="group relative inline-block">
                <p class="text-white text-2xl md:text-3xl lg:text-4xl font-normal font-['Roboto'] animate-hero-text" style="--delay: 0.6s">
                    <span x-text="bannerData.header3"></span>
                </p>
                @if($isAdmin)
                    <button @click="openEditModal('header3', bannerData.header3)"
                            class="absolute inset-0 flex items-center justify-center
                                   opacity-0 group-hover:opacity-100 transition-opacity duration-300
                                   bg-blue-600/70 text-white px-4 py-2 rounded-lg text-sm
                                   hover:bg-blue-700/70 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        Edit
                    </button>
                @endif
            </div>

            {{-- HEADER 4 --}}
            <div class="group relative inline-block">
                <p class="text-white text-lg md:text-xl lg:text-2xl font-normal font-['Source_Sans_Pro'] animate-hero-text" style="--delay: 0.8s">
                    <span x-text="bannerData.header4"></span>
                </p>
                @if($isAdmin)
                    <button @click="openEditModal('header4', bannerData.header4)"
                            class="absolute inset-0 flex items-center justify-center
                                   opacity-0 group-hover:opacity-100 transition-opacity duration-300
                                   bg-blue-600/70 text-white px-4 py-2 rounded-lg text-sm
                                   hover:bg-blue-700/70 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        Edit
                    </button>
                @endif
            </div>
        </div>
    </div>

    {{-- STATS SECTION --}}
    <div class="relative z-10 w-full bg-zinc-500/20 shadow-md py-4 md:py-6 lg:py-8 px-4 sm:px-8 lg:px-16 mt-auto group">
        <div class="flex flex-col sm:flex-row justify-around items-center gap-6 md:gap-12 lg:gap-24">
            <div class="text-center animate-stat-item" style="--delay: 0.2s">
                <div class="text-white text-3xl md:text-4xl font-bold font-['Merriweather']">
                    <span x-text="bannerData.barangay"></span>
                </div>
                <div class="text-white text-sm md:text-lg font-light">Barangay</div>
            </div>
            <div class="text-center animate-stat-item" style="--delay: 0.4s">
                <div class="text-white text-3xl md:text-4xl font-bold font-['Merriweather']">
                    <span x-text="bannerData.residents ? bannerData.residents + '+' : '0'"></span>
                </div>
                <div class="text-white text-sm md:text-lg font-light">Residents</div>
            </div>
            <div class="text-center animate-stat-item" style="--delay: 0.6s">
                <div class="text-white text-3xl md:text-4xl font-bold font-['Merriweather']">
                    <span x-text="bannerData.projects ? bannerData.projects + '+' : '0'"></span>
                </div>
                <div class="text-white text-sm md:text-lg font-light">Public Projects</div>
            </div>
            <div class="text-center animate-stat-item" style="--delay: 0.8s">
                <div class="text-white text-3xl md:text-4xl font-bold font-['Merriweather']">
                    <span x-text="bannerData.yrs_service"></span>
                </div>
                <div class="text-white text-sm md:text-lg font-light">Years of Service</div>
            </div>
        </div>

        @if($isAdmin)
            <button @click="openEditModal('stats')"
                    class="absolute inset-0 flex items-center justify-center
                           opacity-0 group-hover:opacity-100 transition-opacity duration-300
                           bg-gray-800/70 text-white px-6 py-3 rounded-lg text-lg font-semibold
                           hover:bg-gray-900/70 focus:outline-none focus:ring-2 focus:ring-gray-700 focus:ring-opacity-50"
                    title="Edit All Statistics">
                Edit All Statistics
            </button>
        @endif

        <div class="w-full h-px bg-white/50 my-6"></div>

        <div class="relative z-10 w-full text-center text-white text-xs md:text-sm lg:text-base font-normal px-4 md:px-8 lg:px-16 animate-footer-text group">
            <p><span x-text="bannerData.description"></span></p>
            @if($isAdmin)
                <button @click="openEditModal('description', bannerData.description)"
                        class="absolute inset-0 flex items-center justify-center
                               opacity-0 group-hover:opacity-100 transition-opacity duration-300
                               bg-blue-600/70 text-white px-4 py-2 rounded-lg text-sm
                               hover:bg-blue-700/70 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    Edit
                </button>
            @endif
        </div>
    </div>

    {{-- Edit Modal Component --}}
    <x-admin.content-manager.modal.edit-banner-modal :sectionBanner="$sectionBanner"/>
</div>
