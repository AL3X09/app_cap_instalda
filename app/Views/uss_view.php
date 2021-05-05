<div class="main-panel">
    <div class="content">
        <div class="page-inner mt--6">

            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <h1 class="text-blue pb-2 fw-bold">UNIDAD DE SERVICIOS DE SALUD</h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" onclick="get_hso()">
                        Insertar
                    </button>
                    <table id="table_uss"></table>
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

                    <form id="forminsertuss" method="post">

                        <div class="form-group row">
                            <label for="hso" class="col-sm-2 col-form-label">HSO</label>
                            <div class="col-sm-10">
                                <select class="form-control form-control" id="hso_select" name="hso" required>
                                    <option value="">Seleccione</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="direccion" class="col-sm-2 col-form-label">Direeción</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Direeción">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="telefono" class="col-sm-2 col-form-label">Teléfono</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Teléfono">
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="insertuss()">Gurdar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JS pagina 	-->
    <script src="<?= base_url(); ?>/assets/js/paginas/uss.js"></script>