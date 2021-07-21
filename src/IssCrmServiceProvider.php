<?php

namespace Bildvitta\IssCrm;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Bildvitta\IssCrm\Commands\IssCrmCommand;

class IssCrmServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('iss-crm')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_iss-crm_table')
            ->hasCommand(IssCrmCommand::class);
    }
}
