@extends('layouts.admin')

@section('title', 'Vacations Management')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-3xl font-bold text-gray-900 flex items-center">
        <i class="fas fa-umbrella-beach text-gray-800 mr-3"></i>
        Vacations Management
    </h1>
    <a href="{{ route('admin.vacations.create') }}" class="bg-gray-800 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-900 transition-all duration-200 shadow-md hover:shadow-lg">
        <i class="fas fa-plus mr-2"></i>Create New Vacation
    </a>
</div>

<div class="bg-white rounded-lg shadow-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-800">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                        <i class="fas fa-image mr-2"></i>Image
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                        <i class="fas fa-tag mr-2"></i>Name
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                        <i class="fas fa-calendar mr-2"></i>Dates
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                        <i class="fas fa-dollar-sign mr-2"></i>Price
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                        <i class="fas fa-map-marker-alt mr-2"></i>Location
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                        <i class="fas fa-cog mr-2"></i>Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($vacations as $vacation)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($vacation->image)
                                <img src="{{ asset('storage/' . $vacation->image) }}" alt="{{ $vacation->name }}" class="w-16 h-16 object-cover rounded-lg border border-gray-300">
                            @else
                                <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-image text-gray-400"></i>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-semibold text-gray-900">{{ $vacation->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-600">{{ $vacation->start_date->format('M d, Y') }}</div>
                            <div class="text-sm text-gray-500">to {{ $vacation->end_date->format('M d, Y') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-semibold text-gray-900">${{ number_format($vacation->price, 2) }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-600">
                                @if($vacation->city && $vacation->country)
                                    {{ $vacation->city }}, {{ $vacation->country }}
                                @elseif($vacation->city)
                                    {{ $vacation->city }}
                                @elseif($vacation->country)
                                    {{ $vacation->country }}
                                @else
                                    <span class="text-gray-400">Not specified</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                            <a href="{{ route('admin.vacations.show', $vacation) }}" class="text-gray-600 hover:text-gray-900 transition-colors">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.vacations.edit', $vacation) }}" class="text-gray-600 hover:text-gray-900 transition-colors">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.vacations.destroy', $vacation) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this vacation?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                            <i class="fas fa-inbox text-4xl mb-2"></i>
                            <p>No vacations found. Create your first vacation!</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
        {{ $vacations->links() }}
    </div>
</div>
@endsection