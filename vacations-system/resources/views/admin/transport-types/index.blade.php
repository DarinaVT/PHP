@extends('layouts.admin')

@section('title', 'Transport Types Management')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-3xl font-bold text-gray-900 flex items-center">
        <i class="fas fa-plane text-gray-800 mr-3"></i>
        Transport Types Management
    </h1>
    <a href="{{ route('admin.transport-types.create') }}" class="bg-gray-800 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-900 transition-all duration-200 shadow-md hover:shadow-lg">
        <i class="fas fa-plus mr-2"></i>Create New Transport Type
    </a>
</div>

<div class="bg-white rounded-lg shadow-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-800">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                        <i class="fas fa-tag mr-2"></i>Name
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                        <i class="fas fa-align-left mr-2"></i>Description
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                        <i class="fas fa-cog mr-2"></i>Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($transportTypes as $transportType)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="text-sm font-semibold text-gray-900">{{ $transportType->name }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-600">{{ $transportType->description ?? 'No description' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                            <a href="{{ route('admin.transport-types.show', $transportType) }}" class="text-gray-600 hover:text-gray-900 transition-colors">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.transport-types.edit', $transportType) }}" class="text-gray-600 hover:text-gray-900 transition-colors">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.transport-types.destroy', $transportType) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this transport type?');">
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
                        <td colspan="3" class="px-6 py-8 text-center text-gray-500">
                            <i class="fas fa-inbox text-4xl mb-2"></i>
                            <p>No transport types found. Create your first transport type!</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
        {{ $transportTypes->links() }}
    </div>
</div>
@endsection