<div class="max-w-4xl mx-auto bg-white p-6 md:p-8 lg:p-10 rounded-lg shadow-xl border border-gray-200">

        <!-- Removed Laravel Form Integration attributes (action, method) and @csrf -->
        <form>
            <!-- Header Section -->
            <div class="text-center mb-6">
                <p class="text-xs text-gray-500 mb-1">BIR FORM 0016 (DECEMBER, 2014)</p>
                <p class="text-xs text-gray-500 mb-4">ANALYZA-2/9/2018-10:24 AM-16851009 (CC:1040001000)</p>
                <h1 class="text-2xl font-extrabold text-gray-800 mb-2">COMMUNITY TAX CERTIFICATE</h1>
                <h2 class="text-xl font-bold text-gray-700">INDIVIDUAL</h2>
            </div>

            <!-- Top Information Fields -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-x-6 gap-y-4 mb-6">
                <div>
                    <input type="text" name="year" class="form-field" value="" placeholder="">
                    <p class="label-text">YEAR</p>
                </div>
                <div>
                    <input type="text" name="place_of_issue" class="form-field" value="" placeholder="City/Mun./Prov.">
                    <p class="label-text">PLACE OF ISSUE (City/Mun./Prov.)</p>
                </div>
                <div>
                    <input type="date" name="date_issued" class="form-field" value="">
                    <p class="label-text">DATE ISSUED</p>
                </div>
            </div>

            <!-- Taxpayer's Copy -->
            <div class="flex justify-end mb-6">
                <div class="bg-blue-100 text-blue-800 px-4 py-2 rounded-md font-semibold text-sm">TAXPAYER'S COPY</div>
            </div>

            <!-- Name and TIN Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-x-6 gap-y-4 mb-6">
                <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-x-4">
                    <div>
                        <input type="text" name="surname" class="form-field" value="" placeholder="SURNAME">
                        <p class="label-text">NAME (SURNAME)</p>
                    </div>
                    <div>
                        <input type="text" name="first_name" class="form-field" value="" placeholder="FIRST">
                        <p class="label-text">(FIRST)</p>
                    </div>
                    <div>
                        <input type="text" name="middle_name" class="form-field" value="" placeholder="MIDDLE">
                        <p class="label-text">(MIDDLE)</p>
                    </div>
                </div>
                <div class="flex items-start lg:col-span-1">
                    <div class="w-full">
                        <label class="block text-xs text-gray-500 mb-1">TIN (If Any):</label>
                        <div class="grid grid-cols-11 gap-1">
                            <input type="text" name="tin_1" maxlength="1" class="form-field text-center" style="width: 24px;" value="">
                            <input type="text" name="tin_2" maxlength="1" class="form-field text-center" style="width: 24px;" value="">
                            <input type="text" name="tin_3" maxlength="1" class="form-field text-center" style="width: 24px;" value="">
                            <span class="text-xl -mt-1">-</span>
                            <input type="text" name="tin_4" maxlength="1" class="form-field text-center" style="width: 24px;" value="">
                            <input type="text" name="tin_5" maxlength="1" class="form-field text-center" style="width: 24px;" value="">
                            <input type="text" name="tin_6" maxlength="1" class="form-field text-center" style="width: 24px;" value="">
                            <span class="text-xl -mt-1">-</span>
                            <input type="text" name="tin_7" maxlength="1" class="form-field text-center" style="width: 24px;" value="">
                            <input type="text" name="tin_8" maxlength="1" class="form-field text-center" style="width: 24px;" value="">
                            <input type="text" name="tin_9" maxlength="1" class="form-field text-center" style="width: 24px;" value="">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Address and Other Details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4 mb-6">
                <div>
                    <input type="text" name="address" class="form-field" value="" placeholder="">
                    <p class="label-text">ADDRESS</p>
                </div>
                <div class="grid grid-cols-3 gap-x-4">
                    <div class="flex items-center space-x-2">
                        <input type="radio" id="male" name="gender" value="male" class="form-radio text-blue-600 rounded-full">
                        <label for="male" class="text-sm">1 MALE</label>
                    </div>
                    <div class="flex items-center space-x-2">
                        <input type="radio" id="female" name="gender" value="female" class="form-radio text-blue-600 rounded-full">
                        <label for="female" class="text-sm">2 FEMALE</label>
                    </div>
                    <div>
                        <input type="text" name="height" class="form-field" value="" placeholder="">
                        <p class="label-text">HEIGHT</p>
                    </div>
                </div>
            </div>

            <!-- Citizenship, ICR No., Place of Birth, Date of Birth, Weight -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-6 gap-y-4 mb-6">
                <div>
                    <input type="text" name="citizenship" class="form-field" value="Filipino">
                    <p class="label-text">CITIZENSHIP</p>
                </div>
                <div>
                    <input type="text" name="icr_no" class="form-field" value="" placeholder="">
                    <p class="label-text">ICR NO. (If An Alien)</p>
                </div>
                <div>
                    <input type="text" name="place_of_birth" class="form-field" value="" placeholder="">
                    <p class="label-text">PLACE OF BIRTH</p>
                </div>
                <div>
                    <input type="date" name="date_of_birth" class="form-field" value="">
                    <p class="label-text">DATE OF BIRTH</p>
                </div>
                <div>
                    <input type="text" name="weight" class="form-field" value="" placeholder="">
                    <p class="label-text">WEIGHT</p>
                </div>
            </div>

            <!-- Civil Status -->
            <div class="mb-6">
                <label class="block text-xs text-gray-500 mb-2">CIVIL STATUS</label>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                    <div class="flex items-center space-x-2">
                        <input type="radio" id="single" name="civil_status" value="single" class="form-radio text-blue-600 rounded-full">
                        <label for="single">1 Single</label>
                    </div>
                    <div class="flex items-center space-x-2">
                        <input type="radio" id="married" name="civil_status" value="married" class="form-radio text-blue-600 rounded-full">
                        <label for="married">2 Married</label>
                    </div>
                    <div class="flex items-center space-x-2">
                        <input type="radio" id="widow_er" name="civil_status" value="widower" class="form-radio text-blue-600 rounded-full">
                        <label for="widow_er">3 Widow/Widower/ Legally Separated</label>
                    </div>
                    <div class="flex items-center space-x-2">
                        <input type="radio" id="divorced" name="civil_status" value="divorced" class="form-radio text-blue-600 rounded-full">
                        <label for="divorced">4 Divorced</label>
                    </div>
                </div>
            </div>

            <!-- Profession/Occupation/Business -->
            <div class="mb-6">
                <input type="text" name="profession_occupation_business" class="form-field" value="" placeholder="">
                <p class="label-text">PROFESSION / OCCUPATION / BUSINESS</p>
            </div>

            <!-- A. BASIC COMMUNITY TAX -->
            <div class="mb-6">
                <div class="section-title">A. BASIC COMMUNITY TAX (P5.00) Voluntary or Exempted (P 1.00)</div>
                <div class="grid grid-cols-2 gap-4 items-center">
                    <div class="text-sm">AMOUNT</div>
                    <div class="flex items-center justify-end">
                        <span class="mr-2 font-bold">P</span>
                        <input type="text" name="basic_community_tax" class="form-field text-right w-24 md:w-32" value="5.00">
                    </div>
                </div>
            </div>

            <!-- B. ADDITIONAL COMMUNITY TAX -->
            <div class="mb-6">
                <div class="section-title">B. ADDITIONAL COMMUNITY TAX (tax not to exceed P5,000.00)</div>
                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4 items-center">
                        <div class="text-sm">1. GROSS RECEIPTS OR EARNINGS DERIVED FROM BUSINESS DURING THE PRECENDING YEAR (P1.00 for every P1,000.00)</div>
                        <div class="flex items-center justify-end">
                            <span class="mr-2 font-bold">P</span>
                            <input type="text" name="gross_receipts_earnings" class="form-field text-right w-24 md:w-32" value=".00">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 items-center">
                        <div class="text-sm">2. SALARIES OR GROSS RECEIPT OR EARNINGS DERIVED FROM EXERCISE OF PROFESSION OR PURSUIT OF ANY OCCUPATION (P1.00 for every P1,000)</div>
                        <div class="flex items-center justify-end">
                            <span class="mr-2 font-bold">P</span>
                            <input type="text" name="salaries_earnings" class="form-field text-right w-24 md:w-32" value=".00">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 items-center">
                        <div class="text-sm">3. INCOME FROM REAL PROPERTY (P1.00 for every P1,000)</div>
                        <div class="flex items-center justify-end">
                            <span class="mr-2 font-bold">P</span>
                            <input type="text" name="income_real_property" class="form-field text-right w-24 md:w-32" value="950.00">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Signature and Totals Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4 mb-6">
                <div>
                    <div class="border border-gray-300 h-24 flex items-center justify-center rounded-md mb-2 bg-gray-50 text-gray-400">
                        Right Thumb Print Placeholder
                    </div>
                    <p class="label-text text-center">Right Thumb Print</p>
                </div>
                <div>
                    <div class="mb-4">
                        <input type="text" name="taxpayer_signature" class="form-field text-center" value="" placeholder="">
                        <p class="label-text text-center">TAXPAYER'S SIGNATURE</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4 items-center mb-2">
                        <div class="font-bold text-sm">TOTAL</div>
                        <div class="flex items-center justify-end">
                            <span class="mr-2 font-bold">P</span>
                            <input type="text" name="total_amount" class="form-field text-right w-24 md:w-32" value="0.00">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 items-center mb-2">
                        <div class="font-bold text-sm">INTEREST</div>
                        <div class="flex items-center justify-end">
                            <span class="mr-2 font-bold">P</span>
                            <input type="text" name="interest" class="form-field text-right w-24 md:w-32" value=".00">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 items-center">
                        <div class="font-bold text-sm">TOTAL AMOUNT PAID</div>
                        <div class="flex items-center justify-end">
                            <span class="mr-2 font-bold">P</span>
                            <input type="text" name="total_amount_paid" class="form-field text-right w-24 md:w-32" value=".00">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Information -->
            <div class="text-center mt-8">
                <p class="text-sm font-semibold mb-2">OIC - Municipal Treasurer</p>
                <p class="text-xs text-gray-500 mb-4">MUNICIPAL/CITY TREASURER</p>
                <p class="text-xs text-gray-500">DOP: 05.11.2015</p>
            </div>

            <!-- Submit Button -->
            <div class="text-center mt-8">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-full shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
                    Submit Payment
                </button>
            </div>
        </form>

    </div>