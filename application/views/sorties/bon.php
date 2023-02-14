<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link href="<?php echo base_url() ?>assets/img/favicon.png" rel="icon" type="image/png">
	<!--	Core MDB-->
	<link href="<?= base_url() ?>assets/dashboards/css/mdb.min.css" rel="stylesheet">
	<!--	Font-->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/dashboards/css/all.css">
	<!-- Bootstrap core CSS -->
	<link href="<?= base_url() ?>assets/dashboards/css/bootstrap.min.css" rel="stylesheet">

	<title><?= $title ?? "Bon de sortie n°" . $output->key_sortie ?></title>

	<?php
	$total = null;
	?>
	<style>
		@media print {
			.not-print {
				display: none;
			}
		}
	</style>
</head>
<body class="container">
<div class="card p-5 m-5">
	<div class="row">
		<div class="col-md-2 w-25">
			<img src="<?= base_url() ?>assets/img/excellent-congo-logo.png" alt="Logo"
				 style="width: 200px; margin-top: -10px!important;">
		</div>
		<div class="col-md-10 text-center justify-content-center mb-0 w-75">
			<h4>EXCELLENT CONGO</h4>
			<p class="mt-2" style="margin-left: -20px">
				<span class="text-danger">Galaxy Phone</span> <br>
				<span class="font-italic">Tel : (243) 0003033 / 0033033</span><br>
				Email : contact@nomdomaine.com
			</p>
		</div>
	</div>

	<div class="d-flex justify-content-between">
		<div class="col-sm-6 d-flex justify-content-start">
		</div>
		<div class="col-sm-3">
			<p><span class="font-weight-bold">Bon de sortie n° : <?= $output->key_sortie ?></span><br/>
				<span class="font-weight-bold">Date </span> : <?= date('d-m-Y', strtotime($output->date_sortie)) ?>
				<br>
				<a href="<?= site_url('sorties') ?>" class="not-print link-message"> Liste des bons</a>
			</p>
		</div>
		<div class="col-sm-3 text-right pr-4">
			<p><span class="font-weight-bold">Point de vente </span><br/>
				<?= $output->salespoint_name ?><br/>
				<a href="<?= site_url('articles') ?>" class="not-print link-message">Nouvelle sortie</a>
			</p>
		</div>
	</div>
	<div class="card-body">
		<table class="table table-striped table-bordered">
			<thead>
			<th>Designation</th>
			<th>Qté</th>
			<th>Date</th>
			</thead>
			<?php $suffix = ''; ?>
			<?php

			if ($output->qte_sortie > 1 && $output->unityName != 'Rouleau') {
				$suffix = 's';
			} elseif ($output->qte_sortie > 1 && $output->unityName === 'Rouleau') {
				$suffix = 'x';
			}
			?>
			<tr class="font-weight-bold">
				<td class="font-weight-bold"><?= $output->designation ?></td>
				<td class="font-weight-bold"><?= $output->qte_sortie . "  $output->unityName" . $suffix ?> </td>
				<td class="font-weight-bold"><?= $output->date_sortie ?></td>
			</tr>
		</table>
	</div>
</div>
</body>
</html>


