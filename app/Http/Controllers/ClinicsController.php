<?php

namespace App\Http\Controllers;

use App\Models\Clinics;
use Illuminate\Http\Request;

class ClinicsController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');
        $city = $request->query('city', 'all');
        $openOnly = $request->has('open');

        // Base query
        $query = Clinics::query();

        if ($q) {
            $query->where(function ($qB) use ($q) {
                $qB
                    ->where('name', 'like', "%{$q}%")
                    ->orWhere('address', 'like', "%{$q}%")
                    ->orWhere('phone', 'like', "%{$q}%")
                    ->orWhereJsonContains('specialties', $q); // fallback, DB dependent
            });
        }

        if ($city && $city !== 'all') {
            $query->where('city', $city);
        }

        if ($openOnly) {
            $query->where('is_open', true);
        }

        $clinics = $query
            ->orderByDesc('is_open')
            ->orderBy('city')
            ->get();

        $cities = Clinics::query()
            ->select('city')
            ->distinct()
            ->pluck('city')
            ->filter()
            ->values();

        return view('pages.clinics', compact('clinics', 'cities'));
    }
}
