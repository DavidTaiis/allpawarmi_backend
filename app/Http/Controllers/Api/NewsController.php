<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Processes\NewsProcess;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    /**
     * @var NewsProcess
     */
    private $newsProcess;

    /**
     * 
     * @param NewsProcess
     */
    public function __construct(NewsProcess $newsProcess)
    {
        $this->newsProcess = $newsProcess;
    }
    
    public function getNews()
    {
        return $this->newsProcess->getNews();
    }
}
