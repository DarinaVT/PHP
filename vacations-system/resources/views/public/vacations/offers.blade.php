
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offers - ATG Hotels</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>
<body class="bg-gray-50">
    <nav class="bg-gray-100 shadow-sm">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-4 pl-8">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-800">Home</a>
                    <a href="{{ route('public.offers') }}" class="text-gray-600 hover:text-gray-800">Offers</a>
                </div>
                <div class="flex items-center space-x-4 pr-8">
                    @auth
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.vacations.index') }}" class="hover:text-gray-800">
                                <i class="fas fa-tachometer-alt mr-1"></i>Admin Dashboard
                            </a>
                        @endif
                        <a href="{{ route('profile.edit') }}" class="hover:text-gray-800 flex items-center">
                            @if(auth()->user()->avatar)
                                <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Profile" class="w-8 h-8 rounded-full mr-2 border-2 border-gray-400">
                            @else
                                <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center mr-2">
                                    <i class="fas fa-user text-gray-600"></i>
                                </div>
                            @endif
                            Profile
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-gray-800">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="bg-gray-800 text-white px-6 py-2.5 rounded-lg font-semibold hover:bg-gray-900 transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                            <i class="fas fa-sign-in-alt mr-2"></i>Log In
                        </a>
                        <a href="{{ route('register') }}" class="bg-amber-600 text-white px-6 py-2.5 rounded-lg font-semibold hover:bg-amber-700 transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                            <i class="fas fa-user-plus mr-2"></i>Sign Up
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-8">All Offers</h1>

        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <form method="GET" action="{{ route('public.offers') }}" class="flex flex-wrap gap-4 items-end">
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-plane text-gray-500"></i> Transport Type
                    </label>
                    <select name="transport_type_id" onchange="this.form.submit()" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-500">
                        <option value="">All Types</option>
                        @foreach($transportTypes as $type)
                            <option value="{{ $type->id }}" {{ request('transport_type_id') == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex-1 min-w-[200px]">
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-building text-gray-500"></i> Organizer
                    </label>
                    <select name="organizer_id" onchange="this.form.submit()" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-500">
                        <option value="">All Organizers</option>
                        @foreach($organizers as $organizer)
                            <option value="{{ $organizer->id }}" {{ request('organizer_id') == $organizer->id ? 'selected' : '' }}>
                                {{ $organizer->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex-1 min-w-[200px]">
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="far fa-calendar text-gray-500"></i> Date From
                    </label>
                    <input type="text" name="date_from" id="date_from" value="{{ request('date_from') }}" placeholder="Select date" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-500">
                </div>

                <div class="flex-1 min-w-[200px]">
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="far fa-calendar text-gray-500"></i> Date To
                    </label>
                    <input type="text" name="date_to" id="date_to" value="{{ request('date_to') }}" placeholder="Select date" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-500">
                </div>

                <div class="flex-1 min-w-[200px]">
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-sort text-gray-500"></i> Sort By
                    </label>
                    <select name="sort_by" onchange="this.form.submit()" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-500">
                        <option value="latest" {{ request('sort_by') == 'latest' ? 'selected' : '' }}>Latest First</option>
                        <option value="price_low" {{ request('sort_by') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price_high" {{ request('sort_by') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                        <option value="date_asc" {{ request('sort_by') == 'date_asc' ? 'selected' : '' }}>Date: Earliest</option>
                        <option value="date_desc" {{ request('sort_by') == 'date_desc' ? 'selected' : '' }}>Date: Latest</option>
                        <option value="transport" {{ request('sort_by') == 'transport' ? 'selected' : '' }}>Transport Type</option>
                        <option value="organizer" {{ request('sort_by') == 'organizer' ? 'selected' : '' }}>Organizer</option>
                    </select>
                </div>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @forelse($vacations as $vacation)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 border border-gray-200">
                    <div class="relative h-64 overflow-hidden bg-gray-800">
                        @if($vacation->image)
                            <img src="{{ asset('storage/' . $vacation->image) }}" alt="{{ $vacation->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-gray-700 to-gray-900 flex items-center justify-center">
                                <i class="fas fa-image text-gray-400 text-4xl"></i>
                            </div>
                        @endif
                        <div class="absolute top-4 right-4 bg-white px-4 py-2 rounded-lg shadow-md">
                            <span class="text-2xl font-bold text-gray-900">${{ number_format($vacation->price, 0) }}</span>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $vacation->name }}</h3>
                        
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-calendar-alt w-5"></i>
                                <span class="text-sm">{{ $vacation->start_date->format('M d') }} - {{ $vacation->end_date->format('M d, Y') }}</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-clock w-5"></i>
                                <span class="text-sm">{{ $vacation->duration }} days</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-plane w-5"></i>
                                <span class="text-sm">{{ $vacation->transportType->name }}</span>
                            </div>
                            @if($vacation->city || $vacation->country)
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-map-marker-alt w-5"></i>
                                <span class="text-sm">
                                    @if($vacation->city && $vacation->country)
                                        {{ $vacation->city }}, {{ $vacation->country }}
                                    @elseif($vacation->city)
                                        {{ $vacation->city }}
                                    @else
                                        {{ $vacation->country }}
                                    @endif
                                </span>
                            </div>
                            @endif
                        </div>
                        
                        <a href="{{ route('public.vacations.show', $vacation) }}" class="block w-full bg-gray-900 hover:bg-black text-white text-center py-3 rounded-lg font-semibold transition-colors duration-200">
                            Explore <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-4 text-center py-12">
                    <p class="text-gray-500 text-lg">No offers found.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $vacations->links() }}
        </div>
    </div>

    <script>
        const dateFromInput = document.getElementById('date_from');
        const dateToInput = document.getElementById('date_to');

        if (dateFromInput) {
            flatpickr(dateFromInput, {
                dateFormat: "Y-m-d",
                minDate: "today",
                onChange: function(selectedDates) {
                    if (selectedDates.length > 0 && dateToInput) {
                        flatpickr(dateToInput).set('minDate', selectedDates[0]);
                    }
                }
            });
        }

        if (dateToInput) {
            flatpickr(dateToInput, {
                dateFormat: "Y-m-d",
                minDate: "today"
            });
        }
    </script>
</body>
</html>