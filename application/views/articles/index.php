<main class="pt-5">
	<div class="container-fluid mt-5">
		<?php if ($this->session->flashdata('article_created')) : ?>
			<div class="alert alert-success alert-dismissible" role="alert" id="connexion-failed">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close" id="btn-close">
					<span aria-hidden="true">&times;</span>
				</button>
				<strong><?php echo $this->session->flashdata('article_created'); ?></strong>
			</div>
		<?php endif; ?>
		<?php if ($this->session->flashdata('article_deleted')) : ?>
			<div class="alert alert-success alert-dismissible" role="alert" id="connexion-failed">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close" id="btn-close">
					<span aria-hidden="true">&times;</span>
				</button>
				<strong><?php echo $this->session->flashdata('article_deleted'); ?></strong>
			</div>
		<?php endif; ?>
		<!-- Heading -->
		<div class="card mb-4 wow fadeIn">
			<div class="card-body d-sm-flex justify-content-between">

				<h4 class="mb-2 mb-sm-0 pt-1">
					<a href="<?php echo base_url() ?>pages/dashboards">Page d'accueil</a>
					<span>/</span>
					<span><?php echo $title; ?></span>
				</h4>
			</div>
		</div>
		<div class="row wow fadeIn">
			<div class="col-md-12 col-sm-12 col-lg-12 mb-4">
				<div class="card">
					<div class="card-body">
						<a style="float: right" class="btn btn-success btn-sm"
						   href="<?php echo base_url() ?>articles/create">Ajouter</a>
						<table id="dt-material-checkbox" class="table table-hover w-100">
							<thead>
							<tr class="text-justify">
								<th class="th-sm">Image</th>
								<th class="th-sm">Désignation</th>
								<th class="th-sm">Catégorie</th>
								<th class="th-sm">Prix Unitaire</th>
								<th class="th-sm">Quantité Stock</th>
								<th class="th-lg">Action</th>
							</tr>
							</thead>
							<tbody>
							<?php foreach ($articles as $row) : ?>
								<tr class="text-left">
									<td><img class="rounded"
											 src="<?php echo base_url() ?>assets/img/articles/<?= $row->image_article ?>"
											 width="50" height="50"></td>

									<td class="font-weight-bold"><?php echo ucfirst($row->designation) ?></td>
									<td><?php echo ucfirst($row->nom_categorie) ?></td>
									<td class="font-weight-bold"><?= $row->devise ?> <?= number_format($row->prix_unitaire, 2, ',', ' ') ?></td>
									<td><?= $row->qte_actuelle . " $row->unityName " ?> </td>

									<td class="d-flex justify-content-between">
										<a href="<?php echo base_url() ?>articles/entree/<?= $row->id_article ?>"
										   class="btn-sm btn-outline-pink">Entrée</a>

										<a href="<?php echo base_url() ?>sorties/sortie/<?= $row->id_article ?>"
										   class="btn-sm btn-outline-info">Sortie</a>

										<a href="<?php echo base_url() ?>articles/edit/<?= $row->id_article ?>"
										   class="btn-sm btn-outline-purple"><i class="fa fa-edit"></i></a>

										<a onclick="return confirm('Etes-vous sûr de supprimer cette commande ?');"
										   class="btn-sm btn-outline-danger"
										   href="<?php echo base_url() ?>articles/delete/<?= $row->id_article ?>"><i
													class="fa fa-trash-alt"></i></a>
									</td>
								</tr>
							<?php endforeach; ?>
							</tbody>
							<!-- Table body -->
						</table>
						<!-- Table  -->

					</div>

				</div>
				<!--/.Card-->

			</div>
			<!--Grid column-->

			<!--Grid column-->

		</div>
		<!--Grid row-->
		<div class="pt-4 mb-5"></div>
		<div class="pt-3 mb-2"></div>
	</div>
</main>
<!--Main layout-->
