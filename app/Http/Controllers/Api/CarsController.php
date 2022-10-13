<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Processes\CarsProcess;
use Illuminate\Http\Request;

class CarsController extends Controller
{

    /**
     * @var CarsProcess
     */
    private $carsProcess;

    /**
     * 
     * @param CarsProcess
     */
    public function __construct(CarsProcess $carsProcess)
    {
        $this->carsProcess = $carsProcess;
    }
    
    public function getCamionetas()
    {
        return $this->carsProcess->getCamionetas();
    }
    public function getPrivado()
    {
        return $this->carsProcess->getPrivado();
    }
    public function getCamionetaId($id)
    {
        return $this->carsProcess->getCamionetaId($id);
    }
}
