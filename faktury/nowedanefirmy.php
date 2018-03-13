<?php
session_start();
if (!isset($_SESSION["logidszef"]))
	{
		header('location:index.php');
	}
	elseif (empty($_POST['nazwa']) || empty($_POST['regon']) || empty($_POST['nip']) || empty($_POST['kraj']) || empty($_POST['kod']) || empty($_POST['miasto']) || empty($_POST['ulica']) || empty($_POST['ulicanr']))
		{
			$_SESSION["pustendf"] = '<b><font color="blue">Należy uzupełnić wszstkie powyższe pola za wyjątkiem nr lokalu jeżeli nie występuje.</font></b>';
			header('location:ustawienia.php');
		}
		else
			{
			$logidszef = $_SESSION["logidszef"];
			require_once 'dbconnect.php';
			$nazwa=trim($_POST['nazwa']);
			$regon=trim($_POST['regon']);
			$nip=trim($_POST['nip']);
			$kraj=trim($_POST['kraj']);
			$kod=trim($_POST['kod']);
			$miasto=trim($_POST['miasto']);
			$ulica=trim($_POST['ulica']);
			$ulicanr=trim($_POST['ulicanr']);
			$lokalnr=trim($_POST['lokalnr']);
			mysqli_query($polacz, "insert into firma values (null, '$nazwa', '$regon', '$nip', '$logidszef', '$kraj', '$kod', '$miasto', '$ulica', '$ulicanr', '$lokalnr', now())");
			header('location:ustawienia.php');
			}
?>

