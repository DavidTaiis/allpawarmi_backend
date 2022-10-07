<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MyBaseController;
use App\Models\User;
use App\Models\Measure;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;

class MeasureController extends MyBaseController
{
    
    
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->layout->content = View::make('measure.index', [
        ]);
    }

    public function getList()
    {
        $data = Request::all();
        $query = Measure::query();
        
        $recordsTotal = $query->get()->count();

        $recordsFiltered = $recordsTotal;
        if (isset($data['search']['value']) && $data['search']['value']) {
            $search = $data['search']['value'];
            $query->where('measures.measure', 'like', "$search%");
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
        $measure = isset($id) ? Measure::find($id) : new Measure();

        $view = View::make('measure.loads._form', [
            'method' => $method,
            'measure' => $measure,

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
            if ($data['measure_id'] == '') { //Create
                $measure = new Measure();
                $measure->status = 'ACTIVE';
            } else { //Update
                $measure = Measure::query()->find($data['measure_id']);
                if (isset($data['status'])) {
                    $measure->status = $data['status'];
                }
            }

            $measure->measure = trim($data['measure']);
        
            $measure->save();

            DB::commit();
            return Response::json(['status' => 'success']);
        } catch (\Exception $e) {
            DB::rollback();
            return Response::json(['status' => 'error', 'messageDev' => $e->getMessage()]);
        }
    }

}
