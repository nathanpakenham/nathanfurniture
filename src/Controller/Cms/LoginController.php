<?php

namespace App\Controller\Cms;

use App\Controller\AbstractController;
use App\Foundation\Db;
use App\Foundation\Globals;

class LoginController extends AbstractController
{
	public function showLogin()
	{
		if (isset($_SESSION['cms']['id'])) {
			header("Location: /cms/dashboard");
			exit();
		}

		Globals::addBreadCrumb('Cms Login', '/cms');

		$this->app->render('cms/login/index.php', [
			'title' => 'Cms Login'
		]);
	}

	public function login()
	{
		$email = $_POST['email'] ?? '';
		$password = $_POST['password'] ?? '';

		savePostToSession($_POST);

		if ($email === '' || $password === '') {
			$_SESSION['msg'] = 'Missing required fields';
			header('Location: /cms');
			exit();
		}

		if (!checkEmail($email)) {
			$_SESSION['msg'] = 'Invalid email address';
			header('Location: /cms');
			exit();
		}

		$sql = "SELECT * FROM users WHERE email = ?";
		$result = Db::execute($sql, [$email]);

		if (!$result || $result->num_rows === 0) {
			$_SESSION['msg'] = 'Cms User not found with that email';
			header('Location: /cms');
			exit();
		}

		$row = $result->fetch_assoc();

		if (empty($row['password']) || !password_verify($password, $row['password'])) {
			$_SESSION['msg'] = 'Incorrect password';
			header('Location: /cms');

			$sql = "UPDATE users SET login_attempts = login_attempts + 1 WHERE id = ?";
			Db::execute($sql, [$row['id']]);
			exit();
		}

		if ($row['login_attempts'] > 3) {
			$_SESSION['msg'] = 'Account is locked currently';
			header('Location: /cms');
			exit();
		}

		session_regenerate_id(true);
		$_SESSION['cms']['id'] = $row['id'];

		$sql = "UPDATE users SET ip_address = ? WHERE id = ?";
		Db::execute($sql, [$_SERVER['REMOTE_ADDR'], $row['id']]);

		header('Location: /cms/dashboard');
		exit();
	}
}
