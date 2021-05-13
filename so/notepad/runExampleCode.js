

$('#editor').trumbowyg({
    btnsDef: {
        alert: {
            fn: function() {
				var url = new URL(window.location.href);
				var id = url.searchParams.get("c");
				var dir = url.searchParams.get("d");
				var name = "";
				var contenido = document.getElementById('editor').innerHTML;
				//alert("Guardo el documento " + (id == null ? "nuevo" : id) + " en " + dir + " con el contenido " + contenido);
				
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
						if(response[0].content==="200")
						{
							alert("Documento guardado");
						}
						else
						{
							alert("Error al guardar documento: " + response);
						}
					},
					error: function (xhr, status, error) {
					  alert("Error: " + xhr.responseText + " - " + error);
					}
				});

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


