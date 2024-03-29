<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Processes\OrderProcess;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    /**
     * @var OrderProcess
     */
    private $orderProcess;

    /**
     * 
     * @param OrderProcess
     */
    public function __construct(OrderProcess $orderProcess)
    {
        $this->orderProcess = $orderProcess;
    }

    public function createOrder(Request $request)
    {
        return $this->orderProcess->createOrder($request);
    }
    public function getOrdersByConsumerId()
    {
        return $this->orderProcess->getOrdersByConsumerId();
    }

    public function getProductsOrder($orderId)
    {
        return $this->orderProcess->getProductsOrder($orderId);
    }
    
    public function updateStatus(Request $request){
        return $this->orderProcess->updateStatus($request);
    }
    public function getOrdersBySeller()
    {
        return $this->orderProcess->getOrdersBySeller();
    }
    public function getOrders()
    {
        return $this->orderProcess->getOrders();
    }
}
