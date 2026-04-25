<?php

namespace App\Foundation;

use Detection\MobileDetect;

class Common
{
	public function init()
	{
		$this->checkExtenstions();
		$this->checkRedirects();
		$this->forceSSL();
		$this->blockCmsAccess();
		$this->checkMaxInputVars();
		$this->initCsrfToken();
		$this->initGlobals();
		$this->initCustomer();
		$this->doNotTrack();
	}

	public function checkExtenstions()
	{
		// more should be added
		$requiredExtensions = ['mysqli', 'memcached', 'curl', 'gd'];

		foreach ($requiredExtensions as $extension) {
			if (!extension_loaded($extension)) {
				die('Required PHP extension "' . $extension . '" is not loaded.');
			}
		}
	}

	public function checkRedirects()
	{
		// do nothing for now
	}

	public function forceSSL()
	{
		// as its only on dev not necessary for now
		// could be implemented by checking port number
	}

	public function blockCmsAccess()
	{
		// do nothing for now not doing cms yet only.
	}

	public function checkMaxInputVars()
	{
		$max = (int) ini_get('max_input_vars');
		$count = count($_POST);

		if ($count >= $max) {
			die('Max input vars exceeded.');
		}
	}

	// probably needs improving in the future
	public function initCsrfToken()
	{
		if (empty($_SESSION['csrf_token'])) {
			$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
		}
	}

	public function initGlobals()
	{
		$global = new \stdClass();

		$global->breadCrumbs = [
			['name' => 'home', 'url' => '/']
		];

		$global->detect = new MobileDetect();

		// google
		// extra js

		return $global;
	}

	public function initCustomer()
	{
		// set currency type, symbol, exchange rate, base currency
		/*
		Customer::initBkey();
		Baskets::getSavedBasket();
		Baskets::checkBasketAvailability();
		*/
	}

	public function doNotTrack()
	{
		// to implement later
	}
}
