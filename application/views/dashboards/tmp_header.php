<?php
$session_data = $this->session->userdata('logged_in');
$data['id'] = $session_data['id'];
$data['user_name'] = $session_data['user_name'];
$data['role_utilisateur'] = $session_data['role_utilisateur'];
$data['user_image'] = $session_data['user_image'];
if (empty($data['id'])) {
    redirect(base_url('pages/connexion'));
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Billing & Stock Manager | by Afrinewsoft</title>
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/dashboards/css/all.css">
	<!-- Bootstrap core CSS -->
	<link href="<?php echo base_url() ?>assets/dashboards/css/bootstrap.min.css" rel="stylesheet">
	<!-- Material Design Bootstrap -->
	<link href="<?php echo base_url() ?>assets/dashboards/css/mdb.min.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>assets/dashboards/css/sidebar.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>assets/dashboards/css/myStyle.css" rel="stylesheet">

	<!-- Your custom styles (optional) -->
	<link href="<?php echo base_url() ?>assets/dashboards/css/style.min.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>assets/dashboards/css/addons/datatables.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>assets/dashboards/css/addons/datatables-select.css" rel="stylesheet">
	<!-- Select2 -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

	<link href="<?php echo base_url() ?>assets/dashboards/css/addons/datatables-select.css" rel="stylesheet">


	<style type="text/css">
        @media print {
            .not-print {
                display: none;
            }
        }
	</style>
</head>

<body class="grey lighten-3">

<!--Main Navigation-->
<header>
	<!-- Navbar -->
	<nav class="navbar fixed-top navbar-expand-lg navbar-dark purple-gradient scrolling-navbar">
		<div class="container-fluid">

			<!-- Brand -->
			<a class="navbar-brand waves-effect" href="<?php echo base_url() ?>pages/dashboards">
				<strong class="white-text">STOCK APP</strong>
			</a>

			<!-- Collapse -->
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
					aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<!-- Links -->
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<!-- Left -->
				<ul class="navbar-nav mr-auto">

				</ul>

				<!-- Right -->
				<ul class="navbar-nav nav-flex-icons">
					<li class="nav-item">
						<a href="<?php echo base_url() ?>users/edit/<?php echo $data['id'] ?>"
						   class="nav-link border border-light rounded waves-effect">
							<i class="fa fas-user mr-2"></i><?php echo ucfirst($data['user_name']); ?>
						</a>
					</li>
					<li class="nav-item">
						<a onclick="return confirm('Êtes-vous sûr de vous déconnecter ?');"
						   href="<?php echo base_url() ?>pages/logout"
						   class="nav-link border border-light rounded waves-effect">
							<i class="fas fa-lock mr-2"></i>Se Déconnecter
						</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- Navbar -->


	<!-- Sidebar -->
	<div class="sidebar-fixed position-fixed">

		<div class="list-group list-group-flush mt-5">
			<a href="<?php echo base_url() ?>pages/dashboards" class="list-group-item active waves-effect">
				<i class="fas fa-chart-pie mr-3"></i>Dashboard
			</a>


			<a href="<?php echo base_url() ?>shopping_cart" class="list-group-item list-group-item-action waves-effect">
				<i class="fas fa-money-bill-alt mr-3 green-text"></i>Facturation</a>

			<a href="<?php echo base_url() ?>commandes" class="list-group-item list-group-item-action waves-effect">


				<i class="fas fa-database mr-3 red-text"></i>Invoices</a>

			<a href="<?php echo base_url() ?>commandes/facturesByarticle"
			   class="list-group-item list-group-item-action waves-effect">
				<i class="fas fa-chart-bar mr-3 blue-text"></i>Ventes</a>
			<a href="<?php echo base_url() ?>sorties" class="list-group-item list-group-item-action waves-effect">
				<i class="fas fa-cannabis mr-3 text-info"></i>Sorties</a>

			<a href="<?php echo base_url() ?>articles/entreelist"
			   class="list-group-item list-group-item-action waves-effect">
				<i class="fas fa-chart-bar mr-3 pink-text"></i>Entrée</a>
			<a href="<?php echo base_url() ?>articles/index"
			   class="list-group-item list-group-item-action waves-effect">
				<i class="fas fa-calculator mr-3 text-danger"></i>Articles</a>
			<a href="<?php echo base_url() ?>commandes/facturesByarticle"
			   class="list-group-item list-group-item-action waves-effect">
				<i class="fas fa-database mr-3 red-text"></i>Ventes</a>

			<a href="<?php echo base_url() ?>articles/inventaire"
			   class="list-group-item list-group-item-action waves-effect">
				<i class="fas fa-database mr-3 blue-text"></i>Stock</a>

			<a href="<?php echo base_url() ?>commandes/soldes"
			   class="list-group-item list-group-item-action waves-effect">
				<i class="fas fa-money-bill-alt mr-3 green-text"></i>Soldes</a>

			<a href="<?php echo base_url() ?>commandes/retrieveList"
			   class="list-group-item list-group-item-action waves-effect">
				<i class="fas fa-chart-pie mr-3 red-text"></i>Dépenses</a>

            <?php if ($data['role_utilisateur'] == 'admin'): ?>

				<a href="<?php echo base_url() ?>users" class="list-group-item list-group-item-action waves-effect">
					<i class="fas fa-user-alt-slash mr-3 text-success"></i>Utilisateurs</a>
            <?php endif; ?>

			<a href="<?php echo base_url() ?>commandes/soldes"
			   class="list-group-item list-group-item-action waves-effect">
				<i class="fas fa-money-bill-alt mr-3 green-text"></i>Soldes</a>


			<a href="<?php echo base_url() ?>articles/index"
			   class="list-group-item list-group-item-action waves-effect">
				<i class="fas fa-calculator mr-3 text-danger"></i>Articles</a>

			<a href="<?php echo base_url() ?>sorties" class="list-group-item list-group-item-action waves-effect">
				<i class="fas fa-cannabis mr-3 text-info"></i>Sorties</a>

			<a href="<?php echo base_url() ?>articles/entreelist"
			   class="list-group-item list-group-item-action waves-effect">
				<i class="fas fa-chart-bar mr-3 pink-text"></i>Entrée</a>

			<a href="<?php echo base_url() ?>articles/inventaire"
			   class="list-group-item list-group-item-action waves-effect">
				<i class="fas fa-database mr-3 red-text"></i>Stock</a>


			<a href="<?php echo base_url() ?>users/view_membre"
			   class="list-group-item list-group-item-action waves-effect">
				<i class="fas fa-user mr-3"></i>Mon compte</a>
		</div>

	</div>
	<!-- Sidebar -->
</header>
<?php if ($this->session->flashdata('message')): ?>
    <?php echo '<p class="alert alert-success">' . $this->session->flashdata('message') . '</p>'; ?>
<?php endif; ?>
<?php if ($this->session->flashdata('post_updated')): ?>
    <?php echo '<p class="alert alert-success">' . $this->session->flashdata('post_updated') . '</p>'; ?>
<?php endif; ?>
<?php if ($this->session->flashdata('post_deleted')): ?>
    <?php echo '<p class="alert alert-success">' . $this->session->flashdata('post_deleted') . '</p>'; ?>
<?php endif; ?>


