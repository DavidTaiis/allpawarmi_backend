<?php

namespace App\Processes;

use App\Http\Resources\GeolocationMaResource;
use App\Models\Image;
use App\Models\GeolocationMa;
use App\Models\Users;
use App\Repositories\GeolocationMaRepository;
use App\Validators\GeolocationMaValidator;

use Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class GeolocationMaProcess
{
    /**
     * @var GeolocationMaRepository
     */
    private $geolocationMaValidator;
    private $geolocationMaRepository;

 
    public function __construct(GeolocationMaValidator $geolocationMaValidator, GeolocationMaRepository $geolocationMaRepository)
    {
        $this->geolocationMaValidator = $geolocationMaValidator;
        $this->geolocationMaRepository = $geolocationMaRepository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */

    public function addGeolocation($request)
    {
        $userId = Auth::user()->id;
        $name = Auth::user()->name;
        $input = $request->all();
        $this->geolocationMaValidator->addGeolocation($input);
        $this->geolocationMaRepository->addGeolocation($input, $userId,$name);
        
        return Response::json([
            'status' => 'success',
            'message' => '! Ubicación registrada exitosamente!',
        ], 200);
    }
    public function getGeolocationFarmers()
    {
        $geolocation = $this->geolocationMaRepository->getGeolocationFarmers();
        GeolocationMaResource::withoutWrapping();
        return GeolocationMaResource::collection($geolocation);
    }
}
