<!-- BLOG/NEWSFEED SECTION -->
      <div class="bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
          <div class="mx-auto max-w-2xl lg:mx-0 text-center lg:text-left">
            <h2 class="text-5xl font-bold tracking-tight text-gray-900 sm:text-6xl mb-2">LGU News & Announcements</h2>
            <p class="text-lg text-gray-600">Get the latest updates on local ordinances, community events, and government advisories from your LGU.</p>
          </div>
          <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
            <!-- Newsfeed Cards (Dynamic) -->
            @if($newsfeeds->count())
                @foreach ($newsfeeds as $newsfeed)
                <article x-data="{ editMode: false }" class="flex flex-col items-start rounded-2xl bg-white shadow-none" id="newsfeed-{{ $newsfeed->id }}">
                    <!-- Newsfeed Card View Mode -->
                    <template x-if="!editMode">
                        <div>
                            <img src="{{ asset('storage/' . $newsfeed->image_path) }}" alt="" class="mb-6 w-full h-64 object-cover rounded-xl">
                            <div class="flex items-center gap-x-4 text-xs mb-2">
                                <time datetime="{{ $newsfeed->published_at }}" class="text-gray-500">{{ $newsfeed->published_at }}</time>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $newsfeed->title }}</h3>
                            <p class="text-gray-600 mb-6">{{ $newsfeed->content }}</p>
                            <div class="flex items-center gap-x-4 mt-auto">
                                <img src="{{ asset('storage/' . $newsfeed->icon_path) }}" alt="" class="w-10 h-10 rounded-full bg-gray-50">
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $newsfeed->author }}</p>
                                    <p class="text-gray-600 text-sm">{{ $newsfeed->authortitle }}</p>
                                </div>
                            </div>
                            <button @click="editMode = true"
                                class="mt-4 inline-block rounded bg-indigo-600 px-4 py-2 text-white font-semibold hover:bg-indigo-500 transition">
                                Edit
                            </button>
                        </div>
                    </template>
                    <!-- Newsfeed Card Edit Mode -->
                    <template x-if="editMode">
                        <form action="{{ route('newsfeeds.update', $newsfeed->id) }}" method="POST" enctype="multipart/form-data" class="w-full">
                            @csrf
                            @method('PUT')
                            <!-- Preview image -->
                            <img src="{{ asset('storage/' . $newsfeed->image_path) }}" alt="" class="mb-6 w-full h-64 object-cover rounded-xl">
                            <div class="flex items-center gap-x-4 text-xs mb-2">
                                <input type="date" name="published_at" value="{{ old('published_at', $newsfeed->published_at ? \Illuminate\Support\Carbon::parse($newsfeed->published_at)->format('Y-m-d') : '') }}" required class="text-gray-500 border rounded px-2 py-1">
                            </div>
                            <input type="text" name="title" value="{{ old('title', $newsfeed->title) }}" required class="mb-2 w-full border rounded px-2 py-1 text-xl font-semibold text-gray-900" placeholder="Title">
                            <textarea name="content" required class="mb-2 w-full border rounded px-2 py-1 text-gray-600" placeholder="Content">{{ old('content', $newsfeed->content) }}</textarea>
                            <div class="flex items-center gap-x-4 mt-auto mb-4">
                                <img src="{{ asset('storage/' . $newsfeed->icon_path) }}" alt="" class="w-10 h-10 rounded-full bg-gray-50">
                                <div>
                                    <input type="text" name="author" value="{{ old('author', $newsfeed->author) }}" required class="font-semibold text-gray-900 border rounded px-2 py-1 mb-1" placeholder="Author">
                                    <input type="text" name="authortitle" value="{{ old('authortitle', $newsfeed->authortitle) }}" required class="text-gray-600 text-sm border rounded px-2 py-1" placeholder="Author Title">
                                </div>
                            </div>
                            <label class="block mb-2 text-sm font-medium text-gray-700" for="image_upload_{{ $newsfeed->id }}">Change Image</label>
                            <input type="file" name="image_upload" id="image_upload_{{ $newsfeed->id }}" class="mb-2 w-full border rounded px-2 py-1">
                            <label class="block mb-2 text-sm font-medium text-gray-700" for="icon_upload_{{ $newsfeed->id }}">Change Icon</label>
                            <input type="file" name="icon_upload" id="icon_upload_{{ $newsfeed->id }}" class="mb-2 w-full border rounded px-2 py-1">
                            <div class="flex gap-2">
                                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Update</button>
                                <button type="button" @click="editMode = false" class="bg-gray-300 px-4 py-2 rounded">Cancel</button>
                            </div>
                        </form>
                    </template>
                </article>
                @endforeach
            @endif
          </div>
        </div>
      </div>