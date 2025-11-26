<?php

namespace App\Providers;

use App\Models\Therapy;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('components.commons.header', function ($view) {
            $payload = Cache::remember('therapy_nav', 60 * 60, function () {
                // Load all available therapies (add scopes/limits if needed)
                $therapies = Therapy::where('available', true)
                    ->orderBy('title')
                    ->get(['title', 'slug', 'categories']); // <-- removed "category"

                // Categories list from model static method, or fallback
                $categoriesList = method_exists(Therapy::class, 'categories')
                    ? Therapy::categories()
                    : [
                        'back_pain' => 'Back Pain',
                        'neck_pain' => 'Neck & Shoulder',
                        'joint_pain' => 'Joint Pain',
                        'other' => 'Other',
                    ];

                $grouped = [];

                // Initialize groups
                foreach ($categoriesList as $key => $label) {
                    $grouped[$key] = collect();
                }
                $grouped['uncategorized'] = collect(); // fallback bucket

                foreach ($therapies as $therapy) {
                    $cats = [];

                    // Normalize categories from the "categories" column only
                    $raw = $therapy->categories;

                    if (is_array($raw)) {
                        // e.g. cast in model: protected $casts = ['categories' => 'array'];
                        $cats = $raw;
                    } elseif (is_string($raw)) {
                        // could be JSON or comma-separated string
                        $decoded = json_decode($raw, true);
                        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                            $cats = $decoded;
                        } else {
                            // fall back to comma separated list
                            $cats = array_filter(array_map('trim', explode(',', $raw)));
                        }
                    }

                    if (empty($cats)) {
                        $grouped['uncategorized']->push($therapy);
                        continue;
                    }

                    $assigned = false;

                    foreach ($cats as $c) {
                        if (isset($categoriesList[$c])) {
                            $grouped[$c]->push($therapy);
                            $assigned = true;
                        } else {
                            // Unknown category key -> put into uncategorized
                            $grouped['uncategorized']->push($therapy);
                        }
                    }

                    if (!$assigned && empty($cats)) {
                        $grouped['uncategorized']->push($therapy);
                    }
                }

                // Limit each category to a handful of items for the nav
                $maxNavItemsPerCategory = 6;

                $result = [
                    'categories' => $categoriesList,
                    'grouped' => array_map(function ($col) use ($maxNavItemsPerCategory) {
                        return $col->unique('slug')->take($maxNavItemsPerCategory)->values()->all();
                    }, $grouped),
                ];

                return $result;
            });

            // This is what the header will read from
            $view->with('therapyNav', $payload);
        });
    }
}
