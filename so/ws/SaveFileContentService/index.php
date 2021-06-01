<?php

		$obj1 = new response;
		$obj1->id = $idContent;

		//echo "update file_contents set fl_content='".$content."' where fl_id=".$idContent.";";
		
		if($idContent=="")
		{
			$fl_folder_id = ($folder === 'fld' or $folder === '') ? 'null' : substr($folder, 3);
			$icon = endsWith($nameContent, '.zip') ? "7" : "6";
			
			
			$query = "insert into files(fl_name, fl_width, fl_left, fl_top, fl_icon, fl_folder_id) values ('".$nameContent."', 96, 250, 250, ".$icon.", ".$fl_folder_id.");";
			$obj1->message = ExecuteSQL($query);
			
			if($obj1->message == "200")
			{
				$query = "insert into file_contents(fl_content) values ('".$content."');";
				$obj1->message = ExecuteSQL($query);
			}
		}
		else
		{
			$query = "update file_contents set fl_content='".$content."' where fl_id=".substr($idContent, 2).";";
			$obj1->message = ExecuteSQL($query);
		}
		
		$obj[0] = $obj1;
?>
