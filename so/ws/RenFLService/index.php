<?php

	$obj1 = new response;
	$obj1->id = $RenFLI;
	
	if($obj1->id == "" or $NewName == "..")
	{
		$obj1->message = "500";
	}
	else if(substr($obj1->id, 0, 3)=="fld")
	{
		//cojo el nombre antiguo
		$query = "select fld_name, fld_path from folders where fld_id=".substr($obj1->id, 3).";";
		$array = SQLToArray($query);
		
		$fld_name = $array[0]["fld_name"];
		$fld_path = $array[0]["fld_path"];
		
		//actualizo el nombre
		$query = "update folders set fld_name='".$NewName."' where fld_id=".substr($obj1->id, 3).";";
		$obj1->message = ExecuteSQL($query);
		
		//actualizo el path de los hijos
		$query = "update folders set fld_path=CONCAT('".$fld_path."#".$NewName."', SUBSTRING(fld_path, 1 + LENGTH('".$fld_path."#".$fld_name."'))) where fld_path like '".$fld_path."#".$fld_name."%';";
		$obj1->message = ExecuteSQL($query);
	}
	else if(substr($obj1->id, 0, 2)=="fl")
	{
		$query = "update files set fl_name='".$NewName."' where fl_id=".substr($obj1->id, 2).";";
		$obj1->message = ExecuteSQL($query);
	}
	else
	{
		$obj1->message = "";
	}

	$obj[0] = $obj1;
	
?>