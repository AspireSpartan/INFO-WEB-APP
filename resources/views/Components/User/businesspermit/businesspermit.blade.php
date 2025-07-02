<div class="min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-8">
        <div class="bg-white p-6 sm:p-8 md:p-10 rounded-lg shadow-xl w-full max-w-4xl border border-gray-200 mt-[60px]">
            <h1 class="text-3xl sm:text-4xl font-bold text-center text-gray-800 mb-6 sm:mb-8">Business Permit Application</h1>
            <p class="text-center text-gray-600 mb-8 sm:mb-10">Please fill out the form below accurately to apply for your business permit.</p>

            <form action="#" method="POST" class="space-y-6 sm:space-y-8">
                <!-- Business Information Section -->
                <div class="border-b border-gray-200 pb-6 sm:pb-8">
                    <h2 class="text-2xl font-semibold text-gray-700 mb-4">1. Business Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                        <div>
                            <label for="business_name" class="block text-sm font-medium text-gray-700 mb-1">Business Name <span class="text-red-500">*</span></label>
                            <input type="text" id="business_name" name="business_name" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="business_type" class="block text-sm font-medium text-gray-700 mb-1">Type of Business <span class="text-red-500">*</span></label>
                            <select id="business_type" name="business_type" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="">Select Type</option>
                                <option value="sole_proprietorship">Sole Proprietorship</option>
                                <option value="partnership">Partnership</option>
                                <option value="corporation">Corporation</option>
                                <option value="llc">Limited Liability Company (LLC)</option>
                                <option value="others">Others</option>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label for="business_address" class="block text-sm font-medium text-gray-700 mb-1">Business Address <span class="text-red-500">*</span></label>
                            <input type="text" id="business_address" name="business_address" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="business_phone" class="block text-sm font-medium text-gray-700 mb-1">Business Phone</label>
                            <input type="tel" id="business_phone" name="business_phone"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="business_email" class="block text-sm font-medium text-gray-700 mb-1">Business Email <span class="text-red-500">*</span></label>
                            <input type="email" id="business_email" name="business_email" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                    </div>
                </div>

                <!-- Owner/Applicant Information Section -->
                <div class="border-b border-gray-200 pb-6 sm:pb-8">
                    <h2 class="text-2xl font-semibold text-gray-700 mb-4">2. Owner/Applicant Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                        <div>
                            <label for="owner_first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name <span class="text-red-500">*</span></label>
                            <input type="text" id="owner_first_name" name="owner_first_name" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="owner_last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name <span class="text-red-500">*</span></label>
                            <input type="text" id="owner_last_name" name="owner_last_name" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                        <div class="md:col-span-2">
                            <label for="owner_address" class="block text-sm font-medium text-gray-700 mb-1">Residential Address <span class="text-red-500">*</span></label>
                            <input type="text" id="owner_address" name="owner_address" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="owner_phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number <span class="text-red-500">*</span></label>
                            <input type="tel" id="owner_phone" name="owner_phone" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="owner_email" class="block text-sm font-medium text-gray-700 mb-1">Email Address <span class="text-red-500">*</span></label>
                            <input type="email" id="owner_email" name="owner_email" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                    </div>
                </div>

                <!-- Business Activity Section -->
                <div class="border-b border-gray-200 pb-6 sm:pb-8">
                    <h2 class="text-2xl font-semibold text-gray-700 mb-4">3. Business Activity / Nature</h2>
                    <div>
                        <label for="business_activity" class="block text-sm font-medium text-gray-700 mb-1">Describe your business activity in detail <span class="text-red-500">*</span></label>
                        <textarea id="business_activity" name="business_activity" rows="4" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
                    </div>
                    <div class="mt-4">
                        <label for="capitalization" class="block text-sm font-medium text-gray-700 mb-1">Total Capitalization (PHP) <span class="text-red-500">*</span></label>
                        <input type="number" id="capitalization" name="capitalization" min="0" step="any" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                </div>

                <!-- Declaration and Consent Section -->
                <div class="pb-6 sm:pb-8">
                    <h2 class="text-2xl font-semibold text-gray-700 mb-4">4. Declaration and Consent</h2>
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="declaration_consent" name="declaration_consent" type="checkbox" required
                                class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="declaration_consent" class="font-medium text-gray-700">I hereby declare that the information provided is true and correct to the best of my knowledge and belief.</label>
                            <p class="text-gray-500">I understand that any false information may lead to the denial or revocation of my business permit.</p>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end pt-4">
                    <button type="submit"
                        class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition ease-in-out duration-150">
                        Submit Application
                    </button>
                </div>
            </form>
        </div>
    </div>