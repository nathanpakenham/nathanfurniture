<?php

namespace App\Foundation;

class Cookie
{
	public static function set($name, $value, $expiresAt, $path = ''): void
	{
		setcookie($name, $value, $expiresAt, $path);
	}

	public static function findCookie($name) {
		return $_COOKIE[$name] ?? false;
	}

	public static function hasExpired($cookieExpiryDate) : bool {
		return strtotime($cookieExpiryDate) < time();
	}
}
