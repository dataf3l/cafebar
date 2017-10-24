<?php

require_once 'dbconfig.php';

if($user->is_loggedin()!="")
{
    $user->redirect('home.php');
}
$error = array(); // []
if(isset($_POST['btn-signup']))
{
   $uname = trim($_POST['txt_uname']);
   $upass = trim($_POST['txt_upass']); 
 
   if($uname=="") {
      $error[] = "provide username !"; 
   } 
   if($upass=="") {
      $error[] = "provide password !";
   } 
   if(strlen($upass) < 6) {
      $error[] = "Password must be atleast 6 characters"; 
   }
   if(count($error) == 0) {
	   //no db errors, we proceed
      try
      {
         $stmt = $DB_con->prepare("SELECT uname as user_name FROM users WHERE uname=:uname ");
         $stmt->execute(array(':uname'=>$uname));
         $row=$stmt->fetch(PDO::FETCH_ASSOC);
         if($stmt->rowCount() > 0) {
            $error[] = "sorry username already taken !";
         } else {
            if($user->register($uname,$upass)) 
            {
                $user->redirect('joined.php');
            }
         }
     }
     catch(PDOException $e)
     {
        echo $e->getMessage();
     }
   }else{
	   
	   echo(implode("<br>",$error));

       // there were no records on the db matching the user.
   }
}


//verificacion conexion
/*
CREATE TABLE `persona` (
  id int(10) not null auto_increment,
 `nombre` varchar(100) NOT NULL,
 `cedula` int(11) NOT NULL,
 primary key(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 

*/
/*  $db = new PDO('mysql:host=localhost;dbname=registro;', 'root', '');
  
  function sanitize($input){
	  return str_replace(array("'","\"","<",">",";","&","`"),"",$input);  
  }
  if(!isset($_POST['usuario'])){
	 die("faltan variables");  
  }
  //variabes
  $usuario = sanitize($_POST['usuario']);
  $cedula = sanitize($_POST['cedula']);
  //sentencia sql
  $sql="INSERT INTO persona (nombre,cedula) VALUES('$usuario', '$cedula')";

//ejecutar sql
try {
    //Connect as appropriate as above
    $affected = $db->exec($sql); 
} 
catch (PDOException $ex) {
    echo "An Error occured!"; //User friendly message/message you want to show to user
    echo($ex->getMessage());
}

//verificar ejecucion
if($affected==0){
	echo 'inmposible crear el registro.';
}else{
	echo"datos guardados correctamente<br>
	<a href=./index.html>volver</a>";
}
*/
