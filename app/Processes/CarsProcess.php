<?php

namespace App\Processes;

use App\Http\Resources\CarsResource;
use App\Http\Resources\PrivadoResource;
use App\Models\Image;
use App\Models\Cars;
use App\Models\Users;
use App\Repositories\CarsRepository;
use App\Validators\CarsValidator;
use Illuminate\Support\Facades\DB;
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
    public function getRoutesPrivate()
    {
        $privado = $this->carsRepository->getRoutesPrivate();
        PrivadoResource::withoutWrapping();
        return PrivadoResource::collection($privado);
    }

    public function getCamionetaId($id){
        $camioneta = $this->carsRepository->getCamionetaId($id);
        CarsResource::withoutWrapping();
        return new CarsResource($camioneta);
    }
    public function addCamioneta($request)
    {
        $input = $request->all();
        $this->carsRepository->addCamioneta($input);
        
        return Response::json([
            'status' => 'success',
            'message' => '! Camioneta creada correctamente.!',
        ], 200);
    }
    public function getCamionetaAuth(){
        $camioneta = $this->carsRepository->getCamionetaAuth();
        CarsResource::withoutWrapping();
        return CarsResource::collection($camioneta);
    }

    public function addRoutePrivate($request){
    /*     try {
            DB::beginTransaction();  */
            $userId = Auth::user()->id;
            $input = $request->all();
            $car = $this->carsRepository->addCar($input, $userId);
            $route = $this->carsRepository->addRoute($input, $car->id);
            foreach (($input['geolocation']) as $geolocation) {
               $geo = $this->carsRepository->addGeolocation($geolocation);
               $this->carsRepository->addRouteTransport($geo->id, $route->id);
            }
            DB::commit();
            return Response::json([
                'status' => 'success',
                'message' => '! Orden creada exitosamente!',
            ], 200);

 /*         } catch (\Exception $e) {
            DB::rollback();
            return Response::json([
                'status' => 'failed',
                'message' => '! Algo sucedio!',
            ], 404);
        }   */
    }
}
