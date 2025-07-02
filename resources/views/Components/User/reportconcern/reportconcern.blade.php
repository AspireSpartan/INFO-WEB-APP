<div class="min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-8">
        <div class="bg-white p-6 sm:p-8 md:p-10 rounded-lg shadow-xl w-full max-w-4xl border border-gray-200">
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
                            <label for="concern_location" class="block text-sm font-medium text-gray-700 mb-1">Location of Concern (Specific Address/Landmark) <span class="text-red-500">*</span></label>
                            <input type="text" id="concern_location" name="concern_location" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                        <div class="md:col-span-2">
                            <label for="concern_description" class="block text-sm font-medium text-gray-700 mb-1">Description of Concern <span class="text-red-500">*</span></label>
                            <textarea id="concern_description" name="concern_description" rows="5" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Submission Button -->
                <div class="flex justify-end pt-4">
                    <button type="submit"
                        class="px-6 py-3 bg-red-600 text-white font-semibold rounded-md shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition ease-in-out duration-150">
                        Submit Concern Report
                    </button>
                </div>
            </form>
        </div>
    </div>