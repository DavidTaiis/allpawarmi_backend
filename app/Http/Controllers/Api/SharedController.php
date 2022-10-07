<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Processes\SharedProcess;
use Illuminate\Http\Request;

class SharedController extends Controller
{

    /**
     * @var SharedProcess
     */
    private $associationProcess;

    /**
     * 
     * @param SharedProcess
     */
    public function __construct(SharedProcess $sharedProcess)
    {
        $this->sharedProcess = $sharedProcess;
    }

    public function addShared(Request $request)
    {
        return $this->sharedProcess->addShared($request);
    }
    

    public function getShared()
    {
        return $this->sharedProcess->getShared();
    }
}
