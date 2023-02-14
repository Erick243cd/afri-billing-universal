<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link href="<?php echo base_url() ?>assets/img/favicon.png" rel="icon" type="image/png">
	<link href="<?php echo base_url() ?>assets/img/favicon.png" rel="icon" type="image/png">
	<!--	Core MDB-->
	<link href="<?= base_url() ?>assets/dashboards/css/mdb.min.css" rel="stylesheet">
	<!--	Font-->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/dashboards/css/all.css">
	<!-- Bootstrap core CSS -->
	<link href="<?= base_url() ?>assets/dashboards/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/dashboards/css/addons/datatables.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/dashboards/css/addons/datatables-select.css" rel="stylesheet">

	<title><?= $title ?? "Point de vente " . $sales_point->salespoint_name ?></title>

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
			<p>
				<span class="font-weight-bold">Rapport de Stock n° : #<?= $sales_point->salespoint_id ?></span><br/>
				<br>
				<a href="<?= site_url('sorties/salesPoints') ?>" class="not-print link-message"> Liste de point de
					ventes</a>
			</p>
		</div>
		<div class="col-sm-3 text-right pr-4">
			<p><span class="font-weight-bold">Point de vente </span><br/>
				<?= $sales_point->salespoint_name ?><br/>
				<a href="<?= site_url('articles') ?>" class="not-print link-message">Nouvelle sortie</a>
			</p>
		</div>
	</div>
	<div class="card-body">
		<table id="dt-material-checkbox" class="table table-striped table-bordered w-100">
			<thead>
			<tr>
				<th>Designation</th>
				<th>Quantité en stock</th>
			</tr>
			</thead>
			<tbody>
			<?php $suffix = ''; ?>
			<?php
			foreach ($stockdata as $output) : ?>
				<?php
				if ($output->disponibleQty > 1 && $output->unityName != 'Rouleau') {
					$suffix = 's';
				} elseif ($output->disponibleQty > 1 && $output->unityName === 'Rouleau') {
					$suffix = 'x';
				}
				?>
				<tr class="font-weight-bold">
					<td class="font-weight-bold"><?= $output->designation ?></td>
					<td class="font-weight-bold"><?= $output->disponibleQty . "  $output->unityName" . $suffix ?> </td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript" src="<?= base_url() ?>assets/dashboards/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/dashboards/js/addons/datatables.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/dashboards/js/addons/datatables-select.js"></script>

<script type="text/javascript">
	//Datatable config
	$('#dt-material-checkbox').dataTable({
		"scrollY": true,
		"scrollX": true,
		"pageLength": 100

		// // columnDefs: [{
		// // 	orderable: false,
		// // 	className: 'select-checkbox',
		// // 	targets: 0
		// // }],
		// select: {
		// 	style: 'os',
		// 	// selector: 'td:first-child'
		// }
	});

</script>
</body>
</html>
