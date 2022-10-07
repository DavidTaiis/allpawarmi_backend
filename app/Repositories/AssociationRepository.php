<?php

namespace App\Repositories;

use App\Models\Image;
use App\Models\ImageParameter;
use App\Models\Association;
use Illuminate\Support\Facades\Auth;

class AssociationRepository
{

    public function getAssociationById($farmerId){
        $association  = Association::query();
        $association->where("users_id", $farmerId );
        
        return $association->get() ?? null;

    }
    public function updateAssociation($input)
    {
       
       $association = Association::find($input["id"]);
       $association->name = $input["name"];
       $association->lat = $input["lat"];
       $association->lng = $input["lng"];
       $association->advantages = $input["advantages"];
       $association->rules = $input["rules"];
       $association->users_id = $input["users_id"];
        $association->save();

    }
}
