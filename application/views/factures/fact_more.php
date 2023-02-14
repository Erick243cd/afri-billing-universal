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

	<title><?= $title ?? "Facture n°" . $facture['fact_token'] ?></title>
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
			<p class="" style="margin-left: -20px">
				<span class="text-danger">Galaxy Phone</span><br>
				<span class="font-italic">Tel : (243) 0003033 / 0033033</span><br>
				Email : contact@nomdomaine.com
			</p>
		</div>
	</div>

	<div class="d-flex justify-content-between">
		<div class="col-sm-6 d-flex justify-content-start">
		</div>
		<div class="col-sm-3">
			<p><span class="font-weight-bold">Facture n° : <?= $facture["fact_token"] ?></span><br/>
				<span class="font-weight-bold">Date</span> : <?= date('d-m-Y', strtotime($facture["date_facture"])) ?>
				<br>
				<a href="<?= site_url('commandes') ?>" class="not-print link-message"> Liste des factures</a><br>
				<a href="<?= site_url('commandes/paymentReceipt/' . $facture["fact_token"] . '/' . $facture['client_token']) ?>"
				   class="not-print link-message"> IMPRIMER</a>
			</p>
		</div>
		<div class="col-sm-3 text-right pr-4">
			<p><span class="font-weight-bold">Client </span><br/>
				<?= $facture['client_name'] !== '' ? $facture['client_name'] : $facture["client_token"] ?><br/>
				<a href="<?= site_url('shopping_cart') ?>" class="not-print link-message"> Nouvelle facture</a>
			</p>
		</div>
	</div>
	<div class="card-body">
		<table class="table table-striped table-bordered">
			<thead>
			<th>Designation</th>
			<th>Qté</th>
			<th>P.U</th>
			<th>Remise</th>
			<th>Total</th>
			</thead>

			<?php $suffix = '';
			$remise = 0;
			?>
			<?php foreach ($factures as $row): ?>
				<?php
				$total += $row->subtotal;
				$remise += $row->remise;
				if ($row->qte_achetee > 1 && $row->unityName != 'Rouleau') {
					$suffix = 's';
				} elseif ($row->qte_achetee > 1 && $row->unityName === 'Rouleau') {
					$suffix = 'x';
				}
				?>
				<tr class="font-weight-bold">
					<td class="font-weight-bold"><?= $row->designation ?></td>
					<td class="font-weight-bold"><?= $row->qte_achetee . "  $row->unityName" . $suffix ?> </td>
					<td class="font-weight-bold">FC <?= number_format($row->prix_unitaire, 2, '.', '') ?></td>
					<td class="font-weight-bold">FC <?= number_format($row->remise, 2, '.', '') ?></td>
					<td class="font-weight-bold">FC <?= number_format($row->subtotal - $row->remise, 2, '.', '') ?></td>
				</tr>
			<?php endforeach ?>
		</table>
		<div class="float-right border-dark m-1 w-50">
			<h4 class="border border-default font-weight-bold ml-5 p-2 text-right" style="letter-spacing: 2px">Total
				TTC: FC <?= number_format($total - $remise, 2, '.', '') ?></h4>
			<?php
			$tva = ($total - $remise) * 0.16;

			if ($facture['product_tva'] > 0): ?>
				<p class="font-weight-bold text-right" style="letter-spacing: 2px">
					Total HTVA :
					FC <?= number_format($total - $remise - $tva, '2', '.', ' ') ?><br>
					Total TVA (16%) : FC <?= number_format($tva, '2', '.', ' ') ?></p>
			<?php endif; ?>
		</div>

	</div>
</div>
</body>
</html>

