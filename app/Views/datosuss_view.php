<div class="main-panel">
	<div class="content">
		<div class="page-inner mt--6">

			<div class="row">
				<div class="col-md-12">
					<div class="text-center">
						<h1 class="text-blue pb-2 fw-bold">DATOS PARA LA UNIDAD DE SERVICIOS</h1>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					 <!-- Button trigger modal -->
					 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" onclick="get_uus()">
                        Insertar
                    </button>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<form id="formcapinstalada" method="post">
						<div class="form-group row">
							<label for="pkhso" class="col-sm-3 col-form-label">Sub red</label>
							<div class="col-sm-8">
								<select class="form-control form-control" id="hso_selectf" name="pkhsof" required onchange="get_gus()">
									<option value="">Seleccione Sub Red</option>
								</select>
							</div>
						</div>
					</form>
				</div>
				
				<div class="col-md-4">
					<form id="formcapinstalada" method="post">
						<div class="form-group row">
							<label for="pkuss" class="col-sm-6 col-form-label">Unidad de servicios</label>
							<div class="col-sm-6">
								<select class="form-control form-control" id="uus_selectf" name="pkuusf" required onchange="get_gus()">
									<option value="">Seleccione Unidad de servicios</option>
								</select>
							</div>
						</div>
					</form>
				</div>
				<div class="col-md-4">
					<form id="formcapinstalada" method="post">
						<div class="form-group row">
							<label for="pkuss" class="col-sm-3 col-form-label">Grupo</label>
							<div class="col-sm-8">
								<select class="form-control form-control" id="uus_selectf" name="pkuusf" required onchange="get_gus()">
									<option value="">Seleccione</option>
								</select>
							</div>
						</div>
					</form>
				</div>
			</div>

			<div class="row">
                <div class="col-md-12">
                   
                    <table id="table_datos_uss"
                    data-toolbar="#toolbar"
                    data-search="true"
                    data-show-refresh="true"
                    data-show-toggle="true"
                    data-show-fullscreen="true"
                    data-show-columns="true"
                    data-show-columns-toggle-all="true"
                    data-show-export="true"
                    data-click-to-select="true"
                    data-detail-formatter="detailFormatter"
                    data-minimum-count-columns="2"
                    data-show-pagination-switch="true"
                    data-pagination="true"
                    data-id-field="id"
                    data-page-list="[4, 8, 16, 100]"
                    data-show-footer="false"
                    data-sort-name="numero"
                    data-sort-order="asc"
                    class="table table-bordered table-head-bg-info table-bordered-bd-info mt-4"
                    >
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title blue-text" id="exampleModalLabel">Formulario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form id="formcapaciuss" method="post">

                        <div class="form-group row">
                            <label for="pkuss" class="col-sm-12 col-form-label">Unidad de servicios</label>
                            <div class="col-sm-12">
                                <select class="form-control form-control" id="uus_select" name="pkuus" required onchange="get_gus()">
                                    <option value="">Seleccione</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pkgus" class="col-sm-12 col-form-label">Grupo</label>
                            <div class="col-sm-12">
                                <select class="form-control form-control" id="gus_select" name="pkgus" required onchange="get_svo()">
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pksvo" class="col-sm-12 col-form-label">Servicio de oferta</label>
                            <div class="col-sm-12">
                                <select class="form-control form-control" id="svo_select" name="pksvo" required onchange="get_programa()">
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pkprog" class="col-sm-12 col-form-label">Programa</label>
                            <div class="col-sm-12">
                                <select class="form-control form-control" id="prog_select" name="pkprog" required onchange="get_perfil_est()">
                                </select>
                            </div>
                        </div>
						<div class="form-group row">
                            <label for="pkprog" class="col-sm-12 col-form-label">Perfil</label>
                            <div class="col-sm-12">
                                <select class="form-control form-control" id="perf_select" name="pkperf" required onchange="get_data_estandar()">
                                </select>
                            </div>
                        </div>
                        <hr />
                        <!--SECCION DEL ESTANDAR-->
                        <div class="form-group row">
                            <label for="data" class="col-sm-12 col-form-label">*Según los datos anteriormente seleccionados se cargaran <br/> los datos correspondientes a su estandar</label>
                        </div>
                        <div class="form-group row">
                            <label for="numest" class="col-sm-6 col-form-label">Núm. Estudiantes</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="numesth" name="numesth" disabled required>
                                <input type="hidden" class="form-control" id="numest" name="numest">
                            </div>
                        </div>
                        <div class="form-group row">
						<label for="numpaci" class="col-sm-6 col-form-label">Núm. de de pacientes en relación<br/>al estadar de estudiantes</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="numpacih" name="numpacih" disabled required>
                                <input type="hidden" class="form-control" id="numpaci" name="numpaci">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="numestydoc" class="col-sm-6 col-form-label">Núm. estudiante por cada docente</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="numestydoch" name="numestydoch" disabled required>
                                <input type="hidden" class="form-control" id="numestydoc" name="numestydoc">
                            </div>
                        </div>
                        <input type="hidden" class="form-control" id="pkrel" name="pkrel" required>
                        <hr />
                        <!--SECCION DEL ESTANDAR POR SERVICIOS-->
                        <div class="form-group row">
                            <label for="numcamuus" class="col-sm-12 col-form-label">Núm. espacios del servicio en la unidad de servicios</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="numcamuus" name="numcamuus" placeholder="No camas, No de camillas, No quirófanos del servicio en la USS" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="numespaciosuus" class="col-sm-12 col-form-label">Num. Consultorios y/o unidades</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="numespauus" name="numespauus" placeholder="No Consultorios y/o unidades odontológicas del servicio en la USS" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="numpacuus" class="col-sm-12 col-form-label">Num. de pacientes en la unidad de servicios</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="numpacuus" name="numpacuus" placeholder="No de pacientes en la USS" required>
                            </div>
                        </div>

                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="insertcapuus()">Gurdar</button>
                    
                </div>
            </div>
        </div>
    </div>


	<!-- JS pagina 	-->
	<script src="<?= base_url(); ?>/assets/js/paginas/datosuss.js"></script>