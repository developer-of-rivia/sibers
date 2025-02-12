<?php

namespace App\Controllers;

use App\Core\ViewCreator;
use GuzzleHttp\Client;

class NewsapiController
{
	/**
	 * 
	 */
	public function index()
	{	
		if(isset($_SESSION['articles']))
		{
			$postsPerPage = 10; // сколько надо постов выводить на одной странице
			$allPosts = $_SESSION['articles']; // все посты
			$allPostsCount = count($allPosts); // сколько всего постов
			$pageNeed = ceil(count($allPosts) / $postsPerPage); // сколько страниц понадобится, учитывая условия
		
			$data = [
				'allPosts' => $allPosts,
				'allPostsCount' => $allPostsCount,
				'pageNeed' => $pageNeed,
				'postsPerPage' => $postsPerPage,
				'searchQuery' => $_SESSION['searchQuery']
			];

			return new ViewCreator('newsapi', $data);
		} else {
			return new ViewCreator('newsapi');
		}
	}

	/**
	 * 
	 */
	public function send()
	{
		$client = new Client();

		if($_POST['phrase'])
		{
			$searchQuery = $_POST['phrase'];
		}

		$apiKey = '9af3200a936b4ec4b089da9d45369d02';
        $endPoint = 'https://newsapi.org/v2/everything?q=' . $searchQuery;
		$response = $client->request('GET', $endPoint, ['headers' => ['Authorization' => 'Bearer ' . $apiKey]])->getBody();
		$articles = json_decode($response, true)['articles'];
		

		$_SESSION['articles'] = $articles;
		$_SESSION['searchQuery'] = $searchQuery;
		header("Location: index?page=0");
	}
}