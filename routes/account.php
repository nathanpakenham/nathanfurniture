<?php

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

$app->post('/register', function () {
	$obj = new RegisterController();
	$obj->store();
})->name('register.store');


$app->get('/login', function () {
	$obj = new \App\Controller\LoginController();
	$obj->index();
})->name('login');

$app->post('/login', function () {
	$obj = new \App\Controller\LoginController();
	$obj->login();
})->name('login.post');


$app->group('/account', function () use ($app) {

});
