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

        /* expand page content area so layout looks like the example */
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
            min-height: 52px;
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

        /* center container width like your example */
        .jv-container {
            max-width: 1100px;
            margin-left: auto;
            margin-right: auto;
            padding: 0 1rem;
        }
    </style>
    @php
        // Use the correct resource FQCN (namespace + class)
        $articleResourceClass = \App\Filament\Resources\Articles\ArticleResource::class;

        // Try to resolve Filament resource URLs; fall back to a direct panel URL
        try {
            $articlesIndexUrl = $articleResourceClass::getUrl('index');
        } catch (\Throwable $e) {
            // fallback direct URL (panel path + resource slug)
            $articlesIndexUrl = url('jivanam-admin/resources/articles') ?? '#';
        }

        try {
            $articlesCreateUrl = $articleResourceClass::getUrl('create');
        } catch (\Throwable $e) {
            $articlesCreateUrl = url('jivanam-admin/resources/articles/create') ?? '#';
        }
    @endphp
    <div class="jv-container">


        <div class="jv-dashboard-grid">
            {{-- Manage Therapies --}}
            <a href="{{ \App\Filament\Resources\Therapies\TherapyResource::getUrl('index') }}"
                class="jv-dashboard-button jv-gold">
                🌿 Manage Therapies
            </a>

            {{-- Manage Testimonials (create this resource if not present) --}}
            <a href="{{ \App\Filament\Resources\Testimonials\TestimonialResource::getUrl('index') ?? '#' }}"
                class="jv-dashboard-button jv-green">
                💬 Manage Testimonials
            </a>
            {{-- Manage Articles --}}
            <a href="{{ $articlesIndexUrl }}" class="jv-dashboard-button jv-blue" @if($articlesIndexUrl === '#')
            title="Articles resource not registered" @endif>
                📰 Manage Articles
            </a>



        </div>
    </div>
</x-filament-panels::page>
