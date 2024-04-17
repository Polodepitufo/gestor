<?php
require_once('../session.php');
require_once('../db.php');
require_once('crud.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<base href="../" />
	<title>Descuentos</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="shortcut icon" href="../assets/media/logos/favicon.ico" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
	<link href="../assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
	<link href="../assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
	<link href="../assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="../assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
</head>

<body id="kt_app_body" data-kt-app-layout="light-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
	<script>
		var defaultThemeMode = "light";
		var themeMode;
		if (document.documentElement) {
			if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
				themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
			} else {
				if (localStorage.getItem("data-bs-theme") !== null) {
					themeMode = localStorage.getItem("data-bs-theme");
				} else {
					themeMode = defaultThemeMode;
				}
			}
			if (themeMode === "system") {
				themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
			}
			document.documentElement.setAttribute("data-bs-theme", themeMode);
		}
	</script>

	<div class="d-flex flex-column flex-root app-root" id="kt_app_root">

		<div class="app-page flex-column flex-column-fluid" id="kt_app_page">
			<?php require_once('../utilities/header.php') ?>
			<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
				<?php require_once('../utilities/sidebar.php');
				require_once('../utilities/message.php') ?>
				<div class="app-main flex-column flex-row-fluid" id="kt_app_main">

					<div class="d-flex flex-column flex-column-fluid">

						<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
							<div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
								<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
									<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Descuentos por cantidad</h1>
								</div>
								<div class="d-flex align-items-center gap-2 gap-lg-3">
									<a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_crear_descuento">Crear descuento</a>
								</div>
							</div>

						</div>

						<div id="kt_app_content" class="app-content flex-column-fluid">
							<div id="kt_app_content_container" class="app-container container-xxl">
								<div class="card card-flush">
									<div class="card-header align-items-center py-5 gap-2 gap-md-5">
										<div class="card-title">
											<div class="d-flex align-items-center position-relative my-1">
												<i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
													<span class="path1"></span>
													<span class="path2"></span>
												</i>
												<input type="text" data-kt-ecommerce-descuento-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Buscar descuento" />
											</div>
										</div>


									</div>

									<div class="card-body pt-0">
										<!--begin::Table-->
										<div class="table-responsive">
											<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_descuento_table">
												<thead>
													<tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
														<th class="w-10px pe-2">
															<div class="form-check form-check-sm form-check-custom form-check-solid me-3">
																<input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_ecommerce_descuento_table .form-check-input" value="1" />
															</div>
														</th>
														<th class="min-w-250px">Descuento</th>
														<th class="min-w-150px">Mínima/ máxima</th>
														<th class="min-w-150px">Tipo</th>
														<th class="text-end min-w-50px"></th>
														<th class="text-end min-w-50px"></th>
													</tr>
												</thead>
												<tbody class="fw-semibold text-gray-600">
													<?php foreach ($sql_descuentos as $row) {
														$id_descuento = $row['ID'];
														$cantidad = ($row['DESCUENTOFIJO'] == 0) ? $row['DESCUENTOPORC'] : $row['DESCUENTOFIJO'];
														$tipo = ($row['DESCUENTOFIJO'] == 0) ? 'DESCUENTO EN PORCENTAJE' : 'DESCUENTO FIJO';
													?>
														<tr>
															<td>
																<div class="form-check form-check-sm form-check-custom form-check-solid">
																	<input class="form-check-input" type="checkbox" value="1" />
																</div>
															</td>

															<td>
																<div class="d-flex">
																	<div class="ms-5">
																		<div class="text-gray-800 fs-5 fw-bold mb-1" data-kt-ecommerce-descuento-filter="descuento_name"><?php echo $row['NOMBRE'] ?></div>
																	</div>
																</div>
															</td>

															<td>

																<div class="text-muted fs-7 fw-bold"><?php echo $row['MINIMA'] . '/' . $row['MAXIMA']; ?></div>
															</td>

															<td>
																<div class="text-muted fs-7 fw-bold"><?php echo $tipo . ' de ' . $cantidad; ?></div>
															</td>

															<td class="text-end">
																<div class="d-flex align-items-center gap-2 gap-lg-3">
																	<a href="#" class="btn btn-sm fw-bold btn-primary boton-editar" data-bs-toggle="modal" data-bs-target="#kt_modal_editar_descuento" data-id="<?php echo $id_descuento; ?>" data-minima="<?php echo $row['MINIMA']; ?>" data-nombre="<?php echo $row['NOMBRE']; ?>" data-maxima="<?php echo $row['MAXIMA']; ?>" data-tipo="<?php echo $tipo; ?>" data-cantidad="<?php echo $cantidad; ?>">Editar</a>
																</div>
															</td>
															<td class="text-end">
																<form class="form" novalidate="novalidate" id="formulario_eliminar" method="POST">
																	<div class="d-flex align-items-center gap-2 gap-lg-3">
																		<button type="button" class="btn btn-sm fw-bold btn-danger boton-eliminar" data-kt-ecommerce-descuento-filter="delete_row" data-id="<?php echo $id_descuento; ?>"  name="boton-eliminar">X</button>
																		<input hidden name="eliminar_descuento" id="eliminar_descuento" value="">
																	</div>
																</form>
															</td>
														</tr>
													<?php } ?>
												</tbody>
												<!--end::Table body-->
											</table>
										</div>
										<!--end::Table-->
									</div>
								</div>
							</div>
						</div>

					</div>

				</div>
			</div>
		</div>
	</div>

	<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
		<i class="ki-duotone ki-arrow-up">
			<span class="path1"></span>
			<span class="path2"></span>
		</i>
	</div>

	<div class="modal fade" id="kt_modal_crear_descuento" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered mw-900px">
			<div class="modal-content">
				<div class="modal-header">
					<h2>Crear descuento</h2>
					<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
						<i class="ki-duotone ki-cross fs-1">
							<span class="path1"></span>
							<span class="path2"></span>
						</i>
					</div>
				</div>

				<div class="modal-body py-lg-10 px-lg-10">
					<div class="d-flex flex-column flex-xl-row flex-row-fluid" id="kt_modal_create_descuento_stepper">
						<!--begin::Content-->
						<div class="flex-row-fluid py-lg-5 px-lg-15">
							<!--begin::Form-->
							<form class="form" novalidate="novalidate" id="kt_modal_create_descuento_formulario" method="POST">
								<input hidden name="crear_descuento">
								<div class="w-100">
									<div class="fv-row mb-10">
										<label class="required form-label">Nombre</label>
										<input type="text" name="nombre_descuento" class="form-control mb-2" placeholder="Nombre del descuento" />
									</div>
								</div>
								<div class="d-flex justify-content-between ">
									<div class="w-49">
										<div class="mb-10 fv-row"> <label class="form-label required">Mínima</label>
											<input type="text" required name="minimo_descuento" class="form-control mb-2" placeholder="Cantidad mínima del descuento" value="" />
										</div>
									</div>
									<div class="w-49">
										<div class="mb-10 fv-row"> <label class="form-label required">Máxima</label>
											<input type="text" required name="maximo_descuento" class="form-control mb-2" placeholder="Cantidad máxima del descuento" value="" />
										</div>
									</div>
								</div>
								<div class="d-flex justify-content-between">
									<div class="w-49">
										<div class="mb-10"> <label class="form-label">Tipo de descuento</label>
											<select class="form-select mb-2" data-hide-search="true" data-placeholder="Select an option" name="tipo_descuento">
												<option value="DESCUENTO FIJO" selected="Fijo">Descuento fijo</option>
												<option value="DESCUENTO EN PORCENTAJE">Descuento en porcentaje</option>
											</select>
										</div>
									</div>
									<div class="w-49">
										<div class="mb-10 fv-row"> <label class="form-label required">Importe/ porcentaje aplicable</label>
											<input type="number" required step="0.1" name="cantidad_descuento" class="form-control mb-2" placeholder="Importe/ porcentaje aplicable" />
										</div>
									</div>
								</div>
								<!--begin::Actions-->
								<div class="d-flex flex-stack pt-10 justify-content-end">
									<div>
										<button type="submit" name='a' id="kt_modal_create_descuento_submit" class="btn btn-lg btn-primary">
											<span class="indicator-label">Crear
												<i class="ki-duotone ki-arrow-right fs-3 ms-2 me-0">
													<span class="path1"></span>
													<span class="path2"></span>
												</i></span>
											<span class="indicator-progress">Comprobando datos...
												<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
										</button>
									</div>
									<!--end::Wrapper-->
								</div>
								<!--end::Actions-->
							</form>
							<!--end::Form-->
						</div>
						<!--end::Content-->
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="kt_modal_editar_descuento" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered mw-900px">
			<div class="modal-content">
				<div class="modal-header">
					<h2>Editar descuento</h2>
					<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
						<i class="ki-duotone ki-cross fs-1">
							<span class="path1"></span>
							<span class="path2"></span>
						</i>
					</div>
				</div>

				<div class="modal-body py-lg-10 px-lg-10">
					<div class="d-flex flex-column flex-xl-row flex-row-fluid" id="kt_modal_editar_descuento_stepper">
						<!--begin::Content-->
						<div class="flex-row-fluid py-lg-5 px-lg-15">
							<!--begin::Form-->
							<form class="form" novalidate="novalidate" id="kt_modal_editar_descuento_formulario" method="POST">
								<input hidden name="editar_descuento" id="editar_descuento">

								<div class="w-100">
									<div class="fv-row mb-10">
										<label class="required form-label">Nombre</label>
										<input type="text" name="editar_nombre_descuento"  id="editar_nombre_descuento" class="form-control mb-2" placeholder="Nombre del descuento" />
									</div>
								</div>
								<div class="d-flex justify-content-between ">
									<div class="w-49">
										<div class="mb-10 fv-row"> <label class="form-label required">Mínima</label>
											<input type="text" required name="editar_minimo_descuento" id="editar_minimo_descuento" class="form-control mb-2" placeholder="Cantidad mínima del descuento" value="" />
										</div>
									</div>
									<div class="w-49">
										<div class="mb-10 fv-row"> <label class="form-label required">Máxima</label>
											<input type="text" required name="editar_maximo_descuento" id="editar_maximo_descuento"  class="form-control mb-2" placeholder="Cantidad máxima del descuento" value="" />
										</div>
									</div>
								</div>
								<div class="d-flex justify-content-between">
									<div class="w-49">
										<div class="mb-10"> <label class="form-label">Tipo de descuento</label>
											<select class="form-select mb-2" data-hide-search="true" data-placeholder="Select an option" name="editar_tipo_descuento" id="editar_tipo_descuento">
												<option value="DESCUENTO FIJO" selected="Fijo">Descuento fijo</option>
												<option value="DESCUENTO EN PORCENTAJE">Descuento en porcentaje</option>
											</select>
										</div>
									</div>
									<div class="w-49">
										<div class="mb-10 fv-row"> <label class="form-label required">Importe/ porcentaje aplicable</label>
											<input type="number" required step="0.1" name="editar_cantidad_descuento"  id="editar_cantidad_descuento" class="form-control mb-2" placeholder="Importe/ porcentaje aplicable" />
										</div>
									</div>
								</div>
								<!--begin::Actions-->
								<div class="d-flex flex-stack pt-10 justify-content-end">
									<div>
										<button type="submit" name='kt_modal_edit_descuento_submit' id="kt_modal_edit_descuento_submit" class="btn btn-lg btn-primary">
											<span class="indicator-label">Editar
												<i class="ki-duotone ki-arrow-right fs-3 ms-2 me-0">
													<span class="path1"></span>
													<span class="path2"></span>
												</i></span>
											<span class="indicator-progress">Comprobando datos...
												<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
										</button>
									</div>
									<!--end::Wrapper-->
								</div>
								<!--end::Actions-->
							</form>
							<!--end::Form-->
						</div>
						<!--end::Content-->
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		var hostUrl = "../assets/";
	</script>

	<script src="../assets/plugins/global/plugins.bundle.js"></script>
	<script src="../assets/js/scripts.bundle.js"></script>
	<script src="../assets/plugins/custom/datatables/datatables.bundle.js"></script>
	<script src="../assets/js/custom/apps/ecommerce/catalog/descuentos.js"></script>
	<script src="../assets/js/widgets.bundle.js"></script>
	<script src="../assets/js/custom/widgets.js"></script>
	<script src="../assets/js/custom/utilities/messageerror.js"></script>
</body>

</html>