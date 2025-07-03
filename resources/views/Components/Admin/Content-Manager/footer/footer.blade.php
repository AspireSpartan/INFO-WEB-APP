<div class="w-full min-h-[579px] h-auto bg-black flex justify-center items-start py-24 px-8 md:px-16 lg:px-32 relative overflow-x-hidden group">
    <button id="footer_master_edit_button" class="absolute top-4 right-4 bg-orange-500 text-white px-5 py-2 rounded-lg text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300 hover:bg-orange-600 z-40">Edit All Data</button>

    <div class="w-full max-w-[1400px] flex flex-col md:flex-row justify-between items-start gap-16">
        {{-- Main Logo Section --}}
        <div class="flex flex-col items-center justify-start gap-4 flex-shrink-0 mx-auto md:mx-0 md:mr-24 mb-16 md:mb-0 relative" id="footer_main_logo_container">
            <img src="storage/CorDev_footer.svg" alt="CoreDev Logo" class="w-[auto] h-[200px] object-cover" id="footer_main_logo_img" />
        </div>

        <div class="flex flex-col md:flex-row justify-start items-start gap-16 md:gap-36 flex-shrink-0 w-full md:w-auto">
            <div class="flex flex-col justify-start items-start gap-16 flex-shrink-0 w-auto md:w-2/1">
                {{-- KEEP IN TOUCH Section --}}
                <div class="flex flex-col justify-start items-start gap-6 relative" id="footer_keep_in_touch_section">
                    <div class="text-white text-xl font-normal font-['Microsoft_Sans_Serif']" id="footer_keep_in_touch_title">KEEP IN TOUCH</div>
                    <div class="text-stone-300 text-xl font-italic font-['Source_Sans_Pro']" id="footer_keep_in_touch_paragraph">Be up to date with our happenings <br/>and events. We Love Gumaca!</div>
                    <div class="flex justify-start items-center gap-8 mt-4" id="footer_social_links_list">
                        {{-- Social Media Links will be dynamically rendered here by JS --}}
                    </div>
                </div>

                {{-- ABOUT GOVPH Section --}}
                <div class="self-stretch flex flex-col justify-start items-start gap-6 relative" id="footer_about_govph_section">
                    <div class="self-stretch text-white text-xl font-normal font-['Microsoft_Sans_Serif']" id="footer_about_govph_title">ABOUT GOVPH</div>
                    <div class="w-auto md:w-[300px]" id="footer_about_govph_content">
                        <span class="text-stone-300 text-xs font-normal font-['Source_Sans_Pro']" id="footer_about_govph_paragraph">Learn more about the Philippine government, its structure, how government works and the people behind it.<br/><br/></span>
                        <span class="text-stone-300 text-xs font-normal font-['Source_Sans_Pro']" id="footer_about_govph_links">
                            {{-- About GovPH Links will be dynamically rendered here by JS --}}
                        </span>
                    </div>
                </div>
            </div>

            <div class="w-full md:w-96 flex flex-col justify-start items-start gap-24 flex-shrink-0">
                {{-- GOVERNMENT LINKS Section --}}
                <div class="self-stretch flex flex-col justify-start items-start gap-6 relative" id="footer_government_links_section">
                    <div class="self-stretch text-white text-xl font-normal font-['Microsoft_Sans_Serif']" id="footer_government_links_title">GOVERNMENT LINKS</div>
                    <div class="self-stretch text-stone-300 text-xs font-normal font-['Source_Sans_Pro']" id="footer_government_links_list">
                        {{-- Government Links will be dynamically rendered here by JS --}}
                    </div>
                </div>

                {{-- CONTACT US Section --}}
                <div class="self-stretch flex flex-col justify-start items-start gap-8 relative" id="footer_contact_us_section">
                    <div class="self-stretch text-white text-xl font-normal font-['Microsoft_Sans_Serif']" id="footer_contact_us_title">CONTACT US!</div>
                    <div class="w-full md:w-72 flex flex-col justify-start items-start gap-3" id="footer_contact_details_display_area">
                        {{-- Contact details will be dynamically rendered here by JS --}}
                        <div class="inline-flex justify-start items-center gap-7">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <div class="text-white text-xs font-normal font-['Microsoft_Sans_Serif']" id="footer_phone_number">(63+) 910 495 8419</div>
                        </div>
                        <div class="self-stretch inline-flex justify-start items-center gap-7">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <div class="text-white text-xs font-normal font-['Microsoft_Sans_Serif']" id="footer_email">government@gmail.com</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- NEW: Master Selection Modal (Modern Tiles) --}}
<div id="footer_master_selection_modal" class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50 hidden p-4">
    <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-4xl border border-gray-200">
        <h3 class="text-3xl font-extrabold text-gray-800 mb-8 text-center">Edit Footer Sections</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <button id="master_edit_main_logo_btn" class="bg-gray-100 hover:bg-gray-200 text-gray-800 p-6 rounded-xl flex flex-col items-center justify-center gap-3 transition-all duration-200 transform hover:scale-105 shadow-lg border border-gray-300">
                <svg class="w-16 h-16 text-orange-500" fill="currentColor" viewBox="0 0 24 24"><path d="M4 3a2 2 0 00-2 2v14a2 2 0 002 2h16a2 2 0 002-2V5a2 2 0 00-2-2H4zm0 2h16v14H4V5zm2 2h12v9H6V7zm10 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                <span class="text-xl font-semibold">Main Logo</span>
            </button>
            <button id="master_edit_keep_in_touch_btn" class="bg-gray-100 hover:bg-gray-200 text-gray-800 p-6 rounded-xl flex flex-col items-center justify-center gap-3 transition-all duration-200 transform hover:scale-105 shadow-lg border border-gray-300">
                <svg class="w-16 h-16 text-orange-500" fill="currentColor" viewBox="0 0 24 24"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884zM18.003 8.614L10 12.612 1.997 8.614A2 2 0 002 9v9a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-.003-.386zM6 10v4a2 2 0 002 2h8a2 2 0 002-2v-4l-6 3-6-3z"/></svg>
                <span class="text-xl font-semibold">Keep In Touch</span>
            </button>
            <button id="master_edit_about_govph_btn" class="bg-gray-100 hover:bg-gray-200 text-gray-800 p-6 rounded-xl flex flex-col items-center justify-center gap-3 transition-all duration-200 transform hover:scale-105 shadow-lg border border-gray-300">
                <svg class="w-16 h-16 text-orange-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                <span class="text-xl font-semibold">About GovPH</span>
            </button>
            <button id="master_edit_government_links_btn" class="bg-gray-100 hover:bg-gray-200 text-gray-800 p-6 rounded-xl flex flex-col items-center justify-center gap-3 transition-all duration-200 transform hover:scale-105 shadow-lg border border-gray-300">
                <svg class="w-16 h-16 text-orange-500" fill="currentColor" viewBox="0 0 24 24"><path d="M17 7h-4V3H7v4H3v6h4v4h6v4h4v-4h4V9h-4zM9 5h2v2H9V5zm0 10H7v-2h2v2zm6 2h-2v-2h2v2zm0-10h-2V9h2V7zm-2 2h-2v2h2V9z"/></svg>
                <span class="text-xl font-semibold">Government Links</span>
            </button>
            <button id="master_edit_contact_us_btn" class="bg-gray-100 hover:bg-gray-200 text-gray-800 p-6 rounded-xl flex flex-col items-center justify-center gap-3 transition-all duration-200 transform hover:scale-105 shadow-lg border border-gray-300">
                <svg class="w-16 h-16 text-orange-500" fill="currentColor" viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-1 16H5V6h14v12zm-8-3h2v-2h-2v2zm-4 0h2v-2H7v2z"/></svg>
                <span class="text-xl font-semibold">Contact Us</span>
            </button>
            <div class="hidden lg:flex bg-gray-100 p-6 rounded-xl items-center justify-center border border-gray-300 opacity-50 cursor-not-allowed">
                <svg class="w-16 h-16 text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15h2v-2h-2v2zm0-4h2V7h-2v6z"/></svg>
            </div>
        </div>
        <button id="master_selection_cancel_btn" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-3 px-6 rounded-lg w-full transition-colors duration-200 text-lg">Cancel</button>
    </div>
