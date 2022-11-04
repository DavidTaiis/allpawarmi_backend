<?php

namespace App\Processes;

use App\Http\Resources\ComercioResource;
use App\Models\Image;
use App\Models\User;
use App\Processes\ImageProcess;
use App\Repositories\UserRepository;
use App\Repositories\ComercioRepository;
use Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class ComercioProcess
{
    /**
     * @var ComercioRepository
     */
    private $comercioRepository;

   
    public function __construct(ComercioRepository $comercioRepository)
    {
        $this->comercioRepository = $comercioRepository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */

    public function getComercios()
    {
        $comercios = $this->comercioRepository->getComercios();
        ComercioResource::withoutWrapping();
        return ComercioResource::collection($comercios);
    }

}
