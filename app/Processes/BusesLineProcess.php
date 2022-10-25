<?php

namespace App\Processes;

use App\Http\Resources\BusesLineResource; 
use App\Http\Resources\StopResource;
use App\Http\Resources\StopBasicResource;
use App\Models\Image;
use App\Models\User;
use App\Processes\ImageProcess;
use App\Repositories\BusesLineRepository;
use App\Repositories\StopRepository;
use Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class BusesLineProcess
{
    /**
     * @var BusesLineRepository
     */
    private $busesLineRepository;

    /**
     * @var StopRepository
     */
    private $stopRepository;

   
    public function __construct(BusesLineRepository $busesLineRepository,StopRepository $stopRepository)
    {
        $this->busesLineRepository = $busesLineRepository;
        $this->stopRepository = $stopRepository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */

    public function getBusesLine()
    {
        $buses = $this->busesLineRepository->getBusesLine();
        BusesLineResource::withoutWrapping();
        return BusesLineResource::collection($buses);
    }

    public function  getBusesLineId($busesLineId)
    {
        $bus = $this->busesLineRepository->getAcopioId($busesLineId);
        BusesLineResource::withoutWrapping();
        return BusesLineResource::make($bus);
    }

    public function getStops()
    {
        $stops = $this->stopRepository->getStops();
        StopResource::withoutWrapping();
        return StopResource::collection($stops);
    } 
   
    public function getLineBusesWithStops($idLineBus)
    {
        $busLine =[];
        $lineBus = $this->busesLineRepository->getBusesLineId($idLineBus);
        $stops = $this->stopRepository->getStopsByLineBus($idLineBus);
        StopBasicResource::withoutWrapping();
        if ($lineBus == null){
            return;
        }
        return [
            "id" => $lineBus->id,
            "name" => $lineBus->name,
            "descripcion" => $lineBus->description,
            "latInit" => $lineBus->lat_init,
            "lngInit" => $lineBus->lng_init,
            "latFinish" => $lineBus->lat_finish,
            "lngFinish" => $lineBus->lng_finish,
            "price" => $lineBus->price,
            "stops" => StopBasicResource::collection($stops)
        ];
        
        
        
    }
}
