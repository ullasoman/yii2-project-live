<?php

use yii\helpers\Url;
?>
<section class="page-header padding-tb page-header-bg-1">
	<div class="container">
		<div class="page-header-item d-flex align-items-center justify-content-center">
			<div class="post-content">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item"><a href="#">Order</a></li>
						<li class="breadcrumb-item active" aria-current="page">Transaction</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</section>
<section class="page-content bg-grey">
	<div id="notfound" class="container">
		<div class="row">
			<div class="notfound m-auto">
				<div class="mb-5">
					<div class="notfound-404">
						<h1>404</h1>
					</div>
					<h2>We are sorry, Page not found!</h2>
					<p class="mt-4 mb-4">The page you are looking for might have been removed had its name changed or is temporarily unavailable.</p>
				</div>
				<div>
					<a href="<?= Url::to(['site/index']) ?>" class="btn-custom">
						<span class="cv-text ms-1 text-uppercase">Try Our Products</span>
					</a>
				</div>
			</div>
		</div>

	</div>
</section>