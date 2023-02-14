<main class="pt-5 mx-lg-5">
	<div class="container-fluid mt-5">

		<!-- Heading -->
		<div class="card mb-4 wow fadeIn">

			<!--Card content-->
			<div class="card-body d-sm-flex justify-content-between">

				<h4 class="mb-2 mb-sm-0 pt-1">
					<a href="<?php echo base_url() ?>pages/dashboards" target="_blank">Page d'accueil</a>
					<span>/</span>
					<span><?php echo $title; ?></span>
				</h4>
			</div>

		</div>

		<div class="col-lg-12 col-sm-12 col-md-8">
			<div class="card">
				<div class="card-header text-center">
					<a title="Editer votre compte" href="<?php echo base_url() ?>users/edit/<?php echo $user['id'] ?>">
						<img class="img-thumbnail" style=""
							 src="<?php echo base_url() ?>assets/img/users/<?php echo $user['user_image'] ?>" alt=""
							 width="100" height="100">
					</a>
					<a title="Editer votre compte" href="<?php echo base_url() ?>users/edit/<?php echo $user['id'] ?>">
						<h4 class="text-secondary" style="font-weight: 600; font-size: 20px">
							<?php echo ucfirst($user['user_name']) ?>
						</h4>
					</a>
					<p class="blue-text"><?php echo ucfirst($user['role_utilisateur']) ?></p>
					<?php if ($user['role_utilisateur'] != 'admin'): ?>
						<span class="red-text">Point de vente <?= $user['salespoint_name']?></span>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="mt-3 pb-4"></div>
	</div>
</main>
