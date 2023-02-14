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
				<span class="text-danger text-center"><?= validation_errors(); ?></span>
				<?= form_open('sales_points/update/' . $sales_point->salespoint_id); ?>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Nom du point de vente</label>
							<input type="text" class="form-control" name="name"
								   value="<?= $sales_point->salespoint_name ?>">
						</div>
					</div>

					<div class="col-md-6">
						<label for="">Adresse</label>
						<input type="text" class="form-control" name="address"
							   value="<?= $sales_point->salespoint_adress ?>">
					</div>
					<button type="submit" class="btn btn-sm btn-primary ml-3 mb-2"
							onclick="return confirm('Ces modifications seront appliquées, Voulez-vous continuer ?')">
						Modifier
					</button>
				</div>
				</form>
			</div>
		</div>
	</div>
</main>


