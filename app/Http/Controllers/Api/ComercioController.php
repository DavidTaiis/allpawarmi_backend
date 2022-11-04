<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Processes\ComercioProcess;
use Illuminate\Http\Request;

class ComercioController extends Controller
{

    /**
     * @var ComercioProcess
     */
    private $comercioProcess;

    /**
     * 
     * @param ComercioProcess
     */
    public function __construct(ComercioProcess $comercioProcess)
    {
        $this->comercioProcess = $comercioProcess;
    }

    public function getComercios()
    {
        return $this->comercioProcess->getComercios();
    }

}
