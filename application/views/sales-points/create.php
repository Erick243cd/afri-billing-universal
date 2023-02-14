<main class="pt-5">
	<div class="container-fluid mt-5">
		<!-- Heading -->
		<div class="card mb-4 wow fadeIn">
			<!--Card content-->
			<div class="card-body d-sm-flex justify-content-between">
				<h4 class="mb-2 mb-sm-0 pt-1">
					<a href="<?php echo base_url() ?>pages/dashboards">Page d'accueil</a>
					<span>/</span>
					<span><?php echo $title; ?></span>
				</h4>
			</div>
		</div>

		<div class="card p-5">
			<span class="text-danger"><?php echo validation_errors(); ?></span>
			<?php echo form_open_multipart('sales_points/create'); ?>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Nom du point de vente</label>
						<input type="text" class="form-control" value="<?= set_value('name') ?>"
							   name="name">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Adresse</label>
						<input type="text" class="form-control" value="<?= set_value('address') ?>"
							   name="address">
					</div>
				</div>
				<button type="submit" class="btn btn-primary mb-5 ml-3 btn-sm">Enregistrer</button>
			</div>
			</form>
		</div>
	</div>
</main>

