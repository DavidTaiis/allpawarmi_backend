<?php

namespace App\Processes;

use App\Http\Resources\FarmerResource;
use App\Models\Image;
use App\Models\User;
use App\Http\Resources\ProductResource;
use App\Processes\ImageProcess;
use App\Repositories\UserRepository;
use App\Repositories\MeasureProductRepository;
use Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class ConsumerProcess
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var MeasureProductRepository
     */
    private $measureProductRepository;
   
    public function __construct(UserRepository $userRepository, MeasureProductRepository $measureProductRepository)
    {
        $this->userRepository = $userRepository;
        $this->measureProductRepository = $measureProductRepository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */

    public function getFarmers()
    {
        $farmers = $this->userRepository->getFarmers();
        FarmerResource::withoutWrapping();
        return FarmerResource::collection($farmers);
    }
    public function  getProductsByFarmer($farmerId)
    {
        $products = $this->measureProductRepository->getProductsByFarmer($farmerId);
        ProductResource::withoutWrapping();
        return ProductResource::collection($products);
    }
    public function  getProductById($productId)
    {
        $product = $this->measureProductRepository->getProductById($productId);
        ProductResource::withoutWrapping();
        return ProductResource::make($product);
    }
   
}
