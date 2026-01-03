<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-600 text-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <h1 class="text-2xl font-bold">Vacations Admin Panel</h1>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="hover:text-blue-200">Public Site</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="hover:text-blue-200">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="mb-6">
                <ul class="flex space-x-4 border-b">
                    <li><a href="{{ route('admin.vacations.index') }}" class="px-4 py-2 hover:bg-gray-100">Vacations</a></li>
                    <li><a href="{{ route('admin.transport-types.index') }}" class="px-4 py-2 hover:bg-gray-100">Transport Types</a></li>
                    <li><a href="{{ route('admin.organizers.index') }}" class="px-4 py-2 hover:bg-gray-100">Organizers</a></li>
                    <li><a href="{{ route('admin.users.index') }}" class="px-4 py-2 hover:bg-gray-100">Users</a></li>
                </ul>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</body>
</html>