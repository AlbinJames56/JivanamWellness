<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Dashboard extends Page
{
    // The label that appears in the sidebar
    protected static ?string $navigationLabel = 'Dashboard';

    // Optional: order in the sidebar
    protected static ?int $navigationSort = 1;

    /**
     * Tell Filament which Blade view to render.
     *
     * NOTE: This property must match Filament\Pages\Page's declaration (non-static),
     * otherwise PHP will throw "Cannot redeclare non static ... as static".
     */
    protected string $view = 'vendor.filament-panels.pages.dashboard';

    /**
     * Use a method instead of a typed static property to avoid
     * PHP type/formatter issues with UnitEnum|string|null in some environments.
     *
     * Return type matches Filament's expectation: UnitEnum|string|null
     */
    public static function getNavigationGroup(): \UnitEnum|string|null
    {
        // return null for top-level (no dropdown group)
        return null;

        // or to put it in a group:
        // return 'Content';
    }
}
