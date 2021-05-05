<div class="main-panel">
    <div class="content">
        <div class="page-inner mt--6">

            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <h1 class="text-blue pb-2 fw-bold">SERVICIOS OFERTADOS POR LA UNIDAD</h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" onclick="get_gus()">
                        Insertar
                    </button>
                    <table id="table_svo"></table>
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

                    <form id="forminsertsvo" method="post">

                        <div class="form-group row">
                            <label for="gus" class="col-sm-2 col-form-label">Grupo de servicios</label>
                            <div class="col-sm-10">
                                <select class="form-control form-control" id="gus_select" name="pkgus" required>
                                    <option value="">Seleccione</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nombre" class="col-sm-2 col-form-label">Servicio ofertado</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Servicio" required>
                            </div>
                        </div>
                       
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="insertsvo()">Gurdar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JS pagina 	-->
    <script src="<?= base_url(); ?>/assets/js/paginas/svo.js"></script>