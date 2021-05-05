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
 
 class desktop {
  public $folders;
  public $paths;
 }

	$op=$_POST['op'];
	
	if($op=="GetFolders")
	{

		if($_POST['folder'] == "" or $_POST['folder'] == "fld")
		{
			$obj1 = new folder;
			$obj1->id = "fld0";
			$obj1->name = "Home";
			$obj1->width = "96";
			$obj1->left = "50";
			$obj1->top = "100";
			$obj1->icon = "folder_home";

			$obj[0] = $obj1;
			
			$path1 = new path;
			$path1->name = "Desktop";
			$paths[0] = $path1;
		}
		else if($_POST['folder'] == "fld0")
		{
			$obj1 = new folder;
			$obj1->id = "fld";
			$obj1->name = "..";
			$obj1->width = "96";
			$obj1->left = "50";
			$obj1->top = "100";
			$obj1->icon = "folder";

			$obj[0] = $obj1;

			$obj1 = new folder;
			$obj1->id = "fld1";
			$obj1->name = "My Files";
			$obj1->width = "96";
			$obj1->left = "50";
			$obj1->top = "200";
			$obj1->icon = "folder_files";

			$obj[1] = $obj1;

			$obj1 = new folder;
			$obj1->id = "fld2";
			$obj1->name = "My Music";
			$obj1->width = "96";
			$obj1->left = "150";
			$obj1->top = "100";
			$obj1->icon = "folder_music";

			$obj[2] = $obj1;
						
			$obj1 = new folder;
			$obj1->id = "fld3";
			$obj1->name = "My Images";
			$obj1->width = "96";
			$obj1->left = "150";
			$obj1->top = "200";
			$obj1->icon = "folder_images";

			$obj[3] = $obj1;
			
			$obj1 = new folder;
			$obj1->id = "fld4";
			$obj1->name = "My Videos";
			$obj1->width = "96";
			$obj1->left = "250";
			$obj1->top = "100";
			$obj1->icon = "folder_videos";

			$obj[4] = $obj1;

			$path1 = new path;
			$path1->name = "Desktop";
			$paths[0] = $path1;
			$path1 = new path;
			$path1->name = "Home";
			$paths[1] = $path1;
		}
		else 
		{
			$obj1 = new folder;
			$obj1->id = "fld0";
			$obj1->name = "..";
			$obj1->width = "96";
			$obj1->left = "50";
			$obj1->top = "100";
			$obj1->icon = "folder";

			$obj[0] = $obj1;

			$path1 = new path;
			$path1->name = "Desktop";
			$paths[0] = $path1;
			$path1 = new path;
			$path1->name = "Home";
			$paths[1] = $path1;
			$path1 = new path;
			$path1->name = "Current folder: ".$_POST['folder'];
			$paths[2] = $path1;		
		}


		$mydesktop = new desktop;
		$mydesktop->folders = $obj;
		$mydesktop->paths = $paths;

		echo json_encode($mydesktop);
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
		
		$mysqli = new mysqli("localhost", "root", "14Laurita", "so");

		if ($mysqli->connect_errno) {
			printf("Falló la conexión: %s\n", $mysqli->connect_error);
			exit();
		}

		if ($mysqli->query($consulta) === TRUE) {
			$resultado = "200";
		}

		$mysqli->close();
		
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