<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MyBaseController;
use App\Models\TransportGeolocation;
use App\Models\BusesLine;
use App\Models\Stop;
use App\Models\Measure;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class StopController extends MyBaseController
{
    
    
    public function __construct()
    {
        parent::__construct();
    }

    public function index($id = null)
    {
        $busesLine = BusesLine::query()->find($id);
        $this->layout->content = View::make('stop.index', [
            'busesLine' => $busesLine,
        ]);
    }

    public function getList($id = null)
    {
        $data = Request::all();
        $query = Stop::query();
        $query->where('buses_linea_id', $id);
        
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
                $query->orderBy('stops.' . $column_name, $dir);
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

    public function getForm($busesLineId ,$id = null)
    {

        $method = 'POST';
        $stop= isset($id) ? Stop::find($id) : new Measure();
        $busesLine = BusesLine::query()
            ->where('id', $busesLineId)
            ->first();
        
        $view = View::make('stop.loads._form', [
            'method' => $method,
            'stop' => $stop,
            'busesLine' => $busesLine
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
            
            if ($data['stop_id'] == '') { //Create
                $stop= new Stop();
                $geolocation = new TransportGeolocation();
                $geolocation->status = 'ACTIVE';
                $stop->status = 'ACTIVE';
                
            } else { //Update
                $stop= Stop::query()->find($data['stop_id']);
                $geolocation = TransportGeolocation::find($stop->transport_geolocation_id);
                if (isset($data['status'])) {
                    $stop->status = $data['status'];
                    $geolocation->status = $data['status'];
                }
            }

            
            $geolocation->lng = trim($data['lng']);
            $geolocation->lat = trim($data['lat']);
            $geolocation->type = 'stop';
            $geolocation->save();

            $stop->name = trim($data['name']);
            $stop->description = trim($data['description']);
            $stop->buses_linea_id = trim($data['busesLine_id']);
            $stop->transport_geolocation_id = $geolocation->id;
            $stop->save();

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
                $stop = Stop::query()->find($key);
                $stop->weight=$value;
                $stop->save();
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
