<?php

namespace Bildvitta\IssCrm;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

/**
 * Class IssCrmServiceProvider.
 */
class IssCrmServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name('iss-crm')->hasConfigFile();
    }

    public function register(): void
    {
        parent::register();

        $this->app->singleton('crm', fn ($app, $args) => new IssCrm($args[0] ?? request()->bearerToken()));
    }
}
