<?php

namespace App\Core;

class ViewCreator
{
	public function __construct($viewName, $data = [])
	{
		include APP_FOLDER . '/App/views/' . $viewName . '.php';
	}
}