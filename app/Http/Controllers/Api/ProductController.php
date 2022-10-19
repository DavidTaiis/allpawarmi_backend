<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Processes\ProductProcess;
use Illuminate\Http\Request;
use App\Repositories\MeasureProductRepository;

class ProductController extends Controller
{

    /**
     * @var ProductProcess
     */
    private $productProcess;
    private $measureProductRepository;
    /**
     * 
     * @param ProductProcess
     */
    public function __construct(ProductProcess $productProcess, MeasureProductRepository $measureProductRepository)
    {
        $this->productProcess = $productProcess;
    }
    
    public function addProduct(Request $request)
    {
        return $this->productProcess->addProduct($request);
    }
    public function getMeasures(){
        return $this->productProcess->getMeasures();
    }
    public function updateProduct(Request $request)
    {
        return $this->productProcess->updateProduct($request);
    }
    public function deleteProduct($id)
    {
        return $this->productProcess->deleteProduct($id);
    }
}
