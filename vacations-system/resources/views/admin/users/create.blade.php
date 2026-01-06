@extends('layouts.admin')

@section('title', 'Create User')

@section('content')
<h2 class="text-2xl font-bold mb-6">Create New User</h2>

<form action="{{ route('admin.users.store') }}" method="POST">
    @csrf

    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">Name</label>
        <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">Password</label>
        <input type="password" name="password" class="w-full border rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">Confirm Password</label>
        <input type="password" name="password_confirmation" class="w-full border rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label class="flex items-center">
            <input type="checkbox" name="is_admin" value="1" {{ old('is_admin') ? 'checked' : '' }} class="mr-2">
            <span class="text-gray-700">Admin User</span>
        </label>
    </div>

    <div class="flex justify-end space-x-4">
        <a href="{{ route('admin.users.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</a>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Create User</button>
    </div>
</form>
@endsection