<?php
session_start();
if (!isset($_SESSION["logidszef"]))
	{
		header('location:index.php');
	}
	elseif (empty($_POST['login']) || empty($_POST['haslo']) || empty($_POST['imie']) || empty($_POST['nazwisko']) || empty($_POST['email']))
		{
			$_SESSION["pustenp"] = '<b><font color="blue">Należy uzupełnić wszstkie powyższe pola dotyczące pracownika.</font></b>';
			header('location:ustawienia.php');
		}
		else
			{
				$logidszef = $_SESSION["logidszef"];
				require_once 'dbconnect.php';
				$polacz=mysqli_connect($host,$user,$password,$database);
				$login=trim($_POST['login']);
				$haslo=trim($_POST['haslo']);
				$imie=trim($_POST['imie']);
				$nazwisko=trim($_POST['nazwisko']);
				$email=trim($_POST['email']);
				mysqli_query($polacz, "insert into pracownik (idpracownik, loginp, haslop, imiep, nazwiskop, emailp, datarejp, szef_idszef) values (null, '$login', '$haslo', '$imie', '$nazwisko', '$email', now(), '$logidszef')");
				header('location:ustawienia.php');
			}
?>

