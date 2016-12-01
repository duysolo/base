<?php namespace WebEd\Base\Core\Http\ViewComposers;

use Illuminate\View\View;

class AdminBar
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('loggedInUser', request()->user());
    }
}
