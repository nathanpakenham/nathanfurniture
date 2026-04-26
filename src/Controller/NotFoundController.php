<?php

namespace App\Controller;

class NotFoundController extends AbstractController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->app->render('404/dashboard.php');
	}
}
