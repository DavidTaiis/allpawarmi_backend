<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Processes\NotificationProcess;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    /**
     * @var NotificationProcess
     */
    private $notificationProcess;

    /**
     * 
     * @param NotificationProcess
     */
    public function __construct(NotificationProcess $notificationProcess)
    {
        $this->notificationProcess = $notificationProcess;
    }

    public function addNotification(Request $request)
    {
        return $this->notificationProcess->addNotification($request);
    }

    public function getNotifications()
    {
        return $this->notificationProcess->getNotifications();
    }

}
