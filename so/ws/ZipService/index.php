<?php
	$obj1 = new response;
	$obj1->id = $IdZip;
	
	$zip = new ZipArchive();
	$zipfilename = "ZIP ".time().".zip";
	$filename = "./".$zipfilename;

	if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) 
	{
		$obj1->id = "";
		$obj1->message = "No se puede crear el Zip";
		$obj[0] = $obj1;
	}
	else if($obj1->id == "")
	{
		$obj1->message = "";
		$obj[0] = $obj1;
	}
	else if(substr($obj1->id, 0, 3)=="fld")
	{
		$idFolderToDelete = substr($obj1->id, 3);

		$query = "select concat('fld', case when fld_father is null then '' else fld_father end) as father, fld_name from folders where fld_id=".$idFolderToDelete.";";
		$array = SQLToArray($query);
		
		$folderFather = $array[0]["father"];
		$folderName = $array[0]["fld_name"];
		
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
		
		$query = "select fl_id, fl_name, concat(fld_path, '#', fld_name) as path from files left outer join folders on folders.fld_id=files.fl_folder_id where fl_folder_id in (".$idFatherToDelete.");";
		$array = SQLToArray($query);
		
		$i = 0;
		$obj1->message = "";
		$tieneContenido = false;
		
		while($i<count($array))
		{
			if($array[$i]["fl_id"] != '')
			{
				$pathsfiles = $obj1->message.str_replace("#", "/", $array[$i]["path"])."/".$array[$i]["fl_name"].".html";
				$query2 = "select fl_content from file_contents where fl_id in (".$array[$i]["fl_id"].");";

				$contentsarray = SQLToArray($query2);
				$contentsfiles = $contentsarray[0]["fl_content"];

				$zip->addFromString($pathsfiles, $contentsfiles);
				
				$tieneContenido = true;
			}
			$i++;
		}
		
		$zip->close();
		
		if(!$tieneContenido)
		{
			$obj1->message = "El directorio no tiene contenido";
			$obj[0] = $obj1;
		}
		else
		{
			$folder=$folderFather;
			$idContent="";
			$nameContent=$folderName." ".$zipfilename;
			
			$myfile = fopen($filename, "r") or die("Unable to open file!");
			$content=fread($myfile,filesize($filename));
			fclose($myfile);

			unlink($filename);
			
			include("./SaveFileContentService/index.php");
		}
	}
	else if(substr($obj1->id, 0, 2)=="fl")
	{
		$obj1->id = substr($obj1->id, 2);
		$query2 = "select fl_name, fl_content, fl_folder_id from files left outer join file_contents on files.fl_id = file_contents.fl_id where files.fl_id in (".$obj1->id.");";
		
		$contentsarray = SQLToArray($query2);
		$folderName = $contentsarray[0]["fl_name"];
		$contentsfiles = $contentsarray[0]["fl_content"];
		$folderFather = "fld".$contentsarray[0]["fl_folder_id"];
		
		$zip->addFromString($folderName, $contentsfiles);
		
		$zip->close();
		
		$folder=$folderFather;
		$idContent="";
		$nameContent=$folderName." ZIP ".time().".zip";;

		$myfile = fopen($filename, "r");
		$content="".fread($myfile,filesize($filename));
		fclose($myfile);

		unlink($filename);
		
		include("./SaveFileContentService/index.php");
	}
	else
	{
		$obj1->message = "";
		$obj[0] = $obj1;
	}
	
?>