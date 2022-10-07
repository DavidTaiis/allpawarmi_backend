<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MyBaseController;
use App\Models\User;
use App\Models\Acopio;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use App\Imports\UsersImport;

class AcopioController extends MyBaseController
{
    
    
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->layout->content = View::make('acopio.index', [
        ]);
    }

    public function getList()
    {
        $data = Request::all();
        $query = Acopio::with('user');
        
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
                $query->orderBy('acopio_center.' . $column_name, $dir);
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
        $acopio = isset($id) ? Acopio::find($id) : new Acopio();
        $users = User::all()->pluck('name', 'id')->toArray();

        $view = View::make('acopio.loads._form', [
            'method' => $method,
            'acopio' => $acopio,
            'users' => $users
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
            if ($data['acopio_id'] == '') { //Create
                $acopio = new Acopio();
                $acopio->status = 'ACTIVE';
            } else { //Update
                $acopio = Acopio::query()->find($data['acopio_id']);
                if (isset($data['status'])) {
                    $acopio->status = $data['status'];
                }
            }
            dd(($data['days']));
            $acopio->name = trim($data['name']);
            $acopio->lat = trim($data['lat']);
            $acopio->lng = trim($data['lng']);
            $acopio->description = trim($data['description']);
            $acopio->days = trim($data['days']);
            $acopio->hours = trim($data['hours']);
            $acopio->users_id = trim($data['users_id']);
            $acopio->save();

            DB::commit();
            return Response::json(['status' => 'success']);
        } catch (\Exception $e) {
            DB::rollback();
            return Response::json(['status' => 'error', 'messageDev' => $e->getMessage()]);
        }
    }

}
