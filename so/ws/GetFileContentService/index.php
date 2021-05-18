<?php
		//files
		$query = "select fl_content from file_contents where fl_id=".$idContent.";";
				
		//echo $query;
		$array = SQLToArray($query);
		$complete_path = "";

		$i = 0;
		while($i<count($array))
		{
			$obj1 = new fileContent;
			$obj1->id = $idContent;
			$obj1->content = $array[$i]["fl_content"];
			
			$obj[0] = $obj1;
			$i++;
		}
?>
