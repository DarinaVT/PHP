<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Vacation;
use App\Models\TransportType;
use App\Models\Organizer;
use Illuminate\Http\Request;

class VacationController extends Controller
{
    public function index(Request $request)
    {
        $query = Vacation::with(['transportType', 'organizer']);

        if ($request->filled('duration_min')) {
            $query->where('duration', '>=', $request->duration_min);
        }
        if ($request->filled('duration_max')) {
            $query->where('duration', '<=', $request->duration_max);
        }

        if ($request->filled('organizer_id')) {
            $query->where('organizer_id', $request->organizer_id);
        }

        if ($request->filled('transport_type_id')) {
            $query->where('transport_type_id', $request->transport_type_id);
        }

        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        $vacations = $query->latest()->paginate(12);

        $transportTypes = TransportType::all();
        $organizers = Organizer::all();
        $maxPrice = Vacation::max('price') ?? 10000;
        $maxDuration = Vacation::max('duration') ?? 30;

        return view('public.vacations.index', compact('vacations', 'transportTypes', 'organizers', 'maxPrice', 'maxDuration'));
    }

    public function show(Vacation $vacation)
    {
        $vacation->load(['transportType', 'organizer']);
        return view('public.vacations.show', compact('vacation'));
    }
}