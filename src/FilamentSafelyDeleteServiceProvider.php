<?php

namespace Konnco\FilamentSafelyDelete;

use Filament\PluginServiceProvider;
use Spatie\LaravelPackageTools\Package;

class FilamentSafelyDeleteServiceProvider extends PluginServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('filament-safely-delete')
            ->hasConfigFile()
            ->hasTranslations();
    }
}
