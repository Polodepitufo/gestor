	<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
		<div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
			<div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary body-bg h-30px w-30px position-absolute top-50 start-100 translate-middle rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
				<i class="ki-duotone ki-double-left fs-2 rotate-180">
					<span class="path1"></span>
					<span class="path2"></span>
				</i>
			</div>
		</div>

		<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
			<div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
				<div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
					<a class="menu-link" href="dashboard/index.php">
						<div class="menu-item ">
							<span class="menu-link">
								<span class="menu-icon">
									<i class="ki-duotone ki-abstract-41 fs-2">
										<span class="path1"></span>
										<span class="path2"></span>
									</i>
								</span>
								<span class="menu-title">Dashboard</span>
							</span>
						</div>
					</a>

					<a class="menu-link" href="clientes/index.php">
						<div class="menu-item ">
							<span class="menu-link">
								<span class="menu-icon">
									<i class="ki-duotone ki-user fs-2">
										<span class="path1"></span>
										<span class="path2"></span>
									</i>
								</span>
								<span class="menu-title">Clientes</span>
							</span>
						</div>
					</a>

					<a class="menu-link" href="pedidos/index.php">
						<div class="menu-item ">
							<span class="menu-link">
								<span class="menu-icon">
									<i class="ki-duotone ki-sms fs-2">
										<span class="path1"></span>
										<span class="path2"></span>
									</i>
								</span>
								<span class="menu-title">Pedidos</span>
							</span>
						</div>
					</a>

					<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
						<span class="menu-link">
							<span class="menu-icon">
								<i class="ki-duotone ki-basket fs-2">
									<span class="path1"></span>
									<span class="path2"></span>
									<span class="path3"></span>
									<span class="path4"></span>
								</i>
							</span>
							<span class="menu-title">Inventario</span>
							<span class="menu-arrow"></span>
						</span>

						<div class="menu-sub menu-sub-accordion">

							<div class="menu-item">
								<a class="menu-link" href="productos/index.php">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">Productos</span>
								</a>
							</div>

							<div class="menu-item">
								<a class="menu-link" href="categorias/index.php">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">Categorías</span>
								</a>
							</div>

							<div class="menu-item">
								<a class="menu-link" href="marcas/index.php">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">Marcas</span>
								</a>
							</div>

							<div class="menu-item">
								<a class="menu-link" href="colores/index.php">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">Colores</span>
								</a>
							</div>

							<div class="menu-item">
								<a class="menu-link" href="tallas/index.php">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">Tallas</span>
								</a>
							</div>

							<div class="menu-item">
								<a class="menu-link" href="descuentos/index.php">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">Tarifas y descuento por cantidad</span>
								</a>
							</div>

							<div class="menu-item">
								<a class="menu-link" href="tarifas/index.php">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">Tarifas de envío</span>
								</a>
							</div>
						</div>
					</div>

					<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
						<span class="menu-link">
							<span class="menu-icon">
								<i class="ki-duotone ki-abstract-25 fs-2">
									<span class="path1"></span>
									<span class="path2"></span>
								</i>
							</span>
							<span class="menu-title">Marketing</span>
							<span class="menu-arrow"></span>
						</span>

						<div class="menu-sub menu-sub-accordion">
							<div class="menu-item">
								<a class="menu-link" href="cupones/index.php">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">Cupones descuento</span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>