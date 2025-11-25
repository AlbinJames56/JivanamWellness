<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Clinics;
use App\Models\Therapy;
use App\Models\Testimonial; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;// if you have a Testimonial model

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
            // fetch up to 6 active team members, ordered by sort_order (adjust as needed)
            $teamMembers = TeamMember::query()
                ->where('active', true)
                ->orderBy('sort_order')    // fallback ordering
                ->orderByDesc('featured')  // featured first if you want
                ->limit(6)
                ->get();
        } catch (\Throwable $e) {
            $teamMembers = collect();
            \Log::error('Failed to load TeamMember: ' . $e->getMessage());
        }

        try {
            $testimonialModels = Testimonial::query()
                ->orderByDesc('created_at')
                ->get();
        } catch (\Throwable $e) {
            $testimonialModels = collect();
            \Log::error('Failed to load Testimonial: ' . $e->getMessage());
        }

        try {
            // Fetch testimonials (remove where() if you want both text + video mixed)
            $rawTestimonials = Testimonial::query()
                ->orderByDesc('created_at')
                ->get();

            $testimonials = $rawTestimonials->map(function ($t) {
                $videoPath = $t->video ?? null;
                $thumbPath = $t->video_thumbnail ?? null;
                $avatarPath = $t->avatar ?? null;

                return [
                    'name' => $t->name ?? ($t->author_name ?? 'Anonymous'),
                    'location' => $t->location ?? null,
                    'avatar' => $avatarPath ? (Str::startsWith($avatarPath, ['http://', 'https://']) ? $avatarPath : Storage::url($avatarPath)) : null,
                    'rating' => $t->rating ?? null,
                    'text' => $t->text ?? $t->message ?? '',
                    'treatment' => $t->therapy?->title ?? null,
                    'isVideo' => (bool) ($t->is_video ?? false),
                    'video' => $videoPath ? (Str::startsWith($videoPath, ['http://', 'https://']) ? $videoPath : Storage::url($videoPath)) : null,
                    'videoThumbnail' => $thumbPath ? (Str::startsWith($thumbPath, ['http://', 'https://']) ? $thumbPath : Storage::url($thumbPath)) : null,
                ];
            });
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
            'teamMembers' => $teamMembers ?? collect(),
        ]);
    }
}
