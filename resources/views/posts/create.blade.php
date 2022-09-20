<x-app-layout>
    <x-slot name="header">
        <div class="flex mb-4">
            <div class="w-1/3">
                <h3 class="text-gray-700 text-3xl font-medium">Add Post</h3>
            </div>
            <div class="w-1/3">

            </div>
            <div class="w-1/3 text-right">
                <a href="{{ route('posts.index') }}" class="text-indigo-600 hover:text-indigo-900">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                        View Post
                    </button>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="px-12">
        <div class="flex flex-col items-center mt-8">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div class="align-middle inline-block min-w-full overflow-hidden sm:rounded-lg border-b border-gray-200">
                    <div class="w-full max-w-xs">
                        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
                            action="{{ route('posts.store') }}" method="post">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                    Title
                                </label>
                                <input
                                    class="shadow appearance-none border @error('title') border-red-500 @enderror rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="title" type="text" placeholder="Enter Title" name="title" value="{{ old('title') }}">
                                @error('title')
                                    <div class="text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="body">
                                    Body
                                </label>
                                <textarea
                                    class="shadow appearance-none border @error('body') border-red-500 @enderror rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="body" type="text" placeholder="Enter body" name="body">{{ old('body') }}</textarea>
                                @error('body')
                                    <div class="text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="flex items-center justify-between">
                                <button
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                    type="submit">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

