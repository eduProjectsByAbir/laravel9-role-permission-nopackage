@extends('admin.layouts.admin-layout')
@section('body')
<div class="flex mb-4">
    <div class="w-1/3">
        <h3 class="text-gray-700 text-3xl font-medium">Set Permissions</h3>
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

<div class="flex flex-col items-center mt-8 bg-white pt-5 pb-5 border border-green-700 rounded">
    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <div class="align-middle inline-block min-w-full overflow-hidden sm:rounded-lg">
            <div class="flex m-2 p-2">
                <div class="max-w-md mx-auto">
                    <h1 class="max-w-sm mx-auto text-green-700 font-bold"><strong>{{ $role->name }}</strong> Has Permissions For </h1><br>
                    @foreach ($role->permissions as $item)
                        <span class="m-2 p-2 bg-indigo-300 rounded-md">{{ $item->name }}</span>
                    @endforeach
                </div>
            </div>
            <form class="w-full max-w-lg bg-white" action="{{ route('admin.roles.permissions', $role->id) }}" method="post">
                @csrf
                <div class="inline-block relative w-80 h-40">
                    <label class="block text-gray-600 pt-2 pb-2 text-bold" for="Multiselect">Set Permissions</label>
                    <select
                        class="block w-full rounded-sm cursor-pointer focus:outline-none"
                        multiple name="permissions[]" id="permissions" autocomplete="off">
                        <option value="" disabled>Select Permissions</option>
                        @foreach ($permissions as $permission)
                        <option value="{{ $permission->id }}" @selected($role->hasPermission($permission->name))>{{ $permission->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-center text-center pt-4">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit">
                        Assign Permission
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link
href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css"
rel="stylesheet"
/>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
<script>
  new TomSelect('#permissions', {
    maxItems: 50,
  });
</script>
@endsection
