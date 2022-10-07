<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MyBaseController;
use App\Models\User;
use App\Models\Product;
use App\Models\MeasureProduct;
use App\Models\Measure;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends MyBaseController
{
    
    
    public function __construct()
    {
        parent::__construct();
    }

    public function index($id = null)
    {
        $farmer = User::query()->find($id);
        $this->layout->content = View::make('product.index', [
            'farmer' => $farmer,
        ]);
    }

    public function getList($id = null)
    {
        $data = Request::all();
        $query = MeasureProduct::query();
        $query->with(['measure']);
        $query->with(['product']);
        $query->where('users_id', $id);
        
        $recordsTotal = $query->get()->count();

        $recordsFiltered = $recordsTotal;

        if (isset($data['search']['value']) && $data['search']['value']) {
            $search = $data['search']['value'];
            $query->where('users.name', 'like', "$search%");
            $recordsFiltered = $query->get()->count();
        }
        if (isset($data['start']) && $data['start']) {
            $query->offset((int)$data['start']);
        }
        if (isset($data['length']) && $data['length']) {
            $query->limit((int)$data['length']);
        }
        if (isset($data['order']) && $data['order']) {
            $orders = $data['order'];
            foreach ($orders as $order) {
                $column = $order['column'];
                $dir = $order['dir'];
                $column_name = $data['columns'][$column]['data'];
                $query->orderBy('products.' . $column_name, $dir);
            }
        }
        $products = $query->get()->toArray();
        return Response::json(
            array(
                'draw' => $data['draw'] ?? null,
                'recordsTotal' => $recordsTotal,
                'recordsFiltered' => $recordsFiltered,
                'data' => $products,
            )
        );
    }

    public function getForm($userId ,$id = null)
    {

        $method = 'POST';
        $measureProduct = isset($id) ? MeasureProduct::find($id) : new Measure();
        $product = $measureProduct != null ? Product::find($measureProduct->products_id) : null;
        $measures = Measure::all()->pluck('measure', 'id')->toArray();
        $user = User::query()
            ->where('id', $userId)
            ->first();
        
        $view = View::make('product.loads._form', [
            'method' => $method,
            'product' => $product,
            'user' => $user,
            'measures' => $measures,
            'measureProduct' => $measureProduct,
            'product' => $product

        ])->render();
        return Response::json(array(
            'html' => $view,
        ));
    }

    public function postSave()
    {
        try {
           
            DB::beginTransaction();
            $data = Request::all();
            if ($data['measureProduct_id'] == '') { //Create
                $measureProduct = new MeasureProduct();
                $measureProduct->status = 'ACTIVE';
                $product = new Product();
                $product->status = 'ACTIVE';
                
            } else { //Update
                $measureProduct = MeasureProduct::query()->find($data['measureProduct_id']);
                $product = Product::find($measureProduct->products_id);
                if (isset($data['status'])) {
                    $product->status = $data['status'];
                }
            }
            $product->name = trim($data['name']);
            $product->description = trim($data['description']);
            $product->users_id = trim($data['users_id']);
            $product->save();

            $measureProduct->price = $data['price'];
            $measureProduct->stock = $data['stock'];
            $measureProduct->status = 'ACTIVE';
            $measureProduct->measures_id = $data['measures_id'];
            $measureProduct->users_id = $data['users_id'];
            $measureProduct->products_id = $product->id;
            $measureProduct->save();

            DB::commit();
            return Response::json(['status' => 'success']);
        } catch (\Exception $e) {
            DB::rollback();
            return Response::json(['status' => 'error', 'messageDev' => $e->getMessage()]);
        }
    }
    public function updateProductWeight(){
        try {
            $data = Request::all();
            foreach($data as $key => $value) {
                $product = Product::query()->find($key);
                $product->weight=$value;
                $product->save();
            }
            return Response::json([
                'status' => 'success',
            ], 200);
        } catch (\Exception $e) {
            return Response::json([
                'status' => 'error',
                'message' => 'Error al actualizar el orden de los productos',
                'devMessage' => $e->getMessage(),
            ], 500);
        }
    }
}
