<?php

namespace App\Foundation;

use mysqli;
use Exception;
use mysqli_result;

class Db
{
	private static ?mysqli $connection = null;

	public static function init(): ?mysqli
	{
		if (self::$connection instanceof mysqli) {
			return self::$connection;
		}

		foreach (['DB_HOST', 'DB_NAME', 'DB_PASS', 'DB_USER', 'DB_PORT'] as $key) {
			if (empty($_ENV[$key])) {
				throw new Exception('Database configuration is missing: ' . $key);
			}
		}

		$connection = new mysqli(
			$_ENV['DB_HOST'],
			$_ENV['DB_USER'],
			$_ENV['DB_PASS'],
			$_ENV['DB_NAME'],
			(int) $_ENV['DB_PORT']
		);

		if ($connection->connect_errno) {
			throw new Exception('Database connection failed: ' . $connection->connect_error);
		}

		$connection->set_charset('utf8mb4');

		self::$connection = $connection;

		return self::$connection;
	}

	public static function execute(string $query, array $params = [])
	{
		$connection = self::init();
		$stmt = $connection->prepare($query);

		if (!$stmt) {
			throw new \Exception('Prepare failed: ' . $connection->error);
		}

		if ($params !== []) {
			$types = '';

			foreach ($params as $param) {
				$type = match (true) {
					is_int($param) => 'i',
					is_float($param) => 'd',
					default => 's'
				};
				$types .= $type;
			}

			$stmt->bind_param($types, ...$params);
		}

		if (!$stmt->execute()) {
			$error = $stmt->error;
			$stmt->close();
			throw new Exception('Execute failed: ' . $error);
		}

		$result = $stmt->get_result();

		if ($result instanceof mysqli_result) {
			$stmt->close();
			return $result;
		}

		if ($result !== false) {
			$stmt->close();
			return $result;
		}

		$affected = $stmt->affected_rows;
		$stmt->close();

		return $affected;
	}

	public static function lastInsertId(): int
	{
		return self::init()->insert_id;
	}

	public static function getConnection(): mysqli
	{
		return self::init();
	}
}
