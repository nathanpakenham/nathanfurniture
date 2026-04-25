<?php

namespace App\Foundation;

use Detection\MobileDetect;
use stdClass;

class Globals
{
	private static ?StdClass $globals = null;

	public static function init(): StdClass
	{
		if (self::$globals instanceof stdClass) {
			return self::$globals;
		}

		$global = new stdClass();
		$global->breadCrumbs = [['name' => 'home', 'url' => '/']];
		$global->detect = new MobileDetect();
		$global->extraJs = [];
		$global->google = null;

		self::$globals = $global;

		return self::$globals;
	}

	public static function get(): stdClass
	{
		return self::init();
	}

	public static function addBreadCrumb(string $name, string $url): void
	{
		$globals = self::init();
		$globals->breadCrumbs[] = [
			'name' => $name,
			'url' => $url,
		];
	}

	public static function setExtraJs(string $script): void
	{
		$globals = self::init();
		$globals->extraJs[] = $script;
	}

	public static function reset(): void
	{
		self::$globals = null;
	}
}
