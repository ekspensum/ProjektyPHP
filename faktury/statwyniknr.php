<!Doctype HTML>
<html lang="pl-PL">
<head>
	<meta charset="utf-8"/>
	<title>Statystyka</title>
</head>

<body>
<body bgcolor="gray">
<form action="logout.php" method="POST" />
<p><input type="submit" value="Wyloguj" /></p>
</form>
<a href="faktury.php">Fakturowanie - nowe towary/usługi</a><br/>
<a href="fakturychbox.php">Fakturowanie - istniejące towary/usługi</a><br/>
<a href="ustawienia.php">Ustawienia serwisu</a><br/>
<a href="statystyka.php">Statystyka</a><br/>
<br/>
<?php
include_once 'danefirmy.php';
include_once 'funkcje.php';
if(isset($_SESSION["logidszef"]) || isset($_SESSION["logidprac"]))
	{
		if(isset($_SESSION["logidszef"]))
		{
			$idszef=$_SESSION["logidszef"];
		}
		elseif(isset($_SESSION["logidprac"]))
		{
			$logidprac = $_SESSION["logidprac"];
			$pracownik=mysqli_query($polacz, "select * from pracownik where idpracownik= '$logidprac'");
			$pracowtab=mysqli_fetch_assoc($pracownik);
			$idszef=$pracowtab['szef_idszef'];
		}
		
		if(!empty($_POST['nr']) && is_numeric($_POST['nr']))
		{
			unset($_SESSION['pustynr']);
			$nr=$_POST['nr'];
			$wynikid=mysqli_query($polacz, "select idfaktury from faktury where (szef_idszef = '$idszef' or pracownik_szef_idszef = '$idszef') and nrfaktury = '$nr'");
			if(mysqli_num_rows($wynikid)>0)
			{
				$daneid=mysqli_fetch_assoc($wynikid);
				$nridfaktury=$daneid['idfaktury'];
				$danefaktury=mysqli_query($polacz, "select * from faktury, nabywca, firma, towar where faktury.idfaktury = '$nridfaktury' and (faktury.szef_idszef = '$idszef' or faktury.pracownik_szef_idszef = '$idszef') and  (nabywca.idnabywca = nabywca_idnabywca) and towar.faktury_idfaktury = '$nridfaktury' and firma.szef_idszef = '$idszef' group by idtowar");
				echo '<br/>';
				$_SESSION['nridfaktury']=$nridfaktury;
				danehtmlfaktury($polacz, $danefaktury, $nridfaktury);
				opcjewydruku();
				echo '<br/><br/><a href="statystyka.php">Powrót</a>';
			}
			else
			{
				echo '<br/><b><font color="blue">Nie odnaleziono faktury</font></b>';
				echo '<br/><br/><a href="statystyka.php">Powrót</a>';
			}
		}
		else
		{
			$_SESSION['pustynr']='<b><font color="blue">Brak numeru faktury lub numer faktury jest nieporawny.</font></b>';
			header('location: statystyka.php');
		}
	}
		
?>

</body>
</html>