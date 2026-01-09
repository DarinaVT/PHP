<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $vacation->name }} - Vacations</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <nav class="bg-blue-600 text-white shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold">🏖️ Vacations System</h1>
                <a href="{{ route('public.vacations.index') }}" class="hover:text-blue-200">Back to List</a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            @if($vacation->image)
                <img src="{{ asset('storage/' . $vacation->image) }}" alt="{{ $vacation->name }}" class="w-full h-96 object-cover">
            @endif
            
            <div class="p-8">
                <h1 class="text-3xl font-bold mb-4">{{ $vacation->name }}</h1>
                
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <p class="text-gray-600"><strong>Start Date:</strong> {{ $vacation->start_date->format('F d, Y') }}</p>
                        <p class="text-gray-600"><strong>End Date:</strong> {{ $vacation->end_date->format('F d, Y') }}</p>
                        <p class="text-gray-600"><strong>Duration:</strong> {{ $vacation->duration }} days</p>
                    </div>
                    <div>
                        <p class="text-gray-600"><strong>Transport:</strong> {{ $vacation->transportType->name }}</p>
                        <p class="text-gray-600"><strong>Organizer:</strong> {{ $vacation->organizer->name }}</p>
                        <p class="text-gray-600"><strong>Contact:</strong> {{ $vacation->organizer->email }}</p>
                        @if($vacation->organizer->phone)
                            <p class="text-gray-600"><strong>Phone:</strong> {{ $vacation->organizer->phone }}</p>
                        @endif
                    </div>
                </div>

                @if($vacation->description)
                    <div class="mb-6">
                        <h2 class="text-xl font-bold mb-2">Description</h2>
                        <p class="text-gray-700">{{ $vacation->description }}</p>
                    </div>
                @endif

                <div class="bg-blue-50 p-6 rounded-lg">
                    <p class="text-3xl font-bold text-blue-600">${{ number_format($vacation->price, 2) }}</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>