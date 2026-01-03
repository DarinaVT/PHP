@extends('layouts.admin')

@section('title', 'Create Vacation')

@section('content')
<h2 class="text-2xl font-bold mb-6">Create New Vacation</h2>

<form action="{{ route('admin.vacations.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
            <label class="block text-gray-700 font-bold mb-2">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block text-gray-700 font-bold mb-2">Price</label>
            <input type="number" step="0.01" name="price" value="{{ old('price') }}" class="w-full border rounded px-3 py-2" required>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
            <label class="block text-gray-700 font-bold mb-2">Start Date</label>
            <input type="date" name="start_date" value="{{ old('start_date') }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block text-gray-700 font-bold mb-2">End Date</label>
            <input type="date" name="end_date" value="{{ old('end_date') }}" class="w-full border rounded px-3 py-2" required>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
            <label class="block text-gray-700 font-bold mb-2">Transport Type</label>
            <select name="transport_type_id" class="w-full border rounded px-3 py-2" required>
                <option value="">Select Transport Type</option>
                @foreach($transportTypes as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-gray-700 font-bold mb-2">Organizer</label>
            <select name="organizer_id" class="w-full border rounded px-3 py-2" required>
                <option value="">Select Organizer</option>
                @foreach($organizers as $organizer)
                    <option value="{{ $organizer->id }}">{{ $organizer->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">Image</label>
        <input type="file" name="image" accept="image/*" class="w-full border rounded px-3 py-2">
        <p class="text-sm text-gray-500 mt-1">Max size: 2MB. Formats: JPEG, PNG, JPG, GIF</p>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">Description</label>
        <textarea name="description" rows="4" class="w-full border rounded px-3 py-2">{{ old('description') }}</textarea>
    </div>

    <div class="flex justify-end space-x-4">
        <a href="{{ route('admin.vacations.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</a>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Create Vacation</button>
    </div>
</form>
@endsection