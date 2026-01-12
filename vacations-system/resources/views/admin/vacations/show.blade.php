<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $vacation->name }} - ATG Hotels</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <nav class="bg-gray-100 shadow-sm">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-4 pl-8">
                    <a href="{{ route('public.offers') }}" class="text-gray-600 hover:text-gray-800">Offers</a>
                </div>
                <div class="flex items-center space-x-4">
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
                        <a href="{{ route('login') }}" class="bg-gray-800 text-white px-6 py-2.5 rounded-lg font-semibold hover:bg-gray-900 transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">Log In</a>
                        <a href="{{ route('register') }}" class="bg-amber-600 text-white px-6 py-2.5 rounded-lg font-semibold hover:bg-amber-700 transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">Sign Up</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <div class="mb-6">
            <a href="{{ route('public.vacations.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center inline-flex">
                <i class="fas fa-arrow-left mr-2"></i> Back to Vacations
            </a>
        </div>

        <div id="offer-details" class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Hero Image Section -->
            @if($vacation->image)
                <div class="w-full h-[500px] overflow-hidden relative">
                    <img src="{{ asset('storage/' . $vacation->image) }}" alt="{{ $vacation->name }}" class="w-full h-full object-cover">
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-6">
                        <h1 class="text-4xl font-bold text-white mb-2">{{ $vacation->name }}</h1>
                        <div class="flex items-center text-white text-sm space-x-4">
                            <span><i class="fas fa-calendar-alt mr-1"></i>{{ $vacation->duration }} days, {{ $vacation->duration - 1 }} nights</span>
                            @if($vacation->city || $vacation->country)
                            <span>|</span>
                            <span>
                                <i class="fas fa-map-marker-alt mr-1"></i>
                                @if($vacation->city && $vacation->country)
                                    {{ $vacation->city }}, {{ $vacation->country }}
                                @elseif($vacation->city)
                                    {{ $vacation->city }}
                                @else
                                    {{ $vacation->country }}
                                @endif
                            </span>
                            @endif
                            <span>|</span>
                            <span><i class="fas fa-plane mr-1"></i>{{ $vacation->transportType->name }}</span>
                        </div>
                    </div>
                </div>
            @else
                <div class="w-full h-[300px] bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                    <div class="text-center text-white">
                        <i class="fas fa-image text-6xl mb-4"></i>
                        <h1 class="text-4xl font-bold">{{ $vacation->name }}</h1>
                    </div>
                </div>
            @endif

            <div class="p-8">
                <!-- Offer Header Info -->
                <div class="mb-6 pb-6 border-b border-gray-200">
                    <div class="flex items-center justify-between flex-wrap gap-4">
                        <div>
                            <div class="text-sm text-gray-500 mb-1">Offer No: {{ $vacation->id }}</div>
                            <div class="text-2xl font-bold text-gray-900">{{ $vacation->name }}</div>
                        </div>
                        <div class="text-right">
                            <div class="text-sm text-gray-500 mb-1">Price from</div>
                            <div class="text-4xl font-bold text-gray-900">${{ number_format($vacation->price, 2) }}</div>
                        </div>
                    </div>
                </div>

                <!-- Information Cards Row -->
                <div class="row mb-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                            <div class="flex items-center mb-3">
                                <div class="bg-gray-800 p-3 rounded-lg mr-3">
                                    <i class="fas fa-map-marker-alt text-white text-xl"></i>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-500 text-sm uppercase tracking-wide">Location</div>
                                    <div class="text-gray-900 font-bold text-lg">
                                        @if($vacation->city && $vacation->country)
                                            {{ $vacation->city }}, {{ $vacation->country }}
                                        @elseif($vacation->city)
                                            {{ $vacation->city }}
                                        @elseif($vacation->country)
                                            {{ $vacation->country }}
                                        @else
                                            Not specified
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                            <div class="flex items-center mb-3">
                                <div class="bg-gray-700 p-3 rounded-lg mr-3">
                                    <i class="fas fa-calendar-alt text-white text-xl"></i>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-500 text-sm uppercase tracking-wide">Duration</div>
                                    <div class="text-gray-900 font-bold text-lg">{{ $vacation->duration }} days</div>
                                    <div class="text-sm text-gray-600 mt-1">{{ $vacation->start_date->format('M d, Y') }} - {{ $vacation->end_date->format('M d, Y') }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                            <div class="flex items-center mb-3">
                                <div class="bg-gray-800 p-3 rounded-lg mr-3">
                                    <i class="fas fa-plane text-white text-xl"></i>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-500 text-sm uppercase tracking-wide">Transport</div>
                                    <div class="text-gray-900 font-bold text-lg">{{ $vacation->transportType->name }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                            <div class="flex items-center mb-3">
                                <div class="bg-gray-700 p-3 rounded-lg mr-3">
                                    <i class="fas fa-building text-white text-xl"></i>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-500 text-sm uppercase tracking-wide">Organizer</div>
                                    <div class="text-gray-900 font-bold text-lg">{{ $vacation->organizer->name }}</div>
                                    <div class="text-sm text-gray-600 mt-1">{{ $vacation->organizer->email }}</div>
                                </div>
                            </div>
                        </div>

                        @if($vacation->max_guests)
                        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                            <div class="flex items-center mb-3">
                                <div class="bg-amber-700 p-3 rounded-lg mr-3">
                                    <i class="fas fa-users text-white text-xl"></i>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-500 text-sm uppercase tracking-wide">Max Guests</div>
                                    <div class="text-gray-900 font-bold text-lg">{{ $vacation->max_guests }} guests</div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="bg-gray-50 p-6 rounded-xl border-2 border-gray-300 shadow-md">
                            <div class="text-center">
                                <div class="text-sm text-gray-600 mb-2 uppercase tracking-wide font-semibold">Price from</div>
                                <div class="text-4xl font-bold text-gray-900">${{ number_format($vacation->price, 2) }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                @if($vacation->description)
                    <div class="offer-description description mb-8 bg-gray-50 p-8 rounded-xl border border-gray-200 shadow-sm">
                        <h2 class="text-2xl font-bold mb-4 text-gray-900 flex items-center">
                            <i class="fas fa-info-circle text-gray-700 mr-3"></i>
                            Description
                        </h2>
                        <div class="text-gray-700 leading-relaxed text-lg">{{ $vacation->description }}</div>
                    </div>
                @endif

                <!-- External Link Section -->
                <div class="bg-gray-800 p-6 rounded-xl shadow-lg text-center">
                    <h3 class="text-xl font-bold text-white mb-2">Interested in this offer?</h3>
                    <p class="text-gray-300 mb-4">Visit here for more details</p>
                    @if($vacation->external_url)
                        <a href="{{ $vacation->external_url }}" target="_blank" rel="noopener noreferrer" class="inline-block bg-amber-600 text-white px-8 py-3 rounded-lg font-bold hover:bg-amber-700 transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                            <i class="fas fa-external-link-alt mr-2"></i>View Full Offer Details
                        </a>
                    @else
                        <a href="#" class="inline-block bg-amber-600 text-white px-8 py-3 rounded-lg font-bold hover:bg-amber-700 transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                            <i class="fas fa-external-link-alt mr-2"></i>View Full Offer Details
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>