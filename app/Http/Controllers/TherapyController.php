<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Therapy;
use App\Models\Testimonial;

class TherapyController extends Controller
{
    public function index()
    {
        // fetch therapies (you can paginate if desired)
        $therapies = Therapy::orderBy('title')->get();

        // fetch latest testimonials and eager-load therapy relation
        $testimonials = Testimonial::with('therapy')
            ->latest()
            ->take(6)
            ->get();

        // FAQs remain static — keep in controller so view is clean
        $faqs = [
            [
                'q' => 'How do I choose the right therapy for my condition?',
                'a' =>
                    'Our practitioners will conduct a consultation including pulse diagnosis and dosha assessment to recommend suitable therapies.',
            ],
            [
                'q' => 'Are the therapies safe for everyone?',
                'a' =>
                    'Generally yes when administered by qualified practitioners. We assess each client and adapt treatments for safety.',
            ],
            [
                'q' => 'How many sessions will I need?',
                'a' =>
                    'It varies—acute conditions fewer, chronic conditions may need extended plans. We will advise after assessment.',
            ],
            [
                'q' => 'Can I combine multiple therapies?',
                'a' =>
                    'Yes — integrated plans often combine therapies for optimal results.',
            ],
            [
                'q' => 'What should I expect during my first visit?',
                'a' =>
                    'A detailed consultation, pulse diagnosis and a personalized plan with schedule and follow-up.',
            ],
        ];

        return view(
            'pages.TherapyPage',
            compact('therapies', 'testimonials', 'faqs')
        );
    }
    public function show($slug)
    {
        $therapy = Therapy::where('slug', $slug)->firstOrFail();

        // Optionally fetch related testimonials or other data
        $relatedTestimonials = Testimonial::where('therapy_id', $therapy->id)
            ->latest()
            ->take(3)
            ->get();

        return view(
            'components.Therapy.therapy-show',
            compact('therapy', 'relatedTestimonials')
        );
    }
}
