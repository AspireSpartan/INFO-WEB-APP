
@props(['reports'])
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Cedula Reports Management</h1>
    
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Full Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Barangay</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Address</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Birth Details</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Occupation</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Income</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tax Due</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
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
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="{{ route('cedulareports.update', $report->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status" onchange="this.form.submit()" class="text-sm rounded border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="pending" {{ $report->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="done" {{ $report->status === 'done' ? 'selected' : '' }}>Done</option>
                                    <option value="rejected" {{ $report->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </form>
                        </td>
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
    </div>
    
    <div class="mt-4">
        @if ($reports instanceof \Illuminate\Pagination\LengthAwarePaginator)
            {{ $reports->links() }}
        @else
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">The reports variable is not a paginator instance.</span>
            </div>
        @endif
    </div>
</div>
</div>