@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6 mb-6">
    <h2 class="text-3xl font-bold text-gray-900 mb-6 flex items-center">
        <i class="fas fa-edit text-gray-800 mr-3"></i>
        Edit User
    </h2>

    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-gray-700 font-semibold mb-2">
                <i class="fas fa-user text-gray-600 mr-2"></i>Name
            </label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all" required>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-2">
                <i class="fas fa-envelope text-gray-600 mr-2"></i>Email
            </label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all" required>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-2">
                <i class="fas fa-lock text-gray-600 mr-2"></i>Password
            </label>
            <input type="password" name="password" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all" placeholder="Leave blank to keep current password">
            <p class="text-sm text-gray-500 mt-2">
                <i class="fas fa-info-circle mr-1"></i>Leave blank if you don't want to change the password
            </p>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-2">
                <i class="fas fa-lock text-gray-600 mr-2"></i>Confirm Password
            </label>
            <input type="password" name="password_confirmation" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all" placeholder="Confirm new password">
        </div>

        <div class="flex items-center">
            <input type="checkbox" name="is_admin" id="is_admin" value="1" {{ old('is_admin', $user->is_admin) ? 'checked' : '' }} class="w-4 h-4 text-gray-800 border-gray-300 rounded focus:ring-gray-500">
            <label for="is_admin" class="ml-2 text-gray-700 font-semibold">
                <i class="fas fa-shield-alt text-gray-600 mr-2"></i>Admin User
            </label>
        </div>

        <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
            <a href="{{ route('admin.users.index') }}" class="bg-gray-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-600 transition-all duration-200 shadow-md hover:shadow-lg">
                <i class="fas fa-times mr-2"></i>Cancel
            </a>
            <button type="submit" class="bg-gray-800 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-900 transition-all duration-200 shadow-md hover:shadow-lg">
                <i class="fas fa-save mr-2"></i>Update User
            </button>
        </div>
    </form>
</div>
@endsection
