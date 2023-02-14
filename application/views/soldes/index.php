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

		<?= form_open("commandes/soldes") ?>
		<div class="card mb-4 wow fadeIn not-print">
			<div class="card-body d-lg-flex justify-content-center">
				<div class="row">
					<h4 class="col-sm-6">Solde
						du <?= ($this->input->post('date_facture') !== null) ? date('d, M Y', strtotime($this->input->post('date_facture'))) : date('d, M Y') ?>
					</h4>
					<div class="col-sm-4">
						<input type="date" name="date_facture" class="form-control" required>
					</div>
					<div class="col-sm-2">
						<input type="submit" class="btn btn-md btn-primary m-0" value="Charger">
					</div>
				</div>
			</div>
		</div>
		</form>

		<!--Grid row-->
		<div class="row wow fadeIn">
			<!--Grid column-->
			<div class="col-md-4">
				<div class="card">
					<div class="card-body">
						<h4 class="text-center text-center">
							<span class="text-danger text-center">USD</span>
							$ <?= isset($usd_amount) ? number_format($usd_amount, 0, ' ', ' ') : "00" ?>
						</h4>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card">
					<div class="card-body">
						<h4 class="text-center text-center">
							<span class="text-danger text-center">FC</span>
							<?= isset($cdf_amount) ? number_format($cdf_amount, 0, ' ', ' ') : "00" ?>
						</h4>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card">
					<div class="card-body">
						<h4 class="text-center text-center">
							<span class="text-danger text-center">REMISE</span>
							FC <?= isset($remise) ? number_format($remise, 0, ' ', ' ') : "00" ?>
						</h4>
					</div>
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
