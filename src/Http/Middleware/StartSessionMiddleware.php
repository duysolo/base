<?php namespace WebEd\Base\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Event;
use Illuminate\Session\Middleware\StartSession as IlluminateStartSession;
use WebEd\Base\Events\SessionStarted;
use WebEd\Base\Facades\DashboardLanguageFacade;

class StartSessionMiddleware extends IlluminateStartSession
{
    /**
     * @param SessionManager $manager
     */
    public function __construct(SessionManager $manager)
    {
        parent::__construct($manager);
    }

    /**
     * Start the session for the given request.
     * @param Request $request
     * @return \Illuminate\Contracts\Session\Session
     */
    protected function startSession(Request $request)
    {
        $session = parent::startSession($request);

        $locale = DashboardLanguageFacade::getDashboardLanguage();

        app()->setLocale($locale);

        Event::fire(new SessionStarted($session));

        return $session;
    }
}
