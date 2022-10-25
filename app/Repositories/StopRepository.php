<?php

namespace App\Repositories;

use App\Models\Image;
use App\Models\ImageParameter;
use App\Models\Stop;
use Illuminate\Support\Facades\Auth;
use App\Repositories\LevelRepository;

class StopRepository
{
    public function getStops(){
        $stops = Stop::query();

    return $stops->get() ?? null;
    }
    public function getStopsByLineBus($idLineBus){
        $stops = Stop::query();
        $stops->where('buses_linea_id', $idLineBus);

    return $stops->get() ?? null;
    }
}
