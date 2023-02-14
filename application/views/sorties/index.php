<main class="pt-5">
	<div class="container-fluid mt-5">
		<?php if ($this->session->flashdata('success')): ?>
			<div class="alert alert-success alert-dismissible" role="alert" id="connexion-failed">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close" id="btn-close">
					<span aria-hidden="true">&times;</span>
				</button>
				<strong><?php echo $this->session->flashdata('success'); ?></strong>
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
			<div class="col-md-12 mb-4">
				<div class="card">
					<div class="card-body">
						<a style="float: right" class="btn purple-gradient btn-sm"
						   href="<?php echo base_url() ?>articles">Nouvelle sortie</a>
						<table id="dt-material-checkbox" class="table table-hover" cellspacing="0"
							   width="100%">
							<thead class="blue-grey lighten-4">
							<tr class="">
								<th class="th-sm">Date sortie</th>
								<th class="th-sm">Article</th>
								<th class="th-sm">Quantité sortie</th>
								<th class="th-sm">Stock Restant</th>
								<th class="th-sm">Motif de sortie</th>
								<th class="th-lg"></th>

							</tr>
							</thead>
							<tbody>
							<?php foreach ($sorties as $row): ?>
								<tr>
									<td class="font-weight-bold"><?= $row->date_sortie ?></td>
									<td><?= $row->designation ?></td>
									<td class="font-weight-bold"><?= $row->qte_sortie . " " . $row->unityName ?></td>
									<td class="font-weight-bold text-info"><?= $row->qte_restante . " " . $row->unityName ?></td>
									<td class="font-weight-bold"><?= $row->motif_sortie . " " . $row->salespoint_name ?></td>
									<td>
										<a class="btn-sm btn-info"
										   href="<?= site_url('sorties/edit/' . $row->id_sortie) ?>"><i
													class="fa fa-edit"></i></a>
										<a href="<?= site_url() ?>sorties/printByOutput/<?= $row->id_sortie ?>"
										   class="btn-sm btn-outline-primary">Bon de sortie</a>
									</td>
								</tr>
							<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>

		</div>
		<!--Grid row-->
		<div class="pt-4 mb-5"></div>
		<div class="pt-3 mb-2"></div>

	</div>
</main><!--Main layout-->
