@extends('layouts.admin')

@section('title', 'Vacations')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Vacations</h2>
    <a href="{{ route('admin.vacations.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        <i class="fas fa-plus"></i> Add New Vacation
    </a>
</div>

<table class="min-w-full bg-white">
    <thead class="bg-gray-200">
        <tr>
            <th class="px-4 py-2 text-left">Name</th>
            <th class="px-4 py-2 text-left">Dates</th>
            <th class="px-4 py-2 text-left">Duration</th>
            <th class="px-4 py-2 text-left">Transport</th>
            <th class="px-4 py-2 text-left">Organizer</th>
            <th class="px-4 py-2 text-left">Price</th>
            <th class="px-4 py-2 text-left">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($vacations as $vacation)
            <tr class="border-b">
                <td class="px-4 py-2">{{ $vacation->name }}</td>
                <td class="px-4 py-2">{{ $vacation->start_date->format('M d') }} - {{ $vacation->end_date->format('M d, Y') }}</td>
                <td class="px-4 py-2">{{ $vacation->duration }} days</td>
                <td class="px-4 py-2">{{ $vacation->transportType->name }}</td>
                <td class="px-4 py-2">{{ $vacation->organizer->name }}</td>
                <td class="px-4 py-2">${{ number_format($vacation->price, 2) }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('admin.vacations.show', $vacation) }}" class="text-blue-500 hover:text-blue-700">View</a>
                    <a href="{{ route('admin.vacations.edit', $vacation) }}" class="text-green-500 hover:text-green-700 ml-2">Edit</a>
                    <form action="{{ route('admin.vacations.destroy', $vacation) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 ml-2" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="px-4 py-2 text-center">No vacations found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{ $vacations->links() }}
</div>
@endsection