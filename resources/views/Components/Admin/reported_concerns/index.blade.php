@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Manage Reported Concerns</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b border-gray-300 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Reporter</th>
                    <th class="px-6 py-3 border-b border-gray-300 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 border-b border-gray-300 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Location</th>
                    <th class="px-6 py-3 border-b border-gray-300 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Description</th>
                    <th class="px-6 py-3 border-b border-gray-300 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 border-b border-gray-300 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Actions</th>
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
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $concern->status == 'pending' ? 'yellow' : ($concern->status == 'in_progress' ? 'blue' : 'green') }}-100 text-{{ $concern->status == 'pending' ? 'yellow' : ($concern->status == 'in_progress' ? 'blue' : 'green') }}-800">
                            {{ ucfirst(str_replace('_', ' ', $concern->status)) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-300 text-sm leading-5 font-medium">
                        <a href="{{ route('admin.reportedconcerns.edit', $concern->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="mt-4">
        {{ $concerns->links() }}
    </div>
</div>
@endsection