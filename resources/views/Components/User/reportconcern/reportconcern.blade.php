<div class="min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-8">
        <div class="bg-white p-6 sm:p-8 md:p-10 rounded-lg shadow-xl w-full max-w-4xl border border-gray-200 mt-[60px]">
            <h1 class="text-3xl sm:text-4xl font-bold text-center text-gray-800 mb-6 sm:mb-8">Report a Concern</h1>
            <p class="text-center text-gray-600 mb-8 sm:mb-10">Please use this form to report any concerns. Provide as much detail as possible.</p>

            <form action="#" method="POST" class="space-y-6 sm:space-y-8">
                <!-- Reporter Information Section -->
                <div class="border-b border-gray-200 pb-6 sm:pb-8">
                    <h2 class="text-2xl font-semibold text-gray-700 mb-4">1. Your Information (Who)</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                        <div>
                            <label for="reporter_name" class="block text-sm font-medium text-gray-700 mb-1">Your Full Name <span class="text-red-500">*</span></label>
                            <input type="text" id="reporter_name" name="reporter_name" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="reporter_email" class="block text-sm font-medium text-gray-700 mb-1">Email Address <span class="text-red-500">*</span></label>
                            <input type="email" id="reporter_email" name="reporter_email" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="reporter_phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                            <input type="tel" id="reporter_phone" name="reporter_phone"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                        <div class="md:col-span-2">
                            <label for="reporter_address" class="block text-sm font-medium text-gray-700 mb-1">Your Residential Address</label>
                            <input type="text" id="reporter_address" name="reporter_address"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                    </div>
                </div>

                <!-- Concern Details Section -->
                <div class="border-b border-gray-200 pb-6 sm:pb-8">
                    <h2 class="text-2xl font-semibold text-gray-700 mb-4">2. Concern Details (Where & When)</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                        <div>
                            <label for="concern_date" class="block text-sm font-medium text-gray-700 mb-1">Date of Concern <span class="text-red-500">*</span></label>
                            <input type="date" id="concern_date" name="concern_date" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="concern_time" class="block text-sm font-medium text-gray-700 mb-1">Time of Concern</label>
                            <input type="time" id="concern_time" name="concern_time"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Location of Concern <span class="text-red-500">*</span>
                            </label>
                            <div class="grid grid-cols-2 md:grid-cols-1 gap-2">
                                <select id="concern_barangay" name="concern_barangay" required
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
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
                               <div>
                                    <label for="concern_barangay_details" class="block text-sm font-medium text-gray-700 mb-1">
                                        Street/Landmark/Details (Specify exact location)
                                    </label>
                                    <input type="text" id="concern_barangay_details" name="concern_barangay_details"
                                        placeholder="Street/Landmark/Details"
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="md:col-span-2">
                            <label for="concern_description" class="block text-sm font-medium text-gray-700 mb-1">Description of Concern <span class="text-red-500">*</span></label>
                            <textarea id="concern_description" name="concern_description" rows="5" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Submission Button -->
                <div class="flex justify-end pt-4 gap-2">
                    <a href=" https://drive.google.com/file/d/10hgw59_HPRdK5KqEJW6hgnKgmQ7z2Zrp/view?usp=sharing" target="_blank"
                        class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-md shadow-md hover:bg-indigo-700">
                            Download Form
                    </a>
                    <button type="submit"
                        class="px-6 py-3 bg-red-600 text-white font-semibold rounded-md shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition ease-in-out duration-150">
                        Submit Concern Report
                    </button>
                </div>
            </form>
        </div>
    </div>