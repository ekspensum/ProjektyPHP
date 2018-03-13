<?php
session_start();
if (!isset($_SESSION["logidszef"]))
{
	header('location:index.php');
}
elseif (empty($_POST['nrkonta']))
	{
		$_SESSION["pustennk"] = '<b><font color="blue">Należy uzupełnić nr konta bankowego.</font></b>';
		header('location:ustawienia.php');
	}
	else
		{
		$logidszef = $_SESSION["logidszef"];
		require_once 'dbconnect.php';
		$polacz=mysqli_connect($host,$user,$password,$database);
		$nrkonta=trim($_POST['nrkonta']);
		$bank=trim($_POST['bank']);
		mysqli_query($polacz, "insert into kontobank (idkontobank, nrkonta, bank, datarejk, szef_idszef) values (null, '$nrkonta', '$bank', now(), '$logidszef')");
		header('location:ustawienia.php');
		}
?>

