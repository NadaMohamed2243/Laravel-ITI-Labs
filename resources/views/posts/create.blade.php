<!-- filepath: c:\Users\nadam\Downloads\open source\Laravel\day1\lab\itiBlog\resources\views\posts\create.blade.php -->
<x-layout title="Create Post">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800">Create New Post</h2>
                </div>

                @if ($errors->any())
                    <div role="alert" class="max-w-3xl mx-auto mb-4 rounded-sm border-s-4 border-red-500 bg-red-50 p-4">
                        <strong class="block font-medium text-red-800"> Something went wrong </strong>
                        {{-- <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach

                        </ul> --}}
                    </div>
                @endif
                <div class="px-6 py-4">
                    <form method='POST' action={{route('posts.store')}} enctype="multipart/form-data">
                        @csrf
                        <!-- Title Input -->
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                            <input type="text" id="title" name="title"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 py-2 px-3 border @error('title') is-invalid @enderror">
                            @error('title')
                                <div role="alert"
                                    class="max-w-3xl mx-auto m-4 rounded-sm border-s-4 border-red-500 bg-red-50 p-4">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Description Textarea -->
                        <div class="mb-4">
                            <label for="description"
                                class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea id="description" rows="5" name="description"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 py-2 px-3 border"></textarea>
                            @error('description')
                                <div role="alert"
                                    class="max-w-3xl mx-auto m-2 rounded-sm border-s-4 border-red-500 bg-red-50 p-4">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Post Creator Select -->
                        <div class="mb-6">
                            <label for="creator" class="block text-sm font-medium text-gray-700 mb-1">Post
                                Creator</label>
                            <select id="creator" name="creator"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 py-2 px-3 border bg-white">
                                @foreach ($users as $user)
                                    <option value={{ $user->id }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('creator')
                                <div role="alert"
                                    class="max-w-3xl mx-auto m-4 rounded-sm border-s-4 border-red-500 bg-red-50 p-4">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Image Upload Field -->
                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Upload Image</label>
                            <input type="file" id="image" name="image"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 py-2 px-3 border">
                            @error('image')
                                <div role="alert"
                                    class="max-w-3xl mx-auto m-4 rounded-sm border-s-4 border-red-500 bg-red-50 p-4">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit"
                                class="px-4 py-2 bg-green-600 text-white font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 hover:cursor-pointer">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
