

$('#editor').trumbowyg({
    btnsDef: {
        alert: {
            fn: function() {
				if(confirm("¿Seguro que quieres guardar el elemento y todo su contenido aquí?"))
				{
					var url = new URL(window.location.href);
					var id = url.searchParams.get("c");
					var dir = url.searchParams.get("d");
					var name = "";
					var contenido = document.getElementById('editor').innerHTML;
					
					if(id === '')
					{
						name = prompt("Nombre del fichero", "Nuevo Archivo");
					}
					
					var parametros = {
						"op" : "SaveFileContent",
						"d" : dir,
						"c" : id,
						"n" : name,
						"con" : contenido
					};

					$.ajax({
						data:  parametros,
						url:   '../ws/folder.php',
						dataType : 'json',
						type:  'post',
						success:  function (response) {
							if(response[0].message==="200")
							{
								alert("Documento guardado");
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
            },
            ico: 'upload'
        }
    },
    btns: [
        ['alert'],
		['strong', 'em', 'del'],
		['superscript', 'subscript'],
		['link'],
		['unorderedList', 'orderedList', 'horizontalRule', 'formatting', 'removeformat' ],
        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull']
    ]
})
.on('tbwinit', 
	function()
	{ 
		var idContent = (new URL(window.location.href)).searchParams.get("c");

		if(idContent != '')
		{
			var parametros = {
				"op" : "GetFileContent",
				"c" : idContent
			};

			$.ajax({
				data:  parametros,
				url:   '../ws/folder.php',
				dataType : 'json',
				type:  'post',
				success:  function (response) {
					if(response!==null)
					{
						document.getElementById('editor').innerHTML = response[0].content;
					}
				},
				error: function (xhr, status, error) {
				  alert("Error: " + xhr.responseText + " - " + error);
				}
			});
		}
	}
);


