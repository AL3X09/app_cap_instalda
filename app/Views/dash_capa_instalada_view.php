<div class="main-panel">
    <div class="content">
        <div class="page-inner mt--6">

            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <h1 class="text-blue pb-2 fw-bold">CAPACIDAD ACADÉMICA INSTALADA</h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <!--<form id="formcapinstalada" method="post">-->
                    <div class="form-group row">
                        <label for="pkhso" class="col-form-label">Sub Red</label>
                        <div class="col-sm-8">
                            <select class="form-control form-control" id="hso_select" name="pkhso" required onchange="get_uss()">
                            </select>
                        </div>
                    </div>
                    <!--</form>-->
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="pkuss" class="col-form-label">Unidad de servicios</label>
                        <div class="col-sm-8">
                            <select class="form-control form-control" id="uss_select" name="pkuss" required onchange="get_gus()">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="pkuss" class="col-form-label">Grupo</label>
                        <div class="col-sm-8">
                            <select class="form-control form-control" id="gus_select" name="pkgus" required onchange="get_svo()">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="pkuss" class="col-form-label">Servicio Ofertado</label>
                        <div class="col-sm-8">
                            <select class="form-control form-control" id="svo_select" name="pksvo" required onchange="get_programa()">
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="pkuss" class="col-form-label">Programa</label>
                        <div class="col-sm-8">
                            <select class="form-control form-control" id="prog_select" name="pkprog" required onchange="calldata()">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="pkuss" class="col-form-label">Perfil</label>
                        <div class="col-sm-8">
                            <select class="form-control form-control" id="perf_select" name="pkperf" required onchange="calldata()">
                            </select>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row" id="titleconten">
                <div class="col-md-12">
                    <div class="text-center" id="titulouss">
                        
                    </div>
                </div>
            </div>

            <div class="row" id="contenido">
               
            </div>


        </div>

    </div>



    <!-- JS pagina 	-->
    <script src="<?= base_url(); ?>/assets/js/paginas/dashcapainsta.js"></script>