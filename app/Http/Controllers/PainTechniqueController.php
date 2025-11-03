<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\PainTechnique;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;
use Parsedown;

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

        // prepare raw HTML/markdown (prefer description, else more_info)
        $raw = (string) ($treatment->description ?? $treatment->more_info ?? '');

        // if it's plain text (no tags) try parse as markdown
        $containsHtml = $raw !== strip_tags($raw);
        if (!$containsHtml) {
            // Try Parsedown, otherwise basic nl2br fallback
            try {
                if (class_exists(\Parsedown::class)) {
                    $parser = new \Parsedown();
                    $parser->setUrlsLinked(true);
                    $html = $parser->text($raw);
                } else {
                    // Fallback: convert line breaks to <br> so text isn't broken
                    $html = nl2br(e($raw));
                }
            } catch (\Throwable $e) {
                $html = nl2br(e($raw));
            }
        } else {
            $html = $raw;
        }


        // sanitize HTML in a defensive way:
        $safeHtml = $this->sanitizeHtml($html, 'frontend_html');

        // sanitize more_info separately (if you render it separately in blade)
        $moreInfoRaw = (string) ($treatment->more_info ?? '');
        if ($moreInfoRaw !== '') {
            $moreInfoContainsHtml = $moreInfoRaw !== strip_tags($moreInfoRaw);
            $moreInfoHtml = $moreInfoContainsHtml ? $moreInfoRaw : (new Parsedown())->text($moreInfoRaw);
            $moreInfo = $this->sanitizeHtml($moreInfoHtml, 'frontend_html');
        } else {
            $moreInfo = null;
        }

        $relatedTestimonials = $treatment->testimonials ?? collect();

        // pass sanitized HTML into the view and avoid calling Purifier in blade
        return view('components.painManagement.show', compact(
            'treatment',
            'relatedTestimonials',
            'safeHtml',
            'moreInfo'
        ));
    }

    /**
     * Sanitize HTML using Mews\Purifier if available, otherwise use a conservative fallback.
     *
     * @param string $html
     * @param string $profile
     * @return string
     */
    protected function sanitizeHtml(string $html, string $profile = 'default'): string
    {
        // If mews/purifier is available, use it (safe and configurable)
        if (class_exists(\Mews\Purifier\Facades\Purifier::class) || class_exists(\Mews\Purifier\Purifier::class)) {
            try {
                // use the facade if available
                if (class_exists(\Mews\Purifier\Facades\Purifier::class)) {
                    return \Mews\Purifier\Facades\Purifier::clean($html, $profile);
                }

                // fallback to service class
                if (class_exists(\Mews\Purifier\Purifier::class)) {
                    return Purifier::clean($html, $profile);
                }
            } catch (\Throwable $e) {
                \Log::warning('Purifier::clean failed: ' . $e->getMessage());
            }
        }

        // As a fallback, use a conservative strip_tags approach (safe but limited)
        // allow only a small set of tags used by your editor
        $allowed = '<p><br><strong><b><em><i><ul><ol><li><h1><h2><h3><h4><a><img><blockquote><pre><code>';
        $cleaned = strip_tags($html, $allowed);

        // additional tiny cleanup: remove suspicious attributes (basic)
        // (for better fallback you'd implement a small regex remove: remove "on*" attributes and javascript: URIs)
        // Remove on* attributes (onclick, onerror etc.)
        $cleaned = preg_replace('/(<[a-z][^>]*?)\s+on[a-z]+\s*=\s*(["\']).*?\2/si', '$1', $cleaned);

        // Remove javascript: in href/src
        $cleaned = preg_replace_callback('/<(a|img)[^>]+>/i', function ($m) {
            return preg_replace('/(href|src)\s*=\s*(["\'])(javascript:).*?\2/si', '$1=$2#$2', $m[0]);
        }, $cleaned);

        return $cleaned;
    }
}
