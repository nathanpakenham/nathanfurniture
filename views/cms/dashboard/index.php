<?php include __DIR__ . '/../includes/header.php'; ?>

<section class="my-5">
	<div class="container">
		<h1 class="text-center mb-5">Cms Dashboard</h1>

		<ul class="nav nav-tabs" id="dashboardTabs" role="tablist">
			<li class="nav-item" role="presentation">
				<button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button">
					Overview
				</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders" type="button">
					Orders
				</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="address-tab" data-bs-toggle="tab" data-bs-target="#address" type="button">
					Address
				</button>
			</li>
		</ul>

		<div class="tab-content p-3 border border-top-0" id="dashboardTabsContent">
			<div class="tab-pane fade show active" id="overview">
				<h4>Overview</h4>
				<p>Stats, charts, summary info here.</p>
			</div>

			<div class="tab-pane fade" id="orders">
				<h4>Orders</h4>
				<p>Order data and reports here.</p>
			</div>

			<div class="tab-pane fade" id="address">
				<h4>Address</h4>
				<form method="POST" action="<?= $app->urlFor('account.address') ?>" novalidate>
					<div class="row g-2">
						<div class="col-12 mb-3">
							<label for="address1" class="form-label">Address 1</label>
							<input type="text" id="address1" name="address1" value="<?= e($account['address1'] ?? '') ?>" class="form-control" required>
						</div>
						<div class="col-12 mb-3">
							<label for="address2" class="form-label">Address 2</label>
							<input type="text" id="address2" name="address2" value="<?= e($account['address2'] ?? '') ?>" class="form-control">
						</div>
						<div class="col-md-4 mb-3">
							<label for="town" class="form-label">Town/City</label>
							<input type="text" id="town" name="town" value="<?= e($account['town'] ?? '') ?>" class="form-control" required>
						</div>
						<div class="col-md-4 mb-3">
							<label for="county" class="form-label">County</label>
							<input type="text" id="county" name="county" value="<?= e($account['county'] ?? '') ?>" class="form-control">
						</div>
						<div class="col-md-4 mb-3">
							<label for="postcode" class="form-label">Postcode</label>
							<input type="text" id="postcode" name="postcode" value="<?= e($account['postcode'] ?? '') ?>" class="form-control" required>
						</div>
						<div class="col-12 mb-3">
							<label for="country" class="form-label">Country</label>
							<select id="country" name="country" class="form-select" required>
								<option value="">Choose a country...</option>

								<?php
								$countries = ['United States', 'Canada', 'Australia', 'United Kingdom'];
								foreach ($countries as $country) {
									echo '<option value="' . $country . '" '.($account['country'] == $country ? 'selected' : '').'>' . $country . '</option>';
								}
								?>
							</select>
						</div>
					</div>
					<div class="d-grid mt-4">
						<button type="submit" class="btn btn-primary">Login</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	</div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
