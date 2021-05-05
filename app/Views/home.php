<div class="main-panel">
	<div class="content">
		<div class="page-inner mt--6">

			<div class="row">
				<div class="col-md-12">
					<div class="text-center">
						<h1 class="text-blue pb-2 fw-bold">ESTUDIO DE CAPACIDAD INSTALADA</h1>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<form id="formcapinstalada" method="post">
						<div class="form-group row">
							<label for="pkuss" class="col-sm-3 col-form-label">Unidad de servicios</label>
							<div class="col-sm-3">
								<select class="form-control form-control" id="uus_select" name="pkuus" required onchange="get_gus()">
									<option value="">Seleccione</option>
								</select>
							</div>
						</div>
					</form>
				</div>
			</div>

			<div class="row">

				<div class="col-sm-6 col-md-3">
					<div class="card card-stats card-primary card-round">
						<div class="card-body">
							<div class="row">
								<div class="col-3">
									<div class="icon-big text-center">
										<i class="flaticon-delivery-truck"></i>
									</div>
								</div>
								<div class="col-8 col-stats">
									<div class="numbers">
										<p class="card-category">Unidades de servicios de salud</p>
										<h4 class="card-title" id="carduss"></h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-3">
					<div class="card card-stats card-info card-round">
						<div class="card-body">
							<div class="row">
								<div class="col-4">
									<div class="icon-big text-center">
										<i class="flaticon-file"></i>
									</div>
								</div>
								<div class="col-7 col-stats">
									<div class="numbers">
										<p class="card-category">Grupos</p>
										<h4 class="card-title" id="cardgus"></h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-3">
					<div class="card card-stats card-success card-round">
						<div class="card-body">
							<div class="row">
								<div class="col-3">
									<div class="icon-big text-center">
										<i class="flaticon-users"></i>
									</div>
								</div>
								<div class="col-8 col-stats">
									<div class="numbers">
										<p class="card-category">Servicios ofertados</p>
										<h4 class="card-title" id="cardsvo"></h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-3">
					<div class="card card-stats card-secondary card-round">
						<div class="card-body">
							<div class="row">
								<div class="col-4">
									<div class="icon-big text-center">
										<i class="flaticon-agenda"></i>
									</div>
								</div>
								<div class="col-7 col-stats">
									<div class="numbers">
										<p class="card-category">Programas</p>
										<h4 class="card-title" id="cardprog"></h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

			<div class="row">

				<div class="col-md-6">
					<div class="card">
						<div class="card-header">
							<div class="card-title">Núm. Estudiantes en relación a los programas</div>
						</div>
						<div class="card-body">

							<div class="chart-container">
								<canvas id="chartproperf" width="995" height="300" style="display: block; width: 995px; height: 300px;" class="chartjs-render-monitor"></canvas>
							</div>

						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="card">
						<div class="card-header">
							<div class="card-title">Núm. Docentes requridos en relación a los programas</div>
						</div>
						<div class="card-body">

							<div class="chart-container">
								<canvas id="chartprogdocente" width="995" height="300" style="display: block; width: 995px; height: 300px;" class="chartjs-render-monitor"></canvas>
							</div>

						</div>
					</div>
				</div>
				<!--<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						<div class="card-title">Núm. Estudiantes en relación a los programas</div>
					</div>
					<div class="card-body">

						<div class="chart-container">
							<div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
								<div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
									<div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
								</div>
								<div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
									<div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
								</div>
							</div>
							<canvas id="chartproperf11" width="995" height="300" style="display: block; width: 995px; height: 300px;" class="chartjs-render-monitor"></canvas>
						</div>

					</div>
				</div>
			</div>-->

			</div>


		</div>

	</div>



	<!-- JS pagina 	-->
	<script src="<?= base_url(); ?>/assets/js/paginas/home.js"></script>