
	function tmplPaths(name)
	{
		return "<li class=\"breadcrumb-item active\" aria-current=\"page\">" + name + "</li>";
	}
	
	function tmplFoldersND(id, width, left, top, icon, name)
	{
		return "<div id=\"" + id + "\" class=\"card border-0\" style=\"position: absolute;width: " + width + "px;left:" + left + "px;top:" + top + "px;\" ondblclick=\"javascript:navigate('" + id + "')\" >"
			+ "<img src=\"./icons/" + icon + ".png\" class=\"imagecenter\" alt=\"...\" />"
			+ "<p style=\"text-align:center;\">" + name + "</p>"
			+ "</div>";
	}
	
	function tmplFolders(id, width, left, top, icon, name)
	{
		return "<div id=\"" + id + "\" class=\"card border-0\" style=\"position: absolute;width: " + width + "px;left:" + left + "px;top:" + top + "px;\" ondblclick=\"javascript:navigate('" + id + "')\" >"
			+ "<img src=\"./icons/" + icon + ".png\" class=\"imagecenter\" alt=\"...\" />"
			+ "<div class=\"dropdown\"  style=\"text-align:center;width: " + width + "px;\">"
			+ "<button type=\"button\" class=\"btn btn-light btn-block dropdown-toggle\" type=\"button\" id=\"dropdownMenu2\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\" style=\"white-space:normal;display:inline-flex;padding:0px;\">"
				+ name
			+ "</button>"
			+ "<ul class=\"dropdown-menu\" aria-labelledby=\"dropdownMenu2\" style=\"padding:0px\">"
				+ "<li><a class=\"dropdown-item alert alert-light\" href=\"javascript:ren('" + id + "')\" style=\"padding:4px;margin:0px\">Rename</a></li>"
				+ "<li><a class=\"dropdown-item alert alert-light\" href=\"javascript:zip('" + id + "')\" style=\"padding:4px;margin:0px\">Zip</a></li>"
				+ "<li><a class=\"dropdown-item alert alert-danger\" href=\"javascript:del('" + id + "')\" style=\"padding:4px;margin:0px\">Delete</a></li>"
			+ "</ul>"
			+ "</div>"
			+ "</div>";
	}

	
