<?php

namespace App\Repositories;

use App\Models\Image;
use App\Models\ImageParameter;
use App\Models\Product;
use App\Models\MeasureProduct;
use App\Models\Measure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ProductRepository
{
    public function addProduct($input, $userId)
    {
       $product = new Product();
       $product->name =  $input["name"];
       $product->description =  $input["description"];
       $product->status =  "ACTIVE"; 
       $product->users_id =  $userId;
        $product->save();
        return $product ?? null;

    
    }
    public function getImageModel($imageParameterId, $product)
    {

        $imageModel = Image::query()
            ->where('entity_id', $product->id)
            ->where('image_parameter_id', $imageParameterId)->first();

        return $imageModel ?? null;
    }
    public function getImageParameter()
    {
        $imageParameter = ImageParameter::query()
            ->where('entity', ImageParameter::TYPE_PRODUCT)
            ->where('name', 'Producto')->first();

        return $imageParameter->id;
    }

    public function addMeasureProduct($input, $product){
        
        $userId = Auth::user()->id;
        $measureProduct = new MeasureProduct();
        $measureProduct->price =  $input["price"];
        $measureProduct->stock =  $input["stock"];
        $measureProduct->measures_id =  $input["measure"];
        $measureProduct->products_id =  $product->id;
        $measureProduct->status =  "ACTIVE"; 
        $measureProduct->users_id =  $userId;
         $measureProduct->save();
    }
    public function getMeasures(){
        $measures  = Measure::query();
        return $measures->get() ?? null;

    }
    public function updateProduct($input, $userId)
    {
        $product = Product::find($input['productId']);
       $product->name =  $input["name"];
       $product->description =  $input["description"];
       $product->status =  "ACTIVE"; 
       $product->users_id =  $userId;
        $product->save();
        return $product ?? null;    
    }
    public function updateMeasureProduct($input, $product){
        
        $userId = Auth::user()->id;
        $measureProduct = MeasureProduct::find($input['id']);
        $measureProduct->price =  $input["price"];
        $measureProduct->stock =  $input["stock"];
        $measureProduct->measures_id =  $input["measure"];
        $measureProduct->products_id =  $product->id;
        $measureProduct->status =  "ACTIVE"; 
        $measureProduct->users_id =  $userId;
         $measureProduct->save();
    }
    public function deleteProduct($id){

        $measureProduct = MeasureProduct::find($id);
        $measureProduct->status =  "INACTIVE"; 
       
         $measureProduct->save();
    }

}
