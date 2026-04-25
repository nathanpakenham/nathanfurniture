<?php

/** @var \Slim\App $app */


use App\Foundation\Session;

$checkCmsAccess = function () {
	if (!Session::validate() || !isset($_SESSION['user']['id']) || $_SESSION['user']['id'] == 0) {
		Session::destroy('/cms');
	}
};

$app->group('/account', function () use ($app) {

});
