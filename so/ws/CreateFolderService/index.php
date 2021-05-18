<?php

	$obj1 = new response;
	$obj1->id = $CreateFolderN;
	
	if($obj1->id == "")
	{
		$obj1->message = "";
	}
	else
	{
		$folder_to_check=$CreateFolderFolder;
		if($folder_to_check == "" or $folder_to_check == "fld")
		{
			$folder_father = "null";
			$path_father = "Desktop";
		}
		else
		{
			$folder_father = substr($folder_to_check, 3);
			
			$query = "select fld_name, fld_path from folders where fld_id=".$folder_father.";";
			$array = SQLToArray($query);
			
			$path_father = (count($array) > 0) ? $array[0]["fld_path"]."#".$array[0]["fld_name"] : "Desktop";
		}
		$query = "insert into folders(fld_name, fld_width, fld_left, fld_top, fld_icon, fld_father, fld_path) values ('".$obj1->id."', 96, 250, 250, 0, ".$folder_father.", '".$path_father."');";
		$obj1->message = ExecuteSQL($query);
	}

	$obj[0] = $obj1;
	
?>