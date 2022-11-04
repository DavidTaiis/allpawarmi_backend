<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MyBaseController;
use App\Models\User;
use App\Models\Comercio;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;

class ComercioController extends MyBaseController
{
    
    
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->layout->content = View::make('comercio.index', [
        ]);
    }

    public function getList()
    {
        $data = Request::all();
        $query = Comercio::query();
        
        $recordsTotal = $query->get()->count();

        $recordsFiltered = $recordsTotal;
        if (isset($data['search']['value']) && $data['search']['value']) {
            $search = $data['search']['value'];
            $query->where('comercio.name', 'like', "$search%");
            $recordsFiltered = $query->get()->count();
        }
        if (isset($data['start']) && $data['start']) {
            $query->offset((int)$data['start']);
        }
        if (isset($data['length']) && $data['length']) {
            $query->limit((int)$data['length']);
        }

        $units = $query->get()->toArray();
        return Response::json(
            array(
                'draw' => $data['draw'],
                'recordsTotal' => $recordsTotal,
                'recordsFiltered' => $recordsFiltered,
                'data' => $units
            )
        );
    }

    public function getForm($id = null)
    {

        $method = 'POST';
        $comercio = isset($id) ? Comercio::find($id) : new Comercio();

        $view = View::make('comercio.loads._form', [
            'method' => $method,
            'comercio' => $comercio,

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
            if ($data['comercio_id'] == '') { //Create
                $comercio = new Comercio();
                $comercio->status = 'ACTIVE';
            } else { //Update
                $comercio = Comercio::query()->find($data['comercio_id']);
                if (isset($data['status'])) {
                    $comercio->status = $data['status'];
                }
            }

            $comercio->name = trim($data['name']);
            $comercio->description = trim($data['description']);
            $comercio->lat = trim($data['lat']);
            $comercio->lng = trim($data['lng']);

        
            $comercio->save();

            DB::commit();
            return Response::json(['status' => 'success']);
        } catch (\Exception $e) {
            DB::rollback();
            return Response::json(['status' => 'error', 'messageDev' => $e->getMessage()]);
        }
    }

}
