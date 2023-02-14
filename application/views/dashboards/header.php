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
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta desciption="Application de gestion de stock et facturation">
	<title>Gestion de stock et facturation | by Afrinewsoft</title>
	<link href="<?php echo base_url() ?>assets/img/favicon.png" rel="icon" type="image/png">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/dashboards/css/all.css">
	<!-- Bootstrap core CSS -->
	<link href="<?= base_url() ?>assets/dashboards/css/bootstrap.min.css" rel="stylesheet">
	<!-- Material Design Bootstrap -->
	<link href="<?= base_url() ?>assets/dashboards/css/mdb.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/dashboards/css/sidebar.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/dashboards/css/myStyle.css" rel="stylesheet">

	<!-- Your custom styles (optional) -->
	<link href="<?= base_url() ?>assets/dashboards/css/style.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/dashboards/css/addons/datatables.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/dashboards/css/addons/datatables-select.css" rel="stylesheet">
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

<body class="grey lighten-3 app sidebar-mini rtl">
<!--Main Navigation-->
<header>
	<!-- Navbar -->
	<nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar app-header">
		<div class="container-fluid">
			<!-- Brand -->
			<a class="navbar-brand waves-effect" href="<?php echo base_url() ?>pages/dashboards">
				<strong class="pink-ic">AFRINEWSOFT</strong>
			</a>
			<a class="navbar-toggler" type="button" data-toggle="sidebar" href="" aria-label="Hide Sidebar">
				<!-- Collapse -->
				<button class="navbar-toggler" type="button" data-toggle="collapse"
						data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
						aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
			</a>
			<!-- Collapse -->


			<!-- Links -->
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<!-- Left -->
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link waves-effect rgba-pink-strong" href="<?= base_url() ?>pages/dashboards">Accueil
							<span class="sr-only">(current)</span>
						</a>
					</li>
				</ul>
				<!-- Right -->
				<ul class="navbar-nav nav-flex-icons">
					<li class="nav-item nav-link">
						<a href="#" class="fa fa-seedling pink-text"></a>
					</li>
					<li class="nav-item">
						<a onclick="return confirm('Êtes-vous sûr de vous déconnecter ?');"
						   href="<?= base_url() ?>pages/logout"
						   class="nav-link fa fa-lock border border-light rounded waves-effect">

						</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- Navbar -->

	<!-- Sidebar -->
	<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
	<div class="app-sidebar position-fixed pl-2 pr-2 " style="font-size: small">
		<div class="list-group list-group-flush mt-2">
			<a href="#" class="list-group-item active  waves-effect"
			   style="background-color: deeppink; border-color: hotpink">
				<i class="fas fa-chart-pie mr-3"></i>Dashboard
			</a>

			<div class="has-streeview mt-4" style="font-size: small">
				<a href="#" class="list-group-item  waves-effect" data-toggle="collapse" data-target="#students">
					<i class="fa fa-money-bill-alt mr-3 blue-text mr-3"></i>Facturation<i
							class="fa fa-chevron-right text-muted ml-3"></i>
				</a>
				<ul class="nav nav-treeview collapse" id="students">

					<?php if ($data['role_utilisateur'] != 'admin'): ?>
						<li class="nav-item">
							<a href="<?= base_url() ?>shopping_cart"
							   class="list-group-item list-group-item-action waves-effect">
								<i class="fa fa-cash-register green-text mr-3  ml-3"></i>Nouvelle facture</a>
						</li>
					<?php endif; ?>

					<li class="nav-item">
						<a href="<?= base_url() ?>commandes"
						   class="list-group-item list-group-item-action waves-effect">
							<i class="fa fa-list yellow-text mr-3  ml-3"></i>Liste des factures</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url() ?>commandes/canceledCommands"
						   class="list-group-item list-group-item-action waves-effect">
							<i class="fa fa-trash-restore red-text mr-3  ml-3"></i>Factures annulées </a>
					</li>

					<li class="nav-item">
						<a href="<?= base_url() ?>commandes/facturesByarticle"
						   class="list-group-item list-group-item-action waves-effect">
							<i class="fa fa-balance-scale-right blue-text mr-3  ml-3"></i>Rapport de ventes</a>
					</li>
				</ul>
			</div>
			<?php if ($data['role_utilisateur'] == 'admin'): ?>
				<div class="has-streeview mt-1" style="font-size: small">
					<a href="#" class="list-group-item  waves-effect" data-toggle="collapse" data-target="#perception">
						<i class="fa fa-server mr-3 text-danger mr-3"></i>Stock<i
								class="fa fa-chevron-right text-muted ml-3"></i>
					</a>
					<ul class="nav nav-treeview collapse" id="perception">
						<li class="nav-item">
							<a href="<?= base_url() ?>articles/entreelist"
							   class="list-group-item list-group-item-action waves-effect">
								<i class="fa fa-plus green-text mr-3  ml-3"></i>Liste d'entrées</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url() ?>sorties"
							   class="list-group-item list-group-item-action waves-effect">
								<i class="fas fa-outdent mr-3 red-text ml-3"></i> Liste de sorties</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url() ?>sorties/salesPoints"
							   class="list-group-item list-group-item-action waves-effect">
								<i class="fas fa-laptop-house mr-3 green-text ml-3"></i>Points de ventes</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url() ?>articles/inventaire"
							   class="list-group-item list-group-item-action waves-effect">
								<i class="fas fa-list-alt mr-3 blue-text ml-3"></i>Compte</a>
						</li>
					</ul>
				</div>

				<div class="has-streeview mt-1" style="font-size: small">
					<a href="#" class="list-group-item  waves-effect" data-toggle="collapse" data-target="#inventory">
						<i class="fa fa-file-invoice-dollar mr-3 text-default mr-3"></i>Articles<i
								class="fa fa-chevron-right text-muted ml-3"></i>
					</a>
					<ul class="nav nav-treeview collapse" id="inventory">
						<li class="nav-item">
							<a href="<?= base_url() ?>articles/create"
							   class="list-group-item list-group-item-action waves-effect">
								<i class="fa fa-file-invoice red-text mr-3  ml-3"></i>Nouvel article</a>
						</li>

						<li class="nav-item">
							<a href="<?= base_url() ?>articles/index"
							   class="list-group-item list-group-item-action waves-effect">
								<i class="fa fa-file-invoice blue-text mr-3  ml-3"></i>Liste d'articles</a>
						</li>
					</ul>
				</div>


				<div class="has-streeview mt-1" style="font-size: small">

					<a href="#" class="list-group-item  waves-effect" data-toggle="collapse" data-target="#database">
						<i class="fa fa-database mr-3 text-danger mr-3"></i>Database<i
								class="fa fa-chevron-right text-muted ml-3"></i>
					</a>

					<ul class="nav nav-treeview collapse" id="database">
						<li class="nav-item">
							<button id="updateDB" class="list-group-item list-group-item-action waves-effect">
								<i class="fa fa-upload green-text  mr-3 ml-3"></i>Sauvegarder
							</button>
						</li>
					</ul>
				</div>
			<?php endif; ?>
			<div class="has-streeview mt-1" style="font-size: small">
				<a href="#" class="list-group-item  waves-effect" data-toggle="collapse" data-target="#expenses">
					<i class="fa fa-compass mr-3 green-text mr-3"></i>Compte<i
							class="fa fa-chevron-right text-muted ml-3"></i>
				</a>
				<ul class="nav nav-treeview collapse" id="expenses" style="font-size: small">
					<li class="nav-item">
						<a href="<?= base_url() ?>commandes/soldes"
						   class="list-group-item list-group-item-action waves-effect">
							<i class="fa fa-list-alt green-text  mr-3 ml-3"></i>Solde</a>
					</li>

					<li class="nav-item">
						<a href="#commandes/retrieveList#"
						   class="list-group-item list-group-item-action waves-effect">
							<i class="fa fa-list-alt blue-text mr-3 ml-3"></i>Dépenses</a>
					</li>

				</ul>
			</div>

			<div class="has-streeview mt-1" style="font-size: small">
				<a href="#" class="list-group-item  waves-effect" data-toggle="collapse"
				   data-target="#configurations">
					<i class="fa fa-cogs Nmr-3 text-muted mr-3"></i>Configurations<i
							class="fa fa-chevron-right text-muted ml-3"></i>
				</a>
				<ul class="nav nav-treeview collapse" id="configurations" style="font-size: small">
					<?php if ($data['role_utilisateur'] == 'admin') : ?>
						<li class="nav-item">
							<a href="<?= site_url() ?>sales_points"
							   class="list-group-item list-group-item-action waves-effect">
								<i class="fa fa-cog mr-3 ml-3  blue-text mr-3"></i>Points de vente</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url() ?>users"
							   class="list-group-item list-group-item-action waves-effect">
								<i class="fa fa-users green-text mr-3  ml-3"></i>Utilisateurs</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url() ?>categories"
							   class="list-group-item list-group-item-action waves-effect">
								<i class="fa fa-object-group red-text  mr-3  ml-3"></i>Catégories</a>
						</li>
					<?php endif ?>

					<li class="nav-item">
						<a href="<?= base_url() ?>users/view_membre"
						   class="list-group-item list-group-item-action waves-effect">
							<i class="fa fa-user-check yellow-text ml-3 mr-3"></i>Mon compte</a>
					</li>
					<li class="nav-item mb-4">
						<a onclick="return confirm('Etes-vous sûr de vous déconnecter ?');"
						   href="<?= base_url('pages/logout') ?>"
						   class="list-group-item list-group-item-action waves-effect">
							<i class="fa fa-user-times pink-text  ml-3 mr-3"></i>Déconnexion</a>
					</li>
					<li class="nav-item"></li>
				</ul>
			</div>
		</div>
	</div>
</header>

