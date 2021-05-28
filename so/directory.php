	<button type="button" class="btn btn-primary btn-sm" style="position: absolute;top:60px;left:25px" onclick="createFolder()">+</button>
	<nav aria-label="breadcrumb" style="position: absolute;top:60px;left:75px">
		
	  <ol class="breadcrumb" id="resultPaths">

	  </ol>
	</nav>

	<div id="resultFolders"></div>
	
	<script src="./js/directoryTemplates.js"></script>
	
	<script type="text/javascript">

		var myDir = '<?=$dir ?>';
		Inicializar();
		function Inicializar(){

			var data = new FormData();
			data.append('op', 'GetFolders');
			data.append('folder', myDir);
			
			fetch('./ws/folder.php', {
			  method: 'POST', // or 'PUT'
			  body: data
			}).then(res => res.json())
			.then(response => 
				{
					if(response!==null)
					{
						var index = 0;
						var htmlOutput2 = "";
						while(index < response.folders.length)
						{
							htmlOutput2 = htmlOutput2 + tmplFolders(response.folders[index].id, response.folders[index].width, response.folders[index].left, response.folders[index].top, response.folders[index].icon, response.folders[index].name);
							index++;
						}

						index = 0;
						while(index < response.foldersND.length)
						{
							htmlOutput2 = htmlOutput2 + tmplFoldersND(response.foldersND[index].id, response.foldersND[index].width, response.foldersND[index].left, response.foldersND[index].top, response.foldersND[index].icon, response.foldersND[index].name);
							index++;
						}

						document.getElementById("resultFolders").innerHTML = htmlOutput2;

						index = 0;
						htmlOutput2 = "";
						while(index < response.paths.length)
						{
							htmlOutput2 = htmlOutput2 + tmplPaths(response.paths[index].name);
							index++;
						}

						document.getElementById("resultPaths").innerHTML = htmlOutput2;
						
						for(i = 0; i < response.folders.length; i++) {
							dragElement(document.getElementById(response.folders[i].id));
						}
					}
				}
			)
			.catch(error => alert('Error: ' + error));
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
				alert(myDir == '' ? 'fld' : myDir);
				openMWindow('notepad', 650, 345, myDir == '' ? 'fld' : myDir, navigateTo);
			}
			else
			{
				alert("Format not recognized for file " + navigateTo);
			}
		}
		
		function del(toDel)
		{
			if(confirm("¿Seguro que quieres eliminar el elemento y todo su contenido?"))
			{
				var data = new FormData();
				data.append('op', 'DelFL');
				data.append('i', toDel);
				
				fetch('./ws/folder.php', {
				  method: 'POST', // or 'PUT'
				  body: data
				}).then(res => res.json())
				.then(response => 
					{
						if(response[0].message==="200")
						{
							Inicializar();
						}
						else
						{
							alert("Error al eliminar: " + response[0].message);
						}
					}
				)
				.catch(error => alert('Error: ' + error));
			}
		}
		
		function ren(toRen)
		{
			var name = prompt("Nuevo nombre", "");
			
			if(name !== '' && name !== undefined && name !== null)
			{
				var data = new FormData();
				data.append('op', 'RenFL');
				data.append('i', toRen);
				data.append('n', name);
				
				fetch('./ws/folder.php', {
				  method: 'POST', // or 'PUT'
				  body: data
				}).then(res => res.json())
				.then(response => 
					{
						if(response[0].message==="200")
						{
							Inicializar();
						}
						else
						{
							alert("Error al renombrar: " + response[0].message);
						}
					}
				)
				.catch(error => alert('Error: ' + error));
			}
		}
		
		function createFolder()
		{
			var name = prompt("Nombre del directorio", "Nuevo Directorio");
			
			if(name !== '')
			{
				var data = new FormData();
				data.append('op', 'CreateFolder');
				data.append('d', myDir);
				data.append('n', name);
				
				fetch('./ws/folder.php', {
				  method: 'POST', // or 'PUT'
				  body: data
				}).then(res => res.json())
				.then(response => 
					{
						if(response[0].message==="200")
						{
							Inicializar();
						}
						else
						{
							alert("Error al guardar documento: " + response[0].message);
						}
					}
				)
				.catch(error => alert('Error: ' + error));
			}
		}
		
	</script> 
