<?php include __DIR__ . '/../includes/header.php'; ?>

<section class="my-5">
	<div class="container">
		<h1 class="text-center mb-5">Cms Products</h1>

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
		</div>
	</div>

	</div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
