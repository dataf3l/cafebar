<?php
require_once 'dbconfig.php';

if(!$user->is_loggedin())
{
	header("Location: ./login.php");
	die();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login : cleartuts</title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css"  />
<style>
td {
	white-space:nowrap;
}
.t1 tbody tr td , .t1 tbody tr th{
	font-family:helvetica;
	font-size:12pt;

}
</style>
</head>
<body>
	    <h2>&Uacute;ltimos Archivos.</h2>

		<table border=1 cellspacing=0 cellpadding=4 class=t1>
		<tr>
			<th>
				Tipo
			</th>
			<th>
				Persona
			</th>
			<th>
				Nombre
			</th>
			<th>
				Fecha
			</th>
			<th>
				Tamaño
			</th>
			<th>
				Acciones
			</th>
		</tr>
<?php

$files = glob("./uploaded_files/*");
usort($files, create_function('$a,$b', 'return filemtime($b) - filemtime($a);'));

foreach($files as $file){
	$f = basename($file);
	$parts = explode("-",$f);
	if(count($parts) <= 2 ){
		continue;
	}
	$file_type = $parts[0];
	$file_person = $parts[1];
	unset($parts[0]);
	unset($parts[1]);
	$file_name = implode($parts);
	$file_size = round(filesize($file) / (1024*1024),1) . " MB";
	$mdate = date("Y-m-d H:i:s",filemtime($file));
	$actions = "<a target=_blank href='$file'>Descargar</a>";
	$actions .= " <a href='#' onclick='javascript:if(confirm(\"Seguro?\")){location.href=\"unlink.php?f=".md5(basename($f))."\";}'>[x]</a>";
	echo("		<tr>
				<td>
					$file_type
				</td>
				<td>
					$file_person
				</td>
				<td>
					<a target=_blank href='$file'>$file_name</a>
					
				</td>
				<td>
					$mdate
				</td>
				<td>
					$file_size
				</td>
				<td>
					$actions
				</td>
			</tr>
	");
}



?>
</table>
<h2>Subir Archivo</h2>
<form method=POST action='new.php' enctype="multipart/form-data" >
	<label>Tipo:<br/>
		<input type=text name=type />
	</label>
	<br/>
	<label>Persona:<br/>
		<input type=text name=person />
	</label>
	<br/>
	<label>Nombre:<br/>
		<input type=text name=name />
	</label>
	<br/>
	<br/>
	<label>Archivo:<br/>

		<input type=file name=thefile />
	</label>
	<input type=submit value='Subir Archivo' />
</form>

<hr/>
<a href='./logout.php' >Logout</a>
</body>
</html>
