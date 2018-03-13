<!Doctype HTML>
<html lang="pl-PL">
<head>
	<meta charset="utf-8"/>
	<title>Aktywacja użytkownika</title>
	</head>
<body>
<body bgcolor="gray">
<p><b>Rejestracja użytkownika jako szefa firmy - aktywacja konta:</b></p>
<p/>
<p/>
<?php
if((isset($_GET['kod'])) && (!empty($_GET['kod'])))
{
	require_once 'dbconnect.php';
	$kod=$_GET['kod'];
	$dane=mysqli_query($polacz, "select idszef, szyfr, akt from szef");
	
	while($daneass=mysqli_fetch_assoc($dane))
	{
		if(password_verify($kod, $daneass['szyfr']))
		{
			$idszef=$daneass['idszef'];
			$akt=$daneass['akt'];
			break;
		}
	}
		
	if(($akt==0) && ($idszef>0))
	{
		mysqli_query($polacz, "update szef set akt = 1 where idszef='$idszef'");
		if(mysqli_affected_rows($polacz)>0)
		{
			echo '<b><font color="blue">Twoje konto zostało pomyślnie aktywowane. Przejdź do strony logowania.</font></b>';
		}
		else
			{
				echo '<b><font color="blue">Aktywacja konta nie powiodła się.</font></b>';
			}
	}
	elseif($akt==1)
	{
		echo '<b><font color="blue">Twoje konto jest już aktywne. Nie ma potrzeby ponownej aktywacji. Przejdź do strony logowania.</font></b>';
	}
}
else
{
	header('location:index.php');
}
?>
<br/>
<br/>
<a href="index.php">Powrót do strony logowania</a>
</body>
</html>
