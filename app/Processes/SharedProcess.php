<?php

namespace App\Processes;

use App\Http\Resources\SharedResource;
use App\Models\Image;
use App\Models\User;
use App\Processes\ImageProcess;
use App\Repositories\UserRepository;
use App\Repositories\SharedRepository;
use Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class SharedProcess
{
    /**
     * @var SharedRepository
     */
    private $sharedRepository;

   
    public function __construct(SharedRepository $sharedRepository)
    {
        $this->sharedRepository = $sharedRepository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */

    public function getShared()
    {
        $shareds = $this->sharedRepository->getShared();
        SharedResource::withoutWrapping();
        return SharedResource::collection($shareds);
    }

    public function  getSharedId($sharedId)
    {
        $shared = $this->sharedRepository->getSharedId($sharedId);
        SharedResource::withoutWrapping();
        return SharedResource::make($shared);
    }
   
    public function addShared($request)
    {
        $input = $request->all();
        $this->sharedRepository->addShared($input);
        
        return Response::json([
            'status' => 'success',
            'message' => '! Compartida creada exitosamente creada correctamente.!',
        ], 200);
    }
}
