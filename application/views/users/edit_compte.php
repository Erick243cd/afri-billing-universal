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
		<div class="card p-5">
			<h2 style="color: darkorange; font-size: large;"><?php echo $title; ?></h2>
			<span class="text-danger"> <?php echo validation_errors(); ?></span>
			<?php echo form_open_multipart('users/update_compte'); ?>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input type="hidden" name="id" value="<?php echo $user['id']; ?>">
						<label for="">Rôle</label>
						<select name="role_user" id="" class="form-control">
							<option value="<?php echo $user['role_utilisateur']; ?>"><?php echo ucfirst($user['role_utilisateur']); ?></option>
							<option value="admin">Admin</option>
							<option value="billing">Billing Manager</option>
							<option value="stock">Stock Manager</option>
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Statut</label>
						<select name="statut" id="" class="form-control">
							<option value="<?= $user['statut']; ?>" <?= set_select('statut', $user['statut'], true) ?>><?= ucfirst($user['statut']); ?></option>
							<option value="offline" <?= set_select('statut', "online") ?>>Offline</option>
							<option value="online" <?= set_select('statut', "online") ?>>Online</option>
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Point de vente</label>
						<select name="sales_point" class="form-control" required>
							<option value="<?= $user['sales_point_id']; ?>"<?= set_select('sales_point', $user['sales_point_id'], true) ?>> <?= $user['salespoint_name']; ?> </option>

							<?php foreach ($salespoints as $row): ?>
								<option value="<?= $row->salespoint_id ?>"<?= set_select('sales_point', $row->salespoint_id, false) ?> ><?= $row->salespoint_name ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>

			<button type="submit" class="btn btn-outline-success mb-5 ml-3"
					onclick="return confirm('Ces modifications seront appliquées, Voulez-vous continuer ?')">Modifier
			</button>
			</form>
		</div>
	</div>
</main>
