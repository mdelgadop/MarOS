<?php

	$obj1 = new response;
	$obj1->id = $DelFLI;
	
	if($obj1->id == "")
	{
		$obj1->message = "";
	}
	else if(substr($obj1->id, 0, 3)=="fld")
	{
		$idFolderToDelete = substr($obj1->id, 3);

		//INI FOLDERS HIJOS
		$query = "select fld_id from folders where fld_father=".$idFolderToDelete.";";
		$array = SQLToArray($query);
		$idFatherToDelete = $idFolderToDelete;
		$newIdFatherToDelete = "X";
		while($newIdFatherToDelete !== '')
		{
			$i = 0;
			$newIdFatherToDelete = "";
			while($i<count($array))
			{
				if($array[$i]["fld_id"] != '')
				{
					$idFatherToDelete .= $array[$i]["fld_id"] === '' ? '' : (','.$array[$i]["fld_id"]);
					$newIdFatherToDelete .= $array[$i]["fld_id"] === '' ? '' : ((($i==0)?'':',').$array[$i]["fld_id"]);
				}
				$i++;
			}

			if($newIdFatherToDelete!="")
			{
				$query = "select fld_id from folders where fld_father in (".$newIdFatherToDelete.");";
				$array = SQLToArray($query);
			}
		}
		//FIN FOLDERS HIJOS
		
		$query = "delete from folders where fld_id=".$idFolderToDelete." OR fld_father in (".$idFatherToDelete.");";
		$obj1->message = ExecuteSQL($query);

		$query = "delete from files where fl_folder_id in (".$idFatherToDelete.");";
		$obj1->message = ExecuteSQL($query);
		
		$query = "delete from file_contents where fl_id not in (select fl_id from files);";
		$obj1->message = ExecuteSQL($query);
	}
	else if(substr($obj1->id, 0, 2)=="fl")
	{
		$query = "delete from files where fl_id=".substr($obj1->id, 2).";";
		$obj1->message = ExecuteSQL($query);
		$query = "delete from file_contents where fl_id=".substr($obj1->id, 2).";";
		$obj1->message = ExecuteSQL($query);
	}
	else
	{
		$obj1->message = "";
	}

	$obj[0] = $obj1;
	
	
?>