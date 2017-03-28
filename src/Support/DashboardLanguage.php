<?php namespace WebEd\Base\Support;

class DashboardLanguage
{
    /**
     * @var \Illuminate\Foundation\Application|mixed
     */
    protected $app;

    public function __construct()
    {
        $this->app = app();
    }

    /**
     * @param $slug
     * @return $this
     */
    public function setDashboardLanguage($slug)
    {
        $this->app->setLocale($slug);
        session(['dashboard_language' => $slug]);

        return $this;
    }

    public function getDashboardLanguage($default = null)
    {
        return session('dashboard_language', $default ?: $this->app->getLocale());
    }
}
