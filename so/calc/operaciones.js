		function sumar(cifra1) {
			this.cifra1 = cifra1;
		  this.execute = function() {
			var cifraEscrita = document.getElementById("txtCifra").value;
			this.cifra1 = (1*cifra1) + (1*cifraEscrita);
			document.getElementById("txtCifra").value = this.cifra1;
		  };
		}
		
		function restar(cifra1) {
			this.cifra1 = cifra1;
		  this.execute = function() {
			var cifraEscrita = document.getElementById("txtCifra").value;
			this.cifra1 = (1*cifra1) - (1*cifraEscrita);
			document.getElementById("txtCifra").value = this.cifra1;
		  };
		}
		
		function multiplicar(cifra1) {
			this.cifra1 = cifra1;
		  this.execute = function() {
			var cifraEscrita = document.getElementById("txtCifra").value;
			this.cifra1 = (1*cifra1) * (1*cifraEscrita);
			document.getElementById("txtCifra").value = this.cifra1;
		  };
		}
		
		function dividir(cifra1) {
			this.cifra1 = cifra1;
		  this.execute = function() {
			var cifraEscrita = document.getElementById("txtCifra").value;
			this.cifra1 = (1*cifra1) / (1*cifraEscrita);
			document.getElementById("txtCifra").value = this.cifra1;
		  };
		}
		
		var operacion = new suma(0);
		operacion.execute();
				
		document.getElementById("txtCifra").addEventListener("keyup", fnGestionCifra);
		
		function fnGestionCifra() {
			var cifraEscrita = document.getElementById("txtCifra").value;
			
			if(cifraEscrita.length>0)
			{
				if(cifraEscrita.substr(cifraEscrita.length - 1) != '0'
				&& cifraEscrita.substr(cifraEscrita.length - 1) != '1'
				&& cifraEscrita.substr(cifraEscrita.length - 1) != '2'
				&& cifraEscrita.substr(cifraEscrita.length - 1) != '3'
				&& cifraEscrita.substr(cifraEscrita.length - 1) != '4'
				&& cifraEscrita.substr(cifraEscrita.length - 1) != '5'
				&& cifraEscrita.substr(cifraEscrita.length - 1) != '6'
				&& cifraEscrita.substr(cifraEscrita.length - 1) != '7'
				&& cifraEscrita.substr(cifraEscrita.length - 1) != '8'
				&& cifraEscrita.substr(cifraEscrita.length - 1) != '9'
				&& cifraEscrita.substr(cifraEscrita.length - 1) != '.'
				)
				{
					cifraEscrita = cifraEscrita.substr(0, cifraEscrita.length - 1);
				}
				
				if(cifraEscrita.substr(cifraEscrita.length - 1) === '.' && cifraEscrita.substr(0, cifraEscrita.length - 1).indexOf(".") >= 0)
				{
					cifraEscrita = cifraEscrita.substr(0, cifraEscrita.length - 1);
				}
			}
			
			document.getElementById("txtCifra").value = cifraEscrita;
		}
		
		function nuevaCifra(cifra)
		{
			document.getElementById("txtCifra").value = document.getElementById("txtCifra").value + '' + cifra;
			fnGestionCifra();
		}
		
		function cuadrado()
		{
			var cifraEscrita = document.getElementById("txtCifra").value;
			if(cifraEscrita.length != '')
			{
				cifraEscrita = cifraEscrita*cifraEscrita;
			}
			document.getElementById("txtCifra").value = cifraEscrita;
		}
		
		function cubo()
		{
			var cifraEscrita = document.getElementById("txtCifra").value;
			if(cifraEscrita.length != '')
			{
				cifraEscrita = cifraEscrita*cifraEscrita*cifraEscrita;
			}
			document.getElementById("txtCifra").value = cifraEscrita;
		}
		
		function borrar()
		{
			document.getElementById("txtCifra").value = "";
		}
		
		function pi()
		{
			document.getElementById("txtCifra").value = Math.PI;
		}
		
		function igual()
		{
			if(operacion !== null)
			{
				operacion.execute();
			}
			operacion = null;
		}
		
		function suma()
		{
			var cifraEscrita = document.getElementById("txtCifra").value;
			document.getElementById("txtCifra").value = "";
			operacion = new sumar(cifraEscrita);
		}

		function resta()
		{
			var cifraEscrita = document.getElementById("txtCifra").value;
			document.getElementById("txtCifra").value = "";
			operacion = new restar(cifraEscrita);
		}
		
		function multiplicacion()
		{
			var cifraEscrita = document.getElementById("txtCifra").value;
			document.getElementById("txtCifra").value = "";
			operacion = new multiplicar(cifraEscrita);
		}
		
		function division()
		{
			var cifraEscrita = document.getElementById("txtCifra").value;
			document.getElementById("txtCifra").value = "";
			operacion = new dividir(cifraEscrita);
		}