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
		<div class="card fadeIn mb-4">
			<div class="text-danger">
				<?php echo validation_errors(); ?>
			</div>
			<div class="card-body">
				<?php echo form_open_multipart('articles/create'); ?>
				<div class="row">
					<div class="col-md-6 col-sm-6">
						<div class="md-form">
							<label for="">Désignation de l'article</label>
							<input type="text" class="form-control" name="designation" required="required">
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="md-form">
							<select class="browser-default custom-select mdb-select" name="id_categorie"
									required="required">
								<option value="" disabled selected>Catégorie</option>
								<?php foreach ($categories as $row) : ?>
									<option value="<?= $row->id_categorie; ?>"><?= $row->nom_categorie; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-md-4 col-sm-4">
						<div class="md-form">
							<label for="">Prix D'achat</label>
							<input type="text" step="any" class="form-control" name="prix_achat" required="required">
						</div>
					</div>

					<div class="col-md-4 col-sm-4">
						<div class="md-form">
							<label for="">Prix Unitaire</label>
							<input type="number" step="any" class="form-control" name="prix_unitaire"
								   required="required">
						</div>
					</div>
					<div class="col-md-4 col-sm-4">
						<div class="md-form">
							<select class="browser-default custom-select mdb-select" name="devise" required="required">
								<option value="" disabled>Devise</option>
								<option value="CDF" selected>CDF</option>
<!--								<option value="USD" selected>USD</option>-->
							</select>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="md-form">
							<label for="">Quantité initial</label>
							<input type="number" class="form-control" name="qte_initial" required="required">
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="md-form">
							<select class="browser-default custom-select mdb-select" name="unity" required="required">
								<option value="" disabled>Unité</option>
								<?php foreach ($unities as $unity): ?>
									<option value="<?= $unity->unityId ?>"><?= $unity->unityName ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 mb-0">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroupFileAddon01">Image de l'article</span>
							</div>
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="articlefile"
									   aria-describedby="inputGroupFileAddon01" name="articlefile"
									   accept=".jpg, .jpeg, .png, .gif">
								<label class="custom-file-label" for="inputGroupFile01">Choisir une
									photo</label>
							</div>
						</div>
						<button type="submit" class="btn btn-md blue-gradient mt-3" style="margin-bottom: 10px">
							Enregistrer
						</button>
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>
</main>
