<div class="min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-8 bg-white">
    <div class="bg-white p-6 sm:p-8 md:p-10 rounded-lg shadow-xl w-full max-w-4xl border border-gray-200 mt-[60px]">
        <h1 class="text-3xl sm:text-4xl font-bold text-center text-gray-800 mb-6 sm:mb-8">Business Permit Application</h1>
        <p class="text-center text-black mb-8 sm:mb-10">Please fill out the form below accurately to apply for your business permit.</p>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
                @if(session('pdf'))
                    <div class="mt-2">
                        <a href="data:application/pdf;base64,{{ base64_encode(session('pdf')) }}" download="business_permit.pdf" 
                           class="text-blue-600 hover:text-blue-800 font-medium">
                            Download your business permit
                        </a>
                    </div>
                @endif
            </div>
        @endif

        <form action="{{ route('businesspermit.submit') }}" method="POST" class="space-y-6 sm:space-y-8">
            @csrf
            <!-- Business Information Section -->
            <div class="border-b border-gray-200 pb-6 sm:pb-8">
                <h2 class="text-2xl font-semibold text-black mb-4">1. Business Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                    <div>
                        <label for="business_name" class="block text-sm font-medium text-black mb-1">Business Name <span class="text-red-500">*</span></label>
                        <input type="text" id="business_name" name="business_name" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-black">
                    </div>
                    <div>
                        <label for="business_type" class="block text-sm font-medium text-black mb-1">Type of Business <span class="text-red-500">*</span></label>
                        <select id="business_type" name="business_type" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-black">
                            <option value="">Select Type</option>
                            <option value="sole_proprietorship">Sole Proprietorship</option>
                            <option value="partnership">Partnership</option>
                            <option value="corporation">Corporation</option>
                            <option value="llc">Limited Liability Company (LLC)</option>
                            <option value="others">Others</option>
                        </select>
                    </div>

                    <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                            <div>
                                <label for="business_barangay" class="block text-sm font-medium text-black mb-1">Business Barangay <span class="text-red-500">*</span></label>
                                <select id="business_barangay" name="business_barangay" required
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-black">
                                    <option value="">Select Barangay</option>
                                    <option value="Apas">Apas</option>
                                    <option value="Babag">Babag</option>
                                    <option value="Bacayan">Bacayan</option>
                                    <option value="Banilad">Banilad</option>
                                    <option value="Basak Pardo">Basak Pardo</option>
                                    <option value="Basak San Nicolas">Basak San Nicolas</option>
                                    <option value="Binaliw">Binaliw</option>
                                    <option value="Bonbon">Bonbon</option>
                                    <option value="Budlaan">Budlaan</option>
                                    <option value="Buhisan">Buhisan</option>
                                    <option value="Bulacao">Bulacao</option>
                                    <option value="Busay">Busay</option>
                                    <option value="Calamba">Calamba</option>
                                    <option value="Cambinocot">Cambinocot</option>
                                    <option value="Capitol Site">Capitol Site</option>
                                    <option value="Carreta">Carreta</option>
                                    <option value="Cogon Pardo">Cogon Pardo</option>
                                    <option value="Cogon Ramos">Cogon Ramos</option>
                                    <option value="Day-as">Day-as</option>
                                    <option value="Duljo-Fatima">Duljo-Fatima</option>
                                    <option value="Ermita">Ermita</option>
                                    <option value="Guba">Guba</option>
                                    <option value="Guadalupe">Guadalupe</option>
                                    <option value="Hipodromo">Hipodromo</option>
                                    <option value="Inayawan">Inayawan</option>
                                    <option value="Kalubihan">Kalubihan</option>
                                    <option value="Kamagayan">Kamagayan</option>
                                    <option value="Kamputhaw">Kamputhaw</option>
                                    <option value="Kasambagan">Kasambagan</option>
                                    <option value="Kinasang-an Pardo">Kinasang-an Pardo</option>
                                    <option value="Labangon">Labangon</option>
                                    <option value="Lahug">Lahug</option>
                                    <option value="Lorega San Miguel">Lorega San Miguel</option>
                                    <option value="Lusaran">Lusaran</option>
                                    <option value="Mabini">Mabini</option>
                                    <option value="Mabolo">Mabolo</option>
                                    <option value="Malubog">Malubog</option>
                                    <option value="Mambaling">Mambaling</option>
                                    <option value="Pahina Central">Pahina Central</option>
                                    <option value="Pahina San Nicolas">Pahina San Nicolas</option>
                                    <option value="Pamutan">Pamutan</option>
                                    <option value="Parian">Parian</option>
                                    <option value="Paril">Paril</option>
                                    <option value="Pasil">Pasil</option>
                                    <option value="Pit-os">Pit-os</option>
                                    <option value="Poblacion Pardo">Poblacion Pardo</option>
                                    <option value="Pulangbato">Pulangbato</option>
                                    <option value="Punta Princesa">Punta Princesa</option>
                                    <option value="Quiot">Quiot</option>
                                    <option value="Sambag I">Sambag I</option>
                                    <option value="Sambag II">Sambag II</option>
                                    <option value="San Antonio">San Antonio</option>
                                    <option value="San Jose">San Jose</option>
                                    <option value="San Nicolas Proper">San Nicolas Proper</option>
                                    <option value="San Roque">San Roque</option>
                                    <option value="Santa Cruz">Santa Cruz</option>
                                    <option value="Santo Niño">Santo Niño</option>
                                    <option value="Sawang Calero">Sawang Calero</option>
                                    <option value="Sinsin">Sinsin</option>
                                    <option value="Sirao">Sirao</option>
                                    <option value="Suba">Suba</option>
                                    <option value="Sudlon I">Sudlon I</option>
                                    <option value="Sudlon II">Sudlon II</option>
                                    <option value="Tabunan">Tabunan</option>
                                    <option value="Tagbao">Tagbao</option>
                                    <option value="Talamban">Talamban</option>
                                    <option value="Taptap">Taptap</option>
                                    <option value="Tejero">Tejero</option>
                                    <option value="Tinago">Tinago</option>
                                    <option value="Tisa">Tisa</option>
                                    <option value="To-ong">To-ong</option>
                                    <option value="Zapatera">Zapatera</option>
                                </select>
                            </div>
                            <div>
                                <label for="business_address" class="block text-sm font-medium text-black mb-1">Full Business Address <span class="text-red-500">*</span></label>
                                <input type="text" id="business_address" name="business_address" required
                                    placeholder="Street, Building, Zone, etc."
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-black">
                            </div>
                    </div>

                    <div>
                        <label for="business_phone" class="block text-sm font-medium text-black mb-1">Business Phone</label>
                        <input type="tel" id="business_phone" name="business_phone"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-black">
                    </div>
                    <div>
                        <label for="business_email" class="block text-sm font-medium text-black mb-1">Business Email <span class="text-red-500">*</span></label>
                        <input type="email" id="business_email" name="business_email" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-black">
                    </div>
                </div>
            </div>

            <!-- Owner/Applicant Information Section -->
            <div class="border-b border-gray-200 pb-6 sm:pb-8">
                <h2 class="text-2xl font-semibold text-black mb-4">2. Owner/Applicant Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                    <div>
                        <label for="owner_first_name" class="block text-sm font-medium text-black mb-1">First Name <span class="text-red-500">*</span></label>
                        <input type="text" id="owner_first_name" name="owner_first_name" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-black">
                    </div>
                    <div>
                        <label for="owner_last_name" class="block text-sm font-medium text-black mb-1">Last Name <span class="text-red-500">*</span></label>
                        <input type="text" id="owner_last_name" name="owner_last_name" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-black">
                    </div>
                    <div class="md:col-span-2">
                        <label for="owner_address" class="block text-sm font-medium text-black mb-1">Residential Address <span class="text-red-500">*</span></label>
                        <input type="text" id="owner_address" name="owner_address" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-black">
                    </div>
                    <div>
                        <label for="owner_phone" class="block text-sm font-medium text-black mb-1">Phone Number <span class="text-red-500">*</span></label>
                        <input type="tel" id="owner_phone" name="owner_phone" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-black">
                    </div>
                    <div>
                        <label for="owner_email" class="block text-sm font-medium text-black mb-1">Email Address <span class="text-red-500">*</span></label>
                        <input type="email" id="owner_email" name="owner_email" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-black">
                    </div>
                </div>
            </div>

            <!-- Business Activity Section -->
            <div class="border-b border-gray-200 pb-6 sm:pb-8">
                <h2 class="text-2xl font-semibold text-black mb-4">3. Business Activity / Nature</h2>
                <div>
                    <label for="business_activity" class="block text-sm font-medium text-black mb-1">Describe your business activity in detail <span class="text-red-500">*</span></label>
                    <textarea id="business_activity" name="business_activity" rows="4" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-black"></textarea>
                </div>
                <div class="mt-4">
                    <label for="capitalization" class="block text-sm font-medium text-black mb-1">Total Capitalization (PHP) <span class="text-red-500">*</span></label>
                    <input type="number" id="capitalization" name="capitalization" min="0" step="any" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-black">
                </div>
            </div>

            <!-- Declaration and Consent Section -->
            <div class="pb-6 sm:pb-8">
                <h2 class="text-2xl font-semibold text-black mb-4">4. Declaration and Consent</h2>
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="declaration_consent" name="declaration_consent" type="checkbox" required
                            class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="declaration_consent" class="font-medium text-black">I hereby declare that the information provided is true and correct to the best of my knowledge and belief.</label>
                        <p class="text-black">I understand that any false information may lead to the denial or revocation of my business permit.</p>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end pt-4 gap-2">
                <button type="submit"
                    class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition ease-in-out duration-150">
                    Submit Application
                </button>
            </div>
        </form>
    </div>
</div>