@extends('layouts.admin')

@section('title', 'View User')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.users.index') }}" class="text-blue-500 hover:text-blue-700">← Back to List</a>
</div>

<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-bold mb-4">{{ $user->name }}</h2>
    
    <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
            <p class="text-gray-600"><strong>Email:</strong> {{ $user->email }}</p>
            <p class="text-gray-600"><strong>Role:</strong> 
                @if($user->is_admin)
                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm">Admin</span>
                @else
                    <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded text-sm">User</span>
                @endif
            </p>
            <p class="text-gray-600"><strong>Created:</strong> {{ $user->created_at->format('F d, Y') }}</p>
        </div>
    </div>

    <div class="flex space-x-4">
        <a href="{{ route('admin.users.edit', $user) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit</a>
        <a href="{{ route('admin.users.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back</a>
    </div>
</div>
@endsection