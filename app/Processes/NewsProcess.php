<?php

namespace App\Processes;

use App\Http\Resources\NewsResource;
use App\Models\Image;
use App\Models\News;
use App\Models\Users;
use App\Repositories\NewsRepository;
use App\Validators\NewsValidator;

use Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class NewsProcess
{
    /**
     * @var NewsRepository
     */
    private $newsValidator;
    private $newsRepository;

 
    public function __construct( NewsRepository $newsRepository)
    {
       
        $this->newsRepository = $newsRepository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */

    public function getNews()
    {
        $news = $this->newsRepository->getNews();
        NewsResource::withoutWrapping();
        return NewsResource::collection($news);
    }
}
