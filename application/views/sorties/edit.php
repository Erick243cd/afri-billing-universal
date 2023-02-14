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
				<?php echo form_open_multipart('sorties/update/' . $output->id_sortie); ?>
				<input type="hidden" name="output_qty" value="<?= $output->qte_sortie ?>" required>
				<input type="hidden" name="product_id" value="<?= $output->id_article ?>" required>
				<input type="hidden" name="ancient_sales_point_id" value="<?= $output->salespoint_id ?>" required>

				<div class="row">
					<div class="col-md-4">
						<div class="md-form">
							<label for="" class="font-weight-bold text-info">Quantité sortie</label>
							<input type="number" class="form-control" name="current_qty" required="required" min="1"
								   value="<?= $output->qte_sortie ?>">
						</div>
					</div>
					<div class="col-md-3">
						<select class="browser-default custom-select mdb-select" name="sales_point_id"
								required="required">
							<option value="<?= $output->salespoint_id ?>"><?= $output->salespoint_name ?></option>
							<?php foreach ($salespoints as $row) : ?>
								<option value="<?= $row->salespoint_id ?>" <?= set_select('sales_point_id', $row->salespoint_id) ?>><?= $row->salespoint_name; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="col-sm-12 mb-0">
					<button type="submit" class="btn btn-md blue-gradient mt-3" style="margin-bottom: 10px">Mettre à
						jour
						la sortie
					</button>
				</div>
			</div>
			</form>
		</div>
	</div>
	</div>
</main>
