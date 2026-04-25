<?php

namespace App\Controller;

use Slim\Slim;

abstract class AbstractController
{
	protected Slim $app;

	public function __construct()
	{
		$this->app = Slim::getInstance();
	}
}
