<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow">

    <title>Calculadora</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	

    <style type="text/css">

input[type=button] {
  height: 51px;
  width: 100px;
}

    </style>
	
</head>

<body>
    <div class="container-fluid">
        <div class="row">    
			<table style="width: 0px;">
				<tr>
					<td colspan="4">
						<input type="text" id="txtCifra" style="width:100%" />
					</td>
				</tr>
				<tr>
					<td>
						<input type="button" class="btn btn-secondary" onclick="cuadrado()" value="x^2" />
					</td>
					<td>
						<input type="button" class="btn btn-secondary" onclick="cubo()" value="x^3" />
					</td>
					<td>
						<input type="button" class="btn btn-secondary" onclick="borrar()" value="C" />
					</td>
					<td>
						<input type="button" class="btn btn-secondary" onclick="division()" value="&#247;" />
					</td>
				</tr>
				<tr>
					<td>
						<input type="button" class="btn btn-primary" onclick="nuevaCifra(7)" value="7" />
					</td>
					<td>
						<input type="button" class="btn btn-primary" onclick="nuevaCifra(8)" value="8" />
					</td>
					<td>
						<input type="button" class="btn btn-primary" onclick="nuevaCifra(9)" value="9" />
					</td>
					<td>
						<input type="button" class="btn btn-secondary" onclick="multiplicacion()" value="X" />
					</td>
				</tr>
				<tr>
					<td>
						<input type="button" class="btn btn-primary" onclick="nuevaCifra(4)" value="4" />
					</td>
					<td>
						<input type="button" class="btn btn-primary" onclick="nuevaCifra(5)" value="5" />
					</td>
					<td>
						<input type="button" class="btn btn-primary" onclick="nuevaCifra(6)" value="6" />
					</td>
					<td>
						<input type="button" class="btn btn-secondary" onclick="resta()" value="-" />
					</td>
				</tr>
				<tr>
					<td>
						<input type="button" class="btn btn-primary" onclick="nuevaCifra(1)" value="1" />
					</td>
					<td>
						<input type="button" class="btn btn-primary" onclick="nuevaCifra(2)" value="2" />
					</td>
					<td>
						<input type="button" class="btn btn-primary" onclick="nuevaCifra(3)" value="3" />
					</td>
					<td>
						<input type="button" class="btn btn-secondary" onclick="suma()" value="+" />
					</td>
				</tr>
				<tr>
					<td>
						<input type="button" class="btn btn-primary" onclick="pi()" value="&#928;" />
					</td>
					<td>
						<input type="button" class="btn btn-primary" onclick="nuevaCifra(0)" value="0" />
					</td>
					<td>
						<input type="button" class="btn btn-primary" onclick="nuevaCifra('.')" value="." />
					</td>
					<td>
						<input type="button" class="btn btn-success" onclick="igual()" value="=" />
					</td>
				</tr>
			</table>
        </div> <!-- /.row -->
    </div> <!-- /.container-fluid -->

	<script src="./operaciones.js"></script>
</body>
</html>