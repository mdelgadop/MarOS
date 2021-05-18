<?php

	include("entities/folder.php");

	include("entities/fileContent.php");

	include("value_objects/desktop.php");

	include("value_objects/path.php");

	include("value_objects/response.php");

	$op=$_POST['op'];
	
	if($op=="GetFolders")
	{
		$folder_to_check=$_POST['folder'];
		
		$folder_father = (($folder_to_check == "" or $folder_to_check == "fld") ? " is null" : "=".substr($folder_to_check, 3));
		
		include("GetFoldersService/index.php");
		
		echo json_encode($mydesktop);
	}
	else if($op=="GetFileContent")
	{
		$idContent=$_POST['c'];
		$idContent=substr($idContent, 2);
		
		include("GetFileContentService/index.php");

		echo json_encode($obj);
	}
	else if($op=="SaveFileContent")
	{
		$folder=$_POST['d'];
		$idContent=$_POST['c'];
		$nameContent=$_POST['n'];
		$content=$_POST['con'];

		include("SaveFileContentService/index.php");
		
		echo json_encode($obj);

	}
	else if($op=="SaveCoords")
	{
		$saveCoordsI = $_POST['i'];
		$saveCoordsL = $_POST['l'];
		$saveCoordsT = $_POST['t'];
		
		include("SaveCoordsService/index.php");
		
		echo json_encode($obj);
	}
	else if($op=="DelFL")
	{
		$DelFLI = $_POST['i'];
		
		include("DelFLService/index.php");
		
		echo json_encode($obj);
	}
	else if($op=="CreateFolder")
	{
		$CreateFolderFolder = $_POST['d']; 
		$CreateFolderN = $_POST['n'];
		
		include("CreateFolderService/index.php");
		
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
		$conn = new mysqli("localhost", "root", "", "so");

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
		
		$conn = new mysqli("localhost", "root", "", "so");

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