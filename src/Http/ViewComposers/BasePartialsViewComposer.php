<?php namespace WebEd\Base\Core\Http\ViewComposers;

use Illuminate\View\View;

class BasePartialsViewComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('loggedInUser', request()->user());
    }
}
