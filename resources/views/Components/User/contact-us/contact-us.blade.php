
<main class="min-h-screen bg-gradient-to-l from-neutral-600 via-neutral-400 to-gray-200 flex flex-col items-center justify-center py-16 px-4">
    <!-- Top Section -->
    <section class="w-full max-w-3xl bg-white/80 rounded-[10px] shadow-lg p-8 flex flex-col gap-10 items-center">
        <h1 class="text-black text-4xl font-bold font-['Merriweather'] text-center mb-2">Connect with our team</h1>
        <p class="text-black/75 text-xs font-normal font-['Source_Sans_Pro'] text-center mb-6">
            Have questions or need assistance? Our team is here to help! Whether you have inquiries about our services, need support, or just want to connect, feel free to reach out. Fill out the form, and we’ll get back to you as soon as possible.
        </p>
        <div class="flex flex-col md:flex-row gap-8 w-full">
            <!-- Contact Form -->
            <form class="flex-1 flex flex-col gap-4">
                <input type="text" placeholder="Input your name" class="w-full h-12 bg-white rounded-lg border border-black/25 px-4 text-black text-base font-['Wix_Madefor_Display']" />
                <input type="email" placeholder="Input your email" class="w-full h-12 bg-white rounded-lg border border-black/25 px-4 text-black text-base font-['Wix_Madefor_Display']" />
                <input type="text" placeholder="Subject" class="w-full h-12 bg-white rounded-lg border border-black/25 px-4 text-black text-base font-['Wix_Madefor_Display']" />
                <textarea placeholder="Submit your message request" class="w-full h-32 bg-white rounded-lg border border-black/25 px-4 py-2 text-black text-base font-['Wix_Madefor_Display']"></textarea>
                <button type="submit" class="w-full h-12 bg-blue-950 text-white rounded-lg font-semibold font-['Wix_Madefor_Display'] hover:bg-blue-900 transition">Send Message</button>
            </form>
            <!-- Contact Details -->
            <div class="flex-1 flex flex-col gap-6">
                <div class="flex items-center gap-4 bg-white rounded-[10px] border border-neutral-500/75 p-4">
                    <img src="{{ asset('storage/Contact_add.svg') }}" alt="Address Icon" class="w-10 h-10">
                    <div>
                        <div class="text-black text-base font-semibold font-['Wix_Madefor_Display']">Address</div>
                        <div class="text-black/75 text-xs font-medium font-['Wix_Madefor_Display']">Location of CIT-U</div>
                    </div>
                </div>
                <div class="flex items-center gap-4 bg-white rounded-[10px] border border-neutral-500/75 p-4">
                    <img src="{{ asset('storage/Contact_mobile.svg') }}" alt="Mobile Icon" class="w-10 h-10">
                    <div>
                        <div class="text-black text-base font-semibold font-['Wix_Madefor_Display']">Mobile</div>
                        <div class="text-black/75 text-xs font-medium font-['Wix_Madefor_Display']">01234-567-891</div>
                    </div>
                </div>
                <div class="flex items-center gap-4 bg-white rounded-[10px] border border-neutral-500/75 p-4">
                    <img src="{{ asset('storage/Contact_avail.svg') }}" alt="Availability Icon" class="w-10 h-10">
                    <div>
                        <div class="text-black text-base font-semibold font-['Wix_Madefor_Display']">Availability</div>
                        <div class="text-black/75 text-xs font-medium font-['Wix_Madefor_Display']">Mon-Sat 8:00 am - 5:00 pm</div>
                    </div>
                </div>
                <div class="flex items-center gap-4 bg-white rounded-[10px] border border-neutral-500/75 p-4">
                    <img src="{{ asset('storage/Contact_email.svg') }}" alt="Email Icon" class="w-10 h-10">
                    <div>
                        <div class="text-black text-base font-semibold font-['Wix_Madefor_Display']">E Mail</div>
                        <div class="text-black/75 text-xs font-medium font-['Wix_Madefor_Display']">@WildFind.com</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
