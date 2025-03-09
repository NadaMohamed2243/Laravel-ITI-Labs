<!-- filepath: c:\Users\nadam\Downloads\open source\Laravel\day1\lab\itiBlog\resources\views\posts\index.blade.php -->
<x-layout title="ITI Blog Post">
    <div class="text-center">
        <a href={{ route('posts.create')}}
            class="mt-4 px-4 py-2 bg-green-600 text-white font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
            Create Post
        </a>
    </div>

    <!-- Table Component -->
    <div class="mt-6 rounded-lg border border-gray-200">
        <div class="overflow-x-auto rounded-t-lg">
            <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                <thead class="text-left">
                    <tr>
                        <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">#</th>
                        <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Title</th>
                        <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Posted By</th>
                        <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Created At</th>
                        <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($posts as $post)
                        <tr>
                            {{-- laravel magic (obj can access is as array) $post['id'] == $post->id --}}
                            <td class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">{{ $post->id }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-gray-700">{{$post->title}}</td>
                            {{-- <td class="px-4 py-2 whitespace-nowrap text-gray-700">{{$post->user?->name}}</td> --}}
                            <td class="px-4 py-2 whitespace-nowrap text-gray-700">
                                {{$post->user ? $post->user->name : 'User Not found'}}
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap text-gray-700">{{$post->created_at->format('Y-m-d')}}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-gray-700 space-x-2">
                                <x-button type="primary" href="{{ route('posts.show', $post->id) }}">View</x-button>
                                <x-button type="secondary" href="{{ route('posts.edit', $post->id) }}">Edit</x-button>
                                <x-button type="danger" href="{{ route('posts.destroy', $post->id) }}"
                                    method="DELETE">Delete</x-button>

                                {{-- <form action="{{ route('posts.destroy', $post['id']) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-block px-4 py-1 text-xs font-medium text-white bg-red-600 rounded hover:bg-red-700 cursor-pointer">
                                        Delete
                                    </button>
                                </form> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="rounded-b-lg border-t border-gray-200 px-4 py-2">
            <ol class="flex justify-end gap-1 text-xs font-medium">
                <li>
                    <a href="#"
                        class="inline-flex size-8 items-center justify-center rounded-sm border border-gray-100 bg-white text-gray-900">
                        <span class="sr-only">Prev Page</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-3" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="block size-8 rounded-sm border border-gray-100 bg-white text-center leading-8 text-gray-900">1</a>
                </li>
                <li class="block size-8 rounded-sm border-blue-600 bg-blue-600 text-center leading-8 text-white">2
                </li>
                <li>
                    <a href="#"
                        class="block size-8 rounded-sm border border-gray-100 bg-white text-center leading-8 text-gray-900">3</a>
                </li>
                <li>
                    <a href="#"
                        class="block size-8 rounded-sm border border-gray-100 bg-white text-center leading-8 text-gray-900">4</a>
                </li>
                <li>
                    <a href="#"
                        class="inline-flex size-8 items-center justify-center rounded-sm border border-gray-100 bg-white text-gray-900">
                        <span class="sr-only">Next Page</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-3" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                </li>
            </ol>
        </div>
    </div>


    <!-- Delete Confirmation Modal -->
    <div id="delete-alert" class="hidden fixed inset-0 bg-[rgba(128,128,166,0.4)] flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
            <h2 class="text-lg font-semibold text-gray-800">Confirm Deletion</h2>
            <p class="text-gray-600 mt-2">Are you sure you want to delete this item?</p>
            <div class="mt-4 flex justify-end space-x-2">
                <button onclick="hideDeleteAlert()"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded cursor-pointer">Cancel</button>
                <form id="delete-form" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded cursor-pointer">Delete</button>
                </form>
            </div>
        </div>
    </div>


    <script>
        function showDeleteAlert(href) {
            document.getElementById('delete-alert').classList.remove('hidden');
            document.getElementById('delete-form').setAttribute('action', href);
        }

        function hideDeleteAlert() {
            document.getElementById('delete-alert').classList.add('hidden');
        }
    </script>

</x-layout>