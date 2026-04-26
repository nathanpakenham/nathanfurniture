<?php

namespace App\Controller\Cms;

use App\Controller\AbstractController;
use App\Foundation\Db;
use App\Foundation\Globals;

class ProductController extends AbstractController
{
	public function showProductsList()
	{
//		$sql = "SELECT * FROM customer_accounts WHERE custid = ?";
//		$result = Db::execute($sql, [$_SESSION['cms']['id']]);
//		$account = $result->fetch_assoc();

		$this->app->render('cms/products/index.php', [
			'title' => 'Products'
		]);
	}
}
