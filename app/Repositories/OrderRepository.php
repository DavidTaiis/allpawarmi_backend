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
    public function createOrder($input)
    {
       
       $order = new Order();
       $order->id_client =  $input["id_client"];
       $order->id_seller =  $input["id_seller"];
       $order->total =  $input["total"];
       $order->deliver_date =  $input["deliver_date"];
    
    
    
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

    public function getOrdersByConsumerId($consumerId){
        $order  = Order::query();
        $order->where('id_client' , $consumerId);
        $order->with(['user']);
        return $order->get() ?? null;
    }
    
    public function getProductsOrder($orderId){
        $order  = ProductOrder::query();
        $order->where('order_id' , $orderId);
        $order->with(['products']);
        return $order->get() ?? null;
    }
}
