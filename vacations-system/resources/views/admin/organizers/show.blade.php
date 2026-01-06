@extends('layouts.admin')

@section('title', 'View Organizer')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.organizers.index') }}" class="text-blue-500 hover:text-blue-700">← Back to List</a>
</div>

<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-bold mb-4">{{ $organizer->name }}</h2>
    
    <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
            <p class="text-gray-600"><strong>Email:</strong> {{ $organizer->email }}</p>
            <p class="text-gray-600"><strong>Phone:</strong> {{ $organizer->phone ?? 'N/A' }}</p>
        </div>
        <div>
            <p class="text-gray-600"><strong>Address:</strong> {{ $organizer->address ?? 'N/A' }}</p>
        </div>
    </div>

    <div class="flex space-x-4">
        <a href="{{ route('admin.organizers.edit', $organizer) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit</a>
        <a href="{{ route('admin.organizers.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back</a>
    </div>
</div>
@endsection