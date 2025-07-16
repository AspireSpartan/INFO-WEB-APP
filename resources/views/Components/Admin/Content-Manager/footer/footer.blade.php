<div
    class="w-full min-h-[579px] h-auto bg-black flex justify-center items-start py-24 px-8 md:px-16 lg:px-32 relative overflow-x-hidden"
    x-data="{
        showEditButton: false,
        showMainModal: false,
        activeSubModal: null,
        // Initialize contactUsData directly from the PHP variable
        contactUsData: {{ Js::from($initialContactUsData) }}
    }"
    @mouseenter="showEditButton = true" @mouseleave="showEditButton = false"
    {{-- Directly dispatch contactUsData when 'contactUs' modal opens --}}
    @open-sub-modal.window="activeSubModal = $event.detail; showMainModal = false; if ($event.detail === 'contactUs') $dispatch('init-contact-us-modal', contactUsData);"
    @close-modal.window="showMainModal = false; activeSubModal = null"
    @contact-us-updated.window="Object.assign(contactUsData, $event.detail)" {{-- Listen for updates from modal --}}
    x-init="
        $watch('activeSubModal', value => {
            if (value === 'keepInTouch') {
                $dispatch('init-kit-modal', keepInTouch);
            }
        });
        // The initial fetch for contactUsData is now handled by PHP,
        // so we remove the fetch call from here.
    "
