<?php

use App\Foundation\Session;

$checkAccess = function () {
	if (!Session::validate() || !isset($_SESSION['cms']['id']) || $_SESSION['cms']['id'] == 0) {
		Session::destroy('/cms');
	}
};

$app->get('/cms', function () {
	$obj = new \App\Controller\Cms\LoginController();
	$obj->showLogin();
})->name('cms.login');

$app->post('/cms', function () {
	$obj = new \App\Controller\Cms\LoginController();
	$obj->login();
})->name('cms.login.post');

$app->group('/cms', $checkAccess,  function () use ($app) {
	$app->get('/dashboard', function () {
		$obj = new \App\Controller\Cms\DashboardController();
		$obj->showDashboard();
	})->name('cms.dashboard');

	$app->get('/products', function () {
		$obj = new \App\Controller\Cms\ProductController();
		$obj->showProductsList();
	})->name('cms.products');
});
