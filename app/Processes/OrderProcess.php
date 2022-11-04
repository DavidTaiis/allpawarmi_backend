<?php

namespace App\Processes;

use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderDetaillsResource;
use App\Http\Resources\OrderProductResource;
use App\Models\Image;
use App\Models\Order;
use App\Models\ProductOrder;
use App\Models\Users;
use App\Models\Product;
use App\Repositories\OrderRepository;
use App\Repositories\GeolocationMaRepository;
use Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class OrderProcess
{
    /**
     * @var OrderRepository
     */

    private $orderRepository;
    private $geolocationMaRepository;


 
    public function __construct( OrderRepository $orderRepository ,GeolocationMaRepository $geolocationMaRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->geolocationMaRepository = $geolocationMaRepository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */

    public function createOrder($request)
    {
         try {
            DB::beginTransaction();
            $userId = Auth::user()->id;
            $input = $request->all();
            $order = $this->orderRepository->createOrder($input, $userId);
            foreach ($input['products'] as $products) {
                $this->orderRepository->createProductOrder($order, $products,$userId);
            }
            DB::commit();
            return Response::json([
                'status' => 'success',
                'message' => '! Orden creada exitosamente!',
            ], 200);

        } catch (\Exception $e) {
            DB::rollback();
            return Response::json([
                'status' => 'failed',
                'message' => '! Algo sucedio!',
            ], 404);
        } 
      
    }
    public function getOrdersByConsumerId(){
       
        $orders = $this->orderRepository->getOrdersByConsumerId();
        OrderResource::withoutWrapping();
        return OrderResource::collection($orders);
    }
    public function getOrdersBySeller(){
       
        $orders = $this->orderRepository->getOrdersBySeller();
        OrderResource::withoutWrapping();
        return OrderResource::collection($orders);
    }

    public function getProductsOrder($orderId){
        
        $orders = $this->orderRepository->getProductsOrder($orderId);
        OrderProductResource::withoutWrapping();
        return new OrderProductResource($orders);

    }

    public function updateStatus($request){
        $input = $request->all();
        $this->orderRepository->updateStatus($input);
        
        return Response::json([
            'status' => 'success',
            'message' => '! Actualizada correctamente.!',
        ], 200);
    }
    public function getOrders(){
       
        $orders = $this->orderRepository->getOrders();
        OrderResource::withoutWrapping();
        return OrderResource::collection($orders);
    }
}
