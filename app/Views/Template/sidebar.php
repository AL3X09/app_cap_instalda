<!-- Sidebar -->
<div class="sidebar sidebar-style-2">
	<div class="sidebar-wrapper scrollbar scrollbar-inner">
		<div class="sidebar-content">
			<div class="user">
				<div class="avatar-sm float-left mr-2">
					<img src="../assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
				</div>
				<div class="info">
					<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
						<span>
							<span class="user-level">Administrator</span>
							<span class="caret"></span>
						</span>
					</a>
					<div class="clearfix"></div>

					<div class="collapse in" id="collapseExample">
						<ul class="nav">
							<li>
								<a href="#profile">
									<span class="link-collapse">Perfil</span>
								</a>
							</li>
							<li>
								<a href="#edit">
									<span class="link-collapse">Editar Profile</span>
								</a>
							</li>
							<li>
								<a href="#settings">
									<span class="link-collapse">Confirgurar</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<ul class="nav nav-primary">
				<li class="nav-item" id="navinstrum">
					<a href="<?= base_url(); ?>/capinstalada">
						<i class="fas fa-pen-square"></i>
						<p>Instrumento</p>
					</a>
				</li>
				
				<li class="nav-section"  >
					<span class="sidebar-mini-icon">
						<i class="fa fa-ellipsis-h"></i>
					</span>
					<h4 class="text-section">Tabla de datos</h4>
				</li>
				<li class="nav-item " id="navtdatos">
					<a href="<?= base_url(); ?>/home">
						<i class="fas fa-desktop"></i>
						<p>Total de datos</p>
					</a>
				</li>
				<li class="nav-section">
					<span class="sidebar-mini-icon">
						<i class="fa fa-ellipsis-h"></i>
					</span>
					<h4 class="text-section">datos maestros</h4>
				</li>

				<li class="nav-item">
					<a data-toggle="collapse" href="#base" id="btnbase">
						<i class="fas fa-layer-group"></i>
						<p>Base</p>
						<span class="caret"></span>
					</a>
					<div class="collapse" id="base">
						<ul class="nav nav-collapse">
							<li id="btnhso">
								<a href="<?= base_url(); ?>/hso">
									<span class="sub-item">Sub Redes</span>
								</a>
							</li>
							<li id="btnuss">
								<a href="<?= base_url(); ?>/uss">
									<span class="sub-item">Unidad de servicios</span>
								</a>
							</li>
							<li id="btngus">
								<a href="<?= base_url(); ?>/gus">
									<span class="sub-item">Grupos</span>
								</a>
							</li>
							<li id="btnsvo">
								<a href="<?= base_url(); ?>/svo">
									<span class="sub-item">Servicios ofertados</span>
								</a>
							</li>
							<li id="btnprog">
								<a href="<?= base_url(); ?>/programa">
									<span class="sub-item">Porgramas</span>
								</a>
							</li>
							<li id="btnperf">
								<a href="<?= base_url(); ?>/perfil">
									<span class="sub-item">Perfiles</span>
								</a>
							</li>
							<li id="btnest">
								<a href="<?= base_url(); ?>/estandar">
									<span class="sub-item">Estandar</span>
								</a>
							</li>
							<li id="btndtuss">
								<a href="<?= base_url(); ?>/datosussv">
									<span class="sub-item">Datos de la Unidad de Servicios</span>
								</a>
							</li>

						</ul>
					</div>
				</li>


			</ul>
		</div>
	</div>
</div>
<!-- End Sidebar -->