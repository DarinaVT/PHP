<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vacations - Find Your Perfect Getaway</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <nav class="bg-blue-600 text-white shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold">🏖️ Vacations System</h1>
                <a href="{{ route('login') }}" class="hover:text-blue-200">Admin Login</a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <!-- Search/Filter Section -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-xl font-bold mb-4">Search & Filter Vacations</h2>
            
            <form method="GET" action="{{ route('public.vacations.index') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Duration (days)</label>
                        <div class="flex space-x-2">
                            <input type="number" name="duration_min" value="{{ request('duration_min') }}" placeholder="Min" class="w-full border rounded px-3 py-2">
                            <input type="number" name="duration_max" value="{{ request('duration_max') }}" placeholder="Max" class="w-full border rounded px-3 py-2">
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Organizer</label>
                        <select name="organizer_id" class="w-full border rounded px-3 py-2">
                            <option value="">All Organizers</option>
                            @foreach($organizers as $organizer)
                                <option value="{{ $organizer->id }}" {{ request('organizer_id') == $organizer->id ? 'selected' : '' }}>
                                    {{ $organizer->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Transport Type</label>
                        <select name="transport_type_id" class="w-full border rounded px-3 py-2">
                            <option value="">All Types</option>
                            @foreach($transportTypes as $type)
                                <option value="{{ $type->id }}" {{ request('transport_type_id') == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-gray-700 font-bold mb-2">Price Range: $<span id="priceMin">{{ request('price_min', 0) }}</span> - $<span id="priceMax">{{ request('price_max', $maxPrice) }}</span></label>
                    <div class="flex space-x-4">
                        <input type="range" name="price_min" id="priceMinRange" min="0" max="{{ $maxPrice }}" value="{{ request('price_min', 0) }}" class="flex-1">
                        <input type="range" name="price_max" id="priceMaxRange" min="0" max="{{ $maxPrice }}" value="{{ request('price_max', $maxPrice) }}" class="flex-1">
                    </div>
                    <div class="flex justify-between mt-2">
                        <input type="number" id="priceMinInput" name="price_min" value="{{ request('price_min', 0) }}" class="w-24 border rounded px-2 py-1">
                        <input type="number" id="priceMaxInput" name="price_max" value="{{ request('price_max', $maxPrice) }}" class="w-24 border rounded px-2 py-1">
                    </div>
                </div>

                <div class="flex space-x-4">
                    <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">Search</button>
                    <a href="{{ route('public.vacations.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Clear</a>
                </div>
            </form>
        </div>

        <!-- Latest Vacations -->
        <h2 class="text-2xl font-bold mb-4">Latest Vacations</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($vacations as $vacation)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                    @if($vacation->image)
                        <img src="{{ asset('storage/' . $vacation->image) }}" alt="{{ $vacation->name }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-400">No Image</span>
                        </div>
                    @endif
                    <div class="p-4">
                        <h3 class="text-xl font-bold mb-2">{{ $vacation->name }}</h3>
                        <p class="text-gray-600 mb-2">
                            <i class="fas fa-calendar"></i> {{ $vacation->start_date->format('M d') }} - {{ $vacation->end_date->format('M d, Y') }}
                        </p>
                        <p class="text-gray-600 mb-2">
                            <i class="fas fa-clock"></i> {{ $vacation->duration }} days
                        </p>
                        <p class="text-gray-600 mb-2">
                            <i class="fas fa-plane"></i> {{ $vacation->transportType->name }}
                        </p>
                        <p class="text-gray-600 mb-2">
                            <i class="fas fa-building"></i> {{ $vacation->organizer->name }}
                        </p>
                        <p class="text-2xl font-bold text-blue-600 mb-4">${{ number_format($vacation->price, 2) }}</p>
                        <a href="{{ route('public.vacations.show', $vacation) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 block text-center">
                            View Details
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-8">
                    <p class="text-gray-500">No vacations found matching your criteria.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $vacations->links() }}
        </div>
    </div>

    <script>
        // Price range sliders
        const priceMinRange = document.getElementById('priceMinRange');
        const priceMaxRange = document.getElementById('priceMaxRange');
        const priceMinInput = document.getElementById('priceMinInput');
        const priceMaxInput = document.getElementById('priceMaxInput');
        const priceMinDisplay = document.getElementById('priceMin');
        const priceMaxDisplay = document.getElementById('priceMax');

        priceMinRange.addEventListener('input', function() {
            priceMinInput.value = this.value;
            priceMinDisplay.textContent = this.value;
        });

        priceMaxRange.addEventListener('input', function() {
            priceMaxInput.value = this.value;
            priceMaxDisplay.textContent = this.value;
        });

        priceMinInput.addEventListener('input', function() {
            priceMinRange.value = this.value;
            priceMinDisplay.textContent = this.value;
        });

        priceMaxInput.addEventListener('input', function() {
            priceMaxRange.value = this.value;
            priceMaxDisplay.textContent = this.value;
        });
    </script>
</body>
</html>