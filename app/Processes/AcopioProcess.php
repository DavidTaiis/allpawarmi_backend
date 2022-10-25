<?php

namespace App\Processes;

use App\Http\Resources\AcopioResource;
use App\Models\Image;
use App\Models\User;
use App\Processes\ImageProcess;
use App\Repositories\UserRepository;
use App\Repositories\AcopioRepository;
use Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class AcopioProcess
{
    /**
     * @var AcopioRepository
     */
    private $acopioRepository;

   
    public function __construct(AcopioRepository $acopioRepository)
    {
        $this->acopioRepository = $acopioRepository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */

    public function getAcopios()
    {
        $acopios = $this->acopioRepository->getAcopios();
        AcopioResource::withoutWrapping();
        return AcopioResource::collection($acopios);
    }

    public function  getAcopioId()
    {
        $acopio = $this->acopioRepository->getAcopioId();
        AcopioResource::withoutWrapping();
        return AcopioResource::collection($acopio);
    }
   
    public function addAcopio($request)
    {
        $input = $request->all();
        $this->acopioRepository->addAcopio($input);
        
        return Response::json([
            'status' => 'success',
            'message' => '! Centro de acopio creada correctamente.!',
        ], 200);
    }
}
