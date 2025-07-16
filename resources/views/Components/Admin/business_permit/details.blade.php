@props(['application'])
<div class="space-y-6">
    <!-- Business Information Section -->
    <div class="border-b border-gray-200 pb-6">
        <h2 class="text-xl font-semibold text-black mb-4">Business Information</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Business Name</label>
                <p class="text-sm text-black">{{ $application->business_name }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Type of Business</label>
                <p class="text-sm text-black">{{ ucfirst(str_replace('_', ' ', $application->business_type)) }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Business Barangay</label>
                <p class="text-sm text-black">{{ $application->business_barangay }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Business Address</label>
                <p class="text-sm text-black">{{ $application->business_address }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Business Phone</label>
                <p class="text-sm text-black">{{ $application->business_phone ?? 'N/A' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Business Email</label>
                <p class="text-sm text-black">{{ $application->business_email }}</p>
            </div>
        </div>
    </div>

    <!-- Owner/Applicant Information Section -->
    <div class="border-b border-gray-200 pb-6">
        <h2 class="text-xl font-semibold text-black mb-4">Owner/Applicant Information</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">First Name</label>
                <p class="text-sm text-black">{{ $application->owner_first_name }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Last Name</label>
                <p class="text-sm text-black">{{ $application->owner_last_name }}</p>
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-500 mb-1">Residential Address</label>
                <p class="text-sm text-black">{{ $application->owner_address }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Phone Number</label>
                <p class="text-sm text-black">{{ $application->owner_phone }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Email Address</label>
                <p class="text-sm text-black">{{ $application->owner_email }}</p>
            </div>
        </div>
    </div>

    <!-- Business Activity Section -->
    <div class="border-b border-gray-200 pb-6">
        <h2 class="text-xl font-semibold text-black mb-4">Business Activity / Nature</h2>
        <div>
            <label class="block text-sm font-medium text-gray-500 mb-1">Business Activity</label>
            <p class="text-sm text-black">{{ $application->business_activity }}</p>
        </div>
        <div class="mt-4">
            <label class="block text-sm font-medium text-gray-500 mb-1">Total Capitalization (PHP)</label>
            <p class="text-sm text-black">₱{{ number_format($application->capitalization, 2) }}</p>
        </div>
    </div>

    <!-- Status Section -->
    <div>
        <label class="block text-sm font-medium text-gray-500 mb-1">Application Status</label>
        <p class="text-sm text-black">{{ ucfirst($application->status) }}</p>
    </div>
</div>