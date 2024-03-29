<?php

namespace App\Repositories;

use App\Models\Image;
use App\Models\ImageParameter;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationRepository
{
    public function addNotification($input)
    {
        $userId = Auth::user()->id;
       $notification = new Notification();
       $notification->lat =  $input["lat"];
       $notification->lng =  $input["lng"];
       $notification->type =  $input["type"];
       $notification->description =  $input["description"];
       $notification->users_id =  $userId;
        $notification->save();

    }

    public function getNotifications(){
        $notifications  = Notification::query();
        return $notifications->get() ?? null;
    }
}
