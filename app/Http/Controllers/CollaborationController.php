<?php

namespace App\Http\Controllers;

use App\Http\Resources\CollaborationResource;
use App\Models\Collaboration;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CollaborationController extends Controller
{
    // GET /api/collaborations — grouped by city
    public function index(Request $request)
    {
        $collabs = Collaboration::with(['city', 'company', 'collaborator'])
            ->orderByDesc('collaboration_date')
            ->get();

        // Group by city name
        $grouped = $collabs->groupBy(function ($c) {
            return optional($c->city)->name ?? 'Unknown City';
        })->map(function ($items, $cityName) {
            return [
                'city' => $cityName,
                'records' => CollaborationResource::collection($items)->resolve(),
            ];
        })->values();

        return response()->json($grouped);
    }

    // GET /api/collaborations/by-date?date=YYYY-MM-DD
    public function byDate(Request $request)
    {
        $date = $request->query('date');
        if (!$date) {
            return response()->json(['message' => 'Missing date param (YYYY-MM-DD)'], 422);
        }

        $collabs = Collaboration::with(['city', 'company', 'collaborator'])
            ->whereDate('collaboration_date', $date)
            ->orderBy('city_id')
            ->get();

        return CollaborationResource::collection($collabs);
    }

    // GET /api/collaborations/company/{id}
    public function byCompany($id)
    {
        $company = Company::findOrFail($id);

        $collabs = Collaboration::with(['city', 'company', 'collaborator'])
            ->where(function ($q) use ($id) {
                $q->where('company_id', $id)->orWhere('collaborator_id', $id);
            })
            ->orderByDesc('collaboration_date')
            ->get();

        return response()->json([
            'company' => $company->only(['id', 'name']),
            'collaborations' => CollaborationResource::collection($collabs)->resolve(),
        ]);
    }
}
