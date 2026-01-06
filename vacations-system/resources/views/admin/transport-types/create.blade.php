@extends('layouts.admin')

@section('title', 'Create Transport Type')

@section('content')
<h2 class="text-2xl font-bold mb-6">Create New Transport Type</h2>

<form action="{{ route('admin.transport-types.store') }}" method="POST">
    @csrf

    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">Name</label>
        <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">Description</label>
        <textarea name="description" rows="4" class="w-full border rounded px-3 py-2">{{ old('description') }}</textarea>
    </div>

    <div class="flex justify-end space-x-4">
        <a href="{{ route('admin.transport-types.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</a>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Create Transport Type</button>
    </div>
</form>
@endsection