<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MyBaseController;
use App\Models\Role;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use App\Imports\UsersImport;

class FarmerController extends MyBaseController
{
    
    /**
     * UserController constructor.
     * @param LevelRepository $levelRepository
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->layout->content = View::make('farmers.index', [
        ]);
    }

    public function getList()
    {
        $data = Request::all();
        $query =  User::whereHas('roles', function ($q) {
            $q->where('roles.name', '=', 'Vendedora');
          });
        

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
                $query->orderBy('users.' . $column_name, $dir);
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

}
