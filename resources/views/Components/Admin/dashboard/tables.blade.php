<!-- Reported Concerns -->
 @props(['concerns', 'reports', 'applications'])

                <div class="flex justify-between items-center p-6 border-b border-gray-100">
                    <h2 class="text-2xl font-semibold font-montserrat text-[#37474F]">
                        <i class="fas fa-exclamation-triangle mr-3"></i> Reported Concerns
                    </h2>
                </div>
        <div class="overflow-x-auto shadow-md">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="px-6 py-3 border-b border-gray-300 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Reporter</th>
                        <th class="px-6 py-3 border-b border-gray-300 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 border-b border-gray-300 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Location</th>
                        <th class="px-6 py-3 border-b border-gray-300 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3 border-b border-gray-300 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 border-b border-gray-300 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($concerns as $concern)
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">
                            <div class="text-sm leading-5 font-medium text-gray-900">{{ $concern->reporter_name }}</div>
                            <div class="text-sm leading-5 text-gray-500">{{ $concern->reporter_email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">
                            <div class="text-sm leading-5 text-gray-900">{{ $concern->concern_date }}</div>
                            <div class="text-sm leading-5 text-gray-500">{{ $concern->concern_time }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">
                            <div class="text-sm leading-5 text-gray-900">{{ $concern->concern_barangay }}</div>
                            <div class="text-sm leading-5 text-gray-500">{{ $concern->concern_barangay_details }}</div>
                        </td>
                        <td class="px-6 py-4 border-b border-gray-300">
                            <div class="text-sm leading-5 text-gray-900">{{ Str::limit($concern->concern_description, 100) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $concern->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                ($concern->status == 'working' ? 'bg-blue-100 text-blue-800' : 
                                'bg-green-100 text-green-800') }}">
                                {{ ucfirst($concern->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $concern->action == 'priority' ? 'bg-orange-100 text-orange-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($concern->action) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="overflow-x-auto shadow-md ">

                <div class="flex justify-between items-center p-6 border-b border-gray-100">
                    <h2 class="text-2xl font-semibold font-montserrat text-[#37474F]">
                        <i class="fas fa-file-alt mr-3"></i> Cedula Reports
                    </h2>
                </div>

            <table class="min-w-full divide-y divide-gray-200 ">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Full Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Barangay</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Address</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Birth Details</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Occupation</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Income</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tax Due</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Submitted At</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($reports as $report)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $report->last_name }}, {{ $report->first_name }} {{ $report->middle_name ? $report->middle_name.' ' : '' }}{{ $report->suffix ?? '' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $report->barangay }}</td>
                        <td class="px-6 py-4">{{ $report->residential_address }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($report->date_of_birth)->format('M d, Y') }} in {{ $report->place_of_birth }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $report->profession }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">₱{{ number_format($report->gross_annual_income, 2) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">₱{{ number_format($report->community_tax_due, 2) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($report->created_at)->format('M d, Y H:i') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-gray-500">No cedula reports found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="overflow-x-auto shadow-md">
            <div class="flex justify-between items-center p-6 border-b border-gray-100">
                <h2 class="text-2xl font-semibold font-montserrat text-[#37474F]">
                    <i class="fas fa-file-invoice mr-3"></i> Business Permit Reports
                </h2>
            </div>
            <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Business Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Owner</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Submitted</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($applications as $application)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $application->business_name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $application->owner_first_name }} {{ $application->owner_last_name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $application->created_at->format('M d, Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $application->status === 'approved' ? 'bg-green-100 text-green-800' : 
                               ($application->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                            {{ ucfirst($application->status) }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>