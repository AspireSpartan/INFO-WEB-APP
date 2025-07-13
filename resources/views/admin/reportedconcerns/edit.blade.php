@props(['concerns'])
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Edit Reported Concern</h1>

    <form action="{{ route('admin.reportedconcerns.update', $concern->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status:</label>
            <select name="status" id="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="pending" {{ $concern->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="in_progress" {{ $concern->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="resolved" {{ $concern->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="action" class="block text-gray-700 text-sm font-bold mb-2">Action:</label>
            <select name="action" id="action" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="normal" {{ $concern->action == 'normal' ? 'selected' : '' }}>Normal</option>
                <option value="priority" {{ $concern->action == 'priority' ? 'selected' : '' }}>Priority</option>
                <option value="urgent" {{ $concern->action == 'urgent' ? 'selected' : '' }}>Urgent</option>
            </select>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Update Concern
            </button>
        </div>
    </form>
</div>