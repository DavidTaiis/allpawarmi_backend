<?php

namespace App\Processes;

use App\Http\Resources\AssociationResource;
use App\Models\Association;
use App\Processes\ImageProcess;
use App\Repositories\UserRepository;
use App\Repositories\AssociationRepository;
use Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class AssociationProcess
{
    
    private $associationRepository;

    /**
     * @var AssociationRepository
     */
   
    public function __construct(AssociationRepository $associationRepository)
    {
        $this->associationRepository = $associationRepository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */

    public function  getAssociationById($request)
    {  
        $association = $this->associationRepository->getAssociationById($farmerId);
        AssociationResource::withoutWrapping();
        return AssociationResource::collection($association);
    }

    public function updateAssociation($request)
    {  
        $input = $request->all();
        $this->associationRepository->updateAssociation($input);
        
        return Response::json([
            'status' => 'success',
            'message' => '! Actualizada creada correctamente.!',
        ], 200);
    }
   
}
