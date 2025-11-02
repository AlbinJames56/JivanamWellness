{{-- resources/views/vendor/filament-panels/pages/dashboard.blade.php --}}
<x-filament-panels::page class="fi-dashboard-page">
    <style>
        /* hide Filament top chrome, breadcrumbs, page title, widgets and info boxes */
        .filament-app-layout__header,
        .filament-page-header,
        .filament-page-title,
        .filament-breadcrumbs,
        .filament-global-search,
        .filament-widgets,
        .filament-info-widget,
        .filament-page-actions,
        /* hide sidebar brand & compact top nav if present */
        .filament-main-nav,
        .filament-topbar {
            display: none !important;
        }

        /* expand page content area */
        .fi-dashboard-page .filament-page {
            padding-top: 2rem;
            padding-left: 0.75rem;
            padding-right: 0.75rem;
        }

        /* grid for big buttons */
        .jv-dashboard-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1rem;
            align-items: start;
            margin-top: 1rem;
        }

        @media (max-width: 1024px) {
            .jv-dashboard-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 640px) {
            .jv-dashboard-grid {
                grid-template-columns: 1fr;
            }
        }

        .jv-dashboard-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.9rem 1.25rem;
            font-weight: 600;
            border-radius: 0.6rem;
            color: white;
            text-decoration: none;
            box-shadow: 0 1px 0 rgba(0, 0, 0, 0.02);
            transition: transform .08s ease, box-shadow .08s ease;
            min-height: 56px;
            gap: .5rem;
            font-size: 1rem;
        }

        .jv-dashboard-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        }

        .jv-gold {
            background: #c77a00;
        }

        .jv-green {
            background: #16a34a;
        }

        .jv-blue {
            background: #2563eb;
        }

        .jv-orange {
            background: #ea580c;
        }

        .jv-red {
            background: #dc2626;
        }

        .jv-teal {
            background: #059669;
        }

        .jv-container {
            max-width: 1100px;
            margin-left: auto;
            margin-right: auto;
            padding: 0 1rem;
        }
    </style>

    @php
        $panelPath = config('filament.path', 'admin');

        // canonical resource definitions: label, emoji, candidate class segments (tries in order),
        // candidate slugs (fallbacks), color
        $resources = [
            [
                'label' => 'Manage Bookings',
                'emoji' => '📅',
                'classCandidates' => [
                    'Appointments\\AppointmentResource',
                    'Appointments\\AppointmentsResource',
                ],
                'slugCandidates' => ['appointments', 'booking', 'bookings'],
                'color' => 'jv-red', // pick any of jv-gold/jv-green/jv-blue/jv-orange/jv-red/jv-teal
            ],

            [
                'label' => 'Manage Pain Techniques',
                'emoji' => '🩺',
                // try common variants: singular/plural and different folders
                'classCandidates' => [
                    'PainTechniques\\PainTechniqueResource',
                    'PainTechniques\\PainTechniquesResource',
                    'PainManagements\\PainManagementResource',
                    'PainManagements\\PainManagementsResource',
                ],
                'slugCandidates' => ['pain-techniques', 'pain-technique', 'pain-management', 'pain-managements'],
                'color' => 'jv-gold',
            ],
            [
                'label' => 'Manage Therapies',
                'emoji' => '🌿',
                'classCandidates' => [
                    'Therapies\\TherapyResource',
                    'Therapies\\TherapiesResource',
                ],
                'slugCandidates' => ['therapies', 'therapy'],
                'color' => 'jv-green',
            ],
            [
                'label' => 'Manage Articles',
                'emoji' => '📰',
                'classCandidates' => [
                    'Articles\\ArticleResource',
                    'Articles\\ArticlesResource',
                ],
                'slugCandidates' => ['articles', 'article', 'blog'],
                'color' => 'jv-blue',
            ],
            [
                'label' => 'Manage Clinics',
                'emoji' => '🏥',
                'classCandidates' => [
                    'Clinics\\ClinicResource',
                    'Clinics\\ClinicsResource',
                ],
                'slugCandidates' => ['clinics', 'clinic'],
                'color' => 'jv-orange',
            ],
            [
                'label' => 'Manage Team Members',
                'emoji' => '👥',
                'classCandidates' => [
                    'TeamMembers\\TeamMemberResource',
                    'TeamMembers\\TeamMembersResource',
                ],
                'slugCandidates' => ['team-members', 'team-member', 'team'],
                'color' => 'jv-red',
            ],
            [
                'label' => 'Manage Testimonials',
                'emoji' => '💬',
                'classCandidates' => [
                    'Testimonials\\TestimonialResource',
                    'Testimonials\\TestimonialsResource',
                ],
                'slugCandidates' => ['testimonials', 'testimonial'],
                'color' => 'jv-teal',
            ],
        ];

        // helper: try to resolve a resource URL from a set of candidate classsegments or slugs
        function resolveResourceUrlFromCandidates(array $classCandidates, array $slugCandidates, $panelPath)
        {
            foreach ($classCandidates as $seg) {
                $fqcn = "\\App\\Filament\\Resources\\" . $seg;
                if (class_exists($fqcn) && method_exists($fqcn, 'getUrl')) {
                    try {
                        return $fqcn::getUrl('index');
                    } catch (\Throwable $e) {
                        // ignore and continue trying
                    }
                }
            }
            // fallback: try slug candidates to form a panel URL
            foreach ($slugCandidates as $slug) {
                $url = url(trim($panelPath, '/') . '/resources/' . trim($slug, '/'));
                // we don't have a reliable way to test route existence without making requests,
                // but returning the URL as fallback is still helpful for the UI.
                return $url;
            }
            return '#';
        }
    @endphp


    <div class="jv-container">
        

        <div class="jv-dashboard-grid mt-4">
            @foreach($resources as $r)
                @php
                    $url = resolveResourceUrlFromCandidates(
                        $r['classCandidates'],
                        $r['slugCandidates'],
                        $panelPath
                    );
                @endphp

                <a href="{{ $url }}" class="jv-dashboard-button {{ $r['color'] }}" target="_self" rel="noopener noreferrer"
                    @if($url === '#') title="Resource not available" @endif>
                    <span style="font-size:1.1rem;">{!! $r['emoji'] !!}</span>
                    <span>{{ $r['label'] }}</span>
                </a>
            @endforeach
        </div>

    </div>
</x-filament-panels::page>