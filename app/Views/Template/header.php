<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Capacidad Instalada - APP</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="<?=base_url();?>/assets/img/icon.ico" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="<?=base_url();?>/assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="<?=base_url();?>/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=base_url();?>/assets/css/atlantis.min.css">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="<?=base_url();?>/assets/css/demo.css">
	<!-- CSS Tables -->
	<link rel="stylesheet" href="<?=base_url();?>/assets/css/bootstrap-table.css"/>
	<!-- SET GLOBAL BASE URL -->
    <script>var base_url = '<?php echo base_url() ?>';</script>
	<!--   Core JS Files   -->
	<script src="<?=base_url();?>/assets/js/core/jquery.3.2.1.min.js"></script>
	<!-- Chart JS -->
	<script src="<?= base_url(); ?>/assets/js/plugin/chart.js/chart.min.js"></script>
</head>
<body>
<!-- wrapper -->
<div class="wrapper">