<?php

namespace App\Controller;

use App\Foundation\Db;
use App\Foundation\Globals;

class AccountDashboardController extends AbstractController
{
	public function showDashboard()
	{
		Globals::addBreadCrumb('Dashboard', 'dashboard');

		$sql = "SELECT * FROM customer_accounts WHERE custid = ?";
		$result = Db::execute($sql, [$_SESSION['account']['id']]);
		$account = $result->fetch_assoc();

		$this->app->render('account/dashboard.php', [
			'title' => 'Dashboard',
			'account' => $account
		]);
	}

	public function updateAddress()
	{
		$address1 = $_POST['address1'] ?? '';
		$address2 = $_POST['address2'] ?? '';
		$town = $_POST['town'] ?? '';
		$county = $_POST['county'] ?? '';
		$postcode = $_POST['postcode'] ?? '';
		$country = $_POST['country'] ?? '';

		if ($address1 === '' || $town === '' || $postcode  === ''|| $country === '') {
			$_SESSION['msg'] = 'Missing required fields';
			$err = 1;
		}

		$sql = "UPDATE customer_accounts SET address1 = ?, address2 = ?, town = ?, county = ?, postcode = ?, country = ? WHERE custid = ?";
		$result = Db::execute($sql, [$address1, $address2, $town, $county, $postcode, $country, $_SESSION['account']['id']]);

		if ($result) {
			$_SESSION['msg'] = 'Address updated';
		} else {
			$_SESSION['msg'] = 'Something went wrong';
		}

		header("Location: /account/dashboard");
		exit();
	}
}
