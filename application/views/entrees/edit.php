<main class="pt-5">
	<div class="container-fluid mt-5">

		<?php if ($this->session->flashdata('reappro_enable')): ?>
			<div class="alert alert-danger alert-dismissible" role="alert" id="connexion-failed">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close" id="btn-close">
					<span aria-hidden="true">&times;</span>
				</button>
				<strong><?php echo $this->session->flashdata('reappro_enable'); ?></strong>
			</div>
		<?php endif; ?>
		<div class="card mb-4 wow fadeIn">
			<div class="card-body d-sm-flex justify-content-between">
				<h4 class="mb-2 mb-sm-0 pt-1">
					<a href="<?php echo base_url() ?>pages/dashboards">Page d'accueil</a>
					<span>/</span>
					<span><?= $title; ?></span>
				</h4>
			</div>
		</div>
		<div class="card fadeIn">
			<div class="card-body">
				<?= form_open('articles/updateInput/' . $input->id_reappro); ?>

				<input type="hidden" name="product_id" value="<?= $input->id_article ?>">
				<input type="hidden" name="id_reappro" value="<?= $input->id_reappro ?>">
				<input type="hidden" name="current_qty" value="<?= $input->qte_actuelle ?>">
				<input type="hidden" name="qte_reappro" value="<?= $input->qte_reappro ?>">
				<input type="hidden" name="key_entree" value="<?= $key_entree ?>">


				<div class="row">
					<div class="col-md-4">
						<div class="md-form">
							<label class="font-weight-bold" for="">Nom de l'article</label>
							<input disabled type="text" class="form-control" name="designation" required="required"
								   value="<?= $input->designation ?>">
						</div>
					</div>

					<div class="col-md-4">
						<div class="md-form">
							<label for="">Quantité entrée</label>
							<input type="number" class="form-control" name="new_qty" required="required"
								   value="<?= $input->qte_reappro ?>">
						</div>
					</div>
					<div class="col-sm-4 mb-0">
						<div class="md-form">
							<label for="" class="font-weight-bold text-info">Nom du fournisseur</label>
							<input type="text" class="form-control" name="fournisseur"
								   value="<?= $input->nom_fournisseur ?>"
								   required="required">
						</div>
					</div>
				</div>

				<div class="col-sm-12 mb-0">
					<button type="submit" class="btn btn-md blue-gradient mt-3" style="margin-bottom: 10px">
						Mettre à jour
					</button>
				</div>
			</div>
			</form>
		</div>
	</div>
	</div>
</main>

