<?php namespace NewsTV\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use WebEd\Base\Events\SessionStarted;
use WebEd\Base\Menu\Repositories\Contracts\MenuRepositoryContract;

class BootstrapModuleServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Event::listen(SessionStarted::class, function () {
            $this->onSessionStarted();
        });
    }

    /**
     * Register dashboard menus, translations, cms settings
     */
    protected function onSessionStarted()
    {
        add_new_template([
            'video' => 'Video',
        ], WEBED_BLOG_POSTS);
        add_new_template([
            'contact_us' => 'Contact Us',
            'videos' => 'Videos',
        ], WEBED_PAGES);

        cms_theme_options()
            ->addGroup('menu', trans('webed-theme::base.theme_groups.menus'), 30)
            ->addGroup('footer', trans('webed-theme::base.theme_groups.footer'), 31)
            ->addOptionField('theme_layout', [
                'group' => 'basic',
                'type' => 'select',
                'priority' => 0,
                'label' => trans('webed-theme::base.theme_options.theme_layout.label'),
                'helper' => trans('webed-theme::base.theme_options.theme_layout.helper'),
            ], function () {
                $allThemes = config('sgsoft-themes');

                $themes = [];
                foreach ($allThemes as $alias => $theme) {
                    $themes[$alias] = $theme['title'];
                }

                return [
                    'theme_layout',
                    $themes,
                    get_theme_option('theme_layout'),
                    ['class' => 'form-control']
                ];
            })
            ->addOptionField('items_per_page', [
                'group' => 'basic',
                'type' => 'number',
                'priority' => 1,
                'label' => trans('webed-theme::base.theme_options.items_per_page.label'),
                'helper' => trans('webed-theme::base.theme_options.items_per_page.helper'),
            ], function () {
                return [
                    'items_per_page',
                    get_theme_option('items_per_page'),
                    ['class' => 'form-control']
                ];
            })
            ->addOptionField('top_menu', [
                'group' => 'menu',
                'type' => 'select',
                'priority' => 2,
                'label' => trans('webed-theme::base.theme_options.top_menu.label'),
                'helper' => trans('webed-theme::base.theme_options.top_menu.helper'),
            ], function () {
                $menus = app(MenuRepositoryContract::class)
                    ->getWhere(['status' => 1], ['slug', 'title'])
                    ->pluck('title', 'slug')
                    ->toArray();

                return [
                    'top_menu',
                    $menus,
                    get_theme_option('top_menu'),
                    ['class' => 'form-control']
                ];
            })
            ->addOptionField('footer_menu', [
                'group' => 'menu',
                'type' => 'select',
                'priority' => 3,
                'label' => trans('webed-theme::base.theme_options.footer_menu.label'),
                'helper' => trans('webed-theme::base.theme_options.footer_menu.helper'),
            ], function () {
                $menus = app(MenuRepositoryContract::class)
                    ->getWhere(['status' => 1], ['slug', 'title'])
                    ->pluck('title', 'slug')
                    ->toArray();

                return [
                    'footer_menu',
                    $menus,
                    get_theme_option('footer_menu'),
                    ['class' => 'form-control']
                ];
            })
            ->addOptionField('google_site_verification', [
                'group' => 'basic',
                'type' => 'text',
                'priority' => 4,
                'label' => trans('webed-theme::base.theme_options.google_site_verification.label'),
                'helper' => trans('webed-theme::base.theme_options.google_site_verification.helper'),
            ], function () {
                return [
                    'google_site_verification',
                    get_theme_option('google_site_verification'),
                    ['class' => 'form-control']
                ];
            })
            ->addOptionField('visit_us_on_google_map', [
                'group' => 'basic',
                'type' => 'text',
                'priority' => 5,
                'label' => trans('webed-theme::base.theme_options.visit_us_on_google_map.label'),
                'helper' => trans('webed-theme::base.theme_options.visit_us_on_google_map.helper'),
            ], function () {
                return [
                    'visit_us_on_google_map',
                    get_theme_option('visit_us_on_google_map'),
                    ['class' => 'form-control']
                ];
            })
            ->addOptionField('footer_information', [
                'group' => 'footer',
                'type' => 'text',
                'priority' => 6,
                'label' => trans('webed-theme::base.theme_options.footer_information.label'),
                'helper' => trans('webed-theme::base.theme_options.footer_information.helper'),
            ], function () {
                return [
                    'footer_information',
                    get_theme_option('footer_information'),
                    ['class' => 'form-control']
                ];
            })
            ->addOptionField('footer_copyright', [
                'group' => 'footer',
                'type' => 'text',
                'priority' => 7,
                'label' => trans('webed-theme::base.theme_options.footer_copyright.label'),
                'helper' => trans('webed-theme::base.theme_options.footer_copyright.helper'),
            ], function () {
                return [
                    'footer_copyright',
                    get_theme_option('footer_copyright'),
                    ['class' => 'form-control']
                ];
            });
    }
}
