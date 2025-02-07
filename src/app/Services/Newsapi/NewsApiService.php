<?php

namespace App\Services\Newsapi;

use Illuminate\Support\Facades\Http;

class NewsApiService
{
    private $response;
    private $request;

    public function setRequest($request)
    {
        $this->request = $request;
    }

    public function handle()
    {
        $apiKey = '9af3200a936b4ec4b089da9d45369d02';
        $newsapiDomain = 'https://newsapi.org/v2/';
        $phrase = $this->request->phrase;
        
    
        $response = Http::withHeaders([
            'Authorization' => $apiKey,
        ])->get($newsapiDomain . 'everything' . '?q=' . $phrase);
    
        $this->response = $response->json();
    }

    public function getResponse()
    {
        return $this->response;
    }
}