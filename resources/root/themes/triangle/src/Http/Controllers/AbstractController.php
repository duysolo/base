<?php namespace WebEd\Themes\Triangle\Http\Controllers;

use WebEd\Base\Caching\Services\CacheService;
use WebEd\Base\Caching\Services\Contracts\CacheableContract;
use WebEd\Base\Caching\Services\Traits\Cacheable;
use WebEd\Base\Http\Controllers\BaseFrontController;

abstract class AbstractController extends BaseFrontController implements CacheableContract
{
    use Cacheable;

    /**
     * @var CacheService
     */
    protected $cacheService;

    public function __construct()
    {
        parent::__construct();

        $this->cacheEnabled = true;

        $this->cacheService = app(CacheService::class);

        $this->cacheService
            ->setCacheObject($this)
            /**
             * Cache forever
             */
            ->setCacheLifetime(-1)
            ->setCacheDriver('file');

        google_recaptcha()
            ->setLanguage(app()->getLocale())
            ->registerForm('contactFormRecaptcha')
            ->renderScript('front_footer_js');
    }

    /**
     * Override some menu attributes
     *
     * @param $type
     * @param $relatedId
     * @return null|string|mixed
     */
    protected function getMenu($type, $relatedId)
    {
        $menuHtml = $this->cacheService
            ->setCacheKey(__FUNCTION__, func_get_args())
            ->retrieveFromCache(function () use ($type, $relatedId) {
                return webed_render_menu(get_setting('main_menu', 'main-menu'), [
                    'id' => '',
                    'class' => 'nav navbar-nav navbar-right',
                    'container_class' => 'collapse navbar-collapse',
                    'has_sub_class' => 'dropdown',
                    'container_tag' => 'nav',
                    'container_id' => '',
                    'group_tag' => 'ul',
                    'child_tag' => 'li',
                    'submenu_class' => 'sub-menu',
                    'item_class' => '',
                    'active_class' => 'active current-menu-item',
                    'menu_active' => [
                        'type' => $type,
                        'related_id' => $relatedId,
                    ]
                ]);
            });

        view()->share([
            'cmsMenuHtml' => $menuHtml
        ]);
        return $menuHtml;
    }
}
