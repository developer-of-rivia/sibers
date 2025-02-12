<?php 

namespace App\Controllers;

use App\Core\ViewCreator;
use GuzzleHttp\Client;

class RandomUserApiController
{
	/**
	 * 
	 */
	public function index()
	{	
		if(isset($_SESSION['userAPI_users']))
		{
			$usersPerPage = 10; // сколько надо постов выводить на одной странице
			$allUsers = $_SESSION['userAPI_users']; // все посты
			$allUsersCount = count($allUsers); // сколько всего постов
			$pageNeed = ceil(count($allUsers) / $usersPerPage); // сколько страниц понадобится, учитывая условия
		
			$data = [
				'allUsers' => $allUsers,
				'allUsersCount' => $allUsersCount,
				'pageNeed' => $pageNeed,
				'usersPerPage' => $usersPerPage,
				'searchQuery' => $_SESSION['userAPI_generateCount']
			];

			return new ViewCreator('randomUserApi', $data);
		} else {
			return new ViewCreator('randomUserApi');
		}
	}

	/**
	 * 
	 */
	public function send()
	{
		$client = new Client();

		if($_POST['userAPI_generateCount'])
		{
			$usersCountQuery = $_POST['userAPI_generateCount'];
		}

        $endPoint = 'https://randomuser.me/api/?results=' . $usersCountQuery;
		$response = $client->request('GET', $endPoint)->getBody();
		$users = json_decode($response, true)['results'];


		$_SESSION['userAPI_users'] = $users;
		$_SESSION['userAPI_generateCount'] = $usersCountQuery;
		header("Location: index?page=0");
	}
}