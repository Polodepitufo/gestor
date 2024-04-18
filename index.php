<?php
session_start();
require_once('app/db.php');
require_once('login.php');
?>
<!DOCTYPE html>

<html lang="es">

<head>
	<title>Dashboard</title>
	<meta charset="utf-8" />
	<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
	<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

</head>

<body id="kt_body" class="app-blank">

	<div class="d-flex flex-column flex-root" id="kt_app_root">
		<div class="d-flex flex-column flex-lg-row flex-column-fluid">
			<div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
				<div class="d-flex flex-center flex-column flex-lg-row-fluid">
					<div class="w-lg-500px p-10">
						<form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="POST">
							<div class="text-center mb-11">
								<h1 class="text-dark fw-bolder mb-3">Acceso a dashboard</h1>
							</div>
							<div class="fv-row mb-8">
								<input type="text" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent" requried />
							</div>
							<div class="fv-row mb-8">
								<input type="password" placeholder="Password" name="password" autocomplete="off" class="form-control bg-transparent" required />
							</div>
							<div class="d-grid mb-10">
								<button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
									<span class="indicator-label">Acceder</span>
									<span class="indicator-progress">Comprobando datos...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
								</button>
								<input hidden value="<?php echo $errorMessage;?>" id="errorMessage">


							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: url(assets/media/misc/auth-bg.png)">
				<div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
					<img class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20" src="assets/media/misc/auth-screens.png" alt="" />
				</div>
			</div>

		</div>

	</div>
	<script src="assets/plugins/global/plugins.bundle.js"></script>
	<script src="assets/js/scripts.bundle.js"></script>
	<script src="assets/js/custom/authentication/sign-in/general.js"></script>
	<script src="assets/js/custom/utilities/messageerror.js"></script>
</body>

</html>