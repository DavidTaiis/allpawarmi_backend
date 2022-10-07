<?php

namespace App\Repositories;

use App\Models\Image;
use App\Models\ImageParameter;
use App\Models\MeasureProduct;
use Illuminate\Support\Facades\Auth;

class MeasureProductRepository
{
    public function getProductsByFarmer($farmerId)
    {
        $products  = MeasureProduct::query();
        
        $products->where('users_id' , $farmerId);

        return $products->get() ?? null;
    }    

    public function getProductById($productId)
    {
        $product  = MeasureProduct::query();
        
        $product->where('products_id' , $productId);

        return $product->get() ?? null;
    }  

}
