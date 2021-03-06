<?php

namespace App\Providers;

use App\Contracts\AttributeContract;
use App\Contracts\CategoryContract;
use App\Repositories\AttributeRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        CategoryContract::class => CategoryRepository::class,
        AttributeContract::class, AttributeRepository::class,
    ];

    public function register()
    {
        foreach ($this->repositories as $interface => $implemetation) {
            $this->app->bind($interface, $implemetation);
        }
    }

    public function boot()
    {
    }
}
