<main class="pt-5">
	<div class="container-fluid mt-5">
		<?php if ($this->session->flashdata('error')) : ?>
			<div class="alert alert-danger alert-dismissible" role="alert" id="connexion-failed">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close" id="btn-close">
					<span aria-hidden="true">&times;</span>
				</button>
				<strong><?= $this->session->flashdata('error'); ?></strong>
			</div>
		<?php endif; ?>
		<div class="card mb-4 wow fadeIn">
			<div class="card-body d-sm-flex justify-content-between">
				<h4 class="mb-2 mb-sm-0 pt-1">
					<a href="<?= base_url() ?>pages/dashboards">Page d'accueil</a>
					<span>/</span>
					<span><?= $title; ?></span>
				</h4>
			</div>
		</div>
		<div class="card fadeIn">
			<div class="card-body">
				<?php echo form_open_multipart('sorties/save'); ?>
				<input type="hidden" name="id_article" value="<?= $article['id_article'] ?>">
				<input type="hidden" name="qte_initial" value="<?= $article['qte_actuelle'] ?>" required>
				<div class="row">
					<div class="col-md-3">
						<div class="md-form">
							<label class="font-weight-bold" for="">Nom de l'article</label>
							<input disabled type="text" class="form-control" name="designation" required="required"
								   value="<?= $article['designation'] ?>">
						</div>
					</div>
					<div class="col-md-3">
						<div class="md-form">
							<select disabled class="browser-default custom-select mdb-select" name="id_categorie"
									required="required">
								<option value="<?= $article['id_categorie'] ?>"
										selected><?= $article['nom_categorie'] ?></option>
								<option value="" disabled>Catégorie</option>
								<?php foreach ($categories as $row) : ?>
									<option value="<?= $row->id_categorie; ?>"><?= $row->nom_categorie; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="md-form">
							<label class="font-weight-bold" for="">Prix Unitaire</label>
							<input disabled type="text" class="form-control" name="prix_unitaire" required="required"
								   value="<?= $article['devise'] ?> <?= $article['prix_unitaire'] ?>">
						</div>
					</div>
					<div class="col-md-3">
						<div class="md-form">
							<label for="" class="font-weight-bold text-danger">Quantité en stock</label>
							<input disabled type="text" class="form-control" name="qte_initial" required="required"
								   value="<?= $article['qte_actuelle'] . " " . $article['unityName'] ?>">
						</div>
					</div>
					<div class="col-md-4">
						<div class="md-form">
							<label for="" class="font-weight-bold text-info">Quantité à sortir</label>
							<input type="number" class="form-control" name="qte_sortie" required="required" min="1"
								   max="<?= $article['qte_actuelle'] ?>">
						</div>
					</div>
					<div class="col-md-3">
						<div class="md-form">
							<select class="browser-default custom-select mdb-select" name="sales_point"
									required="required">
								<option value="">Point de vente</option>
								<?php foreach ($sales_points as $row) : ?>
									<option value="<?= $row->salespoint_id; ?>" <?= set_select('sales_point', $row->salespoint_id) ?>><?= $row->salespoint_name; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="md-form">
							<input type="date" class="form-control" name="date_sortie" required="required">
							<label for="" class="font-weight-bold text-info">Date de sortie</label>
						</div>
					</div>
				</div>
				<div class="col-sm-12 mb-0">
					<button type="submit" class="btn btn-md blue-gradient mt-3" style="margin-bottom: 10px">Enregitrer
						la sortie
					</button>
				</div>
			</div>
			</form>
		</div>
	</div>
	</div>
</main>
