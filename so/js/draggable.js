		function dragElement(elmnt) {
			var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
			if (document.getElementById(elmnt.id + "header")) {
				// if present, the header is where you move the DIV from:
				document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
			} else {
				// otherwise, move the DIV from anywhere inside the DIV:
				elmnt.onmousedown = dragMouseDown;
			}

			function dragMouseDown(e) {
				e = e || window.event;
				e.preventDefault();
				// get the mouse cursor position at startup:
				pos3 = e.clientX;
				pos4 = e.clientY;
				document.onmouseup = closeDragElement;
				// call a function whenever the cursor moves:
				document.onmousemove = elementDrag;
			}

			function elementDrag(e) {
				e = e || window.event;
				e.preventDefault();
				// calculate the new cursor position:
				pos1 = pos3 - e.clientX;
				pos2 = pos4 - e.clientY;
				pos3 = e.clientX;
				pos4 = e.clientY;  	
				// set the element's new position:
				var currTop = (1*elmnt.style.top.substring(0, elmnt.style.top.indexOf("px")));
				var currLeft = (1*elmnt.style.left.substring(0, elmnt.style.left.indexOf("px")));
				elmnt.style.top = (currTop - pos2) + "px";
				elmnt.style.left = (currLeft - pos1) + "px";
			}

			function closeDragElement() {
				// stop moving when mouse button is released:
				document.onmouseup = null;
				document.onmousemove = null;
				fnSaveCoordinates();
			}

			function fnSaveCoordinates() {
				if(elmnt.id != myDir && elmnt.id.startsWith("fld") || elmnt.id.startsWith("fl"))
				{
					var data = new FormData();
					data.append('op', 'SaveCoords');
					data.append('i', elmnt.id);
					data.append('t', elmnt.style.top);
					data.append('l', elmnt.style.left);
					
					fetch('./ws/folder.php', {
					  method: 'POST', // or 'PUT'
					  body: data
					}).then(res => res.json())
					.then(response => { } )
					.catch(error => { } );
				}
			}
		}
		
		function undragElement(elmnt) {
		  if (document.getElementById(elmnt.id + "header")) {
			// if present, the header is where you move the DIV from:
			document.getElementById(elmnt.id + "header").onmousedown = null;
		  } else {
			// otherwise, move the DIV from anywhere inside the DIV:
			elmnt.onmousedown = null;
		  }
		}
		
		