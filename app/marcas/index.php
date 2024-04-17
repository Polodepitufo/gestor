<?php
require_once('../session.php');
require_once('../db.php');
require_once('crud.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<base href="../" />
	<title>Marcas</title>
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
									<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Marcas</h1>
								</div>
								<div class="d-flex align-items-center gap-2 gap-lg-3">
									<a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_crear_marca">Crear marca</a>
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
												<input type="text" data-kt-ecommerce-marca-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Buscar marca" />
											</div>
										</div>


									</div>

									<div class="card-body pt-0">
										<!--begin::Table-->
										<div class="table-responsive">
											<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_marca_table">
												<thead>
													<tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
														<th class="w-10px pe-2">
															<div class="form-check form-check-sm form-check-custom form-check-solid me-3">
																<input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_ecommerce_marca_table .form-check-input" value="1" />
															</div>
														</th>
														<th class="min-w-250px"></th>
														<th class="min-w-250px">Marca</th>
														<th class="min-w-150px">Estado</th>
														<th class="text-end min-w-50px"></th>
														<th class="text-end min-w-50px"></th>
													</tr>
												</thead>
												<tbody class="fw-semibold text-gray-600">
													<?php foreach ($sql_marcas as $row) {
														$id_marca = $row['ID'];
														$imagen = $row['IMAGENPRINCIPAL'];
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
																		<div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">

																			<div class="image-input-wrapper w-150px h-75px" style="background-image:url(../assets/media/marcas/<?php echo $imagen; ?>); background-size: cover; background-position: center;">
																			</div>
																		</div>
																	</div>
																</div>
															</td>

															<td>
																<div class="d-flex">
																	<div class="ms-5">
																		<div class="text-gray-800 fs-5 fw-bold mb-1" data-kt-ecommerce-marca-filter="marca_name"><?php echo $row['NOMBRE'] ?></div>
																	</div>
																</div>
															</td>

															<td>
																<?php if ($row['ESTADO'] == 1) { ?>
																	<div class="badge badge-light-success fs-7">Visible</div>
																<?php } else { ?>
																	<div class="badge badge-light-danger fs-7">Oculto</div>
																<?php } ?>

															</td>
															<td class="text-end">
																<div class="d-flex align-items-center gap-2 gap-lg-3">
																	<a href="#" class="btn btn-sm fw-bold btn-primary boton-editar" data-bs-toggle="modal" data-bs-target="#kt_modal_editar_categoria" data-id="<?php echo $id_marca; ?>">Editar</a>
																</div>
															</td>
															<td class="text-end">
																<form class="form" novalidate="novalidate" id="formulario_eliminar" method="POST">
																	<div class="d-flex align-items-center gap-2 gap-lg-3">
																		<button type="button" class="btn btn-sm fw-bold btn-danger boton-eliminar" data-kt-ecommerce-marca-filter="delete_row" name="boton-eliminar" data-id="<?php echo $id_marca; ?>">X</button>
																		<input hidden name="eliminar_marca"  id="eliminar_marca" value="">
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

	<div class="modal fade" id="kt_modal_crear_marca" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered mw-900px">
			<div class="modal-content">
				<div class="modal-header">
					<h2>Crear marca</h2>
					<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
						<i class="ki-duotone ki-cross fs-1">
							<span class="path1"></span>
							<span class="path2"></span>
						</i>
					</div>
				</div>

				<div class="modal-body py-lg-10 px-lg-10">
					<div class="d-flex flex-column flex-xl-row flex-row-fluid" id="kt_modal_crear_marca_stepper">
						<!--begin::Content-->
						<div class="flex-row-fluid py-lg-5 px-lg-15">
							<!--begin::Form-->
							<form class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" novalidate="novalidate" id="kt_modal_crear_marca_formulario" method="POST" enctype='multipart/form-data'>
								<input type="hidden" name="crear_marca" />
								<div class="w-100">
									<div class="fv-row mb-10">
										<label class="required form-label">Nombre</label>
										<input type="text" name="nombre_marca" required class="form-control mb-2" placeholder="Nombre de la marca" value="" />
									</div>
								</div>
								<div class="w-100">
									<div class="mb-10"><label class=" form-label">Estado</label>
										<select class="form-select mb-2" data-hide-search="true" data-placeholder="Select an option" name="estado_marca">
											<option value="1" selected="Visible">Visible</option>
											<option value="0">Oculto</option>
										</select>
									</div>
								</div>
								<div class="w-100">

									<div class="card-header">
										<label class="required form-label">Logotipo</label>
									</div>
									<div class="card-body fv-row mb-10 text-center pt-0">
										<div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
											<div class="image-input-wrapper w-300px h-150px" style="background-size: cover; background-position: center;"></div>

											<label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Seleccionar logotipo">
												<i class="ki-duotone ki-pencil fs-7">
													<span class="path1"></span>
													<span class="path2"></span>
												</i>
												<input type="file" name="logotipo_marca_imagen" accept=".png, .jpg, .jpeg" required />
											</label>
											<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Deseleccionar logotipo">
												<i class="ki-duotone ki-cross fs-2">
													<span class="path1"></span>
													<span class="path2"></span>
												</i>
											</span>
										</div>
										<div class="text-muted fs-7">Los archivos deben ser *.png, *.jpg o *. <br> El tamaño de imagen recomendado es de 300x150 px</div>

									</div>
								</div>
								<!--begin::Actions-->
								<div class="d-flex flex-stack pt-10 justify-content-end">
									<div>
										<button type="submit" name='a' id="kt_modal_crear_marca_submit" class="btn btn-lg btn-primary">
											<span class="indicator-label">Crear
												<i class="ki-duotone ki-arrow-right fs-3 ms-2 me-0">
													<span class="path1"></span>
													<span class="path2"></span>
												</i></span>
											<span class="indicator-progress">Comprobando datos...
												<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="kt_modal_editar_categoria" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered mw-900px">
			<div class="modal-content">
				<div class="modal-header">
					<h2>Editar categoría</h2>
					<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
						<i class="ki-duotone ki-cross fs-1">
							<span class="path1"></span>
							<span class="path2"></span>
						</i>
					</div>
				</div>

				<div class="modal-body py-lg-10 px-lg-10">
					<div class="d-flex flex-column flex-xl-row flex-row-fluid" id="kt_modal_editar_categoria_stepper">
						<!--begin::Content-->
						<div class="flex-row-fluid py-lg-5 px-lg-15">
							<!--begin::Form-->
							<form class="form" novalidate="novalidate" id="kt_modal_editar_categoria_formulario" method="POST">
								<input hidden name="editar_categoria" id="editar_categoria" value="<?php echo $id_categoria; ?>">
								<div class="w-100">
									<div class="fv-row mb-10">
										<label class="required form-label">Nombre</label>
										<input type="text" name="editar_nombre_categoria" id="editar_nombre_categoria" class="form-control mb-2" placeholder="Nombre de la categoría" value="" />
									</div>
								</div>

								<div class="w-100">
									<div class="fv-row mb-10">
										<label class="required form-label">Slug</label>
										<input type="text" name="editar_slug_categoria" id="editar_slug_categoria" class="form-control mb-2" placeholder="Slug de la categoría" value="" />
									</div>
								</div>

								<div class="w-100">
									<div class="fv-row mb-10">
										<label class="form-label">Descripción</label>
										<textarea type="text" name="editar_descripcion_categoria" id="editar_descripcion_categoria" class="form-control mb-2" placeholder="Descripción de la categoría" value=""></textarea>
									</div>
								</div>

								<div class="w-100">
									<div class="mb-10"><label class=" form-label">Estado</label>
										<select class="form-select mb-2" data-hide-search="true" name="editar_estado_categoria" id="editar_estado_categoria">
											<option value="1" selected="Visible">Visible</option>
											<option value="0">Oculto</option>
										</select>
									</div>
								</div>

								<div class="d-flex justify-content-between">
									<div class="w-49">
										<div class="mb-10"> <label class="form-label">Categoría padre</label>
											<select class="form-select mb-2" data-hide-search="true" name="editar_padre_categoria" id="editar_padre_categoria">
												<option value="0">Sin categoría padre</option>
												<?php foreach ($sql_categorias as $row) { ?>
													<option value="<?php echo $row['ID'] ?>"><?php echo $row['NOMBRE'] ?></option>
												<?php } ?>
											</select>
										</div>
									</div>

									<div class="w-49">
										<div class="mb-10"> <label class="form-label">Descuentos</label>
											<select class="form-select mb-2" data-hide-search="true" name="editar_descuento_categoria" id="editar_descuento_categoria">
												<option value="0" selected="Mostrar">Sin descuento</option>
												<?php foreach ($sql_descuentos as $row) { ?>
													<option value="<?php echo $row['ID'] ?>"><?php echo $row['NOMBRE'] ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
								</div>
								<!--begin::Actions-->
								<div class="d-flex flex-stack pt-10 justify-content-end">
									<div>
										<button type="submit" name='kt_modal_edit_categoria_submit' id="kt_modal_edit_categoria_submit" class="btn btn-lg btn-primary">
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
	<script src="../assets/js/custom/apps/ecommerce/catalog/marcas.js"></script>
	<script src="../assets/js/widgets.bundle.js"></script>
	<script src="../assets/js/custom/widgets.js"></script>
	<script src="../assets/js/custom/utilities/modals/upgrade-plan.js"></script>
	<script src="../assets/js/custom/utilities/modals/create-app.js"></script>
	<script src="../assets/js/custom/utilities/modals/users-search.js"></script>
	<script>



	</script>
</body>

</html>