<?php

namespace App\Controller;

class ErrorController extends AbstractController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->app->render('error/dashboard.php');
	}
}
