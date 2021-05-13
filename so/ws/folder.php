<?php

 class folder {
  public $id = "";
  public $name = "";
  public $width = "";
  public $left = "";
  public $top = "";
  public $icon = "folder";
 }
 
 class path {
	public $name = ""; 
 }
 
 class fileContent {
  public $id;
  public $content;
 }

 class desktop {
  public $folders;
  public $paths;
 }

	$op=$_POST['op'];
	
	if($op=="GetFolders")
	{
		$folder_to_check=$_POST['folder'];
		
		$folder_father = (($folder_to_check == "" or $folder_to_check == "fld") ? " is null" : "=".substr($folder_to_check, 3));
		
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
			
			$obj[$iObj] = $obj1;
			$i++;
			$iObj++;
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
		$mydesktop->folders = $obj;
		$mydesktop->paths = $paths;

		echo json_encode($mydesktop);
	}
	else if($op=="GetFileContent")
	{
		$idContent=$_POST['c'];
		$idContent=substr($idContent, 2);
		
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

		echo json_encode($obj);
	}
	else if($op=="SaveFileContent")
	{
		$folder=$_POST['d'];
		$idContent=$_POST['c'];
		$nameContent=$_POST['n'];
		$content=$_POST['con'];

		$obj1 = new fileContent;
		$obj1->id = $idContent;

		//echo "update file_contents set fl_content='".$content."' where fl_id=".$idContent.";";
		if($idContent=="")
		{
			$query = "insert into files(fl_name, fl_width, fl_left, fl_top, fl_icon, fl_folder_id) values ('".$nameContent."', 96, 250, 250, 6, ".substr($folder, 3).");";
			$obj1->content = ExecuteSQL($query);
			
			if($obj1->content == "200")
			{
				$query = "insert into file_contents(fl_content) values ('".$content."');";
				$obj1->content = ExecuteSQL($query);
			}
		}
		else
		{
			$query = "update file_contents set fl_content='".$content."' where fl_id=".substr($idContent, 2).";";
			$obj1->content = ExecuteSQL($query);
		}
		
		$obj[0] = $obj1;

		echo json_encode($obj);

	}
	
	function GetIcon($idIcon)
	{
		if($idIcon == "0")
			return "folder";
		else if($idIcon == "1")
			return "folder_home";
		else if($idIcon == "2")
			return "folder_files";
		else if($idIcon == "3")
			return "folder_music";
		else if($idIcon == "4")
			return "folder_images";
		else if($idIcon == "5")
			return "folder_videos";
		else if($idIcon == "6")
			return "notepad";
	}
	
	function SQLToArray($consulta)
	{
		$conn = new mysqli("localhost", "root", "14Laurita", "so");

		$indice = 0;
		$array[$indice] = null;

		if ($conn->connect_errno) {
			$array[$indice] =  "Falló la conexión: ".$conn->connect_error."\n";
		}
		else{
			if ($resultado = $conn->query($consulta)) {
				while($obj = $resultado->fetch_assoc()){ 
					$array[$indice] = $obj;
					$indice++;
				} 
				unset($obj); 
			}
			$resultado->close(); 
		}
		
		$conn->close();
		
		return $array;
	}

	function ExecuteSQL($consulta)
	{
		$resultado = "500";
		
		$conn = new mysqli("localhost", "root", "14Laurita", "so");

		if ($conn->connect_errno) {
			$resultado =  "Falló la conexión: ".$conn->connect_error."\n";
		}
		else
		{
			if ($conn->query($consulta) === TRUE) {
			  $resultado = "200";
			} else {
			  echo "Error updating record: " . $conn->error;
			}

			$conn->close();
		}
		
		return $resultado;
	}

	function genStr($length=8){
		$str = "";
		$posible = "0123456789abcdefghijklmnopqrstuvwxyz";
		$i=0;
		while($i<$length){
			$ch=substr($posible, mt_rand(0, strlen($posible)-1), 1);
			$str .= $ch;
			$i++;
		}
		return $str;
	}
?>