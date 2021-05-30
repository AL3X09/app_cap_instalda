<div class="main-panel">
    <div class="content">
        <div class="page-inner mt--6">

            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <h1 class="text-blue pb-2 fw-bold">PROGRAMAS</h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" onclick="get_svo()">
                        Insertar
                    </button>
                    <table id="table_prog"></table>
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

                    <form id="forminsertprog" method="post">

                        <!--<div class="form-group row">
                            <label for="pksvo" class="col-sm-2 col-form-label">Servicio de oferta</label>
                            <div class="col-sm-10">
                                <select class="form-control form-control" id="svo_select" name="pksvo" required onchange="get_perfil()">
                                    <option value="">Seleccione</option>
                                </select>
                            </div>
                        </div>-->
                        <div class="form-group row">
                            <label for="programa" class="col-sm-2 col-form-label">Programa</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="programa" name="programa" placeholder="Programa" required>
                            </div>
                        </div>
                        <!--<div class="form-group row">
                            <label for="perfil" class="col-sm-2 col-form-label">Perfil de estudio</label>
                            <div class="col-sm-10">
                                <select class="form-control form-control" id="perfil_select" name="perfil" required>
                                    <option value="">Seleccione</option>
                                </select>
                            </div>
                        </div>-->
                       
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="insertprog()">Gurdar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JS pagina 	-->
    <script src="<?= base_url(); ?>/assets/js/paginas/programa.js"></script>