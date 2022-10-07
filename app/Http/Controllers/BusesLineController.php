<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MyBaseController;
use App\Models\BusesLine;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use App\Imports\UsersImport;

class BusesLineController extends MyBaseController
{
    
    
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->layout->content = View::make('busesline.index', [
        ]);
    }

    public function getList()
    {
        $data = Request::all();
        $query = BusesLine::query();
        
        $recordsTotal = $query->get()->count();

        $recordsFiltered = $recordsTotal;

        if (isset($data['search']['value']) && $data['search']['value']) {
            $search = $data['search']['value'];
            $query->where('buses_linea.name', 'like', "$search%");
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
                $query->orderBy('buses_linea.' . $column_name, $dir);
            }
        }
        $users = $query->get()->toArray();
        return Response::json(
            array(
                'draw' => $data['draw'],
                'recordsTotal' => $recordsTotal,
                'recordsFiltered' => $recordsFiltered,
                'data' => $users,
            )
        );
    }

    public function getForm($id = null)
    {

        $method = 'POST';
        $busesline = isset($id) ? BusesLine::find($id) : new BusesLine();

        $view = View::make('busesline.loads._form', [
            'method' => $method,
            'busesline' => $busesline,
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
            if ($data['busesline_id'] == '') { //Create
                $busesline = new BusesLine();
                $busesline->status = 'ACTIVE';
            } else { //Update
                $busesline = BusesLine::query()->find($data['busesline_id']);
                if (isset($data['status'])) {
                    $busesline->status = $data['status'];
                }
            }
          
            $busesline->name = trim($data['title']);
            $busesline->description = trim($data['lat']);
            $busesline->status = trim($data['lng']);
            $busesline->lat_init = trim($data['lat_init']);
            $busesline->lng_init = trim($data['lng_init']);
            $busesline->lat_finish = trim($data['lat_finish']);
            $busesline->lng_finish = trim($data['lng_finish']);
            $busesline->price = trim($data['price']);

            $busesline->save();

            DB::commit();
            return Response::json(['status' => 'success']);
        } catch (\Exception $e) {
            DB::rollback();
            return Response::json(['status' => 'error', 'messageDev' => $e->getMessage()]);
        }
    }

}
