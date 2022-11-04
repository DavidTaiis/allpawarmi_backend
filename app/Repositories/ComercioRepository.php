<?php

namespace App\Repositories;

use App\Models\Image;
use App\Models\ImageParameter;
use App\Models\Comercio;
use Illuminate\Support\Facades\Auth;
use App\Repositories\LevelRepository;

class ComercioRepository
{
    public function getComercios(){
        $comercios = Comercio::query();

    return $comercios->get() ?? null;

    }
      
}
