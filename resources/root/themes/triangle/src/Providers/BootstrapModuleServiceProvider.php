<?php namespace WebEd\Themes\Triangle\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class BootstrapModuleServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        add_new_template([
            'footer_custom_fields' => 'Footer custom fields',
        ], 'page');

        add_new_template([
            'video' => 'Video',
        ], 'blog-post');
    }
}
