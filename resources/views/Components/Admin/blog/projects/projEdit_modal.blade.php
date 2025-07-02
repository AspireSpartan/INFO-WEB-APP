@extends('layouts.admin')

@section('content')

<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Edit Project</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title (Max 255 chars) <span class="text-red-500">*</span></label>
            <input type="text" name="title" id="title" value="{{ old('title', $project->title) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('title') border-red-500 @enderror" required>
            @error('title')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="site" class="block text-gray-700 text-sm font-bold mb-2">Site <span class="text-red-500">*</span></label>
            <input type="text" name="site" id="site" value="{{ old('site', $project->site) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('site') border-red-500 @enderror" required>
            @error('site')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="scope" class="block text-gray-700 text-sm font-bold mb-2">Scope <span class="text-red-500">*</span></label>
            <input type="text" name="scope" id="scope" value="{{ old('scope', $project->scope) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('scope') border-red-500 @enderror" required>
            @error('scope')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="outcome" class="block text-gray-700 text-sm font-bold mb-2">Outcome <span class="text-red-500">*</span></label>
            <input type="text" name="outcome" id="outcome" value="{{ old('outcome', $project->outcome) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('outcome') border-red-500 @enderror" required>
            @error('outcome')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="url" class="block text-gray-700 text-sm font-bold mb-2">Project URL</label>
            <input type="url" name="url" id="url" value="{{ old('url', $project->url) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('url') border-red-500 @enderror">
            @error('url')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="image_upload" class="block text-gray-700 text-sm font-bold mb-2">Current Project Image:</label>
            @if ($project->image_url)
                <img src="{{ asset('storage/' . $project->image_url) }}" alt="Current Project Image" class="mb-2 max-w-xs h-auto">
            @else
                <p>No current image.</p>
            @endif
            <label for="image_upload" class="block text-gray-700 text-sm font-bold mb-2 mt-2">Upload New Project Image (Optional):</label>
            <input type="file" name="image_upload" id="image_upload" accept="image/*" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <p class="text-xs text-gray-500 mt-1">Max file size: 8MB. Allowed formats: jpeg, png, jpg, gif, svg.</p>
            @error('image_upload')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between mt-6">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Update Project
            </button>
            <a href="{{ route('admin.dashboard') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                Cancel
            </a>
        </div>
    </form>
</div>

@endsection