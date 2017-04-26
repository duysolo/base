<?php namespace WebEd\Base\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class HookServiceProvider extends ServiceProvider
{
    /**
     * @var Request
     */
    protected $request;
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        app()->booted(function () {
            $this->request = request();

            $this->booted();
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Callback when app booted
     *
     * @return void
     */
    protected function booted()
    {
        add_filter(BASE_FILTER_BEFORE_UPDATE, function ($data, $screenName, $action = null) {
            if ($screenName !== WEBED_SETTINGS) {
                return $data;
            }
            if($this->request->get('_tab') === 'advanced') {
                $data['construction_mode'] = (int)($this->request->has('construction_mode'));
                $data['show_admin_bar'] = (int)($this->request->has('show_admin_bar'));
            }
            return $data;
        });
    }
}
