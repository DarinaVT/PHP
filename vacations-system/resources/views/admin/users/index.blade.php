@extends('layouts.admin')

@section('title', 'Users')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Users</h2>
    <a href="{{ route('admin.users.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        <i class="fas fa-plus"></i> Add New User
    </a>
</div>

<table class="min-w-full bg-white">
    <thead class="bg-gray-200">
        <tr>
            <th class="px-4 py-2 text-left">Name</th>
            <th class="px-4 py-2 text-left">Email</th>
            <th class="px-4 py-2 text-left">Role</th>
            <th class="px-4 py-2 text-left">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($users as $user)
            <tr class="border-b">
                <td class="px-4 py-2">{{ $user->name }}</td>
                <td class="px-4 py-2">{{ $user->email }}</td>
                <td class="px-4 py-2">
                    @if($user->is_admin)
                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm">Admin</span>
                    @else
                        <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded text-sm">User</span>
                    @endif
                </td>
                <td class="px-4 py-2">
                    <a href="{{ route('admin.users.show', $user) }}" class="text-blue-500 hover:text-blue-700">View</a>
                    <a href="{{ route('admin.users.edit', $user) }}" class="text-green-500 hover:text-green-700 ml-2">Edit</a>
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 ml-2" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="px-4 py-2 text-center">No users found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{ $users->links() }}
</div>
@endsection