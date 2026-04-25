<?php

namespace App\Controller;

class RegisterController extends AbstractController
{
	public function index()
	{
		$this->app->render('login/index.php');
	}
}
