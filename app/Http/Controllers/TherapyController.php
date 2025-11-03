<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Therapy;
use App\Models\Testimonial;
use Mews\Purifier\Facades\Purifier;
use Parsedown;
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

        // Prepare sanitized HTML for rendering
        $raw = (string) ($therapy->content ?? '');

        // If it doesn't contain HTML tags, treat as Markdown/plain text
        $containsHtml = $raw !== strip_tags($raw);

        if (!$containsHtml) {
            $parser = new Parsedown();
            $parser->setUrlsLinked(true);
            $html = $parser->text($raw);
        } else {
            $html = $raw;
        }

        try {
            $safeHtml = Purifier::clean($html, 'frontend_html');
        } catch (\Throwable $e) {
            \Log::warning('Purifier failed: ' . $e->getMessage());
            // fallback to a minimal helper (app/helpers.php: clean)
            $safeHtml = clean($html, 'default');
        }

        // Pass sanitized HTML to view
        return view('components.therapy.therapy-show', compact('therapy', 'relatedTestimonials', 'safeHtml'));
    }
}
