<!doctype html>
<html lang="fr">
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Stock and Billing manager Application">
	<meta name="author" content="Afrinewsoft">
	<link href="<?php echo base_url() ?>assets/img/favicon.png" rel="icon" type="image/png">

	<title>Gestion de stock et facturation | by Afrinewsoft</title>

	<!-- Bootstrap core CSS -->
	<link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="<?php echo base_url() ?>assets/css/vendor/signin.css" rel="stylesheet">
	<style>
		:root {
			--input-padding-x: .75rem;
			--input-padding-y: .75rem;
		}

		html,
		body {
			height: 100%;
		}

		body {
			display: -ms-flexbox;
			display: -webkit-box;
			display: flex;
			-ms-flex-align: center;
			-ms-flex-pack: center;
			-webkit-box-align: center;
			align-items: center;
			-webkit-box-pack: center;
			justify-content: center;
			padding-top: 40px;
			padding-bottom: 40px;
			background-color: #f5f5f5;
		}

		.form-signin {
			width: 100%;
			max-width: 420px;
			padding: 15px;
			margin: 0 auto;
		}

		.form-label-group {
			position: relative;
			margin-bottom: 1rem;
		}

		.form-label-group > input,
		.form-label-group > label {
			padding: var(--input-padding-y) var(--input-padding-x);
		}

		.form-label-group > label {
			position: absolute;
			top: 0;
			left: 0;
			display: block;
			width: 100%;
			margin-bottom: 0;
			/* Override default `<label>` margin */
			line-height: 1.5;
			color: #495057;
			border: 1px solid transparent;
			border-radius: .25rem;
			transition: all .1s ease-in-out;
		}

		.form-label-group input::-webkit-input-placeholder {
			color: transparent;
		}

		.form-label-group input:-ms-input-placeholder {
			color: transparent;
		}

		.form-label-group input::-ms-input-placeholder {
			color: transparent;
		}

		.form-label-group input::-moz-placeholder {
			color: transparent;
		}

		.form-label-group input::placeholder {
			color: transparent;
		}

		.form-label-group input:not(:placeholder-shown) {
			padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
			padding-bottom: calc(var(--input-padding-y) / 3);
		}

		.form-label-group input:not(:placeholder-shown) ~ label {
			padding-top: calc(var(--input-padding-y) / 3);
			padding-bottom: calc(var(--input-padding-y) / 3);
			font-size: 12px;
			color: #777;
		}
	</style>
</head>

<body>

<body>
<div class="container">
	<div class="row pt-4">
		<div class="col-sm-12 col-lg-12 col-md-12 mt-5">
			<div class="d-flex justify-content-center">
				<?php if ($this->session->flashdata('delay_expirate')) : ?>
					<div class="alert alert-danger alert-dismissible" role="alert" id="connexion-failed">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close" id="btn-close">
							<span aria-hidden="true">&times;</span>
						</button>
						<strong><?php echo $this->session->flashdata('delay_expirate'); ?></strong>
					</div>
				<?php endif; ?>
				<?php if ($this->session->flashdata('connexion_failed')) : ?>
					<div class="alert alert-danger alert-dismissible" role="alert" id="connexion-failed">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close" id="btn-close">
							<span aria-hidden="true">&times;</span>
						</button>
						<strong><?php echo $this->session->flashdata('connexion_failed'); ?></strong>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<div class="col-sm-12">
			<div class="d-flex justify-content-center">

				<div class="card">

					<?php echo form_open('login/index', 'class="mb-0 pb-0"'); ?>
					<img class="mb-4 rounded" src="<?php echo base_url() ?>assets/img/afrinewsoft.jpg" alt=""
						 width="300" height="150">
					<h1 class="h3 mb-3 font-weight-normal text-center">Login</h1>
					<div class="card-body mb-5 p-5">
						<?php if (date('Y-m-d') >= '2023-11-20') : ?>
							<div class="alert alert-danger alert-dismissible" role="alert" id="connexion-failed">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"
										id="btn-close">
									<span aria-hidden="true">&times;</span>
								</button>
								<strong>L'application nécessite de nouvelles mises à jour</strong>
							</div>
						<?php else : ?>
							<label for="inputEmail" class="sr-only">Nom d'utilisateur</label>
							<input type="text" id="inputEmail" class="form-control" name="username"
								   placeholder="Nom d'utilisateur" value="<?= set_value('username')?>" required autofocus>
							<label for="inputPassword" class="sr-only">Mot de passe</label>
							<input type="password" id="inputPassword" class="form-control" name="password"
								   placeholder="Password" required>
							<div class="checkbox mb-3">
							</div>
							<button class="btn btn-md btn-outline-primary btn-block" type="submit">Connexion</button>
						<?php endif; ?>
						</form>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>

</body>

</html>
