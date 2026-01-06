@extends('layouts.admin')

@section('title', 'Transport Types')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Transport Types</h2>
    <a href="{{ route('admin.transport-types.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        <i class="fas fa-plus"></i> Add New Transport Type
    </a>
</div>

<table class="min-w-full bg-white">
    <thead class="bg-gray-200">
        <tr>
            <th class="px-4 py-2 text-left">Name</th>
            <th class="px-4 py-2 text-left">Description</th>
            <th class="px-4 py-2 text-left">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($transportTypes as $transportType)
            <tr class="border-b">
                <td class="px-4 py-2">{{ $transportType->name }}</td>
                <td class="px-4 py-2">{{ Str::limit($transportType->description ?? 'No description', 50) }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('admin.transport-types.show', $transportType) }}" class="text-blue-500 hover:text-blue-700">View</a>
                    <a href="{{ route('admin.transport-types.edit', $transportType) }}" class="text-green-500 hover:text-green-700 ml-2">Edit</a>
                    <form action="{{ route('admin.transport-types.destroy', $transportType) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 ml-2" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="px-4 py-2 text-center">No transport types found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{ $transportTypes->links() }}
</div>
@endsection