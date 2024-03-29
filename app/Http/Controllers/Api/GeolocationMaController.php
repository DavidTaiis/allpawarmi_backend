<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Processes\GeolocationMaProcess;
use Illuminate\Http\Request;

class GeolocationMaController extends Controller
{

    /**
     * @var GeolocationMaProcess
     */
    private $geolocationMaProcess;

    /**
     * 
     * @param GeolocationMaProcess
     */
    public function __construct(GeolocationMaProcess $geolocationMaProcess)
    {
        $this->geolocationMaProcess = $geolocationMaProcess;
    }

    public function addGeolocation(Request $request)
    {
        return $this->geolocationMaProcess->addGeolocation($request);
    }
    
    public function getGeolocationFarmers()
    {
        return $this->geolocationMaProcess->getGeolocationFarmers();
    }

    public function getGeolocationFarmerId($id)
    {
        return $this->geolocationMaProcess->getGeolocationFarmerId($id);
    }
    public function getSellerPoits()
    {
        return $this->geolocationMaProcess->getSellerPoits();
    }

    public function getGeolocationConsumer($id)
    {
        return $this->geolocationMaProcess->getGeolocationConsumer($id);
    }
}
