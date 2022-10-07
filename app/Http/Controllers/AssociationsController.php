<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MyBaseController;
use App\Models\User;
use App\Models\Association;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;

class AssociationsController extends MyBaseController
{
    
    
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->layout->content = View::make('association.index', [
        ]);
    }

    public function getList()
    {
        $data = Request::all();
        $query = Association::with('user');
        
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
                $query->orderBy('association.' . $column_name, $dir);
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
        $association = isset($id) ? Association::find($id) : new Association();
        $users = User::all()->pluck('name', 'id')->toArray();

        $view = View::make('association.loads._form', [
            'method' => $method,
            'association' => $association,
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
            if ($data['association_id'] == '') { //Create
                $association = new Association();
                $association->status = 'ACTIVE';
            } else { //Update
                $association = Association::query()->find($data['association_id']);
                if (isset($data['status'])) {
                    $association->status = $data['status'];
                }
            }
            $association->name = trim($data['name']);
            $association->lat = trim($data['lat']);
            $association->lng = trim($data['lng']);
            $association->advantages = trim($data['advantages']);
            $association->rules = trim($data['rules']);
            $association->users_id = trim($data['users_id']);
            $association->save();

            DB::commit();
            return Response::json(['status' => 'success']);
        } catch (\Exception $e) {
            DB::rollback();
            return Response::json(['status' => 'error', 'messageDev' => $e->getMessage()]);
        }
    }

}
