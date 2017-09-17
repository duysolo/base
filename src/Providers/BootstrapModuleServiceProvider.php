<?php namespace WebEd\Base\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use WebEd\Base\Events\SessionStarted;

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
            ->addSettingField('app_name', [
                'group' => 'basic',
                'type' => 'text',
                'priority' => 6,
                'label' => trans('webed-core::base.settings.app_name.label'),
                'helper' => trans('webed-core::base.settings.app_name.helper')
            ], function () {
                return [
                    'app_name',
                    get_setting('app_name') ?: config('app.name'),
                    ['class' => 'form-control']
                ];
            })
            ->addSettingField('site_logo', [
                'group' => 'basic',
                'type' => 'selectImageBox',
                'priority' => 7,
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
                'priority' => 8,
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

        cms_settings()
            ->addGroup('smtp', 'SMTP', 4)
            ->addSettingField('smtp_driver', [
                'group' => 'smtp',
                'type' => 'text',
                'priority' => 1,
                'label' => trans('webed-core::base.settings.smtp.smtp_driver.label'),
                'helper' => trans('webed-core::base.settings.smtp.smtp_driver.helper'),
            ], function () {
                return [
                    'smtp_driver',
                    get_setting('smtp_driver', config('mail.driver')),
                    ['class' => 'form-control']
                ];
            })
            ->addSettingField('smtp_host', [
                'group' => 'smtp',
                'type' => 'text',
                'priority' => 1,
                'label' => trans('webed-core::base.settings.smtp.smtp_host.label'),
                'helper' => trans('webed-core::base.settings.smtp.smtp_host.helper'),
            ], function () {
                return [
                    'smtp_host',
                    get_setting('smtp_host', config('mail.host')),
                    ['class' => 'form-control']
                ];
            })
            ->addSettingField('smtp_port', [
                'group' => 'smtp',
                'type' => 'text',
                'priority' => 1,
                'label' => trans('webed-core::base.settings.smtp.smtp_port.label'),
                'helper' => trans('webed-core::base.settings.smtp.smtp_port.helper'),
            ], function () {
                return [
                    'smtp_port',
                    get_setting('smtp_port', config('mail.port')),
                    ['class' => 'form-control']
                ];
            })
            ->addSettingField('smtp_encryption', [
                'group' => 'smtp',
                'type' => 'text',
                'priority' => 1,
                'label' => trans('webed-core::base.settings.smtp.smtp_encryption.label'),
                'helper' => trans('webed-core::base.settings.smtp.smtp_encryption.helper'),
            ], function () {
                return [
                    'smtp_encryption',
                    get_setting('smtp_encryption', config('mail.encryption')),
                    ['class' => 'form-control']
                ];
            })
            ->addSettingField('smtp_from_address', [
                'group' => 'smtp',
                'type' => 'text',
                'priority' => 1,
                'label' => trans('webed-core::base.settings.smtp.smtp_from_address.label'),
                'helper' => trans('webed-core::base.settings.smtp.smtp_from_address.helper'),
            ], function () {
                return [
                    'smtp_from_address',
                    get_setting('smtp_from_address', config('mail.from.address')),
                    ['class' => 'form-control']
                ];
            })
            ->addSettingField('smtp_from_name', [
                'group' => 'smtp',
                'type' => 'text',
                'priority' => 1,
                'label' => trans('webed-core::base.settings.smtp.smtp_from_name.label'),
                'helper' => trans('webed-core::base.settings.smtp.smtp_from_name.helper'),
            ], function () {
                return [
                    'smtp_from_name',
                    get_setting('smtp_from_name', config('mail.from.name')),
                    ['class' => 'form-control']
                ];
            })
            ->addSettingField('smtp_username', [
                'group' => 'smtp',
                'type' => 'text',
                'priority' => 1,
                'label' => trans('webed-core::base.settings.smtp.smtp_username.label'),
                'helper' => trans('webed-core::base.settings.smtp.smtp_username.helper'),
            ], function () {
                return [
                    'smtp_username',
                    get_setting('smtp_username', config('mail.username')),
                    ['class' => 'form-control']
                ];
            })
            ->addSettingField('smtp_password', [
                'group' => 'smtp',
                'type' => 'text',
                'priority' => 1,
                'label' => trans('webed-core::base.settings.smtp.smtp_password.label'),
                'helper' => trans('webed-core::base.settings.smtp.smtp_password.helper'),
            ], function () {
                return [
                    'smtp_password',
                    get_setting('smtp_password', config('mail.password')),
                    ['class' => 'form-control']
                ];
            });

        config([
            /**
             * Mail config
             */
            'mail.driver' => get_setting('smtp_driver', config('mail.driver')),
            'mail.host' => get_setting('smtp_host', config('mail.host')),
            'mail.port' => get_setting('smtp_port', config('mail.port')),
            'mail.from.address' => get_setting('smtp_from_address', config('mail.from.address')),
            'mail.from.name' => get_setting('smtp_from_name', config('mail.from.name')),
            'mail.encryption' => get_setting('smtp_encryption', config('mail.encryption')),
            'mail.username' => get_setting('smtp_username', config('mail.username')),
            'mail.password' => get_setting('smtp_password', config('mail.password')),

            /**
             * App name
             */
            'app.name' => get_setting('app_name') ?: config('app.name', 'WebEd CMS'),
        ]);
    }
}
