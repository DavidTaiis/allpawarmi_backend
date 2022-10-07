<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Processes\UserProcess;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * @var UserProcess
     */
    private $userProcess;

    /**
     * CompanyController constructor.
     * @param UserProcess $userProcess
     */
    public function __construct(UserProcess $userProcess)
    {
        $this->userProcess = $userProcess;
    }

    public function getUser()
    {
        return $this->userProcess->getUser();
    }

    public function updateProfileUser(Request $request)
    {
        $data = $request->all();
        return $this->userProcess->updateProfileUser($data);
    }

    public function getUsersTop(Request $request)
    {
       
        return $this->userProcess->getUsersTop($request);
    }
    public function register(Request $request)
    {
        return $this->userProcess->register($request);
    }
    public function getFarmerId($id)
    {
        return $this->userProcess->getFarmerId($id);
    }
}
