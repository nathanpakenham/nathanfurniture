<?php

namespace App\Controller;

use App\Foundation\Db;
use App\Foundation\Globals;
use App\Foundation\Validator;

class RegisterController extends AbstractController
{
	public function index()
	{
		Globals::addBreadCrumb('Register', 'register');

		$this->app->render('register/dashboard.php', [
			'title' => 'Register'
		]);
	}

	public function store()
	{
		$title = $_POST['title'] ?? '';
		$firstName = preg_replace('/[^a-zA-Z ]/', '', $_POST['first_name'] ?? '');
		$last_name = preg_replace('/[^a-zA-Z ]/', '', $_POST['last_name'] ?? '');
		$email = $_POST['email'] ?? '';
		$telephone = $_POST['telephone'] ?? '';
		$address1 = $_POST['address1'] ?? '';
		$address2 = $_POST['address2'] ?? '';
		$town = $_POST['town'] ?? '';
		$county = $_POST['county'] ?? '';
		$postcode = $_POST['postcode'] ?? '';
		$country = $_POST['country'] ?? '';
		$password = $_POST['password'] ?? '';
		$confirmPassword = $_POST['confirm_password'] ?? '';
		
		savePostToSession($_POST);

		if ($title === '' || $firstName === '' || $last_name === '' || $email === '' || $telephone === '' || $address1 === '' || $town === '' || $postcode  === ''|| $country === '' || $password === '' || $confirmPassword === '') {
			$_SESSION['msg'] = 'Missing required fields';
			$err = 1;
		}

		if (!checkEmail($email)) {
			$_SESSION['msg'] = 'Invalid email address';
			$err = 1;
		}

		/** @TODO Improved ban words via a file */
		$bannedWords = ['fuck', 'shit', 'cum', 'porn', 'sex'];

		foreach ($bannedWords as $word) {
			if (str_contains(strtolower($title . ' ' . $firstName . ' ' . $last_name . ' ' . $email . ' ' . $address1 . ' ' . $address2 . ' ' . $town . ' ' . $county), $word)) {
				$_SESSION['msg'] = 'Inappropriate language detected';
				$err = 1;
				break;
			}
		}

		if ($password !== $confirmPassword) {
			$_SESSION['msg'] = 'Passwords do not match';
			$err = 1;
		}

		$sql = "SELECT * FROM customer_accounts WHERE email = ?";
		$result = Db::execute($sql, [$email]);
		if ($result->num_rows > 0) {
			$_SESSION['msg'] = 'This email already exists';
			$err = 1;
		}

		$password = password_hash($password, PASSWORD_DEFAULT);

		if (!isset($err)) {
			$sql = "INSERT INTO customer_accounts 
			(title, first_name, last_name, email, telephone, address1, address2, town, county, postcode, country, password) 
			VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			$result = Db::execute($sql, [$title, $firstName, $last_name, $email, $telephone, $address1, $address2, $town, $county, $postcode, $country, $password]);

			if ($result) {
				$_SESSION['msg'] = 'Registered successfully';
				header("Location: /login");
				exit();
			} else {
				$_SESSION['msg'] = 'Registration failed';
			}
		}

		header('Location: /register');
		exit();
	}
}
