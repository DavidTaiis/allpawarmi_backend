<?php

namespace App\Repositories;

use App\Models\Image;
use App\Models\ImageParameter;
use App\Models\User;
use App\Models\WalletsByUsers;
use Illuminate\Support\Facades\Auth;
use App\Repositories\LevelRepository;

class UserRepository
{
    public function findById($id)
    {
        return User::query()->find($id);
    }

    public function getUser($identificationCard)
    {
        $user = User::query()
            ->where('identification_card', $identificationCard)
            ->first();

        return $user ?? null;
    }
    public function register($input)
    {
       
       $user = new User();
       $user->name =  $input["name"];
       $user->identification_card =  $input["identification_card"];
       $user->phone_number =  $input["phone_number"];
       $user->is_association =  $input["is_association"] ?? "NO";
       if (isset($input['password'])) {
        $user->password = bcrypt($input['password']);
        }   
        $user->save();
        if (isset($input['role'])) {
        $user->syncRoles($input['role']);
        }
    }

    public function getFarmers(){
        $farmers = User::whereHas('roles', function ($q) {
            $q->where('roles.name', '=', 'Vendedora');
          })->get();

    return $farmers ?? null;

    }
    public function getFarmerId($id)
    {
        $user = User::query()->find($id);
        return $user ?? null;
    }
    
}
