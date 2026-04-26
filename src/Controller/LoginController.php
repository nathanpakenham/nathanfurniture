<?php

namespace App\Controller;

use App\Foundation\Db;
use App\Foundation\Globals;

class LoginController extends AbstractController
{
	public function index()
	{
		if (isset($_SESSION['user']['id'])) {
			header("Location: /account/dashboard");
			exit();
		}

		Globals::addBreadCrumb('Login', 'login');

		$this->app->render('login/index.php', [
			'title' => 'Login'
		]);
	}

	public function login()
	{
		$email = $_POST['email'] ?? '';
		$password = $_POST['password'] ?? '';

		savePostToSession($_POST);

		if ($email === '' || $password === '') {
			$_SESSION['msg'] = 'Missing required fields';
			header('Location: /login');
			exit();
		}

		if (!checkEmail($email)) {
			$_SESSION['msg'] = 'Invalid email address';
			header('Location: /login');
			exit();
		}

		$sql = "SELECT * FROM customer_accounts WHERE email = ?";
		$result = Db::execute($sql, [$email]);

		if (!$result || $result->num_rows === 0) {
			$_SESSION['msg'] = 'User not found with that email';
			header('Location: /login');
			exit();
		}

		$row = $result->fetch_assoc();

		if (empty($row['password']) || !password_verify($password, $row['password'])) {
			$_SESSION['msg'] = 'Incorrect password';
			header('Location: /login');
			exit();
		}

		session_regenerate_id(true);
		$_SESSION['user']['id'] = $row['custid'];

		header('Location: /account/dashboard');
		exit();
	}
}
