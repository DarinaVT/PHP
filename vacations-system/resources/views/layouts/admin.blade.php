<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - ATG Hotels</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <nav class="bg-gray-800 shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-6">
                    <a href="{{ route('admin.vacations.index') }}" class="text-white text-xl font-bold">
                        <i class="fas fa-tachometer-alt mr-2"></i>Admin Dashboard
                    </a>
                    <div class="flex items-center space-x-1 border-l border-gray-600 pl-6">
                        <a href="{{ route('admin.vacations.index') }}" class="px-4 py-2 rounded-lg {{ request()->routeIs('admin.vacations.*') ? 'bg-gray-700 text-white' : 'text-gray-300 hover:text-white hover:bg-gray-700' }} transition-colors">
                            <i class="fas fa-umbrella-beach mr-1"></i>Vacations
                        </a>
                        <a href="{{ route('admin.transport-types.index') }}" class="px-4 py-2 rounded-lg {{ request()->routeIs('admin.transport-types.*') ? 'bg-gray-700 text-white' : 'text-gray-300 hover:text-white hover:bg-gray-700' }} transition-colors">
                            <i class="fas fa-plane mr-1"></i>Transport Types
                        </a>
                        <a href="{{ route('admin.organizers.index') }}" class="px-4 py-2 rounded-lg {{ request()->routeIs('admin.organizers.*') ? 'bg-gray-700 text-white' : 'text-gray-300 hover:text-white hover:bg-gray-700' }} transition-colors">
                            <i class="fas fa-building mr-1"></i>Organizers
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="px-4 py-2 rounded-lg {{ request()->routeIs('admin.users.*') ? 'bg-gray-700 text-white' : 'text-gray-300 hover:text-white hover:bg-gray-700' }} transition-colors">
                            <i class="fas fa-users mr-1"></i>Users
                        </a>
                    </div>
                    <a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition-colors ml-6">
                        <i class="fas fa-home mr-1"></i>View Site
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('profile.edit') }}" class="text-gray-300 hover:text-white transition-colors">
                        <i class="fas fa-user-circle mr-1"></i>Profile
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-300 hover:text-white transition-colors">
                            <i class="fas fa-sign-out-alt mr-1"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 shadow-md">
                <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 shadow-md">
                <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>