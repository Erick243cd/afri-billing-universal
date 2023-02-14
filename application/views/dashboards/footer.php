<div class="container mt-5 text-right not-print">
	<p>&copy Afrinewsoft, Tous droits reservés</p>
	<p><i class="fas fa-phone mr-1"></i> +243 992 689 105 <br>
		<i class="fas fa-mail-bulk mr-1"></i> contact@afrinewsoft.com <br>
		<i class="fas fa-weebly mr-1"></i><a href="https://afrinewsoft.com" target="_blank">www.afrinewsoft.com</a> <br>
	</p>
</div>
<!-- SCRIPTS -->
<!-- JQuery -->
<script type="text/javascript" src="<?= base_url() ?>assets/dashboards/js/jquery-3.4.1.min.js"></script>
<!-- Bootstrap tooltips -->
<!-- Select2 -->
<script src="<?= base_url() ?>assets/plugins/select2/js/select2.full.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/dashboards/js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="<?= base_url() ?>assets/dashboards/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="<?= base_url() ?>assets/dashboards/js/mdb.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/dashboards/js/main.js"></script>
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


<script>
	$(document).ready(function () {
		$('.add_cart').click(function () {
			var product_id = $(this).data("productid");
			var product_name = $(this).data("productname");

			var product_unit_price = $(this).data("price");//Prix unitaire
			var product_price_buy = $(this).data("product_price_buy");//Prix d'achat
			var quantity = $('#' + product_id).val();

			var max_quantity = $(this).data("max_quantity");
			var unity = $(this).data("unity");

			var remise = $('#remise' + product_id).val();

			if (quantity != '' && quantity > 0) {
				if (quantity > max_quantity) {
					alert(`La quantité doit être inférieure ou égale au stock`);
				} else if (remise != '' && remise > 0 && remise >= (product_unit_price * quantity)) {
					alert(`La remise doit être inférieure au prix de vente total d'un article !`);
				} else {
					$.ajax({
						url: "<?php echo base_url();?>shopping_cart/add",
						method: "POST",
						data: {
							product_id: product_id,
							product_name: product_name,
							product_price: product_unit_price,
							quantity: quantity,
							product_unit_price: product_unit_price,
							product_price_buy: product_price_buy,
							unity: unity,
							remise: remise
						},
						success: function (data) {
							//alert("Article ajouté à la facture");
							$('#cart_details').html(data);
							$('#' + product_id).val('');
							$('#sales_price' + product_id).val('');
							$('#remise' + product_id).val('');
						}
					});
				}

			} else {
				alert("Saisissez la quantité svp !");
			}

		});

		$('#cart_details').load("<?php echo base_url();?>shopping_cart/load");

		//Suppression
		$(document).on('click', '.remove_inventory', function () {
			var row_id = $(this).attr("id");
			if (confirm("Etes-vous sûr de retirer cet article de votre facture ?")) {
				$.ajax({

					url: "<?php echo base_url();?>shopping_cart/remove",
					method: "POST",
					data: {row_id: row_id},
					success: function (data) {
						//alert("Article retiré de la facture");
						$('#cart_details').html(data);
					}

				});

			} else {
				return false;
			}
		});

		$(document).on('click', '#clear_cart', function () {
			if (confirm("Etes-vous sûr de vider la facture ?")) {
				$.ajax({
					url: "<?php echo base_url();?>shopping_cart/clear",
					success: function (data) {
						alert("Votre facture a été vidé avec succès .");
						$('#cart_details').html(data);
					}
				});
			} else {
				return false;
			}
		});
	});
</script>

</body>

</html>
