@extends('layouts.admin')

@section('title', 'Organizers')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Organizers</h2>
    <a href="{{ route('admin.organizers.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        <i class="fas fa-plus"></i> Add New Organizer
    </a>
</div>

<table class="min-w-full bg-white">
    <thead class="bg-gray-200">
        <tr>
            <th class="px-4 py-2 text-left">Name</th>
            <th class="px-4 py-2 text-left">Email</th>
            <th class="px-4 py-2 text-left">Phone</th>
            <th class="px-4 py-2 text-left">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($organizers as $organizer)
            <tr class="border-b">
                <td class="px-4 py-2">{{ $organizer->name }}</td>
                <td class="px-4 py-2">{{ $organizer->email }}</td>
                <td class="px-4 py-2">{{ $organizer->phone ?? 'N/A' }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('admin.organizers.show', $organizer) }}" class="text-blue-500 hover:text-blue-700">View</a>
                    <a href="{{ route('admin.organizers.edit', $organizer) }}" class="text-green-500 hover:text-green-700 ml-2">Edit</a>
                    <form action="{{ route('admin.organizers.destroy', $organizer) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 ml-2" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="px-4 py-2 text-center">No organizers found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{ $organizers->links() }}
</div>
@endsection