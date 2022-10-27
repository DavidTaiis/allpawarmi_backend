<?php

namespace App\Repositories;

use App\Models\Image;
use App\Models\ImageParameter;
use App\Models\Shared;
use Illuminate\Support\Facades\Auth;
use App\Repositories\LevelRepository;

class SharedRepository
{
    public function getShared(){
        $shareds = Shared::query();
        $shareds->with(['user']);
    return $shareds->get() ?? null;

    }
    public function getSharedId($id)
    {
        $shared = Shared::query()->find($id);
        return $shared ?? null;
    }

    public function addShared($input)
    {
        $userId = Auth::user()->id;
       $shared = new Shared();
       $shared->name =  $input["name"];
       $shared->meeting_point =  $input["meeting_point"];
       $shared->date =  $input["date"];
       $shared->hour =  $input["hour"];
       $shared->status =  $input["status"];
       $shared->users_id =  $userId;
        $shared->save();

    }
    
}
