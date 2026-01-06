@extends('layouts.admin')

@section('title', 'View Transport Type')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.transport-types.index') }}" class="text-blue-500 hover:text-blue-700">← Back to List</a>
</div>

<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-bold mb-4">{{ $transportType->name }}</h2>
    
    <div class="mb-4">
        <h3 class="text-xl font-bold mb-2">Description</h3>
        <p class="text-gray-700">{{ $transportType->description ?? 'No description provided.' }}</p>
    </div>

    <div class="flex space-x-4">
        <a href="{{ route('admin.transport-types.edit', $transportType) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit</a>
        <a href="{{ route('admin.transport-types.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back</a>
    </div>
</div>
@endsection