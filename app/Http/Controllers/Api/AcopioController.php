<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Processes\AcopioProcess;
use Illuminate\Http\Request;

class AcopioController extends Controller
{

    /**
     * @var AcopioProcess
     */
    private $acopioProcess;

    /**
     * 
     * @param AcopioProcess
     */
    public function __construct(AcopioProcess $acopioProcess)
    {
        $this->acopioProcess = $acopioProcess;
    }

    public function getAcopios()
    {
        return $this->acopioProcess->getAcopios();
    }

    public function getAcopioId($acopioId)
    {
        return $this->acopioProcess->getAcopioId($acopioId);
    }
    public function addAcopio(Request $request)
    {
        return $this->acopioProcess->addAcopio($request);
    }

}
