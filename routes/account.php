<?php

/** @var \Slim\App $app */


use App\Controller\RegisterController;
use App\Foundation\Session;

$checkCmsAccess = function () {
	if (!Session::validate() || !isset($_SESSION['account']['id']) || $_SESSION['account']['id'] == 0) {
		Session::destroy('/login');
	}
};

$app->get('/register', function () {
	$obj = new RegisterController();
	$obj->index();
})->name('register');

$app->get('/login', function () {

})->name('login');


$app->group('/account', function () use ($app) {

});
