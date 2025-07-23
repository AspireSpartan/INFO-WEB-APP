<div class="min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-8 pt-16" style="background-color: white;">
    <div class="bg-white p-6 sm:p-8 md:p-10 rounded-lg shadow-xl w-full max-w-4xl border border-gray-200 mt-[60px]">
        <h1 class="text-3xl sm:text-4xl font-bold text-center text-gray-800 mb-6 sm:mb-8">Community Tax Certificate (Cedula) Application</h1>
        <p class="text-center text-gray-600 mb-8 sm:mb-10">Please fill out the form below accurately to apply for your Community Tax Certificate.</p>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
                @if(session('pdf'))
                    <div class="mt-4">
                        <a href="data:application/pdf;base64,{{ base64_encode(session('pdf')) }}" download="cedula.pdf"
                           style="color: blue; text-decoration: underline;">
                            Download Cedula PDF
                        </a>
                    </div>
                @endif
            </div>
        @endif

        <form action="{{ route('cedula.store') }}" method="POST" class="space-y-6 sm:space-y-8">
            @csrf
            <div class="border-b border-gray-200 pb-6 sm:pb-8">
                <h2 class="text-2xl font-semibold text-gray-700 mb-4">1. Personal Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name <span class="text-red-500">*</span></label>
                        <input type="text" id="last_name" name="last_name" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" style="color: black;">
                    </div>
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name <span class="text-red-500">*</span></label>
                        <input type="text" id="first_name" name="first_name" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" style="color: black;">
                    </div>
                    <div>
                        <label for="middle_name" class="block text-sm font-medium text-gray-700 mb-1">Middle Name</label>
                        <input type="text" id="middle_name" name="middle_name"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" style="color: black;">
                    </div>
                    <div>
                        <label for="suffix" class="block text-sm font-medium text-gray-700 mb-1">Suffix (e.g., Jr., Sr.)</label>
                        <input type="text" id="suffix" name="suffix"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" style="color: black;">
                    </div>
                    <div>
                        <label for="barangay" class="block text-sm font-medium text-gray-700 mb-1">Barangay <span class="text-red-500">*</span></label>
                        <select id="barangay" name="barangay" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" style="color: black;">
                            <option value="">Select Barangay</option>
                            <option value="Adlaon">Adlaon</option>
                            <option value="Agsungot">Agsungot</option>
                            <option value="Apas">Apas</option>
                            <option value="Babag">Babag</option>
                            <option value="Bacayan">Bacayan</option>
                            <option value="Basak Pardo">Basak Pardo</option>
                            <option value="Basak San Nicolas">Basak San Nicolas</option>
                            <option value="Binaliw">Binaliw</option>
                            <option value="Bonbon">Bonbon</option>
                            <option value="Budlaan">Budlaan</option>
                            <option value="Buhisan">Buhisan</option>
                            <option value="Bulacao">Bulacao</option>
                            <option value="Buot">Buot</option>
                            <option value="Calamba">Calamba</option>
                            <option value="Cambinocot">Cambinocot</option>
                            <option value="Capitol Site">Capitol Site</option>
                            <option value="Carreta">Carreta</option>
                            <option value="Cogon Pardo">Cogon Pardo</option>
                            <option value="Cogon Ramos">Cogon Ramos</option>
                            <option value="Contop">Contop</option>
                            <option value="Day-as">Day-as</option>
                            <option value="Duljo Fatima">Duljo Fatima</option>
                            <option value="Ermita">Ermita</option>
                            <option value="Guadalupe">Guadalupe</option>
                            <option value="Guba">Guba</option>
                            <option value="Hipodromo">Hipodromo</option>
                            <option value="Inayawan">Inayawan</option>
                            <option value="Kalubihan">Kalubihan</option>
                            <option value="Kalunasan">Kalunasan</option>
                            <option value="Kamagayan">Kamagayan</option>
                            <option value="Kamputhaw">Kamputhaw</option>
                            <option value="Kasambagan">Kasambagan</option>
                            <option value="Kinasang-an Pardo">Kinasang-an Pardo</option>
                            <option value="Labangon">Labangon</option>
                            <option value="Lahug">Lahug</option>
                            <option value="Lorega San Miguel">Lorega San Miguel</option>
                            <option value="Lusaran">Lusaran</option>
                            <option value="Mabini">Mabini</option>
                            <option value="Mambaling">Mambaling</option>
                            <option value="Malubog">Malubog</option>
                            <option value="Pahina Central">Pahina Central</option>
                            <option value="Pahina San Nicolas">Pahina San Nicolas</option>
                            <option value="Pamutan">Pamutan</option>
                            <option value="Pardo">Pardo</option>
                            <option value="Paril">Paril</option>
                            <option value="Pasil">Pasil</option>
                            <option value="Pit-os">Pit-os</option>
                            <option value="Poblacion Pardo">Poblacion Pardo</option>
                            <option value="Pulangbato">Pulangbato</option>
                            <option value="Pung-ol Sibugay">Pung-ol Sibugay</option>
                            <option value="Quiot">Quiot</option>
                            <option value="Sambag I">Sambag I</option>
                            <option value="Sambag II">Sambag II</option>
                            <option value="San Nicolas Proper">San Nicolas Proper</option>
                            <option value="San Roque">San Roque</option>
                            <option value="Santa Cruz">Santa Cruz</option>
                            <option value="Sawang Calero">Sawang Calero</option>
                            <option value="Sinsin">Sinsin</option>
                            <option value="Sirao">Sirao</option>
                            <option value="Suba">Suba</option>
                            <option value="Tabunan">Tabunan</option>
                            <option value="Tagbao">Tagbao</option>
                            <option value="Talamban">Talamban</option>
                            <option value="Taptap">Taptap</option>
                            <option value="Tisa">Tisa</option>
                            <option value="Toong">Toong</option>
                            <option value="Zapatera">Zapatera</option>
                        </select>
                    </div>
                    <div>
                        <label for="residential_address" class="block text-sm font-medium text-gray-700 mb-1">Residential Address (Street, House No., etc.) <span class="text-red-500">*</span></label>
                        <input type="text" id="residential_address" name="residential_address" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" style="color: black;">
                    </div>
                    <div>
                        <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-1">Date of Birth <span class="text-red-500">*</span></label>
                        <input type="date" id="date_of_birth" name="date_of_birth" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" style="color: black;">
                    </div>
                    <div>
                        <label for="place_of_birth" class="block text-sm font-medium text-gray-700 mb-1">Place of Birth <span class="text-red-500">*</span></label>
                        <input type="text" id="place_of_birth" name="place_of_birth" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" style="color: black;">
                    </div>
                    <div>
                        <label for="citizenship" class="block text-sm font-medium text-gray-700 mb-1">Citizenship <span class="text-red-500">*</span></label>
                        <input type="text" id="citizenship" name="citizenship" required value="Filipino"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" style="color: black;">
                    </div>
                    <div>
                        <label for="civil_status" class="block text-sm font-medium text-gray-700 mb-1">Civil Status <span class="text-red-500">*</span></label>
                        <select id="civil_status" name="civil_status" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" style="color: black;">
                            <option value="">Select Status</option>
                            <option value="single">Single</option>
                            <option value="married">Married</option>
                            <option value="widowed">Widowed</option>
                            <option value="separated">Separated</option>
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <label for="profession" class="block text-sm font-medium text-gray-700 mb-1">Profession / Occupation / Business <span class="text-red-500">*</span></label>
                        <input type="text" id="profession" name="profession" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" style="color: black;">
                    </div>
                </div>
            </div>

            <div class="border-b border-gray-200 pb-6 sm:pb-8">
                <h2 class="text-2xl font-semibold text-gray-700 mb-4">2. Income and Tax Details</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                    <div>
                        <label for="gross_annual_income" class="block text-sm font-medium text-gray-700 mb-1">Gross Annual Income (PHP) <span class="text-red-500">*</span></label>
                        <input type="number" id="gross_annual_income" name="gross_annual_income" min="0" step="any" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" style="color: black;">
                    </div>
                    <div>
                        <label for="community_tax_due" class="block text-sm font-medium text-gray-700 mb-1">Community Tax Due (PHP) <span class="text-red-500">*</span></label>
                        <input type="number" id="community_tax_due" name="community_tax_due" min="0" step="any" required value="5.00"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" style="color: black;">
                        <p class="mt-1 text-xs text-gray-500">Basic community tax is PHP 5.00. Additional tax may apply based on income.</p>
                    </div>
                </div>
            </div>

            <div class="pb-6 sm:pb-8">
                <h2 class="text-2xl font-semibold text-gray-700 mb-4">3. Declaration and Consent</h2>
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="cedula_declaration_consent" name="cedula_declaration_consent" type="checkbox" required
                            class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="cedula_declaration_consent" class="font-medium text-gray-700">I hereby declare that the information provided is true and correct to the best of my knowledge and belief.</label>
                        <p class="text-gray-500">I understand that any false information may lead to the denial or revocation of my Community Tax Certificate.</p>
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit"
                    class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition ease-in-out duration-150">
                    Submit Application
                </button>
            </div>
        </form>
    </div>
</div>