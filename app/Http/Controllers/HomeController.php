<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Clinics;
use App\Models\Therapy;
use App\Models\Testimonial; // if you have a Testimonial model

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // latest 3 featured / popular treatments (adjust model & query to your app)
        try {
            $therapies = Therapy::query()
                ->where('available', true)
                ->orderByDesc('featured')
                ->orderByDesc('created_at')
                ->limit(3)
                ->get();
        } catch (\Throwable $e) {
            $therapies = collect();
            \Log::error('Failed to load Therapy: ' . $e->getMessage());
        }

        try {
            $clinics = Clinics::query()
                ->orderBy('city')
                ->limit(6)
                ->get();
        } catch (\Throwable $e) {
            $clinics = collect();
            \Log::error('Failed to load Clinic: ' . $e->getMessage());
        }

        try {
            $articles = Article::query()
                ->where('published', true)
                ->orderByDesc('published_at')
                ->limit(3)
                ->get();
        } catch (\Throwable $e) {
            $articles = collect();
            \Log::error('Failed to load Article: ' . $e->getMessage());
        }

        try {
            $testimonials = Testimonial::query()
                ->orderByDesc('created_at')
                ->limit(3)
                ->get();
        } catch (\Throwable $e) {
            $testimonials = collect();
            \Log::error('Failed to load Testimonial: ' . $e->getMessage());
        }

        // Pass everything to the view. Your blade components already have in-view fallbacks too.
        return view('pages.home', [
            'treatments' => $therapies ?? collect(),
            'clinics' => $clinics ?? collect(),
            'articles' => $articles ?? collect(),
            'testimonials' => $testimonials ?? collect(),
        ]);
    }
}
