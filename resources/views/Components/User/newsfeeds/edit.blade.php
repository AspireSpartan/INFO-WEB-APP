<form action="{{ route('newsfeeds.update', $newsfeed->id) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="title" value="{{ $newsfeed->title }}" required>
    <textarea name="content" required>{{ $newsfeed->content }}</textarea>
    <!-- Add other fields as needed -->
    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Update</button>
</form>