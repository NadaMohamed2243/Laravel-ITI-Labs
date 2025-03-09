<!-- filepath: c:\Users\nadam\Downloads\open source\Laravel\day2\lab\itiBlog\resources\views\comments\edit.blade.php -->
<x-layout title="Edit Comment">
    <div class="max-w-3xl mx-auto space-y-6">
        <div class="bg-white rounded border border-gray-200">
            <div class="px-4 py-3 bg-gray-50 border-b border-gray-200">
                <h2 class="text-base font-medium text-gray-700">Edit Comment</h2>
            </div>
            <div class="px-4 py-4">
                <form action="{{ route('comments.update', $comment) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <textarea name="content" class="w-full border border-gray-300 rounded p-2" rows="3">{{ $comment->content }}</textarea>
                    <button type="submit" class="mt-2 px-4 py-2 bg-blue-600 text-white font-medium rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Update Comment</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>