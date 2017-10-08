<?php namespace WebEd\Base\Hook;

use Illuminate\Http\Request;

class StoreSettingsHook
{
    /**
     * @var Request
     */
    protected $request;

    public function __construct()
    {
        $this->request = request();
    }

    /**
     * @param $data
     * @param $screenName
     * @param null $action
     * @return mixed
     */
    public function execute($data, $screenName, $action = null)
    {
        if ($screenName !== WEBED_SETTINGS) {
            return $data;
        }

        if ($this->request->input('_tab') === 'advanced' && $action === 'edit.post') {
            $data['construction_mode'] = (int)($this->request->has('construction_mode'));
            $data['show_admin_bar'] = (int)($this->request->has('show_admin_bar'));
        }

        return $data;
    }
}
