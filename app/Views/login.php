<div class="container">

    <div class="row">
        <div class="col-md-12">

            <div class="text-center">
                <img src="<?=base_url();?>/assets/img/logo_login.png" class="img-fluid" alt="Responsive image" />
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 ">

        </div>

        <div class="col-md-6 ">
            <form id="formlogin" method="post">

                <div class="form-group row">
                    <label for="correo" class="col-sm-2 col-form-label">Correo</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="contrasenia" class="col-sm-2 col-form-label">Contraseña</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="contrasenia" name="contrasenia" placeholder="Contraseña" required>
                    </div>
                </div>
                <!--<div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Recordarme</label>
                </div>-->
                <div class="mb-3 row">
                    <label class="col-sm-4 col-form-label">
                    <button type="submit" class="btn btn-primary">Iniciar sesion</button>
                    </label>
                    <div class="col-sm-4">
                    <a href="<?=base_url();?>/Registro" class="stretched-link"><h3>No estoy registrado</h3></a>
                    </div>
                </div>
               
            </form>
        </div>

        <div class="col-md-3 ">

        </div>

    </div>

</div>
<br/>
<br/>