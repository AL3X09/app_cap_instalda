<div class="main-panel">
    <div class="content">
        <div class="page-inner mt--6">

            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <h1 class="text-blue pb-2 fw-bold">ESTANDAR DEL GRUPO</h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" onclick="get_uus()">
                        Insertar
                    </button>
                    <!-- data-sortable="true"
                    data-remember-order="true"
                     -->
                    <table id="table_esta"
                    data-toggle="table_esta"
                    data-search="true"
                    data-show-fullscreen="true"
                    data-show-columns-toggle-all="true"
                    data-minimum-count-columns="2"
                    data-pagination="true"
                    data-id-field="id"
                    data-page-list="[4, 8, 16, 100]"
                    data-show-footer="false"
                    data-sort-name="numero"
                    data-sort-name="programa"
                    data-sort-order="asc"
                    
                    
                    class="table table-bordered table-head-bg-info table-bordered-bd-info mt-4"
                    ></table>
                </div>
            </div>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Insertar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form id="forminsertestandar" method="post">

                        <div class="form-group row">
                            <label for="pkuus" class="col-sm-2 col-form-label">Unidad</label>
                            <div class="col-sm-10">
                                <select class="form-control form-control" id="uus_select" name="pkuus" required onchange="">
                                    <option value="">Seleccione</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pkgus" class="col-sm-2 col-form-label">Grupo</label>
                            <div class="col-sm-10">
                                <select class="form-control form-control" id="gus_select" name="pkgus" required onchange="">
                                    <option value="">Seleccione</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pksvo" class="col-sm-2 col-form-label">Servicio</label>
                            <div class="col-sm-10">
                                <select class="form-control form-control" id="svo_select" name="pksvo" required onchange="">
                                    <option value="">Seleccione</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pkprog" class="col-sm-2 col-form-label">Programa</label>
                            <div class="col-sm-10">
                                <select class="form-control form-control" id="prog_select" name="pkprog" required onchange="">
                                    <option value="">Seleccione</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pkperf" class="col-sm-2 col-form-label">Pérfil</label>
                            <div class="col-sm-10">
                                <select class="form-control form-control" id="perf_select" name="pkperf" required>
                                    <option value="">Seleccione</option>
                                </select>
                            </div>
                        </div>
                        <!--Fin primera parte-->
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
                        <div class="form-group row">
                            <label for="observa" class="col-sm-12 col-form-label">Observación</label>
                            <div class="col-sm-12">
                                <textarea class="form-control" id="observa" name="observa" placeholder="Número de estudiantes por cada docente" required></textarea>
                            </div>
                        </div>
                        <div id="divhidden"></div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeM()">Cerrar</button>
                    <button id="btnsave" type="button" class="btn btn-primary" onclick="insertasocia()">Gurdar</button>
                    <button id="btnactua" type="button" class="btn btn-primary invisible" onclick="updatestan3()">Actualizar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JS pagina 	-->
    <script src="<?= base_url(); ?>/assets/js/paginas/estandar.js"></script>