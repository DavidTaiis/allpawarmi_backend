<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Processes\AssociationProcess;
use Illuminate\Http\Request;

class AssociationController extends Controller
{

    /**
     * @var AssociationProcess
     */
    private $associationProcess;

    /**
     * 
     * @param AssociationProcess
     */
    public function __construct(AssociationProcess $associationProcess)
    {
        $this->associationProcess = $associationProcess;
    }

    public function addAssociation(Request $request)
    {
        return $this->associationProcess->addAssociation($request);
    }
    
    public function getAssociationById()
    {
        return $this->associationProcess->getAssociationById();
    }

    public function updateAssociation(Request $request)
    {
        return $this->associationProcess->updateAssociation($request);
    }
}
