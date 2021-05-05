	<nav aria-label="breadcrumb" style="position: absolute;top:60px;left:25px">
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
						$("#resultFolders").html(htmlOutput);
						
						for(i = 0; i < response.folders.length; i++) {
							dragElement(document.getElementById(response.folders[i].id));
						}
						
						var templatePaths = $.templates("#tmplPaths");
						var htmlOutput2 = templatePaths.render(response.paths);
						$("#resultPaths").html(htmlOutput2);
					}
				},
				error: function (xhr, status, error) {
				  alert("Error: " + xhr.responseText);
				}
			});
		}
		
		function navigate(navigateTo)
		{
			var url = window.location.origin + window.location.pathname + "?d=" + navigateTo;
			window.location = url;
		}
	</script> 
		

	<script id="tmplPaths" type="text/x-jsrender">
	<li class="breadcrumb-item active" aria-current="page">{{:name}}</li>
	</script>
	
	<script id="tmplFolders" type="text/x-jsrender">
	<div id="{{:id}}" class="card border-0" style="position: absolute;width: {{:width}}px;left:{{:left}}px;top:{{:top}}px;" ondblclick="javascript:navigate('{{:id}}')" >
		<img src="./icons/{{:icon}}.png" class="imagecenter" alt="..." />
		<p style="text-align:center;">{{:name}}</p>
	</div>
	</script>