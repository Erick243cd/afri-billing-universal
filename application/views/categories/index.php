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

		<!--Grid row-->
		<div class="row wow fadeIn">
			<!--Grid column-->
			<div class="col-md-12 mb-4">
				<?php if ($this->session->flashdata('success')) : ?>
					<div class="alert alert-success alert-dismissible" role="alert" id="connexion-failed">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close" id="btn-close">
							<span aria-hidden="true">&times;</span>
						</button>
						<strong><?php echo $this->session->flashdata('success'); ?></strong>
					</div>
				<?php endif; ?>
				<!--Card-->
				<div class="card">
					<!--Card content-->
					<div class="card-body">
						<a style="float: right" class="btn purple-gradient btn-sm"
						   href="<?php echo base_url() ?>categories/create">Nouvelle catégorie</a>
						<table id="dt-material-checkbox" class="table table-hover" cellspacing="0"
							   width="100%">
							<thead>
							<tr>
								<th class="th-sm">Nom</th>
								<th></th>
							</tr>
							</thead>
							<tbody>
							<?php foreach ($categories as $row): ?>
								<tr>
									<td><?php echo ucfirst($row->nom_categorie) ?></td>
									<td>
										<a class="btn-outline-primary btn-sm"
										   href="<?= base_url() ?>categories/edit/<?= $row->id_categorie; ?>">Editer</a>
										<a class="btn-outline-danger btn-sm" onclick="return confirm('Etes-vous sûr de supprimer cette catégorie ?');"
										   href="<?= base_url() ?>categories/delete/<?= $row->id_categorie; ?>">Supprimer</a>
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

