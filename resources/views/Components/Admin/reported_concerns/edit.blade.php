@props(['concern'])

<form method="POST" action="{{ route('reported_concerns.update', $concern->id) }}">
    @csrf
    @method('PUT')
    <input type="hidden" name="screen" value="reported_concerns">

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

    <div class="flex items-center justify-between gap-4">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Update Concern
        </button>
        <button type="submit" name="action" value="delete" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" onclick="return confirm('Are you sure you want to delete this concern?')">
            Delete Concern
        </button>
    </div>
</form>