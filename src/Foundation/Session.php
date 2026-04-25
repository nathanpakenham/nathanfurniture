<?php

namespace App\Foundation;

class Session
{
	public static function start(): void
	{
		ini_set('date.timezone', 'Europe/London');
		setlocale(LC_ALL, 'en_GB');
		session_set_cookie_params([
			"path" => "/",
			'secure' => false,      // keep false if not using HTTPS
			'httponly' => true,     // recommended
			'samesite' => 'Lax'     // works for normal redirects and POST forms
		]);
		session_cache_limiter(false);
		session_start();
	}

	public static function destroy($redirect = ''): void
	{
		unset($_SESSION);
		session_destroy();

		if ($redirect !== '') {
			header("Location: $redirect");
			exit;
		}
	}

	/**
	 * This function does the following things
	 *
	 * - timestamp based session management & regenerates ID every 5 mins
	 * - Prevent outdated sessions to be consumed by anyone
	 * - check for HTTP_HOST changing
	 * - check for IP changing
	 * - @TODO check its in allow ip list
	 * - @TODO Developers should keep track of all active sessions for every user. And notify them of how many active sessions, from which IP (and area), how long it has been active, etc. PHP does not keep track of these. Developers are supposed to do so.
	 */
	public static function validate(): bool
	{
		$_SESSION['created_at'] ??= time();

		if (!isset($_SESSION['last_regeneration'])) {
			session_regenerate_id(true);
			$_SESSION['last_ip'] = $_SERVER['REMOTE_ADDR'];
			$_SESSION['last_useragent'] = $_SERVER['HTTP_USER_AGENT'] ?? '';
			$_SESSION['last_regeneration'] = time();
		}

		// check for user agent change
		if (isset($_SESSION['last_useragent']) && $_SESSION['last_useragent'] != $_SERVER['HTTP_USER_AGENT']) {
			return false;
		}

		// check valid subnet change
		if (isset($_SESSION['last_ip']) && $_SESSION['last_ip'] !== $_SERVER['REMOTE_ADDR']) {
			return false;
		}

		// regenerate the session
		if (time() - $_SESSION['last_regeneration'] > 300) {
			session_regenerate_id(true);
			$_SESSION['last_regeneration'] = time();
		}

		// completely destroy the session after 20 mins
		if (time() - $_SESSION['created_at'] > 1200) {
			return false;
		}

		return true;
	}
}
