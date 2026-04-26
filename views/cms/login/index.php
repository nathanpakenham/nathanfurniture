<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?= e($title . ' - ' . \App\Foundation\Config::get('client')) ?? \App\Foundation\Config::get('client') ?></title>
	<link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%2210 0 100 100%22><text y=%22.90em%22 font-size=%2290%22>🛒</text></svg>" />
	<meta name="csrf-token" content="<?php echo $_SESSION['csrf_token']; ?>" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
	<link rel="stylesheet" href="/css/lity.min.css">
	<link rel="stylesheet" href="/css/jquery-impromptu.min.css" >
	<link rel="stylesheet" href="/css/frontend.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
</head>
<body>

<section>
	<div class="container">
		<h1 class="text-center my-5">Cms Login</h1>

		<div class="my-5 row justify-content-center">
			<div class="col-md-8 col-lg-6">
				<?php if (!empty($_SESSION['msg'])): ?>
					<div class="alert alert-danger" role="alert">
						<?= e($_SESSION['msg']) ?>
					</div>
					<?php unset($_SESSION['msg']); ?>
				<?php endif; ?>
				<form method="POST" action="<?= $app->urlFor('cms.login.post') ?>" novalidate>
					<div class="row">
						<div class="col-md-12">
							<label for="email" class="form-label">Email address</label>
							<input type="email" id="email" name="email" class="form-control" required>
						</div>
					</div>
					<div class="row g-2">
						<div class="col-md-12">
							<label for="password" class="form-label">Password</label>
							<input type="password" id="password" name="password" class="form-control" required>
						</div>
					</div>
					<div class="d-grid mt-4">
						<button type="submit" class="btn btn-primary">Login</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script src="/js/jquery.min.js"></script>
<script src="/js/jquery-impromptu.min.js"></script>
<script src="/js/lity.min.js"></script>
<script src="/js/main.js"></script>
</body>
</html>
