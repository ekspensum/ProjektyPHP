<?php
session_start();
require_once 'dbconnect.php';
//unset($_SESSION["nridnabywcy"]);	
$_SESSION["nridnabywcy"]=$_POST['box2'];
header('location:faktury.php');	
?>