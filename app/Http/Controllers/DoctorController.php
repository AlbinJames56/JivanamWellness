<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeamMember;

class DoctorController extends Controller
{
    /**
     * Show listing of doctors separated into main and duty doctors.
     */
    public function index()
    {
        // Main doctors: using `featured = true`. Change if you have another flag.
        $mainDoctors = TeamMember::query()
            ->where('active', true)
            ->where('featured', true)
            ->orderByDesc('featured')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        // Other duty doctors: active but not featured
        $dutyDoctors = TeamMember::query()
            ->where('active', true)
            ->where(function ($q) {
                $q->whereNull('featured')->orWhere('featured', false);
            })
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('pages.doctors', compact('mainDoctors', 'dutyDoctors'));
    }
}
