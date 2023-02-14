<main class="pt-5">
	<div class="container-fluid mt-5">
		<!-- Heading -->
		<div class="row wow fadeIn">
			<div class="col-md-12">
				<?php if ($this->session->flashdata('success')): ?>
					<div class="alert alert-success alert-dismissible" role="alert" id="connexion-failed">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close" id="btn-close">
							<span aria-hidden="true">&times;</span>
						</button>
						<strong><?php echo $this->session->flashdata('success'); ?></strong>
					</div>
				<?php endif; ?>
				<?php if ($this->session->flashdata('error')): ?>
					<div class="alert alert-danger alert-dismissible" role="alert" id="connexion-failed">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close" id="btn-close">
							<span aria-hidden="true">&times;</span>
						</button>
						<strong><?php echo $this->session->flashdata('error'); ?></strong>
					</div>
				<?php endif; ?>
				<div class="col-md-12 mb-4">
					<div class="card">
						<div class="card-body">
							<a style="float: right" class="btn btn-success btn-sm"
							   href="<?= base_url() ?>" data-toggle="modal" data-target="#quickview">Facture</a>
							<a class="btn btn-primary btn-sm"
							   href="<?= base_url('commandes') ?>">Liste des factures</a>
							<table id="dt-material-checkbox" class="table table-striped w-100"
								   width="100%">
								<thead>
								<tr class="text-center">
									<th class="th-sm"></th>
									<th class="th-sm"></th>
									<th class="th-sm"></th>
									<th class="th-sm"></th>
									<th class="th-sm"></th>
									<th class="th-sm"></th>

								</tr>
								</thead>
								<tbody>
								<?php foreach ($articles as $row): ?>
									<tr>
										<td class="font-weight-bold"><?php echo ucfirst($row->designation) ?>
											( <?= number_format($row->prix_unitaire, 2, ',', '') ?> <?= $row->devise ?>)
										</td>
										<td>
											<span class="red-text font-weight-bold">
												Stock : <?= ($row->disponibleQty > 1 && $row->unityName != 'Rouleau') ? $row->disponibleQty . " $row->unityName" . "s" : $row->disponibleQty . " $row->unityName " ?>
											</span>

											<input type="hidden" disabled
												   placeholder="Stock :<?= ($row->disponibleQty > 1 && $row->unityName != 'Rouleau') ? $row->disponibleQty . " $row->unityName" . "s" : $row->disponibleQty . " $row->unityName " ?> "
												   min="1" class="form-control quantity">
										</td>
										<td class="">
											<input type="number" placeholder="Quantité" style="width:100px;" min="1"
												   name="quantity" class="form-control quantity"
												   id="<?= $row->id_article ?>">
										</td>
										<td class="">
											<input type="number" placeholder="Remise" style="width:100px;" min="0"
												   name="remise" class="form-control"
												   id="remise<?= $row->id_article ?>">
										</td>

										<input type="hidden" required
											   value="<?= $row->prix_unitaire ?>"
											   name="Prix" class="form-control quantity"
											   id="sales_price<?= $row->id_article ?>">
										<td>
											<button type="button"
													name="add_cart" class="btn btn-default btn-sm add_cart"
													data-productname="<?= $row->designation ?>"
													data-price="<?= $row->prix_unitaire ?>"
													data-productid="<?= $row->id_article ?>"
													data-product_price_buy="<?= $row->prix_achat ?>"
													data-max_quantity="<?= $row->disponibleQty ?>"
													data-unity="<?= $row->unityName ?>">
												<span class="fa fa-plus"></span>
											</button>
										</td>
										<td> <?= $row->nom_categorie ?></td>
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
			</div>
			<div class="col col-lg-12">
				<div class="modal fade" id="quickview" tabindex="-1" role="dialog" aria-labelledby="quickview"
					 aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<?= form_open('commandes/create') ?>
							<div class="modal-header text-center">
								<h6 class="border-bottom border-gray pb-2 mb-0">Facture</h6>
							</div>
							<div class="modal-body" id="cart_details">
								<h4 class="text-center">La facture est vide</h4>




							<?= form_close() ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--Grid row-->
		<div class="pt-4 mb-5"></div>
		<div class="pt-3 mb-2"></div>
	</div>
</main><!--Main layout-->
