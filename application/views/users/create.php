<main class="pt-5">
	<div class="container-fluid mt-5">

		<!-- Heading -->
		<div class="card mb-4 wow fadeIn">

			<!--Card content-->
			<div class="card-body d-sm-flex justify-content-between">

				<h4 class="mb-2 mb-sm-0 pt-1">
					<a href="<?php echo base_url() ?>pages/dashboards">Page d'accueil</a>
					<span>/</span>
					<span><?php echo $title; ?></span>
				</h4>

			</div>

		</div>

		<div class="card p-5">
			<h2 style="color: darkorange; font-size: large;"><?php echo $title; ?></h2>
			<span class="text-danger"><?php echo validation_errors(); ?></span>
			<?php echo form_open_multipart('users/create'); ?>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="">Nom</label>
						<input type="text" class="form-control" value="<?= set_value('username') ?>" name="username"
							   required="required">
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label for="">Rôle</label>
						<select name="role_user" class="form-control" required>
							<option value="">Sélectionner</option>
							<option value="admin" <?= set_select('role_user', 'admin') ?>>Admin</option>
							<option value="billing" <?= set_select('role_user', 'billing') ?>>Billing Manager</option>
							<option value="stock" <?= set_select('role_user', 'stock') ?>>Stock Manager</option>
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Point de vente</label>
						<select name="sales_point" class="form-control" required>
							<option value="">Sélectionner</option>
							<?php foreach ($salespoints as $row): ?>
								<option value="<?= $row->salespoint_id ?>"<?= set_select('sales_point', $row->salespoint_id, false) ?> ><?= $row->salespoint_name ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<button type="submit" class="btn btn-pink mb-5 ml-3">Enregistrer</button>
			</div>
			</form>
		</div>
	</div>
</main>
