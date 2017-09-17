<?php namespace NewsTV\Http\ViewComposers;

use Illuminate\View\View;

class HttpErrorsViewComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        breadcrumbs()
            ->setBreadcrumbClass('breadcrumb')
            ->addLink(trans('webed-theme::base.home'), '/', '<i class="fa fa-home" style="margin-right: 5px;"></i>')
            ->addLink('Error');
    }
}
