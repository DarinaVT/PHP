@extends('layouts.admin')

@section('title', 'Edit Vacation')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6 mb-6">
    <h2 class="text-3xl font-bold text-gray-900 mb-6 flex items-center">
        <i class="fas fa-edit text-gray-800 mr-3"></i>
        Edit Vacation
    </h2>

    <form action="{{ route('admin.vacations.update', $vacation) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-tag text-gray-600 mr-2"></i>Name
                </label>
                <input type="text" name="name" value="{{ old('name', $vacation->name) }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all" required>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-dollar-sign text-gray-600 mr-2"></i>Price
                </label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $vacation->price) }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all" required>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-700 font-semibold mb-2">
                    <i class="far fa-calendar text-gray-600 mr-2"></i>Start Date
                </label>
                <input type="date" name="start_date" id="start_date_edit" value="{{ old('start_date', $vacation->start_date->format('Y-m-d')) }}" min="{{ date('Y-m-d') }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all" required>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2">
                    <i class="far fa-calendar text-gray-600 mr-2"></i>End Date
                </label>
                @php
                    $currentStartDate = old('start_date', $vacation->start_date->format('Y-m-d'));
                    $minEndDate = \Carbon\Carbon::parse($currentStartDate)->addDay()->format('Y-m-d');
                @endphp
                <input type="date" name="end_date" id="end_date_edit" value="{{ old('end_date', $vacation->end_date->format('Y-m-d')) }}" min="{{ $minEndDate }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all" required>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-map-marker-alt text-gray-600 mr-2"></i>City
                </label>
                <input type="text" name="city" value="{{ old('city', $vacation->city) }}" placeholder="e.g., Paris" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-globe text-gray-600 mr-2"></i>Country
                </label>
                <input type="text" name="country" value="{{ old('country', $vacation->country) }}" placeholder="e.g., France" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-plane text-gray-600 mr-2"></i>Transport Type
                </label>
                <select name="transport_type_id" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all" required>
                    <option value="">Select Transport Type</option>
                    @foreach($transportTypes as $type)
                        <option value="{{ $type->id }}" {{ old('transport_type_id', $vacation->transport_type_id) == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-building text-gray-600 mr-2"></i>Organizer
                </label>
                <select name="organizer_id" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all" required>
                    <option value="">Select Organizer</option>
                    @foreach($organizers as $organizer)
                        <option value="{{ $organizer->id }}" {{ old('organizer_id', $vacation->organizer_id) == $organizer->id ? 'selected' : '' }}>
                            {{ $organizer->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-2">
                <i class="fas fa-users text-gray-600 mr-2"></i>Max Guests
            </label>
            <input type="number" name="max_guests" value="{{ old('max_guests', $vacation->max_guests) }}" min="1" placeholder="Maximum number of guests" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all">
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-2">
                <i class="fas fa-image text-gray-600 mr-2"></i>Image
            </label>
            @if($vacation->image)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $vacation->image) }}" alt="{{ $vacation->name }}" class="w-32 h-32 object-cover rounded-lg border border-gray-300 shadow-sm">
                </div>
            @endif
            <input type="file" name="image" accept="image/*" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all">
            <p class="text-sm text-gray-500 mt-2">
                <i class="fas fa-info-circle mr-1"></i>Max size: 2MB. Formats: JPEG, PNG, JPG, GIF
            </p>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-2">
                <i class="fas fa-align-left text-gray-600 mr-2"></i>Description
            </label>
            <textarea name="description" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all">{{ old('description', $vacation->description) }}</textarea>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-2">
                <i class="fas fa-file-alt text-gray-600 mr-2"></i>Detailed Description
            </label>
            <textarea name="detailed_description" rows="6" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all" placeholder="Provide a more detailed description of the vacation...">{{ old('detailed_description', $vacation->detailed_description) }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-check-circle text-gray-600 mr-2"></i>Included Services
                </label>
                <textarea name="included_services" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all" placeholder="List all services included in this vacation...">{{ old('included_services', $vacation->included_services) }}</textarea>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-times-circle text-gray-600 mr-2"></i>Not Included Services
                </label>
                <textarea name="not_included_services" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all" placeholder="List services not included in this vacation...">{{ old('not_included_services', $vacation->not_included_services) }}</textarea>
            </div>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-2">
                <i class="fas fa-calendar-check text-gray-600 mr-2"></i>Program
            </label>
            <textarea name="program" rows="6" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all" placeholder="Enter the detailed program/itinerary for this vacation...">{{ old('program', $vacation->program) }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-map-marker-alt text-gray-600 mr-2"></i>Departure Location
                </label>
                <input type="text" name="departure_location" value="{{ old('departure_location', $vacation->departure_location) }}" placeholder="e.g., Central Station, Sofia" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2">
                    <i class="far fa-clock text-gray-600 mr-2"></i>Departure Time
                </label>
                <input type="time" name="departure_time" value="{{ old('departure_time', $vacation->departure_time ? \Carbon\Carbon::parse($vacation->departure_time)->format('H:i') : '') }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-map-marker-alt text-gray-600 mr-2"></i>Return Location
                </label>
                <input type="text" name="return_location" value="{{ old('return_location', $vacation->return_location) }}" placeholder="e.g., Central Station, Sofia" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2">
                    <i class="far fa-clock text-gray-600 mr-2"></i>Return Time
                </label>
                <input type="time" name="return_time" value="{{ old('return_time', $vacation->return_time ? \Carbon\Carbon::parse($vacation->return_time)->format('H:i') : '') }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all">
            </div>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-2">
                <i class="fas fa-external-link-alt text-gray-600 mr-2"></i>External Offer Link
            </label>
            <input type="url" name="external_url" value="{{ old('external_url', $vacation->external_url) }}" placeholder="https://example.com/offer" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all">
            <p class="text-sm text-gray-500 mt-2">
                <i class="fas fa-info-circle mr-1"></i>Link to the external offer website (optional)
            </p>
        </div>

        <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
            <a href="{{ route('admin.vacations.index') }}" class="bg-gray-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-600 transition-all duration-200 shadow-md hover:shadow-lg">
                <i class="fas fa-times mr-2"></i>Cancel
            </a>
            <button type="submit" class="bg-gray-800 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-900 transition-all duration-200 shadow-md hover:shadow-lg">
                <i class="fas fa-save mr-2"></i>Update Vacation
            </button>
        </div>
    </form>
</div>

<script>
    const startDateInputEdit = document.getElementById('start_date_edit');
    const endDateInputEdit = document.getElementById('end_date_edit');
    
    if (startDateInputEdit.value) {
        const startDate = new Date(startDateInputEdit.value);
        startDate.setDate(startDate.getDate() + 1);
        const minEndDate = startDate.toISOString().split('T')[0];
        endDateInputEdit.setAttribute('min', minEndDate);
    }
    
    startDateInputEdit.addEventListener('change', function() {
        if (this.value) {
            const startDate = new Date(this.value);
            startDate.setDate(startDate.getDate() + 1);
            const minEndDate = startDate.toISOString().split('T')[0];
            endDateInputEdit.setAttribute('min', minEndDate);
            
            if (endDateInputEdit.value && endDateInputEdit.value <= this.value) {
                endDateInputEdit.value = '';
            }
        } else {
            endDateInputEdit.removeAttribute('min');
        }
    });
</script>
@endsection