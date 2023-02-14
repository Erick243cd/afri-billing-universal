<main class="pt-5">
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
		<div class="container-fluid mt-5">
			<div class="card p-5">
				<h6 class="mb-4 orange-text"><?php echo $title; ?></h6>
				<img class="img-thumbnail float-lg-right"
					 src="<?php echo base_url() ?>assets/img/users/<?php echo $user['user_image'] ?>"
					 alt="<?php echo $user['user_image']; ?>" width="100" height="10">
				<?php echo validation_errors(); ?>

				<?php echo form_open_multipart('users/update'); ?>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<input type="hidden" name="id" value="<?php echo $user['id']; ?>">
							<label for="">Nom complet</label>
							<input type="text" class="form-control" name="name"
								   value="<?php echo $user['user_name']; ?>"
								   required="required">
						</div>
					</div>

					<div class="col-md-4">
						<label for="">Nouveau mot de passe</label>
						<input type="password" class="form-control" name="password">
					</div>
					<button type="submit" class="btn btn-sm btn-primary mt-4 ml-3 mb-2"
							onclick="return confirm('Ces modifications seront appliquées, Voulez-vous continuer ?')">
						Modifier
					</button>
				</div>
				</form>
			</div>
		</div>
	</div>
</main>

