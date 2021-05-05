<div class="main-panel">
    <div class="content">
        <div class="page-inner mt--6">

            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <h1 class="text-blue pb-2 fw-bold">PERFILES DE ESTUDIANTE</h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" onclick="">
                        Insertar
                    </button>
                    <table id="table_perf"></table>
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

                    <form id="forminsertperf" method="post">
                        
                        <div class="form-group row">
                            <label for="perfil" class="col-sm-2 col-form-label">Perfil</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="perfil" name="perfil" placeholder="Perfil" required>
                            </div>
                        </div>
                       
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="insertperfil()">Gurdar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JS pagina 	-->
    <script src="<?= base_url(); ?>/assets/js/paginas/perfil.js"></script>