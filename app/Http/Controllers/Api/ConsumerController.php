<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Processes\ConsumerProcess;
use Illuminate\Http\Request;

class ConsumerController extends Controller
{

    /**
     * @var ConsumerProcess
     */
    private $consumerProcess;

    /**
     * 
     * @param ConsumerProcess
     */
    public function __construct(ConsumerProcess $consumerProcess)
    {
        $this->consumerProcess = $consumerProcess;
    }

    public function getFarmers()
    {
        return $this->consumerProcess->getFarmers();
    }
    public function getProductsByFarmer($farmerId)
    {
        return $this->consumerProcess->getProductsByFarmer($farmerId);
    }
    public function getProductById($productId)
    {
        return $this->consumerProcess->getProductById($productId);
    }

}
