@extends('layouts.admin')

@section('title', 'Create Organizer')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6 mb-6">
    <h2 class="text-3xl font-bold text-gray-900 mb-6 flex items-center">
        <i class="fas fa-plus-circle text-gray-800 mr-3"></i>
        Create New Organizer
    </h2>

    <form action="{{ route('admin.organizers.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label class="block text-gray-700 font-semibold mb-2">
                <i class="fas fa-tag text-gray-600 mr-2"></i>Name
            </label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all" required>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-2">
                <i class="fas fa-envelope text-gray-600 mr-2"></i>Email
            </label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all" required>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-2">
                <i class="fas fa-phone text-gray-600 mr-2"></i>Phone
            </label>
            <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all">
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-2">
                <i class="fas fa-map-marker-alt text-gray-600 mr-2"></i>Address
            </label>
            <textarea name="address" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all">{{ old('address') }}</textarea>
        </div>

        <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
            <a href="{{ route('admin.organizers.index') }}" class="bg-gray-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-600 transition-all duration-200 shadow-md hover:shadow-lg">
                <i class="fas fa-times mr-2"></i>Cancel
            </a>
            <button type="submit" class="bg-gray-800 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-900 transition-all duration-200 shadow-md hover:shadow-lg">
                <i class="fas fa-check mr-2"></i>Create Organizer
            </button>
        </div>
    </form>
</div>
@endsection