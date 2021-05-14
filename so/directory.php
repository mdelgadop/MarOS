	<button type="button" class="btn btn-primary btn-sm" style="position: absolute;top:60px;left:25px" onclick="createFolder()">+</button>
	<nav aria-label="breadcrumb" style="position: absolute;top:60px;left:75px">
		
	  <ol class="breadcrumb" id="resultPaths">

	  </ol>
	</nav>

	<div id="resultFolders"></div>
	
	<script type="text/javascript">

		Inicializar();
		function Inicializar(){

			var parametros = {
				"op" : "GetFolders",
				"folder" : "<?=$dir ?>"
			};

			$.ajax({
				data:  parametros,
				url:   './ws/folder.php',
				dataType : 'json',
				type:  'post',
				success:  function (response) {
					if(response!==null)
					{
						var template = $.templates("#tmplFolders");
						var htmlOutput = template.render(response.folders);

						var templateND = $.templates("#tmplFoldersND");
						var htmlOutputND = templateND.render(response.foldersND);

						$("#resultFolders").html(htmlOutput+htmlOutputND);
						
						for(i = 0; i < response.folders.length; i++) {
							dragElement(document.getElementById(response.folders[i].id));
						}
						
						for(i = 0; i < response.foldersND.length; i++) {
							dragElement(document.getElementById(response.foldersND[i].id));
						}

						var templatePaths = $.templates("#tmplPaths");
						var htmlOutput2 = templatePaths.render(response.paths);
						$("#resultPaths").html(htmlOutput2);
					}
				},
				error: function (xhr, status, error) {
				  alert("Error: " + xhr.responseText + " - " + error);
				}
			});
		}
		
		function navigate(navigateTo)
		{
			if(navigateTo.startsWith("fld"))
			{
				var url = window.location.origin + window.location.pathname + "?d=" + navigateTo;
				window.location = url;
			}
			else if(navigateTo.startsWith("fl"))
			{
				openMWindow('notepad', 470, 345, '<?=$_GET["d"] ?>', navigateTo);
			}
			else
			{
				alert("Extension not recognized for file " + navigateTo);
			}
		}
		
		function del(toDel)
		{
			if(confirm("¿Seguro que quieres eliminar el elemento y todo su contenido?"))
			{
				var parametros = {
					"op" : "DelFL",
					"i" : toDel
				};

				$.ajax({
					data:  parametros,
					url:   './ws/folder.php',
					dataType : 'json',
					type:  'post',
					success:  function (response) {
						if(response[0].message==="200")
						{
							Inicializar();
						}
						else
						{
							alert("Error al eliminar " + response[0].message);
						}
					},
					error: function (xhr, status, error) {
					  alert("Error: " + xhr.responseText + " - " + error);
					}
				});
			}
		}
		
		function createFolder()
		{
			var name = prompt("Nombre del directorio", "Nuevo Directorio");;
			
			if(name !== '')
			{
				var parametros = {
					"op" : "CreateFolder",
					"d" : '<?=$dir ?>',
					"n" : name,
				};

				$.ajax({
					data:  parametros,
					url:   './ws/folder.php',
					dataType : 'json',
					type:  'post',
					success:  function (response) {
						if(response[0].message==="200")
						{
							Inicializar();
						}
						else
						{
							alert("Error al guardar documento: " + response[0].message);
						}
					},
					error: function (xhr, status, error) {
					  alert("Error: " + xhr.responseText + " - " + error);
					}
				});
			}
		}
	</script> 
		

	<script id="tmplPaths" type="text/x-jsrender">
	<li class="breadcrumb-item active" aria-current="page">{{:name}}</li>
	</script>
	
	<script id="tmplFolders" type="text/x-jsrender">
		<div id="{{:id}}" class="card border-0" style="position: absolute;width: {{:width}}px;left:{{:left}}px;top:{{:top}}px;" ondblclick="javascript:navigate('{{:id}}')" >
		<img src="./icons/{{:icon}}.png" class="imagecenter" alt="..." />
		<div class="dropdown"  style="text-align:center;width: {{:width}}px;">
		<button type="button" class="btn btn-light btn-block dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false" style="white-space:normal;display:inline-flex;padding:0px;">
			{{:name}}
		</button>
		  <ul class="dropdown-menu" aria-labelledby="dropdownMenu2" style="padding:0px">
			<li><a class="dropdown-item alert alert-danger" href="javascript:del('{{:id}}')" style="padding:4px;margin:0px">Delete</a></li>
		  </ul>
		</div>

		</div>

	</script>

	<script id="tmplFoldersND" type="text/x-jsrender">
	<div id="{{:id}}" class="card border-0" style="position: absolute;width: {{:width}}px;left:{{:left}}px;top:{{:top}}px;" ondblclick="javascript:navigate('{{:id}}')" >
		<img src="./icons/{{:icon}}.png" class="imagecenter" alt="..." />
		<p style="text-align:center;">{{:name}}</p>
	</div>
	</script>
