<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MyBaseController;
use App\Models\News;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use App\Imports\UsersImport;

class NewsController extends MyBaseController
{
    
    
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->layout->content = View::make('news.index', [
        ]);
    }

    public function getList()
    {
        $data = Request::all();
        $query = News::query();
        
        $recordsTotal = $query->get()->count();

        $recordsFiltered = $recordsTotal;

        if (isset($data['search']['value']) && $data['search']['value']) {
            $search = $data['search']['value'];
            $query->where('news.title', 'like', "$search%");
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
                $query->orderBy('news.' . $column_name, $dir);
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
        $news = isset($id) ? News::find($id) : new News();

        $view = View::make('news.loads._form', [
            'method' => $method,
            'news' => $news,
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
            if ($data['news_id'] == '') { //Create
                $news = new News();
                $news->status = 'ACTIVE';
            } else { //Update
                $news = News::query()->find($data['news_id']);
                if (isset($data['status'])) {
                    $news->status = $data['status'];
                }
            }
          
            $news->title = trim($data['title']);
            $news->lat = trim($data['lat']);
            $news->lng = trim($data['lng']);
            $news->description = trim($data['description']);
            $news->date = trim($data['date']);
            $news->save();

            DB::commit();
            return Response::json(['status' => 'success']);
        } catch (\Exception $e) {
            DB::rollback();
            return Response::json(['status' => 'error', 'messageDev' => $e->getMessage()]);
        }
    }

}
