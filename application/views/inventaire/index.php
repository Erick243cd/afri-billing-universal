<main class="pt-5">
	<div class="container-fluid mt-5  not-print">
		<?= form_open("articles/inventaire") ?>
		<div class="card mb-4 wow fadeIn">
			<div class="card-body d-lg-flex">
				<div class="row" style="width: 100%; height: initial;">
					<div class="col-sm-4 text-center content-center">
						<select class="form-control mdb-select" style="size: 20px;" name="month" required>
							<option selected disabled>Mois <?= date("Y") ?></option>
							<option value="1">Janvier</option>
							<option value="2">Février</option>
							<option value="3">Mars</option>
							<option value="4">Avril</option>
							<option value="5">Mais</option>
							<option value="6">Juin</option>
							<option value="7">Juillet</option>
							<option value="8">Août</option>
							<option value="9">Septembre</option>
							<option value="10">Octobre</option>
							<option value="11">Novembre</option>
							<option value="12">Décembre</option>
						</select>
					</div>
					<div class="col-sm-4 text-center content-center">
						<select class="form-control mdb-select" style="size: 20px;" name="motif">
							<option selected disabled>Motif</option>
							<?php foreach ($motifs as $row): ?>
								<option value="<?= $row->motif_sortie ?>"><?= $row->motif_sortie ?></option>
							<?php endforeach ?>

						</select>
					</div>
					<div class="col-sm-4 text-center"><input type="submit" class="btn btn-md btn-primary m-0"
															 value="Charger">
						<h6 class="font-weight-bold text-success"><?= $title ?? "" ?></h6>
					</div>
				</div>
			</div>
		</div>
		</form>
	</div>
	<!-- Heading -->
	<div class="row m-0">
		<div class="col-md-12">
			<div class="card mb-4 wow fadeIn">
				<div class="card-body">
					<h4 class="mb-2 mb-sm-0">
						<a href="">Sorties</a>
						<table class="table table-hover table-responsive-sm">
							<thead>
							<th>Désignation</th>
							<th></th>
							<th>Qte</th>
							<th></th>
							<th>Motif</th>
							<th></th>
							<th></th>
							<th>Date</th>
							</thead>
							<tbody class="">
							<?php foreach ($outputs as $row): ?>
								<tr>
									<td><span><?= $row->designation ?></span></td>
									<td></td>
									<td class="text-right"><span><?= $row->qte_sortie ?></span></td>
									<td></td>
									<td><?= $row->motif_sortie . " " . "<b>". $row->salespoint_name ."</b>"?></td>
									<td></td>
									<td></td>
									<td><?= $row->date_sortie ?></td>
								</tr>
							<?php endforeach ?>
							</tbody>
						</table>
					</h4>
				</div>
			</div>
		</div>

		<div class="col-md-12">
			<div class="card mb-4 wow fadeIn">
				<div class="card-body">
					<h4 class="mb-2 mb-sm-0 pt-1">
						<a href="">Entrées</a>
						<table class="table table-hover table-responsive-sm">
							<thead>
							<th>Désignation</th>

							<th>Qte</th>
							<th>Date</th>
							</thead>
							<tbody class="">
							<?php foreach ($inputs as $row): ?>
								<tr>
									<td><span><?= $row->designation ?></span></td>
									<td><span><?= $row->qte_reappro ?></span></td>
									<td><?= $row->date_reappro ?></td>
								</tr>
							<?php endforeach ?>
							</tbody>
						</table>
					</h4>
				</div>
			</div>
		</div>
	</div>

	<!--Grid row-->
	<div class="pt-4 mb-5"></div>
	<div class="pt-3 mb-2"></div>

	</div>
</main><!--Main layout-->
