<?php namespace WebEd\Base\Support;

class AdminBar
{
    /**
     * @var array
     */
    protected $groups = [];

    /**
     * @var array
     */
    protected $noGroupLinks = [];

    public function __construct()
    {
        $this->groups = [
            'appearance' => [
                'link' => 'javascript:;',
                'title' => trans('webed-core::admin_bar.appearance'),
                'items' => [
                    trans('webed-core::admin_bar.menus') => route('admin::menus.index.get'),
                    trans('webed-core::admin_bar.settings') => route('admin::settings.index.get'),
                    trans('webed-core::admin_bar.theme_options') => route('admin::theme-options.index.get'),
                ],
            ],
            'add-new' => [
                'link' => 'javascript:;',
                'title' => trans('webed-core::admin_bar.add_new'),
                'items' => [
                    trans('webed-core::admin_bar.user') => route('admin::users.create.get'),
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public function getGroups()
    {
        return $this->groups;
    }

    public function getLinksNoGroup()
    {
        return $this->noGroupLinks;
    }

    /**
     * @param $slug
     * @param $title
     * @param string $link
     * @return $this
     */
    public function registerGroup($slug, $title, $link = 'javascript:;')
    {
        if (isset($this->groups[$slug])) {
            return $this;
        }
        $this->groups[$slug] = [
            'title' => $title,
            'link' => $link,
            'items' => [

            ],
        ];
        return $this;
    }

    /**
     * @param $title
     * @param $url
     * @param null $group
     * @return $this
     */
    public function registerLink($title, $url, $group = null)
    {
        if ($group === null || !isset($this->groups[$group])) {
            $this->noGroupLinks[] = [
                'link' => $url,
                'title' => $title,
            ];
        } else {
            $this->groups[$group]['items'][$title] = $url;
        }
        return $this;
    }

    /**
     * @return string
     */
    public function render()
    {
        return view('webed-core::front._admin-bar')->render();
    }
}
