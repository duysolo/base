<?php namespace WebEd\Base\Core\Providers;

use Illuminate\Support\ServiceProvider;
use WebEd\Base\Core\Models\ViewTracker;
use WebEd\Base\Core\Repositories\Contracts\ViewTrackerRepositoryContract;
use WebEd\Base\Core\Repositories\ViewTrackerRepository;
use WebEd\Base\Core\Repositories\ViewTrackerRepositoryCacheDecorator;

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
