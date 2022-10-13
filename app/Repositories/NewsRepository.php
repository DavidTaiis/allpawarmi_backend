<?php

namespace App\Repositories;

use App\Models\Image;
use App\Models\ImageParameter;
use App\Models\News;
use Illuminate\Support\Facades\Auth;
use App\Models\MeasureProduct;

class NewsRepository
{
   
    public function getNews(){
        $news  = News::query();
        return $news->get() ?? null;

    }
}
