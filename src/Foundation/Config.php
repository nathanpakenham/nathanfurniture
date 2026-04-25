<?php

namespace App\Foundation;

use Exception;

class Config
{
	private static array $config = [];
	private static bool $loaded = false;

	public static function init()
	{
		if (self::$loaded) {
			return;
		}

		$path = dirname($_SERVER['DOCUMENT_ROOT']) . '/config/config.php';

		if (!is_file($path)) {
			throw new Exception("Config file not found: {$path}");
		}

		$config = require $path;

		if (!is_array($config)) {
			throw new Exception("Config file must return an array: {$path}");
		}

		self::$config = $config;
		self::$loaded = true;
	}

	public static function get(string $key, mixed $default = null): mixed
	{
		self::init();

		return self::$config[$key] ?? $default;
	}

	public static function set(string $key, mixed $value): void
	{
		self::init();
		self::$config[$key] = $value;
	}

	public static function has(string $key): bool
	{
		self::init();
		return array_key_exists($key, self::$config);
	}
}
