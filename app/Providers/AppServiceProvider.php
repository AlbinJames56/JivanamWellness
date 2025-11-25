<?php

namespace App\Providers;

use App\Models\PainTechnique; 
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
            $payload = Cache::remember('pain_techniques_nav', 60 * 60, function () {
                // load all available techniques (you may add ->limit or eager loads if necessary)
                $techniques = PainTechnique::where('available', true)
                    ->orderBy('title')
                    ->get(['title', 'slug', 'categories', 'category']); // only fields we need

                // categories list from model constant (fall back to a simple array)
                $categoriesList = method_exists(PainTechnique::class, 'categories')
                    ? PainTechnique::categories()
                    : [
                        'massage' => 'Massage',
                        'detox' => 'Detox',
                        'therapy' => 'Therapy',
                        'other' => 'Other',
                    ];

                $grouped = [];
                // initialize groups
                foreach ($categoriesList as $key => $label) {
                    $grouped[$key] = collect();
                }
                $grouped['uncategorized'] = collect(); // fallback group

                foreach ($techniques as $t) {
                    // normalized categories: (1) try JSON array, (2) single category fallback
                    $cats = [];
                    if (!empty($t->categories) && is_array($t->categories)) {
                        $cats = $t->categories;
                    } elseif (!empty($t->category)) {
                        $cats = [$t->category];
                    }

                    if (empty($cats)) {
                        $grouped['uncategorized']->push($t);
                        continue;
                    }

                    $assigned = false;
                    foreach ($cats as $c) {
                        if (isset($categoriesList[$c])) {
                            $grouped[$c]->push($t);
                            $assigned = true;
                        } else {
                            // unknown category key -> put into uncategorized
                            $grouped['uncategorized']->push($t);
                        }
                    }
                }

                // convert to simple data arrays for blade and limit each category for nav (e.g. 6 items)
                $maxNavItemsPerCategory = 6;
                $result = [
                    'categories' => $categoriesList,
                    'grouped' => array_map(function ($col) use ($maxNavItemsPerCategory) {
                        return $col->unique('slug')->take($maxNavItemsPerCategory)->values()->all();
                    }, $grouped),
                ];

                return $result;
            });

            $view->with('painNav', $payload);
        });
    }
}
