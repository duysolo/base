<?php namespace WebEd\Base\Http\Controllers;

use WebEd\Base\ModulesManagement\Actions\UpdateCMSAction;

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
        flash_messages()
            ->addMessages('Composer autoload refreshed', 'success')
            ->showMessagesOnSession();

        return redirect()->back();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getUpdateCms(UpdateCMSAction $action)
    {
        $result = $action->run();

        $msgType = $result['error'] ? 'danger' : 'success';

        flash_messages()
            ->addMessages($result['messages'], $msgType)
            ->showMessagesOnSession();

        return redirect()->back();
    }
}
