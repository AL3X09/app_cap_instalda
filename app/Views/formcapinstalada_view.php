<div class="main-panel">
    <div class="content">
        <div class="page-inner mt--6">

            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <h1 class="text-blue pb-2 fw-bold">INSTRUMENTO DE DILIGENCIAMIENTO</h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" onclick="get_uus()">
                        Insertar
                    </button>
                    <table id="table_prog"
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

                    <form id="formcapinstalada" method="post">

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
                            <label for="pkprog" class="col-sm-12 col-form-label">Progrma</label>
                            <div class="col-sm-12">
                                <select class="form-control form-control" id="prog_select" name="pkprog" required>
                                </select>
                            </div>
                        </div>
                        <hr />
                        <!--SECCION DEL ESTANDAR-->
                        <div class="form-group row">
                            <label for="numest" class="col-sm-12 col-form-label">Núm. Estudiantes</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="numest" name="numest" placeholder="NúmeroNo estudiantes" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="numpaci" class="col-sm-12 col-form-label">Núm. de de pacientes en relación al estadar de estudiantes</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="numpaci" name="numpaci" placeholder=" No de pacientes en relación al estadar de estudiantes" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="numestydoc" class="col-sm-12 col-form-label">Núm. estudiante por cada docente</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="numestydoc" name="numestydoc" placeholder="Número de estudiantes por cada docente" required>
                            </div>
                        </div>
                        <hr />
                        <!--SECCION DEL ESTANDAR POR SERVICIOS-->
                        <div class="form-group row">
                            <label for="numcamuus" class="col-sm-12 col-form-label">Núm. espacios del servicio en la USS</label>
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
                            <label for="numpacuus" class="col-sm-12 col-form-label">Num. de pacientes en la USS</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="numpacuus" name="numpacuus" placeholder="No de pacientes en la USS" required>
                            </div>
                        </div>
                        <!--SECCION CALCULOS DEL ESTANDAR POR SERVICIOS
                        <hr/>
                        <div class="form-group row">
                            <label for="capestcama" class="col-sm-12 col-form-label">Capacidad máxima de estudiantes según No de camas  de la USS </label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="capestcama" name="capestcama" placeholder="Número de estudiantes por cada docente" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="capestunid" class="col-sm-12 col-form-label">Capacidad máxima de estudiantes según No de unidades. </label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="capestunid" name="capestunid" placeholder="Número de estudiantes por cada docente" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="capestpacien" class="col-sm-12 col-form-label">Capacidad máxima de estudiantes según No de pacientes</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="capestpacien" name="capestpacien" placeholder="Número de estudiantes por cada docente" required>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group row">
                            <label for="numdocreq" class="col-sm-12 col-form-label">Núm. de docentes requeridos</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="numdocreq" name="numdocreq" placeholder="Número de estudiantes por cada docente" required>
                            </div>
                        </div>-->
                        <div class="form-group row">
                            <label for="observa" class="col-sm-12 col-form-label">Observación</label>
                            <div class="col-sm-12">
                                <textarea class="form-control" id="observa" name="observa" placeholder="Número de estudiantes por cada docente" required></textarea>
                            </div>
                        </div>

                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="insertestd()">Gurdar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JS pagina 	-->
    <script src="<?= base_url(); ?>/assets/js/paginas/formcapinstalada.js"></script>