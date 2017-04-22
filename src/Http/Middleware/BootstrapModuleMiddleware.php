<?php namespace WebEd\Base\Http\Middleware;

use \Closure;

class BootstrapModuleMiddleware
{
    public function __construct()
    {

    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  array|string $params
     * @return mixed
     */
    public function handle($request, Closure $next, ...$params)
    {
        $this->registerMenu();
        $this->generalSettings();
        $this->socialNetworks();

        return $next($request);
    }

    protected function registerMenu()
    {
        /**
         * Register to dashboard menu
         */
        dashboard_menu()->registerItem([
            'id' => 'webed-dashboard',
            'priority' => -999,
            'parent_id' => null,
            'heading' => trans('webed-core::base.admin_menu.dashboard.heading'),
            'title' => trans('webed-core::base.admin_menu.dashboard.title'),
            'font_icon' => 'icon-pie-chart',
            'link' => route('admin::dashboard.index.get'),
            'css_class' => null,
        ]);

        dashboard_menu()->registerItem([
            'id' => 'webed-configuration',
            'priority' => 999,
            'parent_id' => null,
            'heading' => trans('webed-core::base.admin_menu.configuration.heading'),
            'title' => trans('webed-core::base.admin_menu.configuration.title'),
            'font_icon' => 'icon-settings',
            'link' => route('admin::settings.index.get'),
            'css_class' => null,
        ]);
    }

    protected function generalSettings()
    {
        cms_settings()
            ->addSettingField('site_title', [
                'group' => 'basic',
                'type' => 'text',
                'priority' => 5,
                'label' => trans('webed-core::base.settings.site_title.label'),
                'helper' => trans('webed-core::base.settings.site_title.helper')
            ], function () {
                return [
                    'site_title',
                    get_setting('site_title'),
                    ['class' => 'form-control']
                ];
            })
            ->addSettingField('site_logo', [
                'group' => 'basic',
                'type' => 'selectImageBox',
                'priority' => 5,
                'label' => trans('webed-core::base.settings.site_logo.label'),
                'helper' => trans('webed-core::base.settings.site_logo.helper')
            ], function () {
                return [
                    'site_logo',
                    get_setting('site_logo'),
                    null,
                    trans('webed-core::base.form.choose_image'),
                ];
            })
            ->addSettingField('favicon', [
                'group' => 'basic',
                'type' => 'selectImageBox',
                'priority' => 5,
                'label' => trans('webed-core::base.settings.favicon.label'),
                'helper' => trans('webed-core::base.settings.favicon.helper'),
            ], function () {
                return [
                    'favicon',
                    get_setting('favicon'),
                    null,
                    trans('webed-core::base.form.choose_image'),
                ];
            })
            ->addSettingField('construction_mode', [
                'group' => 'advanced',
                'type' => 'customCheckbox',
                'priority' => 5,
                'label' => null,
                'helper' => trans('webed-core::base.settings.construction_mode.helper'),
            ], function () {
                return [
                    [['construction_mode', '1', trans('webed-core::base.settings.construction_mode.label'), get_setting('construction_mode'),]],
                ];
            })
            ->addSettingField('show_admin_bar', [
                'group' => 'advanced',
                'type' => 'customCheckbox',
                'priority' => 5,
                'label' => null,
                'helper' => trans('webed-core::base.settings.show_admin_bar.helper')
            ], function () {
                return [
                    [['show_admin_bar', '1', trans('webed-core::base.settings.show_admin_bar.label'), get_setting('show_admin_bar')]],
                ];
            });
    }

    protected function socialNetworks()
    {
        cms_settings()->addGroup('socials', trans('webed-core::base.setting_group.socials'));

        $socials = [
            'facebook' => [
                'label' => trans('webed-core::base.settings.socials.facebook'),
            ],
            'youtube' => [
                'label' => trans('webed-core::base.settings.socials.youtube'),
            ],
            'twitter' => [
                'label' => trans('webed-core::base.settings.socials.twitter'),
            ],
            'google_plus' => [
                'label' => trans('webed-core::base.settings.socials.google_plus'),
            ],
            'instagram' => [
                'label' => trans('webed-core::base.settings.socials.instagram'),
            ],
            'linkedin' => [
                'label' => trans('webed-core::base.settings.socials.linkedin'),
            ],
            'flickr' => [
                'label' => trans('webed-core::base.settings.socials.flickr'),
            ],
        ];
        foreach ($socials as $key => $row) {
            cms_settings()->addSettingField($key, [
                'group' => 'socials',
                'type' => 'text',
                'priority' => 1,
                'label' => $row['label'],
                'helper' => null
            ], function () use ($key) {
                return [
                    $key,
                    get_setting($key),
                    [
                        'class' => 'form-control',
                        'placeholder' => 'https://',
                        'autocomplete' => 'off'
                    ]
                ];
            });
        }
    }
}
