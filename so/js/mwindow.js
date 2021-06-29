		var lastId = 0;
		function openMWindow(app, width, height, dir, idContent) {
			var iDiv = document.createElement('div');
			var myApp = getMApp(app);
			if(myApp[0] !== '')
			{
				iDiv.innerHTML = createMWindow(myApp[0], "&nbsp;" + myApp[1], width, height, dir, idContent);
				iDiv.id = 'block';
				iDiv.className = 'block';
				document.getElementsByTagName('body')[0].appendChild(iDiv);
				
				iDiv.style.position = "absolute";
				iDiv.style.left = "50px";//(50 * lastId) + "px";
				iDiv.style.top = "100px";//(50 + (50 * lastId)) + "px";
			}
			//dragElement(iDiv);
		}
		
		function dragMe(id)
		{
			var iDiv = document.getElementById(id);
			dragElement(iDiv);
		}
		
		function undragMe(id)
		{
			var iDiv = document.getElementById(id);
			undragElement(iDiv);
		}
		
		function getMApp(app)
		{
			if(app==='calc')
			{
				return ['./calc/index.php', 'Calculadora'];
			}
			else if(app==='cal')
			{
				return ['./cal/index.php', 'Calendario'];
			}
			else if(app==='notepad')
			{
				return ['./notepad/index.html', 'Bloc de notas'];
			}
			else if(app==='weather')
			{
				return ['./weather/index.php', 'El tiempo'];
			}
			else if(app==='rockpaperscissor')
			{
				return ['./games/rock-paper-scisson/index.html', 'Piedra Papel Tijera'];
			}
			else
			{
				return ['', ''];
			}
		}
		
		function createMWindow(destiny, name, width, height, dir, idContent)
		{
			lastId = lastId + 1;
			return "<div id=\"div" + lastId + "\" class=\"card divDraggable\" style=\"width:" + ((1*width) + 5) + "px;height:" + ((1*height) + 45) + "px;resize: both;overflow: auto;\" >" 
			 + "  <div class=\"row divHeaderDraggable\" style=\"width:100%;margin-left:0px;\" onmouseover=\"dragMe('div" + lastId + "')\" onmouseout=\"undragMe('div" + lastId + "')\"> "
			 + "    <div class=\"col\" style=\"margin:0px;padding:0px;padding-top:3px;\"> "
			 + name
			 + "    </div> "
			 + "    <div class=\"col\" style=\"margin:0px;padding:0px;\"> "
			 + "	  <div class=\"card-header text-end\" style=\"padding:0px;\">" 
			 + "	    <div class=\"btn-group\" role=\"group\" aria-label=\"Basic example\">" 
			 + "		  <button type=\"button\" class=\"btn btn-primary btn-sm\" onclick=\"minMDiv('" + name + "', " + lastId + ")\">_</button>"
			 + "		  <button type=\"button\" class=\"btn btn-primary btn-sm\" onclick=\"closeMDiv(" + lastId + ")\">x</button>"
			 + "	    </div>" 
			 + "	  </div>" 
			 + "    </div> "
			 + "  </div> "
			 + "	  <div class=\"card-body\" style=\"padding:0px;height:100%\">" 
			 + "		<iframe src=\"" + destiny + "?d=" + dir + "&c=" + idContent + "\" style=\"width:100%; height:100%\" style=\"border:none;\" title=\"...\" />" 
			 + "	  </div>" 
			 + "	</div>";
		}
		
		function closeMDiv(idToClose)
		{
			var myobj = document.getElementById("div" + idToClose);
			myobj.remove();
			Inicializar();
		}
		
		function minMDiv(name, idToClose)
		{
			var myobj = document.getElementById("div" + idToClose);
			myobj.style.display = 'none';
			
			var dme = document.getElementById("divMinimizedElements");
			
			dme.innerHTML = dme.innerHTML + getButtonMinimize(name, idToClose);
		}
		
		function maxMDiv(name, idToClose)
		{
			var myobj = document.getElementById("div" + idToClose);
			myobj.style.display = 'block';
			
			var btnMax = document.getElementById("btnMax" + idToClose);
			btnMax.remove();
		}
		
		function getButtonMinimize(name, idToClose)
		{
			return "<button id=\"btnMax" + idToClose + "\" type=\"button\" class=\"btn btn-light\" style=\"margin-right:2px\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\" onclick=\"maxMDiv('" + name + "', '" + idToClose + "')\">"
			  + name
			  + "</button>";
		}
		