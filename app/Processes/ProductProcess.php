<?php

namespace App\Processes;

use App\Http\Resources\ProductResource;
use App\Http\Resources\MeasuresResource;
use App\Models\Image;
use App\Models\Product;
use App\Models\Users;
use App\Repositories\ProductRepository;
use App\Repositories\userRepository;
use Illuminate\Support\Facades\DB;



use Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Processes\ImageProcess;


class ProductProcess
{
    /**
     * @var ProductRepository
     */

    private $productRepository;

     /**
     * @var ImageProcess
     */
    private $imageProcess;

 
    public function __construct(ProductRepository $productRepository,ImageProcess $imageProcess)
    {
     
        $this->productRepository = $productRepository;
        $this->imageProcess = $imageProcess;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */

    public function addProduct($request)
    {
        try { 
            DB::beginTransaction();
            $userId = Auth::user()->id;
            $input = $request->all();
            $product = $this->productRepository->addProduct($input, $userId);
            $this->productRepository->addMeasureProduct($input, $product);
            $image = isset($request['image']) ? $request['image'] : null;
            if ($image != null) {
                $imageModel = $this->productRepository->getImageModel($this->productRepository->getImageParameter(), $product);
                $imageParameterId = $this->productRepository->getImageParameter();
                $this->imageProcess->saveImage($product, $image, $imageModel, $imageParameterId);
            }
            
            DB::commit();
            return Response::json([
                'status' => 'success',
                'message' => '! Producto creada exitosamente!',
            ], 200);

         } catch (\Exception $e) {
            DB::rollback();
            return Response::json([
                'status' => 'failed',
                'message' => '! Algo sucedio!',
            ], 404);
        } 
    }

    public function getProducts()
    {
        $products = $this->productRepository->getProducts();
        ProductResource::withoutWrapping();
        return ProductResource::collection($products);
    }
    public function getMeasures()
    {
        $measures = $this->productRepository->getMeasures();
        MeasuresResource::withoutWrapping();
        return MeasuresResource::collection($measures);
    }
    public function updateProduct($request)
    {
         try { 
            DB::beginTransaction(); 
            $userId = Auth::user()->id;
            $input = $request->all();
            $product = $this->productRepository->updateProduct($input, $userId);
            $this->productRepository->updateMeasureProduct($input, $product);
            $image = isset($request['image']) ? $request['image'] : null;
            if ($image != null) {
                $imageModel = $this->productRepository->getImageModel($this->productRepository->getImageParameter(), $product);
                $imageParameterId = $this->productRepository->getImageParameter();
                $this->imageProcess->saveImage($product, $image, $imageModel, $imageParameterId);
            }
            
            DB::commit();
            return Response::json([
                'status' => 'success',
                'message' => '! Actualizado exitosamente!',
            ], 200);

         } catch (\Exception $e) {
            DB::rollback();
            return Response::json([
                'status' => 'failed',
                'message' => '! Algo sucedio!',
            ], 404);
        } 
    }
    public function deleteProduct($id)
    {
        $products = $this->productRepository->deleteProduct($id);

        return Response::json([
            'status' => 'success',
            'message' => '! Eliminado exitosamente!',
        ], 200);
    }
}

