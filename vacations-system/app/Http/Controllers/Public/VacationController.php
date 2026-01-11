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

        if ($request->filled('location')) {
            $location = $request->location;
            $query->where(function($q) use ($location) {
                $q->where('country', 'like', "%{$location}%")
                ->orWhere('city', 'like', "%{$location}%");
            });
        }

        if ($request->filled('date_from') && $request->filled('date_to')) {
            $query->where(function($q) use ($request) {
                $q->where(function($subQ) use ($request) {
                    $subQ->whereBetween('start_date', [$request->date_from, $request->date_to]);
                })
                ->orWhere(function($subQ) use ($request) {
                    $subQ->whereBetween('end_date', [$request->date_from, $request->date_to]);
                })
                ->orWhere(function($subQ) use ($request) {
                    $subQ->where('start_date', '<=', $request->date_from)
                         ->where('end_date', '>=', $request->date_to);
                });
            });
        } elseif ($request->filled('date_from')) {
            $query->where('start_date', '>=', $request->date_from);
        } elseif ($request->filled('date_to')) {
            $query->where('end_date', '<=', $request->date_to);
        }

        if ($request->filled('guests')) {
            $query->where('max_guests', '>=', $request->guests);
        }

        if ($request->filled('transport_type_id')) {
            $query->where('transport_type_id', $request->transport_type_id);
        }

        if ($request->filled('organizer_id')) {
            $query->where('organizer_id', $request->organizer_id);
        }

        $sortBy = $request->get('sort_by', 'latest');
        switch ($sortBy) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'date_asc':
                $query->orderBy('start_date', 'asc');
                break;
            case 'date_desc':
                $query->orderBy('start_date', 'desc');
                break;
            case 'duration_asc':
                $query->orderByRaw('DATEDIFF(end_date, start_date) + 1 ASC');
                break;
            case 'duration_desc':
                $query->orderByRaw('DATEDIFF(end_date, start_date) + 1 DESC');
                break;
            case 'transport':
                $query->orderBy('transport_type_id', 'asc');
                break;
            case 'organizer':
                $query->orderBy('organizer_id', 'asc');
                break;
            default:
                $query->latest();
        }

        $vacations = $query->paginate(12);

        $locations = Vacation::select('country', 'city')
            ->whereNotNull('country')
            ->orWhereNotNull('city')
            ->get()
            ->flatMap(function($vacation) {
                $result = [];
                if ($vacation->country) {
                    $result[] = ['id' => $vacation->id, 'name' => $vacation->country];
                }
                if ($vacation->city) {
                    $result[] = ['id' => $vacation->id, 'name' => $vacation->city];
                }
                return $result;
            })
            ->unique('name')
            ->values()
            ->toArray();

        $transportTypes = TransportType::all();
        $organizers = Organizer::all();
        $maxPrice = Vacation::max('price') ?? 10000;
        $maxDuration = Vacation::selectRaw('MAX(DATEDIFF(end_date, start_date) + 1) as max_duration')->value('max_duration') ?? 30;
        $hasSearchParams = $request->hasAny(['location', 'date_from', 'date_to', 'guests', 'transport_type_id', 'organizer_id', 'sort_by']);

        return view('public.vacations.index', compact('vacations', 'transportTypes', 'organizers', 'maxPrice', 'maxDuration', 'locations', 'hasSearchParams'));
    }

    public function show(Vacation $vacation)
    {
        if (!auth()->check()) {
            return redirect()->route('register')->with('message', 'Please register or login to view vacation details.');
        }
        
        $vacation->load(['transportType', 'organizer']);
        return view('public.vacations.show', compact('vacation'));
    }

    public function offers(Request $request)
    {
        $query = Vacation::with(['transportType', 'organizer']);

        if ($request->filled('transport_type_id')) {
            $query->where('transport_type_id', $request->transport_type_id);
        }

        if ($request->filled('organizer_id')) {
            $query->where('organizer_id', $request->organizer_id);
        }

        if ($request->filled('date_from')) {
            $query->where('start_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->where('end_date', '<=', $request->date_to);
        }

        $sortBy = $request->get('sort_by', 'latest');
        switch ($sortBy) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'date_asc':
                $query->orderBy('start_date', 'asc');
                break;
            case 'date_desc':
                $query->orderBy('start_date', 'desc');
                break;
            case 'transport':
                $query->orderBy('transport_type_id', 'asc');
                break;
            case 'organizer':
                $query->orderBy('organizer_id', 'asc');
                break;
            default:
                $query->latest();
        }

        $vacations = $query->paginate(12);

        $transportTypes = TransportType::all();
        $organizers = Organizer::all();

        return view('public.vacations.offers', compact('vacations', 'transportTypes', 'organizers'));
    }
}