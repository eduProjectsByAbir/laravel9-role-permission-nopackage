@extends('admin.layouts.admin-layout')
@section('body')
<div class="flex mb-4">
    <div class="w-1/3">
        <h3 class="text-gray-700 text-3xl font-medium">All Users</h3>
    </div>
    <div class="w-1/3">
        <div class="px-3 mb-6 md:mb-0">
            <div class="relative">
                <select
                    class="block appearance-none w-full bg-gray-200 border border-blue-500 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="grid-state">
                    <option>Filter By</option>
                    <option>Latest</option>
                    <option>Oldest</option>
                </select>
            </div>
        </div>
    </div>
    <div class="w-1/3 text-right">
        <a href="{{ route('admin.roles.index') }}" class="text-indigo-600 hover:text-indigo-900">
            <button class="bg-yellow-500 hover:bg-yellow-700 text-black font-bold py-2 px-4 rounded-full">
                Roles
            </button>
        </a>
        <a href="{{ route('admin.permissions.index') }}" class="text-indigo-600 hover:text-indigo-900">
            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full">
                Permissions
            </button>
        </a>
    </div>
</div>

<div class="flex flex-col mt-8">
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
                            Name</th>
                        <th
                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Email</th>
                        <th
                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Role</th>
                        <th
                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Actions</th>
                    </tr>
                </thead>

                <tbody class="bg-white">
                    @forelse($users as $user)
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                {{ $user->id }}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900">{{ $user->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                {{ $user->role->name }}
                            </td>
                            <td
                                class="px-6 py-4 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium">
                                <a href="{{ route('admin.users.edit', $user->id) }}"><button
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                                        Edit
                                    </button></a>
                                @if(!$user->hasRole('admin'))
                                    <a href="javascript:void(0)" onclick="deleteFunction();"><button
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full">
                                            Delete
                                        </button></a>
                                    <form method="POST" id="delete"
                                        action="{{ route('admin.users.destroy', $user->id) }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b text-center border-gray-200" colspan="4">
                                No User Found...
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function deleteFunction() {
        event.preventDefault(); // prevent form submit
        var form = document.getElementById('delete'); // deleting the form
        Swal.fire({
            title: "Are you sure?",
            text: "But you will still be able to retrieve the data.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel please!",
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                form.submit();
                // Swal.fire('Saved!', '', 'success')
            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info')
            }
        });
    }

</script>
@endsection