</div>

{{-- Footer Selection Modal (Existing, now styled with modern theme) --}}
<div id="footer_selection_modal" class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50 hidden p-4">
    <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-md border border-gray-200">
        <h3 class="text-3xl font-extrabold text-gray-800 mb-8 text-center" id="footer_selection_modal_title">What would you like to edit?</h3>
        <div class="flex flex-col sm:flex-row justify-center items-center gap-6 mb-8">
            <button id="footer_selection_edit_text_btn" class="bg-gray-100 hover:bg-gray-200 text-gray-800 p-6 rounded-xl flex flex-col items-center justify-center gap-3 transition-all duration-200 transform hover:scale-105 shadow-lg border border-gray-300 flex-1">
                <svg class="w-16 h-16 text-orange-500" fill="currentColor" viewBox="0 0 24 24"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 000-1.41l-2.34-2.34a.996.996 0 00-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>
                <span class="text-xl font-semibold">Edit Text</span>
            </button>
            <button id="footer_selection_edit_links_btn" class="bg-gray-100 hover:bg-gray-200 text-gray-800 p-6 rounded-xl flex flex-col items-center justify-center gap-3 transition-all duration-200 transform hover:scale-105 shadow-lg border border-gray-300 flex-1">
                <svg class="w-16 h-16 text-orange-500" fill="currentColor" viewBox="0 0 24 24"><path d="M17 7h-4V3H7v4H3v6h4v4h6v4h4v-4h4V9h-4zM9 5h2v2H9V5zm0 10H7v-2h2v2zm6 2h-2v-2h2v2zm0-10h-2V9h2V7zm-2 2h-2v2h2V9z"/></svg>
                <span class="text-xl font-semibold">Edit Links</span>
            </button>
        </div>
        <button id="footer_selection_cancel_btn" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-3 px-6 rounded-lg w-full transition-colors duration-200 text-lg">Cancel</button>
    </div>
</div>

{{-- Footer Text Edit Modal --}}
<div id="footer_edit_text_modal" class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50 hidden p-4">
    <div class="bg-white p-8 rounded-2xl shadow-2xl w-11/12 md:w-2/3 lg:w-1/2 max-h-[90vh] flex flex-col border border-gray-200">
        <h3 class="text-3xl font-extrabold text-gray-800 mb-6 text-center" id="footer_text_modal_title">Edit Content</h3>
        <div class="flex-grow overflow-y-auto pr-2 custom-scrollbar-white">
            <div class="mb-5 hidden" id="footer_edit_title_field">
                <label for="footer_edit_title" class="block text-gray-700 text-base font-semibold mb-2">Title:</label>
                <textarea id="footer_edit_title" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 bg-gray-100 text-gray-800 leading-tight focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200"></textarea>
            </div>
            <div class="mb-5 hidden" id="footer_edit_paragraph_field">
                <label for="footer_edit_paragraph" class="block text-gray-700 text-base font-semibold mb-2">Paragraph:</label>
                <textarea id="footer_edit_paragraph" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 bg-gray-100 text-gray-800 leading-tight focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent h-32 resize-y transition-all duration-200"></textarea>
            </div>
            <div class="mb-5 hidden" id="footer_edit_single_text_field">
                <label for="footer_edit_single_text" class="block text-gray-700 text-base font-semibold mb-2">Text:</label>
                <input type="text" id="footer_edit_single_text" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 bg-gray-100 text-gray-800 leading-tight focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200">
            </div>
        </div>
        <div class="flex justify-end gap-4 mt-6 pt-4 border-t border-gray-200">
            <button id="footer_cancel_text_edit" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-5 rounded-lg transition-colors duration-200">Cancel</button>
            <button id="footer_save_text_edit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-5 rounded-lg transition-colors duration-200">Save Changes</button>
        </div>
    </div>
</div>

{{-- Footer Links Edit Modal (Vertical) --}}
<div id="footer_edit_links_modal" class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50 hidden p-4">
    <div class="bg-white p-8 rounded-2xl shadow-2xl w-11/12 md:w-2/3 lg:w-1/2 max-h-[90vh] flex flex-col border border-gray-200">
        <h3 class="text-3xl font-extrabold text-gray-800 mb-6 text-center" id="footer_links_modal_title">Edit Links</h3>
        <div class="bg-gray-100 p-6 rounded-xl shadow-md mb-6 border border-gray-300"> {{-- Card for new link input --}}
            <h4 class="font-semibold text-xl text-gray-800 mb-4">Add New Link:</h4>
            <div class="mb-4">
                <label for="footer_new_link_text" class="block text-gray-700 text-base font-semibold mb-2">Link Text:</label>
                <input type="text" id="footer_new_link_text" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 bg-white text-gray-800 leading-tight focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200" placeholder="e.g., Facebook">
            </div>
            <div class="mb-4">
                <label for="footer_new_link_url" class="block text-gray-700 text-base font-semibold mb-2">Link URL:</label>
                <input type="text" id="footer_new_link_url" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 bg-white text-gray-800 leading-tight focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200" placeholder="e.g., https://facebook.com/yourpage">
            </div>
            <div id="footer_social_media_icon_upload_field" class="mb-4 hidden">
                <label for="footer_new_link_icon_file" class="block text-gray-700 text-base font-semibold mb-2">Custom Icon (for Social Media):</label>
                <input type="file" id="footer_new_link_icon_file" accept="image/*" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 bg-white text-gray-800 leading-tight focus:outline-none focus:shadow-outline transition-all duration-200">
                <img id="footer_new_link_icon_preview" class="mt-4 h-16 w-16 object-contain hidden border border-gray-400 rounded-md p-1" alt="Icon Preview">
            </div>
            <button id="footer_add_link_button" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-5 rounded-lg w-full transition-colors duration-200">Add Link</button>
        </div>
        <div class="flex-grow overflow-y-auto pr-2 -mr-2 py-4 custom-scrollbar-white"> {{-- Margin-right negative for scrollbar --}}
            <h4 class="font-semibold text-xl text-gray-800 mb-4">Existing Links:</h4>
            <div id="footer_modal_links_list" class="flex flex-col gap-4"> {{-- Added gap for spacing between cards --}}
                {{-- Links will be rendered here --}}
            </div>
        </div>
        <div class="flex justify-end gap-4 mt-6 pt-4 border-t border-gray-200">
            <button id="footer_cancel_links_edit" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-5 rounded-lg transition-colors duration-200">Close</button>
        </div>
    </div>
