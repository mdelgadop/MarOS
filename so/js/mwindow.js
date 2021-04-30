		var lastId = 0;
		function openMWindow(app, width, height) {
			var iDiv = document.createElement('div');
			iDiv.innerHTML = createMWindow(getMApp(app), width, height);
			iDiv.id = 'block';
			iDiv.className = 'block';
			document.getElementsByTagName('body')[0].appendChild(iDiv);
			
			iDiv.style.position = "absolute";
			iDiv.style.left = "50px";//(50 * lastId) + "px";
			iDiv.style.top = "100px";//(50 + (50 * lastId)) + "px";

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
				return './calc/index.html';
			}
			else if(app==='cal')
			{
				return './cal/index.html';
			}
			else if(app==='notepad')
			{
				return './notepad/index.html';
			}
			else
			{
				return '';
			}
		}
		
		function createMWindow(destiny, width, height)
		{
			lastId = lastId + 1;
			return "<div id=\"div" + lastId + "\" class=\"card divDraggable\" style=\"width:" + ((1*width) + 5) + "px;height:" + ((1*height) + 45) + "px;resize: both;overflow: auto;\" >" 
			 + "	  <div class=\"card-header text-end divHeaderDraggable\" style=\"padding:0px;\" onmouseover=\"dragMe('div" + lastId + "')\" onmouseout=\"undragMe('div" + lastId + "')\">" 
			 + "		  <button type=\"button\" class=\"btn btn-primary btn-sm\" onclick=\"closeMDiv(" + lastId + ")\">x</button>"
			 + "	  </div>" 
			 + "	  <div class=\"card-body\" style=\"padding:0px;\">" 
			 + "		<iframe src=\"" + destiny + "\" style=\"width:100%; height:100%\" style=\"border:none;\" title=\"...\" />" 
			 + "	  </div>" 
			 + "	</div>";
		}
		
		function closeMDiv(idToClose)
		{
			var myobj = document.getElementById("div" + idToClose);
			myobj.remove();
		}
