<?php
$files = glob("./uploaded_files/*");

foreach($files as $file){
	$f = basename($file);
	$parts = explode("-",$f);
	if(count($parts) <= 2 ){
		continue;
	}
	if(md5($f) == $_GET["f"]){
		unlink($file);
		header("Location: ./home.php");
		break;
	}
	$file_type = $parts[0];

}
