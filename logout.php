<?php
require_once("./dbconfig.php");
$a = new USER();
$a->logout();
$a->redirect("./login.php");
