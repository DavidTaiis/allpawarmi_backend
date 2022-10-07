<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Processes\BusesLineProcess;
use Illuminate\Http\Request;

class BusesLineController extends Controller
{

    /**
     * @var BusesLineProcess
     */
    private $busesLineProcess;

    /**
     * 
     * @param AcopioProcess
     */
    public function __construct(BusesLineProcess $busesLineProcess)
    {
        $this->busesLineProcess = $busesLineProcess;
    }

    public function getBusesLine()
    {
        return $this->busesLineProcess->getBusesLine();
    }


}
