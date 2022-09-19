<x-app-layout>
    <x-slot name="header">
        <div class="flex mb-4">
            <div class="w-1/3">
                <h3 class="text-gray-700 text-3xl font-medium">Posts</h3>
            </div>
            <div class="w-1/3">

            </div>
            <div class="w-1/3 text-right">
                @can('create', App\Models\Post::class)
                <a href="{{ route('posts.create') }}" class="text-indigo-600 hover:text-indigo-900">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                        Add Post
                    </button>
                </a>
                @endcan
            </div>
        </div>
    </x-slot>

    <div class="px-12">
        <div class="flex flex-col mt-8 mb-8">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-bold text-gray-500 uppercase tracking-wider">
                                    ID</th>
                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Title</th>
                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Body</th>
                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
        
                        <tbody class="bg-white">
                            @forelse($posts as $post)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        {{ $post->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-900">{{ $post->title }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                        {{ $post->body }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium">
                                        <a href="{{ route('posts.edit', $post->id) }}"><button
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                                                Edit
                                            </button></a>
                                        <a href="javascript:void(0)" onclick="deleteFunction();"><button
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full">
                                                Delete
                                            </button></a>
                                        <form method="POST" id="delete"
                                            action="{{ route('posts.destroy', $post->id) }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b text-center border-gray-200" colspan="4">
                                        No Post Found...
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

