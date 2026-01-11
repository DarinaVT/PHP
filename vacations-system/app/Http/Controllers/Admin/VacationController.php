<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vacation;
use App\Models\TransportType;
use App\Models\Organizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class VacationController extends Controller
{
    public function index()
    {
        $vacations = Vacation::with(['transportType', 'organizer'])
            ->latest()
            ->paginate(10);
        
        return view('admin.vacations.index', compact('vacations'));
    }

    public function create()
    {
        $transportTypes = TransportType::all();
        $organizers = Organizer::all();
        
        return view('admin.vacations.create', compact('transportTypes', 'organizers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'transport_type_id' => 'required|exists:transport_types,id',
            'organizer_id' => 'required|exists:organizers,id',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'country' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'max_guests' => 'nullable|integer|min:1',
            'detailed_description' => 'nullable|string',
            'included_services' => 'nullable|string',
            'not_included_services' => 'nullable|string',
            'program' => 'nullable|string',
            'departure_location' => 'nullable|string|max:255',
            'departure_time' => 'nullable|date_format:H:i',
            'return_location' => 'nullable|string|max:255',
            'return_time' => 'nullable|date_format:H:i',
            'external_url' => 'nullable|string|max:255',
        ]);

        $startDate = Carbon::parse($validated['start_date']);
        $endDate = Carbon::parse($validated['end_date']);
        $validated['duration'] = $startDate->diffInDays($endDate) + 1;

        if (!empty($validated['external_url'])) {
            $url = trim($validated['external_url']);
            if (!preg_match('/^https?:\/\//i', $url)) {
                $validated['external_url'] = 'https://' . $url;
            } else {
                $validated['external_url'] = $url;
            }
        } else {
            $validated['external_url'] = null;
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('vacations', 'public');
        }

        Vacation::create($validated);

        return redirect()->route('admin.vacations.index')
            ->with('success', 'Vacation created successfully.');
    }

    public function show(Vacation $vacation)
    {
        $vacation->load(['transportType', 'organizer']);
        return view('admin.vacations.show', compact('vacation'));
    }

    public function edit(Vacation $vacation)
    {
        $transportTypes = TransportType::all();
        $organizers = Organizer::all();
        
        return view('admin.vacations.edit', compact('vacation', 'transportTypes', 'organizers'));
    }

    public function update(Request $request, Vacation $vacation)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'transport_type_id' => 'required|exists:transport_types,id',
            'organizer_id' => 'required|exists:organizers,id',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'country' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'max_guests' => 'nullable|integer|min:1',
            'detailed_description' => 'nullable|string',
            'included_services' => 'nullable|string',
            'not_included_services' => 'nullable|string',
            'program' => 'nullable|string',
            'departure_location' => 'nullable|string|max:255',
            'departure_time' => 'nullable|date_format:H:i',
            'return_location' => 'nullable|string|max:255',
            'return_time' => 'nullable|date_format:H:i',
            'external_url' => 'nullable|string|max:255',
        ]);

        $startDate = Carbon::parse($validated['start_date']);
        $endDate = Carbon::parse($validated['end_date']);
        $validated['duration'] = $startDate->diffInDays($endDate) + 1;

        if (!empty($validated['external_url'])) {
            $url = trim($validated['external_url']);
            if (!preg_match('/^https?:\/\//i', $url)) {
                $validated['external_url'] = 'https://' . $url;
            } else {
                $validated['external_url'] = $url;
            }
        } else {
            $validated['external_url'] = null;
        }

        if ($request->hasFile('image')) {
            if ($vacation->image) {
                Storage::disk('public')->delete($vacation->image);
            }
            $validated['image'] = $request->file('image')->store('vacations', 'public');
        }

        $vacation->update($validated);

        return redirect()->route('admin.vacations.index')
            ->with('success', 'Vacation updated successfully.');
    }

    public function destroy(Vacation $vacation)
    {
        if ($vacation->image) {
            Storage::disk('public')->delete($vacation->image);
        }

        $vacation->delete();

        return redirect()->route('admin.vacations.index')
            ->with('success', 'Vacation deleted successfully.');
    }
}