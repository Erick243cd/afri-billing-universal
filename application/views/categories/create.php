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
			<h2 style="color: darkorange; font-size: large;"><?php echo $title; ?></h2>
			<span class="text-danger"><?php echo validation_errors(); ?></span>
			<?php echo form_open_multipart('categories/create'); ?>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="">Nomde de la catégorie</label>
						<input type="text" class="form-control" name="categoryName" value="<?= set_value('categoryName')?>">
					</div>
				</div>
				<button type="submit" class="btn btn-pink mb-5 ml-3">Enregistrer</button>
			</div>
			</form>
		</div>
	</div>
</main>
