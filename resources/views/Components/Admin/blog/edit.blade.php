@extends('layouts.admin') {{-- This assumes you have a layout file at resources/views/layouts/admin.blade.php --}}

@section('content')

<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Edit Blog Post</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('blogs.update', $blogfeed->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        @method('PUT') {{-- Essential for update method --}}

        <div class="mb-4">
            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
            <input type="text" name="title" id="title" value="{{ old('title', $blogfeed->title) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label for="content" class="block text-gray-700 text-sm font-bold mb-2">Content:</label>
            <textarea name="content" id="content" rows="10" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>{{ old('content', $blogfeed->content) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="author" class="block text-gray-700 text-sm font-bold mb-2">Author:</label>
            <input type="text" name="author" id="author" value="{{ old('author', $blogfeed->author) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label for="authortitle" class="block text-gray-700 text-sm font-bold mb-2">Author Title:</label>
            <input type="text" name="authortitle" id="authortitle" value="{{ old('authortitle', $blogfeed->authortitle) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="published_at" class="block text-gray-700 text-sm font-bold mb-2">Published Date:</label>
            {{-- Changed input type to 'date' and format to 'Y-m-d' --}}
            <input type="date" name="published_at" id="published_at" value="{{ old('published_at', $blogfeed->published_at ? \Carbon\Carbon::parse($blogfeed->published_at)->format('Y-m-d') : '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Main Image (Current):</label>
            @if ($blogfeed->image_path)
                <img src="{{ asset('storage/' . $blogfeed->image_path) }}" alt="Current Blog Image" class="mb-2 max-w-xs h-auto">
            @else
                <p>No current main image.</p>
            @endif
            <label for="image" class="block text-gray-700 text-sm font-bold mb-2 mt-2">Upload New Main Image (Optional):</label>
            <input type="file" name="image" id="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <p class="text-xs text-gray-500 mt-1">Max file size: 8MB. Allowed formats: jpeg, png, jpg, gif, svg.</p>
            {{-- Removed the clear_image checkbox --}}
        </div>

        <div class="mb-4">
            <label for="icon" class="block text-gray-700 text-sm font-bold mb-2">Author Icon (Current):</label>
            @if ($blogfeed->icon_path)
                <img src="{{ asset('storage/' . $blogfeed->icon_path) }}" alt="Current Icon" class="mb-2 w-16 h-16 rounded-full object-cover">
            @else
                <p>No current icon.</p>
            @endif
            <label for="icon" class="block text-gray-700 text-sm font-bold mb-2 mt-2">Upload New Icon (Optional):</label>
            <input type="file" name="icon" id="icon" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <p class="text-xs text-gray-500 mt-1">Max file size: 999KB. Allowed formats: jpeg, png, jpg, gif, svg.</p>
            {{-- Removed the clear_icon checkbox --}}
        </div>

        <div class="flex items-center justify-between mt-6">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Update Blog Post
            </button>
            <a href="{{ route('blogs.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                Cancel
            </a>
        </div>
    </form>
</div>

@endsection