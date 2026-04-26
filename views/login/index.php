<?php  include __DIR__ . '/../includes/header.php'; ?>

<section>
	<div class="container">
		<h1 class="text-center my-5">Account Login</h1>

		<div class="my-5 row justify-content-center">
			<div class="col-md-8 col-lg-6">
				<?php if (!empty($_SESSION['msg'])): ?>
					<div class="alert alert-danger" role="alert">
						<?= e($_SESSION['msg']) ?>
					</div>
					<?php unset($_SESSION['msg']); ?>
				<?php endif; ?>
				<form method="POST" action="<?= isset($app) ? $app->urlFor('login.post') : '/login'; ?>" novalidate>
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

<?php include __DIR__ . '/../includes/footer.php'; ?>
