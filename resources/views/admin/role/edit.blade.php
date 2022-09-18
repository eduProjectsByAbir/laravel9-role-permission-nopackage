@extends('admin.layouts.admin-layout')
@section('body')
<div class="flex mb-4">
    <div class="w-1/3">
        <h3 class="text-gray-700 text-3xl font-medium">Edit Role</h3>
    </div>
    <div class="w-1/3">

    </div>
    <div class="w-1/3 text-right">
        <a href="{{ route('admin.roles.index') }}" class="text-indigo-600 hover:text-indigo-900">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                Back
            </button>
        </a>
    </div>
</div>

<div class="flex flex-col items-center mt-8">
    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <div class="align-middle inline-block min-w-full overflow-hidden sm:rounded-lg border-b border-gray-200">
            <div class="w-full max-w-xs">
                <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
                    action="{{ route('admin.roles.update', $role->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                            Name
                        </label>
                        <input
                            class="shadow appearance-none border @error('name') border-red-500 @enderror rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="name" type="text" placeholder="Enter Role Name" name="name" value="{{ old('name', $role->name) }}">
                        @error('name')
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
@endsection

@section('script')

@endsection
