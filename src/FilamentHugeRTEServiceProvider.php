<?php

namespace BuzzyMind\FilamentHugeRTE;

use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentHugeRTEServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-hugerte';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasViews();
    }

    public function packageBooted(): void
    {
        FilamentAsset::register([
            Js::make('hugerte', 'https://cdn.jsdelivr.net/npm/hugerte@latest/dist/hugerte.min.js')
                ->module(false)
                ->loadedOnRequest(),
        ]);
    }
}