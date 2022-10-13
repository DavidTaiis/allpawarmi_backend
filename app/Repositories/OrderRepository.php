<?php

namespace App\Repositories;

use App\Models\Image;
use App\Models\ImageParameter;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOrder;
use Illuminate\Support\Facades\Auth;


class OrderRepository
{
    public function createOrder($input,$userId)
    {
       
       $order = new Order();
       $order->id_client =  $userId;
       $order->id_seller =  $input["id_seller"];
       $order->total =  $input["total"];
       $order->deliver_date =  $input["deliver_date"];
       $order->status = "Pendiente";    
        $order->save();
        return $order ?? null;

    }

    public function createProductOrder($order, $products)
    {
        $productOrder = new ProductOrder();
        $productOrder->order_id = $order->id;
        $productOrder->products_id = $products["id"];
        $productOrder->quantity = $products["quantity"];
        $productOrder->subtotal = $products["subtotal"];
        
        $productOrder->status = "ACTIVE";
        
        $productOrder->save();
    }

    public function getOrdersByConsumerId(){
        $userId = Auth::user()->id;
        $order  = Order::query();
        $order->where('id_client' , $userId);
        $order->with(['user']);
        return $order->get() ?? null;
    }
    
    public function getProductsOrder($orderId){
        $order  = ProductOrder::query();
        $order->where('order_id' , $orderId);
        $order->with(['products']);
        return $order->get() ?? null;
    }
    
    public function updateStatus($input){
        $order = Order::find($input['id']);
        $order->status = $input['status'];
        
        $order->save();
    }

    public function getOrdersBySeller(){
        $userId = Auth::user()->id;
        $order  = Order::query();
        $order->where('id_seller' , $userId);
        $order->with(['user'],['userClient']);
        return $order->get() ?? null;
    }
}
