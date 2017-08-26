<?php namespace WebEd\Base\Events;

use Illuminate\Foundation\Events\Dispatchable;

class SessionStarted
{
    use Dispatchable;

    /**
     * @var \Illuminate\Session\Store
     */
    public $session;

    public function __construct($session)
    {
        $this->session = $session;
    }
}