>
    <!-- Edit Button -->
    <button
        x-show="showEditButton"
        @click="showMainModal = true"
        class="absolute top-4 right-4 bg-gray-800 text-white px-3 py-1 rounded opacity-75 hover:opacity-100 transition"
        style="display: none;"
    >
        Edit
    </button>

    <div
        class="w-full max-w-[1400px] flex flex-col md:flex-row justify-between items-start gap-16"
        x-data="{
            keepInTouch: {{ Js::from($keepInTouch) }},
            footerLogo: '{{ $footerLogo && $footerLogo->logo_path ? Illuminate\Support\Facades\Storage::url($footerLogo->logo_path) : asset('storage/CorDev_footer.svg')}}',
            aboutGovph: {{ Js::from($aboutGovph) }},
            govphLinks: {{ Js::from($govphLinks) }},
            governmentlinks: {{ Js::from($governmentlinks) }},
            governmentLinksTitle: '{{ $footertitle->government_links_title ?? 'GOVERNMENT LINKS' }}',
        }"
        @keep-in-touch-updated.window="Object.assign(keepInTouch, $event.detail)"
        @logo-updated.window="footerLogo = $event.detail.logo_path"
        @about-govph-updated.window="() => {
            if ($event.detail.aboutGovph) aboutGovph = $event.detail.aboutGovph;
            if ($event.detail.links) govphLinks = $event.detail.links;
        }"
        @government-links-updated.window="
            governmentlinks = $event.detail.governmentlinks;
            governmentLinksTitle = $event.detail.governmentLinksTitle;
        "
    >
        <div class="flex flex-col items-center justify-start gap-4 flex-shrink-0 mx-auto md:mx-0 md:mr-24 mb-16 md:mb-0">
            <img
                :src="footerLogo"
                alt="Footer Logo"
                class="w-[auto] h-[200px] object-cover"
            />
        </div>

        <div class="flex flex-col md:flex-row justify-start items-start gap-16 md:gap-36 flex-shrink-0 w-full md:w-auto">
            <div class="flex flex-col justify-start items-start gap-16 flex-shrink-0 w-auto md:w-2/1">
                <div class="flex flex-col justify-start items-start gap-6">
                    <div class="text-white text-xl font-normal font-['Microsoft_Sans_Serif']" x-text="keepInTouch.title"></div>
                    <div class="text-stone-300 text-xl font-italic font-['Source_Sans_Pro']" x-html="keepInTouch.text_content.replace(/\n/g, '<br>')"></div>
                    {{-- Updated: Added flex-wrap and adjusted gap for better icon display --}}
                    <div class="flex flex-wrap justify-start items-center gap-4 mt-4">
                        <template x-for="link in keepInTouch.social_links" :key="link.url">
                            <a :href="link.url" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-white rounded-full flex items-center justify-center" :aria-label="link.platform">
                                <!-- Dynamically display icon based on link.icon -->
                                <template x-if="link.icon">
                                    {{-- Increased size to w-8 h-8 and ensured text-black for visibility --}}
                                    <i :class="link.icon" class="w-8 h-8 text-black flex items-center justify-center"></i>
                                </template>
                                <template x-if="!link.icon">
                                    <!-- Fallback to platform name if no icon is provided -->
                                    <span class="text-black text-sm font-semibold" x-text="link.platform"></span>
                                </template>
                            </a>
                        </template>
                    </div>
                </div>

                <div class="self-stretch flex flex-col justify-start items-start gap-6">
                    <div class="self-stretch text-white text-xl font-normal font-['Microsoft_Sans_Serif']" x-text="aboutGovph.title"></div>
                    <div class="w-auto md:w-[300px]">
                        <p class="text-stone-300 text-xs font-normal font-['Source_Sans_Pro']" x-html="aboutGovph.description.replace(/\n/g, '<br>')"></p>
                        <br>
                        <div class="text-stone-300 text-xs font-normal font-['Source_Sans_Pro']">
                            <template x-for="link in govphLinks" :key="link.id">
                                <div>
                                    <a :href="link.url" target="_blank" rel="noopener noreferrer" class="hover:underline" x-text="link.title"></a>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full md:w-96 flex flex-col justify-start items-start gap-24 flex-shrink-0">
                <div class="self-stretch flex flex-col justify-start items-start gap-6">
                    <div class="self-stretch text-white text-xl font-normal font-['Microsoft_Sans_Serif']" x-text="governmentLinksTitle"></div>
                    <div class="self-stretch text-stone-300 text-xs font-normal font-['Source_Sans_Pro']">
                        <template x-for="link in governmentlinks" :key="link.id">
                            <div>
                                <a :href="link.url" target="_blank" rel="noopener noreferrer" class="hover:underline" x-text="link.title"></a>
                            </div>
                        </template>
                        <template x-if="!governmentlinks || governmentlinks.length === 0">
                            <div>No government links available.</div>
                        </template>
                    </div>
                </div>
                <div class="self-stretch flex flex-col justify-start items-start gap-8">
                    {{-- CONTACT US SECTION - MADE DYNAMIC --}}
                    <div class="self-stretch text-white text-xl font-normal font-['Microsoft_Sans_Serif']" x-text="contactUsData.contactUsTitle"></div>
                    <div class="w-full md:w-72 flex flex-col justify-start items-start gap-3">
                        <div class="inline-flex justify-start items-center gap-7">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <div class="text-white text-xs font-normal font-['Microsoft_Sans_Serif']" x-text="contactUsData.phoneNumbers"></div>
                        </div>
                        <div class="self-stretch inline-flex justify-start items-center gap-7">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <div class="text-white text-xs font-normal font-['Microsoft_Sans_Serif']" x-text="contactUsData.emailAddresses"></div>
                        </div>
                        <template x-if="contactUsData.contactAddress">
                            <div class="inline-flex justify-start items-start gap-7">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0L6.343 16.657a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <div class="text-white text-xs font-normal font-['Microsoft_Sans_Serif']" x-text="contactUsData.contactAddress"></div>
                            </div>
                        </template>


                        <x-admin.content-manager.footer.edit-content-modal
                            x-show="showMainModal"
                            @close-modal.window="showMainModal = false; activeSubModal = null"
                            @open-sub-modal.window="activeSubModal = $event.detail; showMainModal = false"/>

                            <x-admin.content-manager.footer.edit-modals.edit-keep-in-touch-modal
                            x-show="activeSubModal === 'keepInTouch'"
                            @close-modal.window="activeSubModal = null"
                            :keepInTouch="$keepInTouch"/>

                        <x-admin.content-manager.footer.edit-modals.edit-about-govph-modal
                            x-show="activeSubModal === 'aboutGovph'"
                            @close-modal.window="activeSubModal = null"
                            :aboutGovph="$aboutGovph"
                            :govphLinks="$govphLinks" />

                        <x-admin.content-manager.footer.edit-modals.edit-government-links-modal
                            x-show="activeSubModal === 'governmentLinks'"
                            @close-modal.window="activeSubModal = null"
                            :governmentlinks="$governmentlinks"
                            :footertitle="$footertitle"/>

                        <x-admin.content-manager.footer.edit-modals.edit-contact-us-modal
                            x-show="activeSubModal === 'contactUs'"
                            @close-modal.window="activeSubModal = null" />

                        <x-admin.content-manager.footer.edit-modals.edit-logo-modal
                            x-show="activeSubModal === 'logo'"
                            @close-modal.window="activeSubModal = null"
                            :footerLogo="$footerLogo"/>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
