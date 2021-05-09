<div class="container">

    <div class="row">
        <div class="col-md-12">

            <div class="text-center">
                <img src="<?=base_url();?>/assets/img/logo_login.png" class="img-fluid" alt="Responsive image" />
            </div>
        </div>
        
    </div>

    <div class="row text-center">
        <div class="col-md-3 ">

        </div>

        <div class="col-md-6 ">

            <form class="form-horizontal bv-form" method="post" id="formRegistro">
                <div class="form-group">
                    <h1><span class="badge bg-info text-light">REGISTRO</span></h1>
                </div>

                <div class="form-group row">
                    <label for="nombres" class="col-sm-2 col-form-label">Nombres</label>
                    <div class="col-sm-10">
                        <input type="text" name="nombres" id="nombres" class="form-control" placeholder="Nombres" data-error="Debe ingresar un valor" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="apellidos" class="col-sm-2 col-form-label">Apellidos</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="apellidos" id="apellidos" aria-describedby="emailHelp"
                            placeholder="Apellidos" data-error="Debe ingresar un valor" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="telefono" class="col-sm-2 col-form-label">Teléfono</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="telefono" id="telefono" placeholder="Teléfono" data-error="Debe ingresar un valor" required>
                    </div>

                </div>
                <div class="form-group row">
                    <label for="correo" class="col-sm-2 col-form-label">Correo</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="correo" id="correo" aria-describedby="emailHelp"
                            placeholder="Correo" required>
                        <small id="emailHelp" class="form-text text-muted">Ingrese el correo con el que tendra acceso al sistema</small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="correo_confir" class="col-sm-2 col-form-label">Confirme Correo</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="correo_confir" id="correo_confir" aria-describedby="emailcHelp"
                            placeholder="Confirme Correo" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="contrasenia" class="col-sm-2 col-form-label">Contraseña</label>
                    <div class="col-sm-10">
                        <input type="password" name="contrasenia" class="form-control" id="contrasenia" placeholder="Contraeña" aria-describedby="passHelp" required>
                        <small id="passHelp" class="form-text text-muted">Ingrese una contraseña segura</small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="conf_contrasenia" class="col-sm-3 col-form-label">Confirme contraseña</label>
                    <div class="col-sm-9">
                    <input type="password" name="conf_contrasenia" class="form-control" id="conf_contrasenia" 
                    placeholder="Confirme Contraeña" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-4 col-form-label">
                    <!--<input type="submit" value="Guardar" class="btn btn-primary" />-->
                    <button type="submit" class="btn btn-primary" value="Guardar" id="btnregistro">Registrar</button>
                    </label>
                    <div class="col-sm-4">
                    <a href="<?=base_url();?>/Login" class="stretched-link"><h3>Ya estoy registrado</h3></a>
                    </div>
                </div>
            </form>

        </div>
        <div class="col-md-3 ">
            
        </div>

    </div>

</div>

