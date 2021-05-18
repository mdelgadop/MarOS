<?php
		//files
		$query = "select 'fl' as prefix, fl_id, fl_name, fl_width, fl_left, fl_top, fl_icon, '' as fl_path from files "
				." where fl_folder_id".$folder_father;
				
		$query = $query." union all ";
		//folders
		$query = $query."select 'fld' as prefix, fld_id, fld_name, fld_width, fld_left, fld_top, fld_icon, fld_path from folders "
			   ."where fld_father".$folder_father;
			   
		if($folder_to_check != "" and $folder_to_check != "fld")
		{	
			//folder parent (navigation to ".." folder
		    $query = $query." union all "
			   ."select 'fld' as prefix, fld_father, \"..\", 96, 50, 100, 0, CONCAT(fld_path, \"#\", fld_name) as fld_path from folders where fld_id=".substr($folder_to_check, 3);
		}
		
		$query = $query.";";
		//echo $query;
		$array = SQLToArray($query);
		$complete_path = "";
		$iObj = 0;

		$i = 0;
		while($i<count($array))
		{
			$obj1 = new folder;
			$obj1->id = $array[$i]["prefix"].$array[$i]["fl_id"];
			$obj1->name = $array[$i]["fl_name"];
			$obj1->width = "".$array[$i]["fl_width"];
			$obj1->left = "".$array[$i]["fl_left"];
			$obj1->top = "".$array[$i]["fl_top"];
			$complete_path = $array[$i]["fl_path"];
			
			$obj1->icon = GetIcon($array[$i]["fl_icon"]);
			
			if($obj1->name==="..")
			{
				$objND[0] = $obj1;
			}
			else
			{
				$obj[$iObj] = $obj1;
				$iObj++;
			}
			$i++;
			
		}
		
		$array_paths = explode("#", $complete_path);
		
		$i = 0;
		while($i<count($array_paths))
		{
			$path1 = new path;
			$path1->name = $array_paths[$i];
			$paths[$i] = $path1;
			$i++;
		}
		
		$mydesktop = new desktop;
		$mydesktop->foldersND = $objND!=null?$objND:array();
		$mydesktop->folders = $obj!=null?$obj:array();
		$mydesktop->paths = $paths;

?>
