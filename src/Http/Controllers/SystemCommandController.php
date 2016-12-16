<?php namespace WebEd\Base\Core\Http\Controllers;

class SystemCommandController extends BaseAdminController
{
    protected $module = 'webed-core';

    /**
     * Call command composer dump-autoload
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getCallDumpAutoload()
    {
        modules_management()->refreshComposerAutoload();
        $this->flashMessagesHelper
            ->addMessages('Composer autoload refreshed', 'success')
            ->showMessagesOnSession();

        return redirect()->back();
    }
}
