<?php
session_start();
require_once 'dbconnect.php';
if($_POST['jako']=="szef")
{
	$logowanie=mysqli_query($polacz, "select idszef, login, haslo, akt from szef ") or die("Brak połączenia z bazą danych.");

	if ((empty($_POST['login']) && empty($_POST['haslo'])) || (empty($_POST['login']) && !empty($_POST['haslo'])) || (!empty($_POST['login']) && empty($_POST['haslo'])))
	{
		$_SESSION["puste"] = '<b><font color="blue">Uzupełnij pola login lub hasło</font></b>';
		mysqli_close($polacz);
		header('location:index.php');	
	}
	else	
	{
		$login=trim($_POST['login']);
		$haslo=trim($_POST['haslo']);
		$login=htmlentities($login,ENT_QUOTES,"UTF-8");
		while ($danelogowania=mysqli_fetch_assoc($logowanie))
		{
			if ((($danelogowania['login']===$login) && (password_verify($haslo, $danelogowania['haslo'])) && ($danelogowania['akt']==1)))
				{
					$_SESSION["logidszef"]=$danelogowania['idszef'];
					header('location:faktury.php');
					break;
				}
			elseif (!(($danelogowania['login']===$login) && (password_verify($haslo, $danelogowania['haslo'])) && ($danelogowania['akt']==1)))
				{
					$_SESSION["blad"] = '<b><font color="blue">Nieprawidłowy login lub haslo bądź konto nie zostało aktywowane.</font></b>';
					mysqli_close($polacz);
					header('location:index.php');
				}
		}
	}
}
elseif($_POST['jako']=="pracownik")
{
	$logowanie=mysqli_query($polacz, "select idpracownik, loginp, haslop from pracownik");

	if ((empty($_POST['login']) && empty($_POST['haslo'])) || (empty($_POST['login']) && !empty($_POST['haslo'])) || (!empty($_POST['login']) && empty($_POST['haslo'])))
	{
		$_SESSION["puste"] = '<b><font color="blue">Uzupełnij pola login lub hasło</font></b>';
		mysqli_close($polacz);
		header('location:index.php');	
	}
	else	
	{
		$login=trim($_POST['login']);
		$haslo=trim($_POST['haslo']);
		$login=htmlentities($login,ENT_QUOTES,"UTF-8");
		while ($danelogowania=mysqli_fetch_assoc($logowanie))
		{
			if ((($danelogowania['loginp']===$login) && (password_verify($haslo, $danelogowania['haslop']))))
				{
					$_SESSION["logidprac"]=$danelogowania['idpracownik'];
					header('location:faktury.php');
					break;
				}
			if (!(($danelogowania['loginp']===$login) && (password_verify($haslo, $danelogowania['haslop']))))
				{
					$_SESSION["blad"] = '<b><font color="blue">Nieprawidłowy login lub haslo</font></b>';
					mysqli_close($polacz);
					header('location:index.php');
				}
		}
	}
}
?>
