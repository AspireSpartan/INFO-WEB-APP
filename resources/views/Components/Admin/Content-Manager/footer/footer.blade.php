<div
    class="w-full min-h-[579px] h-auto bg-black flex justify-center items-start py-24 px-8 md:px-16 lg:px-32 relative overflow-x-hidden"
    x-data="{ showEditButton: false, showMainModal: false, activeSubModal: null }"
    @mouseenter="showEditButton = true" @mouseleave="showEditButton = false"
    @open-sub-modal.window="activeSubModal = $event.detail; showMainModal = false"
    @close-modal.window="showMainModal = false; activeSubModal = null"
    x-init="$watch('activeSubModal', value => {
        if (value === 'keepInTouch') {
            $dispatch('init-kit-modal', keepInTouch);
        }
    })"
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
                    <div class="flex justify-start items-center gap-8 mt-4">
                        <template x-for="link in keepInTouch.social_links" :key="link.url">
                            <a :href="link.url" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-white rounded-full flex items-center justify-center" :aria-label="link.platform">
                                <template x-if="link.platform.toLowerCase() === 'facebook'">
                                    <svg class="w-6 h-6 text-black" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.505 1.492-3.89 3.776-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33V22H12c5.523 0 10-4.477 10-10z" clip-rule="evenodd" />
                                    </svg>
                                </template>
                                <template x-if="link.platform.toLowerCase() === 'twitter'">
                                    <svg class="w-6 h-6 text-black" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/>
                                    </svg>
                                </template>
                                <template x-if="!['facebook', 'twitter'].includes(link.platform.toLowerCase())">
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
                    <div class="self-stretch text-white text-xl font-normal font-['Microsoft_Sans_Serif']">CONTACT US!</div>
                    <div class="w-full md:w-72 flex flex-col justify-start items-start gap-3">
                        <div class="inline-flex justify-start items-center gap-7">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <div class="text-white text-xs font-normal font-['Microsoft_Sans_Serif']">(63+) 910 495 8419</div>
                        </div>
                        <div class="self-stretch inline-flex justify-start items-center gap-7">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <div class="text-white text-xs font-normal font-['Microsoft_Sans_Serif']">government@gmail.com</div>
                        </div>

                        <!-- Main Edit Content Modal -->
                        <x-admin.content-manager.footer.edit-content-modal
                            x-show="showMainModal"
                            @close-modal.window="showMainModal = false; activeSubModal = null"
                            @open-sub-modal.window="activeSubModal = $event.detail; showMainModal = false"/>

                            <!-- Sub Modals -->
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
