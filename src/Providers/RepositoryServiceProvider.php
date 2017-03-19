<?php namespace WebEd\Base\Providers;

use Illuminate\Support\ServiceProvider;
use WebEd\Base\Models\ViewTracker;
use WebEd\Base\Repositories\Contracts\ViewTrackerRepositoryContract;
use WebEd\Base\Repositories\ViewTrackerRepository;
use WebEd\Base\Repositories\ViewTrackerRepositoryCacheDecorator;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ViewTrackerRepositoryContract::class, function () {
            $repository = new ViewTrackerRepository(new ViewTracker());

            if (config('webed-caching.repository.enabled')) {
                return new ViewTrackerRepositoryCacheDecorator($repository);
            }

            return $repository;
        });
    }
}
