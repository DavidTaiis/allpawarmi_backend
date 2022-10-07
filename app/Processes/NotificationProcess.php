<?php

namespace App\Processes;

use App\Http\Resources\NotificationResource;
use App\Models\Image;
use App\Models\Notification;
use App\Models\Users;
use App\Repositories\NotificationRepository;
use App\Repositories\userRepository;
use App\Validators\NotificationValidator;

use Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class NotificationProcess
{
    /**
     * @var NotificationRepository
     */
    private $notificationValidator;
    private $notificationRepository;

 
    public function __construct(NotificationValidator $notificationValidator, NotificationRepository $notificationRepository)
    {
        $this->notificationValidator = $notificationValidator;
        $this->notificationRepository = $notificationRepository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */

    public function addNotification($request)
    {
        $input = $request->all();
        $this->notificationValidator->addNotification($input);
        $this->notificationRepository->addNotification($input);
        
        return Response::json([
            'status' => 'success',
            'message' => '! Notificación creada correctamente.!',
        ], 200);
    }
   
}
