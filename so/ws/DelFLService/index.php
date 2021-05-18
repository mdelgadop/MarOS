<?php

	$obj1 = new response;
	$obj1->id = $DelFLI;
	
	if($obj1->id == "")
	{
		$obj1->message = "";
	}
	else if(substr($obj1->id, 0, 3)=="fld")
	{
		$query = "delete from folders where fld_id=".substr($obj1->id, 3).";";
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