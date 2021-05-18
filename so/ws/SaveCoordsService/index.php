<?php

	$obj1 = new response;
	$obj1->id = $saveCoordsI;
	if($obj1->id == "")
	{
		$obj1->message = "";
	}
	else if(substr($obj1->id, 0, 3)=="fld")
	{
		$l = $saveCoordsL;
		$t = $saveCoordsT;
		
		//para borrar el px final
		$to_delete = array('px');
		$to_write   = array('');
		$l  = str_replace($to_delete, $to_write, $l);
		$t  = str_replace($to_delete, $to_write, $t);
		
		$query = "update folders set fld_left=".$l.", fld_top=".$t." where fld_id=".substr($obj1->id, 3).";";
		$obj1->message = ExecuteSQL($query);
	}
	else if(substr($obj1->id, 0, 2)=="fl")
	{
		try {
			$l = $saveCoordsL;
			$obj1->message = "B";
			$t = $saveCoordsT;
			$obj1->message = "C";
			
			//para borrar el px final
			$to_delete = array('px');
			$obj1->message = "D";
			$to_write   = array('');
			$obj1->message = "E";
			$l  = str_replace($to_delete, $to_write, $l);
			$obj1->message = "F";
			$t  = str_replace($to_delete, $to_write, $t);
			$obj1->message = "G";
			
			$query = "update files set fl_left=".$l.", fl_top=".$t." where fl_id=".substr($obj1->id, 2).";";
			$obj1->message = ExecuteSQL($query);
		} catch (Exception $e) {
			//echo 'Excepción capturada: ',  $e->getMessage(), "\n";
		}
	}
	else
	{
		$obj1->message = "";
	}

	$obj[0] = $obj1;
	
?>