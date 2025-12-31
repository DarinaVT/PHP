<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransportType;
use Illuminate\Http\Request;

class TransportTypeController extends Controller
{
    public function index()
    {
        $transportTypes = TransportType::latest()->paginate(10);
        return view('admin.transport-types.index', compact('transportTypes'));
    }

    public function create()
    {
        return view('admin.transport-types.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        TransportType::create($validated);

        return redirect()->route('admin.transport-types.index')
            ->with('success', 'Transport type created successfully.');
    }

    public function show(TransportType $transportType)
    {
        return view('admin.transport-types.show', compact('transportType'));
    }

    public function edit(TransportType $transportType)
    {
        return view('admin.transport-types.edit', compact('transportType'));
    }

    public function update(Request $request, TransportType $transportType)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $transportType->update($validated);

        return redirect()->route('admin.transport-types.index')
            ->with('success', 'Transport type updated successfully.');
    }

    public function destroy(TransportType $transportType)
    {
        $transportType->delete();

        return redirect()->route('admin.transport-types.index')
            ->with('success', 'Transport type deleted successfully.');
    }
}