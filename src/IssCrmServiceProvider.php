<?php

namespace Bildvitta\IssCrm;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

/**
 * Class IssCrmServiceProvider.
 *
 * @package Bildvitta\IssCrm
 */
class IssCrmServiceProvider extends PackageServiceProvider
{
    /**
     * @param  Package  $package
     *
     * @return void
     */
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name('iss-crm')->hasConfigFile();
    }
}
