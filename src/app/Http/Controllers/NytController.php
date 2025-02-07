<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NytController extends Controller
{
    public function index()
    {
        $api_key = 'A6PGJ0Q1x9A0PGGZ2b6GZMavNZ14VXqZ';

        $response = Http::get('https://api.nytimes.com/svc/news/v3/content.json?api-key=' . $api_key);

        dd($response->json());
    }
}
