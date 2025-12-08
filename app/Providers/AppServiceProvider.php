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
                $therapies = \App\Models\Therapy::where('available', true)
                    ->orderBy('title')
                    ->get(['title', 'slug', 'categories']);

                $categoriesList = method_exists(\App\Models\Therapy::class, 'categories')
                    ? \App\Models\Therapy::categories()
                    : [
                        'Therapeutic_Therapy' => 'Therapeutic Therapy',
                        'Panchakarma' => 'Panchakarma',
                        'Swedana_karma' => 'Swedana karma',
                    ];

                // Normalizer: turn any candidate into a predictable token
                $normalize = function (string $s): string {
                    $s = trim($s);
                    // remove extra spaces, convert to underscore, lowercase
                    $s = preg_replace('/[^\p{L}\p{N}]+/u', '_', $s);
                    $s = trim($s, '_');
                    return mb_strtolower($s);
                };

                // Build lookup maps:
                // - normalizedLabelMap[ normalized(label) ] = originalKey
                // - normalizedKeyMap[ normalized(key) ] = originalKey
                $normalizedLabelMap = [];
                $normalizedKeyMap = [];
                foreach ($categoriesList as $key => $label) {
                    $normalizedLabelMap[$normalize((string) $label)] = $key;
                    $normalizedKeyMap[$normalize((string) $key)] = $key;
                    // also keep lowercase key (defensive)
                    $normalizedKeyMap[mb_strtolower($key)] = $key;
                }

                $grouped = [];
                foreach ($categoriesList as $key => $label) {
                    $grouped[$key] = collect();
                }
                $grouped['uncategorized'] = collect();

                foreach ($therapies as $therapy) {
                    $cats = [];

                    $raw = $therapy->categories;

                    if (is_array($raw)) {
                        $cats = $raw;
                    } elseif (is_string($raw)) {
                        $decoded = json_decode($raw, true);
                        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                            $cats = $decoded;
                        } else {
                            $cats = array_filter(array_map('trim', explode(',', $raw)));
                        }
                    }

                    if (empty($cats)) {
                        $grouped['uncategorized']->push($therapy);
                        continue;
                    }

                    $assignedAny = false;
                    foreach ($cats as $c) {
                        if ($c === null || $c === '')
                            continue;
                        $candidate = (string) $c;

                        // 1) exact key match (case-sensitive)
                        if (isset($grouped[$candidate])) {
                            $grouped[$candidate]->push($therapy);
                            $assignedAny = true;
                            continue;
                        }

                        // 2) case-insensitive key match
                        $lower = mb_strtolower($candidate);
                        if (isset($normalizedKeyMap[$lower])) {
                            $target = $normalizedKeyMap[$lower];
                            $grouped[$target]->push($therapy);
                            $assignedAny = true;
                            continue;
                        }

                        // 3) normalized key match
                        $norm = $normalize($candidate);
                        if (isset($normalizedKeyMap[$norm])) {
                            $target = $normalizedKeyMap[$norm];
                            $grouped[$target]->push($therapy);
                            $assignedAny = true;
                            continue;
                        }

                        // 4) normalized label match (match against human labels)
                        if (isset($normalizedLabelMap[$norm])) {
                            $target = $normalizedLabelMap[$norm];
                            $grouped[$target]->push($therapy);
                            $assignedAny = true;
                            continue;
                        }

                        // 5) last resort: case-insensitive label comparison
                        foreach ($categoriesList as $k => $label) {
                            if (strcasecmp($label, $candidate) === 0) {
                                $grouped[$k]->push($therapy);
                                $assignedAny = true;
                                break;
                            }
                        }

                        if (!$assignedAny) {
                            $grouped['uncategorized']->push($therapy);
                        }
                    }

                    // nothing matched at all -> uncategorized
                    if (!$assignedAny) {
                        $grouped['uncategorized']->push($therapy);
                    }
                }

                $maxNavItemsPerCategory = 6;
                $result = [
                    'categories' => $categoriesList,
                    'grouped' => array_map(function ($col) use ($maxNavItemsPerCategory) {
                        return $col->unique('slug')->take($maxNavItemsPerCategory)->values()->all();
                    }, $grouped),
                ];

                // Optional debug: remove once OK
                // Log::debug('therapy_nav payload', $result);

                return $result;
            });

            $view->with('therapyNav', $payload);
        });
    }
}