</div>

{{-- Footer Logo Edit Modal --}}
<div id="footer_edit_logo_modal" class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50 hidden p-4">
    <div class="bg-white p-8 rounded-2xl shadow-2xl w-11/12 md:w-1/2 lg:w-1/3 border border-gray-200">
        <h3 class="text-3xl font-extrabold text-gray-800 mb-6 text-center">Edit Main Logo</h3>
        <div class="mb-6">
            <label for="footer_new_logo_file" class="block text-gray-700 text-base font-semibold mb-2">Upload New Logo (PNG, SVG, JPG, etc.):</label>
            <input type="file" id="footer_new_logo_file" accept="image/*" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 bg-gray-100 text-gray-800 leading-tight focus:outline-none focus:shadow-outline transition-all duration-200">
            <p class="text-sm text-gray-500 mt-2">Recommended: PNG or SVG for best quality.</p>
            <div class="mt-4 flex justify-center items-center h-32 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                <img id="footer_new_logo_preview" class="max-h-full max-w-full object-contain hidden" alt="Logo Preview">
                <span id="footer_logo_preview_placeholder" class="text-gray-400 text-sm">No image selected</span>
            </div>
        </div>
        <div class="flex justify-end gap-4 mt-6 pt-4 border-t border-gray-200">
            <button id="footer_cancel_logo_edit" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-5 rounded-lg transition-colors duration-200">Cancel</button>
            <button id="footer_save_logo_edit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-5 rounded-lg transition-colors duration-200">Save Changes</button>
        </div>
    </div>
</div>

{{-- Footer Contact Details Edit Modal (NEW) --}}
<div id="footer_contact_details_modal" class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50 hidden p-4">
    <div class="bg-white p-8 rounded-2xl shadow-2xl w-11/12 md:w-2/3 lg:w-1/2 max-h-[90vh] flex flex-col border border-gray-200">
        <h3 class="text-3xl font-extrabold text-gray-800 mb-6 text-center">Edit Contact Details</h3>

        <div class="flex-grow overflow-y-auto pr-2 -mr-2 custom-scrollbar-white"> {{-- Added overflow and margin for scrollbar --}}
            <div class="bg-gray-100 p-6 rounded-xl shadow-md mb-6 border border-gray-300"> {{-- Card for Main Contact Info --}}
                <h4 class="font-semibold text-xl text-gray-800 mb-4">Main Contact Info:</h4>
                <div class="mb-4">
                    <label for="footer_edit_main_phone" class="block text-gray-700 text-base font-semibold mb-2">Phone Number:</label>
                    <input type="text" id="footer_edit_main_phone" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 bg-white text-gray-800 leading-tight focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200">
                </div>
                <div>
                    <label for="footer_edit_main_email" class="block text-gray-700 text-base font-semibold mb-2">Email Address:</label>
                    <input type="text" id="footer_edit_main_email" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 bg-white text-gray-800 leading-tight focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200">
                </div>
            </div>

            <div class="bg-gray-100 p-6 rounded-xl shadow-md mb-6 border border-gray-300"> {{-- Card for Add New Contact Detail --}}
                <h4 class="font-semibold text-xl text-gray-800 mb-4">Add New Contact Detail:</h4>
                <div class="mb-4">
                    <label for="footer_new_contact_detail_text" class="block text-gray-700 text-base font-semibold mb-2">Detail Text:</label>
                    <input type="text" id="footer_new_contact_detail_text" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 bg-white text-gray-800 leading-tight focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200" placeholder="e.g., Office Address">
                </div>
                <div class="mb-4">
                    <label for="footer_new_contact_icon_type" class="block text-gray-700 text-base font-semibold mb-2">Icon Type (e.g., phone, email, map, address):</label>
                    <input type="text" id="footer_new_contact_icon_type" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 bg-white text-gray-800 leading-tight focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200" placeholder="e.g., map">
                </div>
                <div class="mb-6">
                    <label for="footer_new_contact_icon_file" class="block text-gray-700 text-base font-semibold mb-2">Custom Icon Image (Optional):</label>
                    <input type="file" id="footer_new_contact_icon_file" accept="image/*" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 bg-white text-gray-800 leading-tight focus:outline-none focus:shadow-outline transition-all duration-200">
                    <img id="footer_new_contact_icon_preview" class="mt-4 h-12 w-12 object-contain hidden border border-gray-400 rounded-md p-1" alt="Icon Preview">
                </div>
                <button id="footer_add_contact_detail_button" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-5 rounded-lg w-full transition-colors duration-200">Add Detail</button>
            </div>

            <div id="footer_modal_other_contact_details_list" class="flex flex-col gap-3"> {{-- Added gap for spacing between cards --}}
                <h4 class="font-semibold text-xl text-gray-800 mb-2">Other Details:</h4>
                {{-- Other contact details will be rendered here --}}
            </div>
        </div>

        <div class="flex justify-end gap-4 mt-6 pt-4 border-t border-gray-200">
            <button id="footer_cancel_contact_edit" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-5 rounded-lg transition-colors duration-200">Cancel</button>
            <button id="footer_save_contact_edit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-5 rounded-lg transition-colors duration-200">Save Changes</button>
        </div>
    </div>
</div>

