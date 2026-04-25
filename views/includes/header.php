<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Vendo Ecommerce</title>
	<meta name="csrf-token" content="<?php echo $_SESSION['csrf_token']; ?>" />
	<link rel="stylesheet" href="/css/bootstrap-grid.css">
	<link rel="stylesheet" href="/css/lity.min.css">
	<link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%2210 0 100 100%22><text y=%22.90em%22 font-size=%2290%22>🛒</text></svg>" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="/css/jquery-impromptu.min.css" >
	<link rel="stylesheet" href="/css/style.css">
</head>
<body>

<header>
	<div class="header__message">
		Default welcome msg!
	</div>

	<div class="container">
		<div class="header__menu">
			<div class="header__logo">Vendo 🛒</div>

			<nav>
				<ul class="header__navigation">
					<li class="header__item">
						<form action="/search" method="post">
							<input name="search" class="header__search" placeholder="Search..." />
						</form>
					</li>
					<li class="header__item">
						<a href="/shopping-basket"><img class="header__basket" src="/images/shopping_basket.svg" alt="shopping basket" /></a>
					</li>
				</ul>
			</nav>
		</div>
	</div>
</header>
