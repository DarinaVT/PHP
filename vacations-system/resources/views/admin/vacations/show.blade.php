@extends('layouts.admin')

@section('title', 'View Vacation')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.vacations.index') }}" class="text-blue-500 hover:text-blue-700">← Back to List</a>
</div>

<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-bold mb-4">{{ $vacation->name }}</h2>
    
    @if($vacation->image)
        <img src="{{ asset('storage/' . $vacation->image) }}" alt="{{ $vacation->name }}" class="w-full h-64 object-cover rounded mb-4">
    @endif

    <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
            <p class="text-gray-600"><strong>Start Date:</strong> {{ $vacation->start_date->format('F d, Y') }}</p>
            <p class="text-gray-600"><strong>End Date:</strong> {{ $vacation->end_date->format('F d, Y') }}</p>
            <p class="text-gray-600"><strong>Duration:</strong> {{ $vacation->duration }} days</p>
        </div>
        <div>
            <p class="text-gray-600"><strong>Transport Type:</strong> {{ $vacation->transportType->name }}</p>
            <p class="text-gray-600"><strong>Organizer:</strong> {{ $vacation->organizer->name }}</p>
            <p class="text-gray-600"><strong>Price:</strong> ${{ number_format($vacation->price, 2) }}</p>
        </div>
    </div>

    @if($vacation->description)
        <div class="mb-4">
            <h3 class="text-xl font-bold mb-2">Description</h3>
            <p class="text-gray-700">{{ $vacation->description }}</p>
        </div>
    @endif

    <div class="flex space-x-4">
        <a href="{{ route('admin.vacations.edit', $vacation) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit</a>
        <a href="{{ route('admin.vacations.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back</a>
    </div>
</div>
@endsection