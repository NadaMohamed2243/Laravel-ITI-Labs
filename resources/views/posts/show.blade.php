<!-- filepath: c:\Users\nadam\Downloads\open source\Laravel\day2\lab\itiBlog\resources\views\posts\show.blade.php -->
<x-layout title="Show Post">
    <div class="max-w-3xl mx-auto space-y-6">
        <!-- Post Info Card -->
        {{-- @dd($post); --}}
        <div class="bg-white rounded border border-gray-200">
            <div class="px-4 py-3 bg-gray-50 border-b border-gray-200">
                <h2 class="text-base font-medium text-gray-700">Post Info</h2>
            </div>
            <div class="px-4 py-4">
                <div class="mb-2">
                    <h3 class="text-lg font-medium text-gray-800">Title :- <span
                            class="font-normal">{{$post->title}}</span></h3>
                </div>
                <div>
                    <h3 class="text-lg font-medium text-gray-800">Description :-</h3>
                    <p class="text-gray-600">{{$post->description}}</p>
                </div>
            </div>
        </div>

        <!-- Post Creator Info Card -->
        <div class="bg-white rounded border border-gray-200">
            <div class="px-4 py-3 bg-gray-50 border-b border-gray-200">
                <h2 class="text-base font-medium text-gray-700">Post Creator Info</h2>
            </div>
            <div class="px-4 py-4">
                <div class="mb-2">
                    <h3 class="text-lg font-medium text-gray-800">Name :- <span
                            class="font-normal">{{$post->user ? $post->user->name : 'No User Found'}}</span></h3>
                </div>
                <div class="mb-2">
                    <h3 class="text-lg font-medium text-gray-800">Email :- <span
                            class="font-normal">{{$post->user?->email}}</span></h3>
                </div>
                <div>
                    <h3 class="text-lg font-medium text-gray-800">Created At :- <span
                            class="font-normal">{{$post->user?->created_at->translatedFormat('l jS \\of F Y H:i:s')}}</span>
                    </h3>
                </div>
            </div>
        </div>

        <!-- Comments Section -->
        <div class="bg-white rounded border border-gray-200">
            <div class="px-4 py-3 bg-gray-50 border-b border-gray-200">
                <h2 class="text-base font-medium text-gray-700">Comments</h2>
            </div>
            <div class="px-4 py-4 space-y-4">
                @foreach($post->comments as $comment)
                    <div class="border-b border-gray-200 pb-2">
                        <p class="flex justify-between text-gray-800"><span
                                class="p-2 my-2 bg-blue-50 rounded border border-blue-300 break-words max-w-[550px] w-full">{{ $comment->content }}</span>
                            <span class="p-2 bg-gray-100 rounded max-h-[45px]">{{ $comment->created_at }}</span>
                        </p>
                        <div class="flex justify-between items-center">
                            <div class="flex space-x-2">
                                <a href="{{ route('comments.edit', $comment) }}"
                                    class="text-blue-600 cursor-pointer p-2 bg-gray-200 rounded hover:bg-gray-300">Edit</a>
                                <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 cursor-pointer p-2 bg-gray-200 rounded hover:bg-gray-300">Delete</button>
                                </form>
                            </div>
                            <div>
                                @if($comment->created_at != $comment->updated_at)
                                    <br>
                                    <strong>Edited:</strong> {{ $comment->updated_at->format('Y-m-d H:i') }}
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                <form action="{{ route('comments.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="commentable_type" value="App\Models\Post">
                    <input type="hidden" name="commentable_id" value="{{ $post->id }}">
                    <textarea name="content" class="w-full border border-gray-300 rounded p-2" rows="3"
                        placeholder="Add a comment"></textarea>
                    <button type="submit"
                        class="mt-2 px-4 py-2 bg-blue-600 text-white font-medium rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 cursor-pointer">Add
                        Comment</button>
                </form>
            </div>
        </div>

        <!-- Back Button -->
        <div class="flex justify-end">
            <a href={{ route('posts.index') }}
                class="px-4 py-2 bg-gray-600 text-white font-medium rounded hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                Back to All Posts
            </a>
        </div>
    </div>
</x-layout>
