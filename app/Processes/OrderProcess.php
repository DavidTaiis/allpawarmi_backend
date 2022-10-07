<?php

namespace App\Processes;

use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderProductResource;
use App\Models\Image;
use App\Models\Order;
use App\Models\ProductOrder;
use App\Models\Users;
use App\Models\Product;
use App\Repositories\OrderRepository;
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

 
    public function __construct( OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */

    public function createOrder($request)
    {
        try {
            DB::beginTransaction();
            $input = $request->all();
            $order = $this->orderRepository->createOrder($input);
            foreach ($input['products'] as $products) {
                $this->orderRepository->createProductOrder($order, $products);
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
    public function getOrdersByConsumerId($consumerId){
        $orders = $this->orderRepository->getOrdersByConsumerId($consumerId);
        OrderResource::withoutWrapping();
        return OrderResource::collection($orders);

    }
    public function getProductsOrder($orderId){
        $orders = $this->orderRepository->getProductsOrder($orderId);
        OrderProductResource::withoutWrapping();
        return OrderProductResource::collection($orders);

    }

   
}
