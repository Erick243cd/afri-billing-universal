<main class="pt-5">
	<div class="container-fluid mt-5">
		<!-- Heading -->
		<div class="card mb-4 wow fadeIn">
			<!--Card content-->
			<div class="card-body d-sm-flex justify-content-between">

				<h4 class="mb-2 mb-sm-0 pt-1">
					<a href="<?php echo base_url() ?>pages/dashboards">Page d'accueil</a>
					<span>/</span>
					<span><?= $title; ?></span>
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
						   href="<?php echo base_url() ?>sales_points/create">Nouveau point de vente</a>
						<table id="dt-material-checkbox" class="table table-hover w-100">
							<thead>
							<tr>
								<th>Point de vente</th>
								<th class="th-sm">Adresse</th>
								<th></th>
							</tr>
							</thead>
							<!-- Table head -->
							<!-- Table body -->
							<tbody>
							<?php foreach ($sales_points as $row): ?>
								<tr>
									<td><?= $row->salespoint_name ?></td>
									<td><?= $row->salespoint_adress ?></td>
									<td>
										<a class="btn-outline-primary btn-sm"  href="<?= base_url() ?>sales_points/update/<?= $row->salespoint_id ?>">Editer</a>
										<a onclick="return confirm('Etes-vous sûr de continuer ?');" class="btn-outline-danger btn-sm"  href="<?= base_url() ?>sales_points/delete/<?= $row->salespoint_id ?>">Supprimer</a>
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
	</div>
</main>
<!--Main layout-->

