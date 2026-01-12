extends('layouts.admin')

@section('title', 'Create Vacation')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6 mb-6">
    <h2 class="text-3xl font-bold text-gray-900 mb-6 flex items-center">
        <i class="fas fa-plus-circle text-gray-800 mr-3"></i>
        Create New Vacation
    </h2>

    <form action="{{ route('admin.vacations.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-tag text-gray-600 mr-2"></i>Name
                </label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all" required>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-dollar-sign text-gray-600 mr-2"></i>Price
                </label>
                <input type="number" step="0.01" name="price" value="{{ old('price') }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all" required>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-700 font-semibold mb-2">
                    <i class="far fa-calendar text-gray-600 mr-2"></i>Start Date
                </label>
                <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" min="{{ date('Y-m-d') }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all" required>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2">
                    <i class="far fa-calendar text-gray-600 mr-2"></i>End Date
                </label>
                <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}" min="{{ old('start_date', date('Y-m-d')) }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all" required>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-map-marker-alt text-gray-600 mr-2"></i>City
                </label>
                <input type="text" name="city" value="{{ old('city') }}" placeholder="e.g., Paris" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-globe text-gray-600 mr-2"></i>Country
                </label>
                <input type="text" name="country" value="{{ old('country') }}" placeholder="e.g., France" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all">
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
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
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
                        <option value="{{ $organizer->id }}">{{ $organizer->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-2">
                <i class="fas fa-users text-gray-600 mr-2"></i>Max Guests
            </label>
            <input type="number" name="max_guests" value="{{ old('max_guests') }}" min="1" placeholder="Maximum number of guests" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all">
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-2">
                <i class="fas fa-image text-gray-600 mr-2"></i>Image
            </label>
            <input type="file" name="image" accept="image/*" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all">
            <p class="text-sm text-gray-500 mt-2">
                <i class="fas fa-info-circle mr-1"></i>Max size: 2MB. Formats: JPEG, PNG, JPG, GIF
            </p>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-2">
                <i class="fas fa-align-left text-gray-600 mr-2"></i>Description
            </label>
            <textarea name="description" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all">{{ old('description') }}</textarea>
        </div>

        <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
            <a href="{{ route('admin.vacations.index') }}" class="bg-gray-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-600 transition-all duration-200 shadow-md hover:shadow-lg">
                <i class="fas fa-times mr-2"></i>Cancel
            </a>
            <button type="submit" class="bg-gray-800 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-900 transition-all duration-200 shadow-md hover:shadow-lg">
                <i class="fas fa-check mr-2"></i>Create Vacation
            </button>
        </div>
    </form>
</div>

<script>
    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');
    
    startDateInput.addEventListener('change', function() {
        if (this.value) {
            const startDate = new Date(this.value);
            startDate.setDate(startDate.getDate() + 1);
            const minEndDate = startDate.toISOString().split('T')[0];
            endDateInput.setAttribute('min', minEndDate);
            
            if (endDateInput.value && endDateInput.value < minEndDate) {
                endDateInput.value = '';
            }
        }
    });
</script>
@endsection