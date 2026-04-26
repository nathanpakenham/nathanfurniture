<?php  include __DIR__ . '/../includes/header.php'; ?>

<section>
	<div class="container">
		<h1 class="text-center my-5">Account Register</h1>

		<div class="my-5 row justify-content-center">
			<div class="col-md-8 col-lg-6">
				<?php if (!empty($_SESSION['msg'])): ?>
					<div class="alert alert-danger" role="alert">
						<?= e($_SESSION['msg']) ?>
					</div>
					<?php unset($_SESSION['msg']); ?>
				<?php endif; ?>
				<form method="POST" action="<?= isset($app) ? $app->urlFor('register.store') : '/register'; ?>" novalidate>
					<div class="row g-2">
						<div class="col-4">
							<label for="title" class="form-label">Title</label>
							<select id="title" name="title" class="form-select" required>
								<option value="">Choose...</option>
								<option value="Mr">Mr</option>
								<option value="Mrs">Mrs</option>
								<option value="Miss">Miss</option>
								<option value="Ms">Ms</option>
								<option value="Dr">Dr</option>
							</select>
						</div>
						<div class="col-4">
							<label for="first_name" class="form-label">First name</label>
							<input type="text" id="first_name" name="first_name" class="form-control" required>
						</div>
						<div class="col-4">
							<label for="last_name" class="form-label">Last name</label>
							<input type="text" id="last_name" name="last_name" class="form-control" required>
						</div>
					</div>

					<div class="mb-3 mt-3">
						<label for="email" class="form-label">Email address</label>
						<input type="email" id="email" name="email" class="form-control" required>
					</div>

					<div class="mb-3">
						<label for="telephone" class="form-label">Telephone number</label>
						<input type="tel" id="telephone" name="telephone" class="form-control">
					</div>

					<div class="row g-2">
						<div class="col-12 mb-3">
							<label for="address1" class="form-label">Address 1</label>
							<input type="text" id="address1" name="address1" class="form-control" required>
						</div>
						<div class="col-12 mb-3">
							<label for="address2" class="form-label">Address 2</label>
							<input type="text" id="address2" name="address2" class="form-control">
						</div>
						<div class="col-md-4 mb-3">
							<label for="town" class="form-label">Town/City</label>
							<input type="text" id="town" name="town" class="form-control" required>
						</div>
						<div class="col-md-4 mb-3">
							<label for="county" class="form-label">County</label>
							<input type="text" id="county" name="county" class="form-control">
						</div>
						<div class="col-md-4 mb-3">
							<label for="postcode" class="form-label">Postcode</label>
							<input type="text" id="postcode" name="postcode" class="form-control" required>
						</div>
						<div class="col-12 mb-3">
							<label for="country" class="form-label">Country</label>
							<select id="country" name="country" class="form-select" required>
								<option value="">Choose a country...</option>
								<option value="United Kingdom" selected>United Kingdom</option>
								<option value="United States">United States</option>
								<option value="Canada">Canada</option>
								<option value="Australia">Australia</option>
								<option value="Ireland">Ireland</option>
								<option value="Germany">Germany</option>
								<option value="France">France</option>
								<option value="Spain">Spain</option>
								<option value="Italy">Italy</option>
								<option value="Netherlands">Netherlands</option>
								<option value="Belgium">Belgium</option>
								<option value="Other">Other</option>
							</select>
						</div>
					</div>

					<div class="row g-2">
						<div class="col-md-6 mb-3">
							<label for="password" class="form-label">Password</label>
							<input type="password" id="password" name="password" class="form-control" required>
						</div>
						<div class="col-md-6 mb-3">
							<label for="confirm_password" class="form-label">Confirm password</label>
							<input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
						</div>
					</div>

					<div class="d-grid">
						<button type="submit" class="btn btn-primary">Register</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
