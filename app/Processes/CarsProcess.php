<?php

namespace App\Processes;

use App\Http\Resources\CarsResource;
use App\Models\Image;
use App\Models\Cars;
use App\Models\Users;
use App\Repositories\CarsRepository;
use App\Validators\CarsValidator;

use Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class CarsProcess
{
    /**
     * @var CarsRepository
     */
    private $carsValidator;
    private $carsRepository;

 
    public function __construct( CarsRepository $carsRepository)
    {
       
        $this->carsRepository = $carsRepository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */

    public function getCamionetas()
    {
        $camionetas = $this->carsRepository->getCamionetas();
        CarsResource::withoutWrapping();
        return CarsResource::collection($camionetas);
    }
    public function getPrivado()
    {
        $privado = $this->carsRepository->getPrivado();
        CarsResource::withoutWrapping();
        return CarsResource::collection($privado);
    }

    public function getCamionetaId($id){
        $camioneta = $this->carsRepository->getCamionetaId($id);
        CarsResource::withoutWrapping();
        return new CarsResource($camioneta);
    }
}
