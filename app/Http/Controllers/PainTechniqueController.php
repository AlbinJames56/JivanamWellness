<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\PainTechnique;
use Illuminate\Http\Request;

class PainTechniqueController extends Controller
{
    public function index()
    {
        $techniques = PainTechnique::where('available', true)
            ->orderByDesc('featured')
            ->orderByDesc('created_at')
            ->get();

        $articles = Article::where('published', true)
            ->latest('published_at')
            ->limit(3)
            ->get();

        return view('pages.pain-management', compact('techniques', 'articles'));
    }
    public function show($slug)
    {
        $treatment = PainTechnique::where('slug', $slug)->firstOrFail();

        // optionally load related items
        $relatedTestimonials = $treatment->testimonials ?? collect();
        return view(
            'components.painManagement.show',
            compact('treatment', 'relatedTestimonials')
        );
    }
}
