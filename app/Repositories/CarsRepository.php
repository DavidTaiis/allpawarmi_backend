<?php

namespace App\Repositories;

use App\Models\Image;
use App\Models\ImageParameter;
use App\Models\Cars;
use Illuminate\Support\Facades\Auth;
use App\Models\MeasureProduct;

class CarsRepository
{
   
    public function getCamionetas(){
        $camioneta  = Cars::query();
        $camioneta->with(['user']);
        return $camioneta->get() ?? null;

    }
    public function getPrivado(){
        $privado  = Cars::query();
        $privado->where('type','Privado');
        $privado->with(['user']);
        return $privado->get() ?? null;

    }
}
