<?php

namespace App\Repositories;

use App\Models\Image;
use App\Models\ImageParameter;
use App\Models\BusesLine;
use Illuminate\Support\Facades\Auth;
use App\Repositories\LevelRepository;

class BusesLineRepository
{
    public function getBusesLine(){
        $buses = BusesLine::query();

    return $buses->get() ?? null;

    }
    public function getBusesLineId($id)
    {
        $bus = BusesLine::query()->find($id);
        return $bus ?? null;
    }

    
}
