<div class="min-h-screen flex flex-col font-source-sans-pro bg-cover bg-center" style="background-image: url('What-is-a-multi-line-phone-system-featured-image.webp');">
    <div class="absolute inset-0 bg-white opacity-70"></div>

    <header class="w-full bg-transparent py-4 px-8 flex items-center relative z-10">
        </header>

    <main class="flex-grow flex flex-col items-center justify-center py-16 px-4 relative z-10">
        <section class="w-full max-w-6xl bg-white rounded-2xl shadow-lg p-12 flex flex-col items-center">

            <div class="flex flex-col items-center gap-4 mb-8">
                <div class="flex items-center gap-4">
                    <img src="{{ asset('storage/Connect_icon.svg') }}" alt="Gear Icon" class="w-16 h-16">
                    <h1 class="text-black text-4xl font-bold">Connect with our team</h1>
                </div>

                <p class="text-neutral-500 text-sm font-normal text-center max-w-md">
                    Have questions or need assistance? Our team is here to help! Whether you have inquiries about our services, need support, or just want to connect, feel free to reach out. Fill out the form, and we’ll get back to you as soon as possible.
                </p>
            </div>

            <div class="flex flex-col md:flex-row gap-8 w-full mt-8">
                <div class="flex-1 bg-neutral-100 rounded-2xl shadow-xl p-8 flex flex-col gap-6">
                    <h2 class="text-black text-2xl font-semibold mb-4">Get in Touch with Us</h2>
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf {{-- Laravel's CSRF token for security --}}

                        <div class="flex flex-col sm:flex-row gap-4 mb-4">
                            <input type="text" name="name" placeholder="Input your name" class="flex-1 h-12 bg-white rounded-lg border border-zinc-200 px-4 text-black text-base focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" required />
                            <input type="email" name="email" placeholder="Input your email" class="flex-1 h-12 bg-white rounded-lg border border-zinc-200 px-4 text-black text-base focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" required />
                        </div>
                        <input type="text" name="subject" placeholder="Subject" class="w-full h-12 bg-white rounded-lg border border-zinc-200 px-4 text-black text-base focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 mb-4" required />
                        <textarea name="message_description" placeholder="Submit your message request" class="w-full h-32 bg-white rounded-lg border border-zinc-200 px-4 py-2 text-black text-base resize-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 mb-6" required></textarea>
                        <button type="submit" class="w-full h-12 bg-blue-950 text-white rounded-lg font-semibold hover:bg-blue-800 transition duration-300 ease-in-out transform hover:scale-105">Send Message</button>
                    </form>

                    {{-- Display success/error messages --}}
                    @if (session('success'))
                        <div class="mt-4 p-3 bg-green-100 text-green-700 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mt-4 p-3 bg-red-100 text-red-700 rounded-lg">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- Display validation errors --}}
                    @if ($errors->any())
                        <div class="mt-4 p-3 bg-red-100 text-red-700 rounded-lg">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <div class="flex-1 flex flex-col gap-6">
                    <h2 class="text-black text-xl font-bold text-center mb-2">Contact details</h2>
                    <p class="text-neutral-500 text-xs font-normal text-center max-w-sm mx-auto">
                        Need to reach us? Here's how! Whether you prefer email, phone, or visiting us in person, we’re available to assist you. Check our contact details below and connect with us anytime during our working hours.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="flex items-center gap-4 bg-blue-950 rounded-xl p-4 shadow-sm transform transition duration-300 ease-in-out hover:scale-105 hover:bg-blue-800 cursor-pointer">
                            <div class="w-10 h-10 bg-blue-800 rounded-full flex items-center justify-center">
                                <img src="{{ asset('storage/address_icon.svg') }}" alt="Address Icon" class="w-6 h-6">
                            </div>
                            <div>
                                <div class="text-white text-base font-bold">Address</div>
                                <div class="text-white text-xs font-normal">Location of CIT-U</div>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 bg-blue-950 rounded-xl p-4 shadow-sm transform transition duration-300 ease-in-out hover:scale-105 hover:bg-blue-800 cursor-pointer">
                            <div class="w-10 h-10 bg-blue-800 rounded-full flex items-center justify-center">
                                <img src="{{ asset('storage/Mobile_icon.svg') }}" alt="Mobile Icon" class="w-6 h-6">
                            </div>
                            <div>
                                <div class="text-white text-base font-bold">Mobile</div>
                                <div class="text-white text-xs font-normal">01234-567-891</div>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 bg-blue-950 rounded-xl p-4 shadow-sm transform transition duration-300 ease-in-out hover:scale-105 hover:bg-blue-800 cursor-pointer">
                            <div class="w-10 h-10 bg-blue-800 rounded-full flex items-center justify-center">
                                <img src="{{ asset('storage/Availability_icon.svg') }}" alt="Availability Icon" class="w-6 h-6">
                            </div>
                            <div>
                                <div class="text-white text-base font-bold">Availability</div>
                                <div class="text-white text-xs font-normal">Mon-Sat 8:00 am - 5:00 pm</div>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 bg-blue-950 rounded-xl p-4 shadow-sm transform transition duration-300 ease-in-out hover:scale-105 hover:bg-blue-800 cursor-pointer">
                            <div class="w-10 h-10 bg-blue-800 rounded-full flex items-center justify-center">
                                <img src="{{ asset('storage/Email_icon.svg') }}" alt="Email Icon" class="w-6 h-6">
                            </div>
                            <div>
                                <div class="text-white text-base font-bold">E Mail</div>
                                <div class="text-white text-xs font-normal">FindWild@WildFind.com</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    {{-- Script to increment notification count after successful submission --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check if a success flag from Laravel session exists
            @if (session('contactFormSuccess'))
                // Increment notification count in localStorage
                let currentCount = localStorage.getItem('unreadNotifications') ? parseInt(localStorage.getItem('unreadNotifications')) : 0;
                currentCount++;
                localStorage.setItem('unreadNotifications', currentCount);

                // Dispatch a custom event to notify the main admin layout
                window.dispatchEvent(new CustomEvent('notification-increment'));

                // Remove the session storage flag to prevent re-incrementing on subsequent page loads/refreshes
                // (Laravel's session flash automatically handles clearing after one request, but a local flag helps)
                sessionStorage.removeItem('contactFormSuccess'); // If you decided to use sessionStorage as a flag
            @endif
        });
    </script>
</div>