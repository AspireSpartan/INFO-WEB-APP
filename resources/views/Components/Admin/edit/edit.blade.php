@extends('layouts.admin') {{-- Or your main admin layout --}}

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Edit News Item</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('news.update', $newsItem->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        @method('PUT') {{-- Essential for update method --}}

        <div class="mb-4">
            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
            <input type="text" name="title" id="title" value="{{ old('title', $newsItem->title) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label for="author" class="block text-gray-700 text-sm font-bold mb-2">Author:</label>
            <input type="text" name="author" id="author" value="{{ old('author', $newsItem->author) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label for="date" class="block text-gray-700 text-sm font-bold mb-2">Date:</label>
            <input type="date" name="date" id="date" value="{{ old('date', \Carbon\Carbon::parse($newsItem->date)->format('Y-m-d')) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label for="url" class="block text-gray-700 text-sm font-bold mb-2">URL:</label>
            <input type="url" name="url" id="url" value="{{ old('url', $newsItem->url) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4 flex items-center">
            <input type="checkbox" name="sponsored" id="sponsored" value="1" {{ old('sponsored', $newsItem->sponsored) ? 'checked' : '' }} class="mr-2 leading-tight">
            <label for="sponsored" class="text-sm text-gray-700">Sponsored</label>
        </div>

        <div class="mb-4">
            <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Image (Current):</label>
            @if ($newsItem->picture)
                <img src="{{ asset('storage/' . $newsItem->picture) }}" alt="Current News Image" class="mb-2 max-w-xs h-auto">
            @else
                <p>No current image.</p>
            @endif
            <label for="image" class="block text-gray-700 text-sm font-bold mb-2 mt-2">Upload New Image (Optional):</label>
            <input type="file" name="image" id="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <p class="text-xs text-gray-500 mt-1">Max file size: 8MB. Allowed formats: jpeg, png, jpg, gif.</p>
        </div>

        <div class="mb-4">
            <label for="views" class="block text-gray-700 text-sm font-bold mb-2">Views:</label>
            <input type="number" name="views" id="views" value="{{ old('views', $newsItem->views) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Update News
            </button>
            <a href="{{ route('admin.dashboard') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection