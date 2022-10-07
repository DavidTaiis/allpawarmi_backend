<?php

namespace App\Processes;

use App\Http\Resources\BusesLineResource;
use App\Models\Image;
use App\Models\User;
use App\Processes\ImageProcess;
use App\Repositories\BusesLineRepository;
use Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class BusesLineProcess
{
    /**
     * @var BusesLineRepository
     */
    private $busesLineRepository;

   
    public function __construct(BusesLineRepository $busesLineRepository)
    {
        $this->busesLineRepository = $busesLineRepository;
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
   
}
