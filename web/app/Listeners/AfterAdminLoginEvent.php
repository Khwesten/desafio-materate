<?php

namespace App\Listeners;

use App\Notification;
use App\SessionLog;


/**
 * Created by IntelliJ IDEA.
 * User: k-heiner@hotmail.com
 * Date: 27/01/2017
 * Time: 18:57
 */
class AfterAdminLoginEvent
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(){}

    /**
     * Handle the event.
     *
     * @param  AdminUserLoggedIn  $event
     * @return void
     */
    public function loginHandle($event)
    {
        @session_start();

        $user = $event->user;

        $session = new SessionLog();
        $session->login_date = date("Y-m-d H:i:s");
        $session->user_id = $user->id;
        $session->save();

        $_SESSION['sessionsIds'][$user->id] = $session->id;
    }

    /**
     * Handle the event.
     *
     * @param  AdminUserLogoutIn  $event
     * @return void
     */
    public function logoutHandle($event)
    {
        @session_start();

        $user = $event->user;

        $sessionId = $_SESSION['sessionsIds'][$user->id];

        $sessionLog = SessionLog::find($sessionId);
        $sessionLog->logout_date = date("Y-m-d H:i:s");
        $sessionLog->save();
    }

    public function loginAppHandle($event)
    {
        $user = $event->user;

        $session = new SessionLog();
        $session->login_date = date("Y-m-d H:i:s");
        $session->user_id = $user->id;
        $session->save();

        $user->last_session = $session->id;
        $user->save();
    }

    public function logoutAppHandle($event)
    {
        $user = $event->user;

        $sessionLog = SessionLog::find($user->lastSession);
        $sessionLog->logout_date = date("Y-m-d H:i:s");
        $sessionLog->save();

        $user->last_session = null;
        $user->save();
    }
}