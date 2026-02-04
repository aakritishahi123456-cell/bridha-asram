<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Configure Filament
        Filament::serving(function () {
            // Custom navigation groups
            Filament::registerNavigationGroups([
                NavigationGroup::make('Content Management')
                    ->label('Content Management')
                    ->icon('heroicon-o-document-text')
                    ->collapsed(),
                NavigationGroup::make('User Management')
                    ->label('User Management')
                    ->icon('heroicon-o-users')
                    ->collapsed(),
                NavigationGroup::make('Donations & Finance')
                    ->label('Donations & Finance')
                    ->icon('heroicon-o-currency-dollar')
                    ->collapsed(),
                NavigationGroup::make('Impact & Analytics')
                    ->label('Impact & Analytics')
                    ->icon('heroicon-o-chart-bar')
                    ->collapsed(),
                NavigationGroup::make('System Settings')
                    ->label('System Settings')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->collapsed(),
            ]);
        });

        // Register custom assets
        FilamentAsset::register([
            Css::make('ngo-admin-styles', resource_path('css/filament.css')),
            Js::make('ngo-admin-scripts', resource_path('js/filament.js')),
        ]);
    }
}