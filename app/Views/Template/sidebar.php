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
				<li class="nav-item active">
					<a href="<?= base_url(); ?>/home">
						<i class="fas fa-desktop"></i>
						<p>Dashboard</p>
					</a>
				</li>
				<li class="nav-section">
					<span class="sidebar-mini-icon">
						<i class="fa fa-ellipsis-h"></i>
					</span>
					<h4 class="text-section">Tabla de datos</h4>
				</li>
				<li class="nav-item">
					<a href="<?= base_url(); ?>/capinstalada">
						<i class="fas fa-pen-square"></i>
						<p>instrumento</p>
					</a>
				</li>
				<li class="nav-section">
					<span class="sidebar-mini-icon">
						<i class="fa fa-ellipsis-h"></i>
					</span>
					<h4 class="text-section">datos maestros</h4>
				</li>
				
				<li class="nav-item">
					<a data-toggle="collapse" href="#base">
						<i class="fas fa-layer-group"></i>
						<p>Base</p>
						<span class="caret"></span>
					</a>
					<div class="collapse" id="base">
						<ul class="nav nav-collapse">
							<li>
								<a href="<?= base_url(); ?>/hso">
									<span class="sub-item">HSO</span>
								</a>
							</li>
							<li>
								<a href="<?= base_url(); ?>/uss">
									<span class="sub-item">Unidad de servicios</span>
								</a>
							</li>
							<li>
								<a href="<?= base_url(); ?>/gus">
									<span class="sub-item">Grupos</span>
								</a>
							</li>
							<li>
								<a href="<?= base_url(); ?>/svo">
									<span class="sub-item">Servicios ofertados</span>
								</a>
							</li>
							<li>
								<a href="<?= base_url(); ?>/programa">
									<span class="sub-item">Porgramas</span>
								</a>
							</li>
							<li>
								<a href="<?= base_url(); ?>/perfil">
									<span class="sub-item">Perfiles</span>
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