<?php 

namespace App\Infrastructure\Provider;

use Illuminate\Support\ServiceProvider;
use App\Domain\Repositories\ProductRepositoryInterface;
use App\Infrastructure\Persistence\Eloquent\Repositories\EloquentProductRepository;
use App\Domain\Repositories\CityRepositoryInterface;
use App\Infrastructure\Persistence\Eloquent\Repositories\EloquentCityRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ProductRepositoryInterface::class, EloquentProductRepository::class);
        $this->app->bind(CityRepositoryInterface::class, EloquentCityRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
