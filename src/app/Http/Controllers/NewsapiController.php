<?php

namespace App\Http\Controllers;

use App\Services\Newsapi\NewsApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NewsapiController extends Controller
{

    public function index()
    {
        return view('newsapi/main');
    }


    public function getData(Request $request, NewsApiService $service)
    {
        $service->setRequest($request);
        $service->handle();
        
        return view('newsapi/main', ['data' => $service->getResponse()]);
    }
}
