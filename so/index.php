<!DOCTYPE html>
<html>
	<title>SO</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
	<script src="./js/mwindow.js"></script>
	<script src="./js/draggable.js"></script>

	<link rel="stylesheet" href="./style/dropdownsubmenu.css" />
		
	<style>
		#lowerleft
		{
			margin-bottom: 1px;
			margin-left : 1px;
			position: fixed;
			bottom: 0;
		}
		
		.imagecenter {
		  display: block;
		  margin-left: auto;
		  margin-right: auto;
		  width: 48px;		
		}
	</style>
	
	<script type="text/javascript">
		function calculadora() {
			openMWindow('calc', 415, 300, '<?=$_GET["d"] ?>', '');
		}
		function calendario() {
			openMWindow('cal', 470, 345, '<?=$_GET["d"] ?>', '');
		}
		function notepad() {
			openMWindow('notepad', 470, 345, '<?=$_GET["d"] ?>', '');
		}
		function weather() {
			openMWindow('weather', 800, 450, '<?=$_GET["d"] ?>', '');
		}
	</script> 
		
<body>


<header>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-sm navbar-secondary fixed-top bg-secondary">

		  <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
			Inicio
		  </button>
		  <ul class="dropdown-menu">
			<li><a class="dropdown-item" href="javascript:notepad()">Bloc de notas</a></li>
			<li><a class="dropdown-item" href="javascript:calculadora()">Calculadora</a></li>
			<li><a class="dropdown-item" href="javascript:calendario()">Calendario</a></li>
			<li><a class="dropdown-item" href="javascript:weather()">El tiempo</a></li>
			<li><hr class="dropdown-divider"></li>
			<li class="dropdown-submenu">
				<a class="dropdown-item" tabindex="-1" href="#">Idiomas</a>
				<ul class="dropdown-menu">
				  <li><a class="dropdown-item" href="#">Español</a></li>
				  <li><a class="dropdown-item" href="#">English</a></li>
				  <li><a class="dropdown-item" href="#">Deutsch</a></li>
				</ul>
			</li>
			<li><hr class="dropdown-divider"></li>
			<li><a class="dropdown-item" href="#">Salir</a></li>
		  </ul>

      </nav>
    </header>

	<?php
	$dir = $_GET["d"];
	include("directory.php");
	?>
	
</body>
</html>