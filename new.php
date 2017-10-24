<?php

if(!isset($_FILES["thefile"])){
	echo("Error, archivo no adjuntado");
	die();
}
if($_FILES["thefile"]["error"]!=0){
	echo("Error, archivo no terminado");
	die();
}
$fname = $_FILES["thefile"]["name"];
$parts = explode(".",$fname);
$ext = $parts[count($parts)-1];
if(strtoupper($ext) == "PHP"){
	die("Invalid file");
}
$f = $_POST["type"]."-".$_POST["person"]."-".$_POST["name"];

move_uploaded_file($_FILES["thefile"]["tmp_name"], "./uploaded_files/$f.$ext");
header("Location: ./home.php");