<style>
    /* Custom scrollbar for better aesthetics on modals (White Theme) */
    .custom-scrollbar-white::-webkit-scrollbar {
        width: 8px;
    }

    .custom-scrollbar-white::-webkit-scrollbar-track {
        background: #e0e0e0; /* Lighter track */
        border-radius: 10px;
    }

    .custom-scrollbar-white::-webkit-scrollbar-thumb {
        background: #999; /* Darker gray thumb */
        border-radius: 10px;
    }

    .custom-scrollbar-white::-webkit-scrollbar-thumb:hover {
        background: #777; /* Even darker gray on hover */
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // --- Footer Modals ---
        const footer_masterSelectionModal = document.getElementById('footer_master_selection_modal');
        const footer_selectionModal = document.getElementById('footer_selection_modal');
        const footer_editTextModal = document.getElementById('footer_edit_text_modal');
        const footer_editLinksModal = document.getElementById('footer_edit_links_modal');
        const footer_editLogoModal = document.getElementById('footer_edit_logo_modal');
        const footer_contactDetailsModal = document.getElementById('footer_contact_details_modal');

        // --- Master Edit Button ---
        const footer_masterEditButton = document.getElementById('footer_master_edit_button');

        // --- Master Selection Modal Elements ---
        const masterEditMainLogoBtn = document.getElementById('master_edit_main_logo_btn');
        const masterEditKeepInTouchBtn = document.getElementById('master_edit_keep_in_touch_btn');
        const masterEditAboutGovphBtn = document.getElementById('master_edit_about_govph_btn');
        const masterEditGovernmentLinksBtn = document.getElementById('master_edit_government_links_btn');
        const masterEditContactUsBtn = document.getElementById('master_edit_contact_us_btn');
        const masterSelectionCancelBtn = document.getElementById('master_selection_cancel_btn');


        // --- Footer Selection Modal Elements ---
        const footer_selectionModalTitle = document.getElementById('footer_selection_modal_title');
        const footer_selectionEditTextBtn = document.getElementById('footer_selection_edit_text_btn');
        const footer_selectionEditLinksBtn = document.getElementById('footer_selection_edit_links_btn');
        const footer_selectionCancelBtn = document.getElementById('footer_selection_cancel_btn');
        let footer_activeSelectionSection = null; // To track which section (Keep In Touch or About GovPH) is being edited

        // --- Footer Text Modal Elements ---
        const footer_textModalTitle = document.getElementById('footer_text_modal_title');
        const footer_editTitleField = document.getElementById('footer_edit_title_field');
        const footer_editParagraphField = document.getElementById('footer_edit_paragraph_field');
        const footer_editSingleTextField = document.getElementById('footer_edit_single_text_field');
        const footer_editTitleInput = document.getElementById('footer_edit_title');
        const footer_editParagraphInput = document.getElementById('footer_edit_paragraph');
        const footer_editSingleTextInput = document.getElementById('footer_edit_single_text');
        const footer_saveTextEditBtn = document.getElementById('footer_save_text_edit');
        const footer_cancelTextEditBtn = document.getElementById('footer_cancel_text_edit');

        // --- Footer Links Modal Elements ---
        const footer_linksModalTitle = document.getElementById('footer_links_modal_title');
        const footer_newLinkTextInput = document.getElementById('footer_new_link_text');
        const footer_newLinkUrlInput = document.getElementById('footer_new_link_url');
        const footer_socialMediaIconUploadField = document.getElementById('footer_social_media_icon_upload_field');
        const footer_newLinkIconFile = document.getElementById('footer_new_link_icon_file');
        const footer_newLinkIconPreview = document.getElementById('footer_new_link_icon_preview');
        const footer_addLinkButton = document.getElementById('footer_add_link_button');
        const footer_modalLinksList = document.getElementById('footer_modal_links_list');
        const footer_cancelLinksEditBtn = document.getElementById('footer_cancel_links_edit');
        let footer_isSocialMediaLinks = false;
        let footer_currentLinksArrayRef = null; // Reference to the actual array in footer_static_data
        let footer_currentLinksTargetElementId = null; // ID of the div to update on the main page

        // --- Footer Logo Modal Elements (UPDATED) ---
        const footer_mainLogoImg = document.getElementById('footer_main_logo_img');
        const footer_newLogoFile = document.getElementById('footer_new_logo_file'); // Changed from footer_new_logo_url
        const footer_newLogoPreview = document.getElementById('footer_new_logo_preview');
        const footer_logoPreviewPlaceholder = document.getElementById('footer_logo_preview_placeholder');
        const footer_saveLogoEditBtn = document.getElementById('footer_save_logo_edit');
        const footer_cancelLogoEditBtn = document.getElementById('footer_cancel_logo_edit');

        // --- Footer Contact Details Modal Elements ---
        const footer_editMainPhoneInput = document.getElementById('footer_edit_main_phone');
        const footer_editMainEmailInput = document.getElementById('footer_edit_main_email');
        const footer_newContactDetailTextInput = document.getElementById('footer_new_contact_detail_text');
        const footer_newContactIconTypeInput = document.getElementById('footer_new_contact_icon_type');
        const footer_newContactIconFile = document.getElementById('footer_new_contact_icon_file');
        const footer_newContactIconPreview = document.getElementById('footer_new_contact_icon_preview');
        const footer_addContactDetailButton = document.getElementById('footer_add_contact_detail_button');
        const footer_modalOtherContactDetailsList = document.getElementById('footer_modal_other_contact_details_list');
        const footer_saveContactEditBtn = document.getElementById('footer_save_contact_edit');
        const footer_cancelContactEditBtn = document.getElementById('footer_cancel_contact_edit');
        const footer_contactDetailsDisplayArea = document.getElementById('footer_contact_details_display_area');


        // --- Footer Data Storage (Static for now) ---
        let footer_static_data = {
            mainLogo: {
                src: "storage/CorDev_footer.svg" // This will temporarily hold base64 or a local URL after upload
            },
            keepInTouch: {
                title: "KEEP IN TOUCH",
                paragraph: "Be up to date with our happenings \nand events. We Love Gumaca!",
                socialLinks: [
                    { text: "Facebook", url: "#", icon: "facebook", imageUrl: "" },
                    { text: "Instagram", url: "#", icon: "instagram", imageUrl: "" },
                    { text: "LinkedIn", url: "#", icon: "linkedin", imageUrl: "" }
                ]
            },
            aboutGovph: {
                title: "ABOUT GOVPH",
                paragraph: "Learn more about the Philippine government, its structure, how government works and the people behind it.",
                links: [
                    { text: "GOV.PH", url: "#" },
                    { text: "Open Data Portal", url: "#" },
                    { text: "Official Gazette", url: "#" }
                ]
            },
            governmentLinks: {
                title: "GOVERNMENT LINKS",
                links: [
                    { text: "Office of the President", url: "#" },
                    { text: "Office of the Vice-President", url: "#" },
                    { text: "Senate of the Philippines", url: "#" },
                    { text: "House of Representatives", url: "#" },
                    { text: "Supreme Court", url: "#" },
                    { text: "Court of Appeals", url: "#" },
                    { text: "Sandiganbayan", url: "#" }
                ]
            },
            contactUs: {
                title: "CONTACT US!",
                mainPhone: "(63+) 910 495 8419",
                mainEmail: "government@gmail.com",
                otherDetails: []
            }
        };

        // --- Helper Functions to manage Modals ---
        function footer_openModal(modalElement) {
            modalElement.classList.remove('hidden');
        }

        function footer_closeModal(modalElement) {
            modalElement.classList.add('hidden');
        }

        // --- Master Edit Button Listener (NEW) ---
        footer_masterEditButton.addEventListener('click', () => {
            footer_openModal(footer_masterSelectionModal);
        });

        // --- Master Selection Modal Listeners (NEW) ---
        masterEditMainLogoBtn.addEventListener('click', () => {
            footer_closeModal(footer_masterSelectionModal);
            // Reset logo file input and preview when opening
            footer_newLogoFile.value = '';
            footer_newLogoPreview.src = '';
            footer_newLogoPreview.classList.add('hidden');
            footer_logoPreviewPlaceholder.classList.remove('hidden');

            footer_openModal(footer_editLogoModal);
        });

        masterEditKeepInTouchBtn.addEventListener('click', () => {
            footer_closeModal(footer_masterSelectionModal);
            footer_activeSelectionSection = 'keepInTouch';
            footer_selectionModalTitle.innerText = `Edit Keep In Touch Section`;
            footer_openModal(footer_selectionModal);
        });

        masterEditAboutGovphBtn.addEventListener('click', () => {
            footer_closeModal(footer_masterSelectionModal);
            footer_activeSelectionSection = 'aboutGovph';
            footer_selectionModalTitle.innerText = `Edit About GovPH Section`;
            footer_openModal(footer_selectionModal);
        });

        masterEditGovernmentLinksBtn.addEventListener('click', () => {
            footer_closeModal(footer_masterSelectionModal);
            footer_linksModalTitle.innerText = `Edit Government Links`;
            footer_socialMediaIconUploadField.classList.add('hidden'); // Gov links don't use social icons
            footer_renderLinksInModal(footer_static_data.governmentLinks.links, 'footer_government_links_list', false);
            footer_openModal(footer_editLinksModal);
        });

        masterEditContactUsBtn.addEventListener('click', () => {
            footer_closeModal(footer_masterSelectionModal);
            footer_editMainPhoneInput.value = footer_static_data.contactUs.mainPhone;
            footer_editMainEmailInput.value = footer_static_data.contactUs.mainEmail;
            footer_renderContactDetailsInModal();
            footer_openModal(footer_contactDetailsModal);
        });

        masterSelectionCancelBtn.addEventListener('click', () => {
            footer_closeModal(footer_masterSelectionModal);
        });

        // --- Selection Modal Logic ---
        footer_selectionEditTextBtn.addEventListener('click', () => {
            footer_closeModal(footer_selectionModal);
            if (footer_activeSelectionSection === 'keepInTouch') {
                footer_textModalTitle.innerText = "Edit Keep In Touch Content";
                footer_editTitleField.classList.remove('hidden');
                footer_editParagraphField.classList.remove('hidden');
                footer_editSingleTextField.classList.add('hidden');
                footer_editTitleInput.value = footer_static_data.keepInTouch.title;
                footer_editParagraphInput.value = footer_static_data.keepInTouch.paragraph;
            } else if (footer_activeSelectionSection === 'aboutGovph') {
                footer_textModalTitle.innerText = "Edit About GovPH Content";
                footer_editTitleField.classList.remove('hidden');
                footer_editParagraphField.classList.remove('hidden');
                footer_editSingleTextField.classList.add('hidden');
                footer_editTitleInput.value = footer_static_data.aboutGovph.title;
                footer_editParagraphInput.value = footer_static_data.aboutGovph.paragraph;
            }
            footer_openModal(footer_editTextModal);
        });

        footer_selectionEditLinksBtn.addEventListener('click', () => {
            footer_closeModal(footer_selectionModal);
            if (footer_activeSelectionSection === 'keepInTouch') {
                footer_linksModalTitle.innerText = "Edit Social Media Links";
                footer_socialMediaIconUploadField.classList.remove('hidden');
                footer_renderLinksInModal(footer_static_data.keepInTouch.socialLinks, 'footer_social_links_list', true);
            } else if (footer_activeSelectionSection === 'aboutGovph') {
                footer_linksModalTitle.innerText = "Edit About GovPH Links";
                footer_socialMediaIconUploadField.classList.add('hidden');
                footer_renderLinksInModal(footer_static_data.aboutGovph.links, 'footer_about_govph_links', false);
            }
            footer_openModal(footer_editLinksModal);
        });

        footer_selectionCancelBtn.addEventListener('click', () => {
            footer_closeModal(footer_selectionModal);
            footer_activeSelectionSection = null;
        });

        // --- Text Modal Logic ---
        footer_saveTextEditBtn.addEventListener('click', () => {
            if (footer_activeSelectionSection === 'keepInTouch') {
                footer_static_data.keepInTouch.title = footer_editTitleInput.value;
                footer_static_data.keepInTouch.paragraph = footer_editParagraphInput.value;
            } else if (footer_activeSelectionSection === 'aboutGovph') {
                footer_static_data.aboutGovph.title = footer_editTitleInput.value;
                footer_static_data.aboutGovph.paragraph = footer_editParagraphInput.value;
            } else {
                console.warn("Save text button clicked for an unknown text context.");
            }
            footer_initializeContent();
            footer_closeModal(footer_editTextModal);
            footer_activeSelectionSection = null;
        });

        footer_cancelTextEditBtn.addEventListener('click', () => {
            footer_closeModal(footer_editTextModal);
            footer_activeSelectionSection = null;
        });

        // --- Links Modal Logic ---
        footer_newLinkIconFile.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    footer_newLinkIconPreview.src = e.target.result;
                    footer_newLinkIconPreview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                footer_newLinkIconPreview.src = '';
                footer_newLinkIconPreview.classList.add('hidden');
            }
        });

        footer_addLinkButton.addEventListener('click', () => {
            const newText = footer_newLinkTextInput.value.trim();
            const newUrl = footer_newLinkUrlInput.value.trim();
            if (newText && newUrl && footer_currentLinksArrayRef) {
                const newLink = { text: newText, url: newUrl };

                if (footer_isSocialMediaLinks) {
                    if (footer_newLinkIconFile.files.length > 0) {
                        newLink.imageUrl = footer_newLinkIconPreview.src;
                        newLink.icon = '';
                    } else {
                        if (newText.toLowerCase().includes('facebook')) newLink.icon = 'facebook';
                        else if (newText.toLowerCase().includes('instagram')) newLink.icon = 'instagram';
                        else if (newText.toLowerCase().includes('linkedin')) newLink.icon = 'linkedin';
                        else newLink.icon = ''; // Fallback for social media if no specific match
                        newLink.imageUrl = '';
                    }
                }

                footer_currentLinksArrayRef.push(newLink);
                footer_newLinkTextInput.value = '';
                footer_newLinkUrlInput.value = '';
                footer_newLinkIconFile.value = '';
                footer_newLinkIconPreview.src = '';
                footer_newLinkIconPreview.classList.add('hidden');

                footer_renderLinksInModal(footer_currentLinksArrayRef, footer_currentLinksTargetElementId, footer_isSocialMediaLinks);
                footer_updateDisplayedLinks(footer_currentLinksTargetElementId, footer_currentLinksArrayRef);
            } else {
                alert('Please enter both link text and URL.');
            }
        });

        function footer_renderLinksInModal(linksArray, targetElementId, isSocialMedia) {
            footer_modalLinksList.innerHTML = '';
            footer_currentLinksArrayRef = linksArray;
            footer_currentLinksTargetElementId = targetElementId;
            footer_isSocialMediaLinks = isSocialMedia;

            if (isSocialMedia) {
                footer_socialMediaIconUploadField.classList.remove('hidden');
            } else {
                footer_socialMediaIconUploadField.classList.add('hidden');
            }

            linksArray.forEach((link, index) => {
                const linkItem = document.createElement('div');
                linkItem.classList.add('bg-white', 'p-4', 'rounded-lg', 'shadow-sm', 'border', 'border-gray-200', 'relative', 'flex', 'flex-col', 'gap-3');

                if (isSocialMedia) {
                    const iconPreviewContainer = document.createElement('div');
                    iconPreviewContainer.classList.add('flex', 'items-center', 'gap-2', 'mb-2');
                    const imgPreview = document.createElement('img');
                    imgPreview.classList.add('h-8', 'w-8', 'object-contain', 'border', 'rounded', 'p-1', 'bg-gray-100');
                    imgPreview.src = link.imageUrl || `data:image/svg+xml;base64,${btoa(getSvgIcon(link.icon))}`;
                    imgPreview.alt = link.text + ' icon';
                    iconPreviewContainer.appendChild(imgPreview);
                    const iconLabel = document.createElement('span');
                    iconLabel.classList.add('text-gray-700');
                    iconLabel.innerText = 'Current Icon:';
                    iconPreviewContainer.appendChild(iconLabel);
                    linkItem.appendChild(iconPreviewContainer);
                }

                const textLabel = document.createElement('label');
                textLabel.classList.add('block', 'text-gray-700', 'text-sm', 'font-semibold');
                textLabel.innerText = 'Link Text:';
                linkItem.appendChild(textLabel);
                const textInput = document.createElement('input');
                textInput.type = 'text';
                textInput.value = link.text;
                textInput.classList.add('shadow-sm', 'appearance-none', 'border', 'border-gray-300', 'rounded-lg', 'w-full', 'py-2', 'px-3', 'bg-gray-100', 'text-gray-800', 'leading-tight', 'focus:outline-none', 'focus:ring-2', 'focus:ring-orange-500', 'focus:border-transparent', 'transition-all', 'duration-200');
                textInput.placeholder = 'Link Text';
                textInput.addEventListener('change', (e) => {
                    linksArray[index].text = e.target.value;
                    footer_updateDisplayedLinks(footer_currentLinksTargetElementId, footer_currentLinksArrayRef);
                });
                linkItem.appendChild(textInput);

                const urlLabel = document.createElement('label');
                urlLabel.classList.add('block', 'text-gray-700', 'text-sm', 'font-semibold', 'mt-3');
                urlLabel.innerText = 'Link URL:';
                linkItem.appendChild(urlLabel);
                const urlInput = document.createElement('input');
                urlInput.type = 'text';
                urlInput.value = link.url;
                urlInput.classList.add('shadow-sm', 'appearance-none', 'border', 'border-gray-300', 'rounded-lg', 'w-full', 'py-2', 'px-3', 'bg-gray-100', 'text-gray-800', 'leading-tight', 'focus:outline-none', 'focus:ring-2', 'focus:ring-orange-500', 'focus:border-transparent', 'transition-all', 'duration-200');
                urlInput.placeholder = 'Link URL';
                urlInput.addEventListener('change', (e) => {
                    linksArray[index].url = e.target.value;
                    footer_updateDisplayedLinks(footer_currentLinksTargetElementId, footer_currentLinksArrayRef);
                });
                linkItem.appendChild(urlInput);

                const removeBtn = document.createElement('button');
                removeBtn.innerText = 'Remove';
                removeBtn.classList.add('bg-red-600', 'hover:bg-red-700', 'text-white', 'font-bold', 'py-1.5', 'px-3', 'rounded-md', 'text-sm', 'mt-4', 'self-end', 'transition-colors', 'duration-200');
                removeBtn.addEventListener('click', () => {
                    footer_removeLink(linksArray, index);
                });
                linkItem.appendChild(removeBtn);

                footer_modalLinksList.appendChild(linkItem);
            });
        }

        function footer_removeLink(linksArray, indexToRemove) {
            linksArray.splice(indexToRemove, 1);
            footer_renderLinksInModal(linksArray, footer_currentLinksTargetElementId, footer_isSocialMediaLinks);
            footer_updateDisplayedLinks(footer_currentLinksTargetElementId, linksArray);
        }

        footer_cancelLinksEditBtn.addEventListener('click', () => {
            footer_closeModal(footer_editLinksModal);
            footer_activeSelectionSection = null; // Reset selection context
            footer_newLinkIconFile.value = '';
            footer_newLinkIconPreview.src = '';
            footer_newLinkIconPreview.classList.add('hidden');
        });

        // --- Logo Modal Logic (UPDATED) ---
        footer_newLogoFile.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    footer_newLogoPreview.src = e.target.result;
                    footer_newLogoPreview.classList.remove('hidden');
                    footer_logoPreviewPlaceholder.classList.add('hidden');
                };
                reader.readAsDataURL(file); // Read file as a data URL (base64)
            } else {
                footer_newLogoPreview.src = '';
                footer_newLogoPreview.classList.add('hidden');
                footer_logoPreviewPlaceholder.classList.remove('hidden');
            }
        });

        footer_saveLogoEditBtn.addEventListener('click', () => {
            if (footer_newLogoFile.files.length > 0) {
                const file = footer_newLogoFile.files[0];
                const reader = new FileReader();

                reader.onload = (e) => {
                    footer_static_data.mainLogo.src = e.target.result; // Store base64 string
                    footer_mainLogoImg.src = e.target.result; // Update displayed image
                    footer_closeModal(footer_editLogoModal);
                    footer_newLogoFile.value = ''; // Clear file input
                    footer_newLogoPreview.src = '';
                    footer_newLogoPreview.classList.add('hidden');
                    footer_logoPreviewPlaceholder.classList.remove('hidden');
                };
                reader.readAsDataURL(file); // Convert file to base64
            } else {
                alert('Please select an image file to upload.');
            }
        });

        footer_cancelLogoEditBtn.addEventListener('click', () => {
            footer_closeModal(footer_editLogoModal);
            // Reset file input and preview when canceling
            footer_newLogoFile.value = '';
            footer_newLogoPreview.src = '';
            footer_newLogoPreview.classList.add('hidden');
            footer_logoPreviewPlaceholder.classList.remove('hidden');
        });

        // --- Contact Details Modal Logic ---
        footer_newContactIconFile.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    footer_newContactIconPreview.src = e.target.result;
                    footer_newContactIconPreview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                footer_newContactIconPreview.src = '';
                footer_newContactIconPreview.classList.add('hidden');
            }
        });

        function footer_renderContactDetailsInModal() {
            footer_modalOtherContactDetailsList.innerHTML = '<h4 class="font-semibold text-xl text-gray-800 mb-2">Other Details:</h4>'; // Clear existing
            footer_static_data.contactUs.otherDetails.forEach((detail, index) => {
                const detailItem = document.createElement('div');
                detailItem.classList.add('bg-white', 'p-4', 'rounded-lg', 'shadow-sm', 'border', 'border-gray-200', 'flex', 'items-center', 'gap-4', 'mb-3');

                if (detail.imageUrl) {
                    const img = document.createElement('img');
                    img.src = detail.imageUrl;
                    img.alt = detail.icon || 'icon';
                    img.classList.add('w-6', 'h-6', 'object-contain', 'flex-shrink-0');
                    detailItem.appendChild(img);
                } else if (detail.icon) {
                    const svgContainer = document.createElement('div');
                    svgContainer.classList.add('w-6', 'h-6', 'flex-shrink-0', 'text-gray-600'); // Changed text color for icons
                    svgContainer.innerHTML = getContactIconSvg(detail.icon);
                    detailItem.appendChild(svgContainer);
                }

                const textSpan = document.createElement('span');
                textSpan.innerText = detail.text;
                textSpan.classList.add('flex-grow', 'text-base', 'text-gray-700'); // Changed text color
                detailItem.appendChild(textSpan);

                const removeBtn = document.createElement('button');
                removeBtn.innerText = 'Remove';
                removeBtn.classList.add('bg-red-600', 'hover:bg-red-700', 'text-white', 'font-bold', 'py-1.5', 'px-3', 'rounded-md', 'text-sm', 'flex-shrink-0', 'transition-colors', 'duration-200');
                removeBtn.addEventListener('click', () => {
                    footer_removeContactDetail(index);
                });
                detailItem.appendChild(removeBtn);

                footer_modalOtherContactDetailsList.appendChild(detailItem);
            });
        }

        footer_addContactDetailButton.addEventListener('click', () => {
            const detailText = footer_newContactDetailTextInput.value.trim();
            const iconType = footer_newContactIconTypeInput.value.trim().toLowerCase();
            let imageUrl = '';

            if (footer_newContactIconFile.files.length > 0) {
                imageUrl = footer_newContactIconPreview.src;
            }

            if (detailText) {
                footer_static_data.contactUs.otherDetails.push({
                    text: detailText,
                    icon: iconType,
                    imageUrl: imageUrl
                });
                footer_newContactDetailTextInput.value = '';
                footer_newContactIconTypeInput.value = '';
                footer_newContactIconFile.value = '';
                footer_newContactIconPreview.src = '';
                footer_newContactIconPreview.classList.add('hidden');
                footer_renderContactDetailsInModal();
            } else {
                alert('Please enter text for the new contact detail.');
            }
        });

        function footer_removeContactDetail(indexToRemove) {
            footer_static_data.contactUs.otherDetails.splice(indexToRemove, 1);
            footer_renderContactDetailsInModal();
        }

        footer_saveContactEditBtn.addEventListener('click', () => {
            footer_static_data.contactUs.mainPhone = footer_editMainPhoneInput.value.trim();
            footer_static_data.contactUs.mainEmail = footer_editMainEmailInput.value.trim();
            footer_initializeContent();
            footer_closeModal(footer_contactDetailsModal);
        });

        footer_cancelContactEditBtn.addEventListener('click', () => {
            footer_closeModal(footer_contactDetailsModal);
            footer_newContactDetailTextInput.value = '';
            footer_newContactIconTypeInput.value = '';
            footer_newContactIconFile.value = '';
            footer_newContactIconPreview.src = '';
            footer_newContactIconPreview.classList.add('hidden');
        });


        // Helper to get SVG for common contact icons
        function getContactIconSvg(iconType) {
            // Updated text-current to use text-gray-600 for white theme contrast
            switch (iconType) {
                case 'phone':
                    return '<svg class="w-5 h-5 text-current" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>';
                case 'email':
                    return '<svg class="w-5 h-5 text-current" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>';
                case 'map':
                case 'address':
                    return '<svg class="w-5 h-5 text-current" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0L6.343 16.657m11.314 0A8.998 8.998 0 0112 20c-3.996 0-7.001-3.218-7.001-7.155C4.999 9.176 9.043 5.39 12 5.39s7.001 3.786 7.001 7.455c0 3.937-3.005 7.155-7.001 7.155zM12 13a2 2 0 100-4 2 2 0 000 4z"/></svg>';
                default:
                    return '<svg class="w-5 h-5 text-current" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"/><path d="M9 12a3 3 0 116 0 3 3 0 01-6 0z"/></svg>'; // Generic icon
            }
        }


        // Helper to get SVG icon content based on type (for social media)
        function getSvgIcon(iconType) {
            // Updated text-white to text-gray-800 for contrast on white background
            switch (iconType) {
                case 'facebook':
                    return '<svg class="w-6 h-6 text-gray-800" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.505 1.492-3.89 3.776-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33V22H12c5.523 0 10-4.477 10-10z" clip-rule="evenodd" /></svg>';
                case 'instagram':
                    return '<svg class="w-6 h-6 text-gray-800" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12 5C8.134 5 5 8.134 5 12s3.134 7 7 7 7-3.134 7-7-3.134-7-7-7zm0 2c2.76 0 5 2.24 5 5s-2.24 5-5 5-5-2.24-5-5 2.24-5 5-5zM12 9a3 3 0 100 6 3 3 0 000-6zm6.5-3.5c-.552 0-1 .448-1 1s.448 1 1 1 1-.448 1-1-.448-1-1-1z" clip-rule="evenodd" /><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm7 10c0 3.86-3.14 7-7 7s-7-3.14-7-7 3.14-7 7-7 7 3.14 7 7z" clip-rule="evenodd" /></svg>';
                case 'linkedin':
                    return '<svg class="w-6 h-6 text-gray-800" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.381 1.11-2.5 2.48-2.5s2.48 1.119 2.48 2.5zM.02 24h4.96V8H.02v16zM24 16.51c0-4.478-2.77-7.317-6.6-7.317-3.791 0-5.748 2.37-5.748 7.317V24h4.96v-7.317c0-2.481.564-4.834 3.535-4.834 2.972 0 3.465 2.564 3.465 4.834V24H24v-7.49z"/></svg>';
                default:
                    return '<svg class="w-6 h-6 text-gray-800" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"/><path d="M9 12a3 3 0 116 0 3 3 0 01-6 0z"/></svg>'; // Generic icon
            }
        }

        // Function to update links on the main display
        function footer_updateDisplayedLinks(targetElementId, linksArray) {
            const targetElement = document.getElementById(targetElementId);
            if (!targetElement) return;

            targetElement.innerHTML = ''; // Clear existing links

            if (targetElementId === 'footer_social_links_list') {
                linksArray.forEach(link => {
                    const a = document.createElement('a');
                    a.href = link.url;
                    a.target = "_blank";
                    a.classList.add('w-10', 'h-10', 'bg-white', 'rounded-full', 'flex', 'items-center', 'justify-center');
                    a.setAttribute('data-link-text', link.text);

                    if (link.imageUrl) {
                        const img = document.createElement('img');
                        img.src = link.imageUrl;
                        img.alt = link.text + ' icon';
                        img.classList.add('w-6', 'h-6', 'object-contain');
                        a.appendChild(img);
                    } else if (link.icon) {
                        a.innerHTML = getSvgIcon(link.icon);
                    } else {
                        a.innerHTML = getSvgIcon('default');
                    }
                    targetElement.appendChild(a);
                });
            } else if (targetElementId === 'footer_about_govph_links') {
                linksArray.forEach(link => {
                    const a = document.createElement('a');
                    a.href = link.url;
                    a.target = "_blank";
                    a.classList.add('block', 'text-stone-300', 'hover:text-orange-400', 'transition-colors', 'duration-200'); // Added hover color
                    a.innerText = link.text;
                    targetElement.appendChild(a);
                });
            } else if (targetElementId === 'footer_government_links_list') {
                 linksArray.forEach(link => {
                    const a = document.createElement('a');
                    a.href = link.url;
                    a.target = "_blank";
                    a.classList.add('block', 'text-stone-300', 'hover:text-orange-400', 'transition-colors', 'duration-200'); // Added hover color
                    a.innerText = link.text;
                    targetElement.appendChild(a);
                });
            }
        }

        // Function to update displayed contact details on the main page
        function footer_updateDisplayedContactDetails() {
            footer_contactDetailsDisplayArea.innerHTML = ''; // Clear existing content

            // Add main phone
            const mainPhoneDiv = document.createElement('div');
            mainPhoneDiv.classList.add('inline-flex', 'justify-start', 'items-center', 'gap-7');
            mainPhoneDiv.innerHTML = `
                ${getContactIconSvg('phone').replace('text-current', 'text-white')}
                <div class="text-white text-xs font-normal font-['Microsoft_Sans_Serif']" id="footer_phone_number">${footer_static_data.contactUs.mainPhone}</div>
            `;
            footer_contactDetailsDisplayArea.appendChild(mainPhoneDiv);

            // Add main email
            const mainEmailDiv = document.createElement('div');
            mainEmailDiv.classList.add('self-stretch', 'inline-flex', 'justify-start', 'items-center', 'gap-7');
            mainEmailDiv.innerHTML = `
                ${getContactIconSvg('email').replace('text-current', 'text-white')}
                <div class="text-white text-xs font-normal font-['Microsoft_Sans_Serif']" id="footer_email">${footer_static_data.contactUs.mainEmail}</div>
            `;
            footer_contactDetailsDisplayArea.appendChild(mainEmailDiv);

            // Add other details
            footer_static_data.contactUs.otherDetails.forEach(detail => {
                const detailDiv = document.createElement('div');
                detailDiv.classList.add('inline-flex', 'justify-start', 'items-center', 'gap-7');

                if (detail.imageUrl) {
                    detailDiv.innerHTML += `<img src="${detail.imageUrl}" alt="${detail.icon || 'icon'}" class="w-5 h-5 object-contain">`;
                } else if (detail.icon) {
                    detailDiv.innerHTML += getContactIconSvg(detail.icon).replace('text-current', 'text-white');
                } else {
                    // Fallback for details without specific icon or image
                    detailDiv.innerHTML += getContactIconSvg('default').replace('text-current', 'text-white');
                }
                detailDiv.innerHTML += `<div class="text-white text-xs font-normal font-['Microsoft_Sans_Serif']">${detail.text}</div>`;
                footer_contactDetailsDisplayArea.appendChild(detailDiv);
            });
        }


        // --- Initial Rendering of all content based on static data ---
        function footer_initializeContent() {
            // Main Logo
            footer_mainLogoImg.src = footer_static_data.mainLogo.src;

            // Keep In Touch Section
            document.getElementById('footer_keep_in_touch_title').innerText = footer_static_data.keepInTouch.title;
            document.getElementById('footer_keep_in_touch_paragraph').innerText = footer_static_data.keepInTouch.paragraph;
            footer_updateDisplayedLinks('footer_social_links_list', footer_static_data.keepInTouch.socialLinks);

            // About GovPH Section
            document.getElementById('footer_about_govph_title').innerText = footer_static_data.aboutGovph.title;
            document.getElementById('footer_about_govph_paragraph').innerText = footer_static_data.aboutGovph.paragraph;
            footer_updateDisplayedLinks('footer_about_govph_links', footer_static_data.aboutGovph.links);

            // Government Links Section
            document.getElementById('footer_government_links_title').innerText = footer_static_data.governmentLinks.title;
            footer_updateDisplayedLinks('footer_government_links_list', footer_static_data.governmentLinks.links);

            // Contact Us Section
            document.getElementById('footer_contact_us_title').innerText = footer_static_data.contactUs.title;
            footer_updateDisplayedContactDetails(); // Call the combined contact update function
        }

        footer_initializeContent();
    });
</script>