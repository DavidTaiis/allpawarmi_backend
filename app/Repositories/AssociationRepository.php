<?php

namespace App\Repositories;

use App\Models\Image;
use App\Models\ImageParameter;
use App\Models\Association;
use Illuminate\Support\Facades\Auth;

class AssociationRepository
{

    public function getAssociationById(){
        $userId = Auth::user()->id;
        $association  = Association::query();
        $association->where("users_id", $userId );
        
        return $association->get() ?? null;

    }
    public function updateAssociation($input)
    {
        $userId = Auth::user()->id;
       $association = Association::query()
       ->where("users_id", $userId)->first() ?? new Association();
       $association->name = $input["name"];
       $association->lat = $input["lat"];
       $association->lng = $input["lng"];
       $association->advantages = $input["advantages"];
       $association->rules = $input["rules"];
       $association->users_id = $userId;
        $association->save();

    }
}
