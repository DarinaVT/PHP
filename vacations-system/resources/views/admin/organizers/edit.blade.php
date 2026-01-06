@extends('layouts.admin')

@section('title', 'Edit Organizer')

@section('content')
<h2 class="text-2xl font-bold mb-6">Edit Organizer</h2>

<form action="{{ route('admin.organizers.update', $organizer) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">Name</label>
        <input type="text" name="name" value="{{ old('name', $organizer->name) }}" class="w-full border rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">Email</label>
        <input type="email" name="email" value="{{ old('email', $organizer->email) }}" class="w-full border rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">Phone</label>
        <input type="text" name="phone" value="{{ old('phone', $organizer->phone) }}" class="w-full border rounded px-3 py-2">
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">Address</label>
        <textarea name="address" rows="3" class="w-full border rounded px-3 py-2">{{ old('address', $organizer->address) }}</textarea>
    </div>

    <div class="flex justify-end space-x-4">
        <a href="{{ route('admin.organizers.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</a>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update Organizer</button>
    </div>
</form>
@endsection