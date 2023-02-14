<?php

class Shopping_cart extends CI_Controller
{

	public function index()
	{
		$sess_data = $this->session->userdata('logged_in');
		$userRole = $sess_data['role_utilisateur'];
		$salesPointId = $sess_data['sales_point_id'];

		if ($userRole != 'admin') {

			$this->load->model("shopping_cart_model");
			$this->load->model("article_model");
			//$data["articles"] = $this->article_model->get_articles();
			$data["articles"] = $this->article_model->getProductsBySalesPoint($salesPointId);

			$this->load->view('dashboards/header');
			$this->load->view('shopping_cards/index', $data);
			$this->load->view('dashboards/footer');

		} else {
			show_error("Vous n'avez pas d'autorisation à cette fonctionnalité");
		}

	}

	function add()
	{
		$tva = 0;
		$this->load->library("cart");
		$remise = $_POST['remise'] != '' ? $_POST['remise'] : 0;
		$data = array(
			"id" => $_POST['product_id'],
			"name" => $_POST['product_name'],
			"qty" => $_POST['quantity'],
			"price" => $_POST['product_price'],
			"unit_price" => $_POST['product_unit_price'],
			"buy_price" => $_POST['product_price_buy'],
			"unity" => $_POST['unity'],
			"remise" => $remise,
			"benefice" => ($_POST['product_unit_price'] - $_POST['product_price_buy']) * 2 - $remise,
			"tva" => $tva,
			"subtotal" => $_POST['product_unit_price'] * $_POST['quantity'],
			"totalWithRemise" => $_POST['product_unit_price'] * $_POST['quantity'] - $remise
		);
		$this->cart->product_name_rules = '[:print:]'; //Special characters name
		$this->cart->insert($data); //Return rowid
		echo $this->cardview();
	}

	function load()
	{
		echo $this->cardview();
	}

	function remove()
	{
		$this->load->library("cart");
		$row_id = $_POST["row_id"];
		$data = array(
			'rowid' => $row_id,
			'qty' => 0
		);
		$this->cart->update($data);
		echo $this->cardview();
	}

	function clear()
	{
		$this->load->library("cart");
		$this->cart->destroy();
		echo $this->cardview();
	}

	function destroy_cart()
	{
		$this->load->library("cart");
		$this->cart->destroy();

		$this->session->set_flashdata('success', 'Facture enregitrée!');
		redirect('shopping_cart/index');
	}

	function cardview()
	{
		$this->load->library("cart");
		$tva = 0;
		$output = '';
		$output .= '
          
                <div align="right">
                    <button type="button" id="clear_cart" class="btn btn-outline-danger btn-sm">Vider la facture</button>
                </div>
                <div class="my-3 p-3 bg-white rounded shadow-sm">    
            ';
		$count = 0;
		$total = 0;
		$remise = 0;
		$suffix = '';
		foreach ($this->cart->contents() as $items) {
			$remise += $items['remise'];

			if ($items['qty'] > 1 && $items['unity'] != 'Rouleau') {
				$suffix = 's';
			} elseif ($items['qty'] > 1 && $items['unity'] === 'Rouleau') {
				$suffix = 'x';
			}

			$count++;
			$output .= '
                            <div class="media text-muted pt-3">
                                <img data-src="holder.js/32x32?theme=thumb&bg=6f42c1&fg=6f42c1&size=1" alt="" class="mr-2 rounded">
                                <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                    <div class="d-flex justify-content-between align-items-center w-100">
                                        <strong class="text-gray-dark">Nom </strong>
                                    </div>
                                    <span class="d-block">@' . $items["name"] . '</span>
                                </div>
                                <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                    <div class="d-flex justify-content-between align-items-center w-100">
                                        <strong class="text-gray-dark">Quantité</strong>
                                    </div>
                                    <span class="d-block">' . $items["qty"] . " " . $items["unity"] . $suffix . '</span>
                                </div>

                                <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                    <div class="d-flex justify-content-between align-items-center w-100">
                                        <strong class="text-gray-dark">Prix</strong>
                                    </div>
                                    <span class="d-block"> FC ' . number_format($items["price"], 2, ',', '') . '</span>
                                </div>
                                
                           
                                <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                    <div class="d-flex justify-content-between align-items-center w-100">
                                        <strong class="text-gray-dark">Reduction</strong>
                                    </div>
                                    <span class="d-block"> FC ' . number_format($items["remise"], 2, ',', '') . '</span>
                                </div>
                                
                                <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                    <div class="d-flex justify-content-between align-items-center w-100">
                                        <strong class="text-gray-dark">Total</strong>
                                    </div>
                                    <span class="d-block"> FC ' . number_format($items["subtotal"] - $items["remise"], 2, ',', '') . '</span>
                                </div>
                       
                                <button type="button" name="remove" class="text-danger btn btn-link remove_inventory" id="' . $items["rowid"] . '">Retirer</button>
                            </div>                  
                ';
			if ($count <= 0) {
				$total = 0;
			} else {
				$total += $items["subtotal"] * $tva / 100;
			}
		}

		$totalWithReduction = $this->cart->total() + $total - $remise;
		$output .= '
        <strong class="d-block text-right text-danger mt-3">
                            <a href="#">Sous-total avec Reduction </a>  <p> FC ' . number_format($totalWithReduction, 2, ',', '') . '</p>
                        </strong>
                 </div>
                 
                 </div>
							<div class="d-md-flex justify-content-center my-1 ml-3 mr-3 mt-0">
								<div class="form-group">
									<label for="usd_amount">Montant USD</label>
									<input type="number" class="form-control" name="usd_amount" value="0" step="any"
										   required>
								</div>
								<div class="form-group">
									<label for="cdf_amount">Montant CDF</label>
									<input type="number" value="' . $totalWithReduction . '" class="form-control" name="cdf_amount" step="any"
										   required>
								</div>
								<div class="form-group">
									<label for="cdf_amount">Nom du client</label>
									<input type="text" class="form-control" name="client_name" step="any">
								</div>
							</div>
							<div class="modal-footer">
								<label class="text-danger">
									AVEC TVA <input type="checkbox" name="is_tva" value="1">
								</label>
								<a class="btn btn-default btn-sm" data-dismiss="modal">Fermer</a>
								<button type="submit" class="btn btn-primary btn-sm"
										href="' . site_url("commandes/create") . '">Enregistrer
								</button>
							</div>
        
        ';

		if ($count == 0) {
			$output = '<h4 class="text-center">La Factures est vide</h4>';
		}
		return $output;
	}
}
