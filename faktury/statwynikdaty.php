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
		
		if(isset($_POST['dataod']) && isset($_POST['datado']))
		{
			$_SESSION['dataod']=$_POST['dataod'];
			$_SESSION['datado']=$_POST['datado'];
		}
			$dataod=$_SESSION['dataod'];
			$datado=$_SESSION['datado'];
			
		$datywyst=mysqli_query($polacz, "select idfaktury from faktury where (szef_idszef = '$idszef' or pracownik_szef_idszef = '$idszef') and datawyst between '$dataod' and '$datado'");
			$ilewierszy=mysqli_num_rows($datywyst);
			
			if($ilewierszy>0)
			{
				$baza=strzalki2($ilewierszy);
				$fakturydaty=mysqli_query($polacz, "select * from faktury, nabywca where (faktury.szef_idszef = '$idszef' or faktury.pracownik_szef_idszef = '$idszef') and nabywca_idnabywca = idnabywca and datawyst between '$dataod' and '$datado' order by nrfaktury, krajn, miaston, nazwan, imien, nazwiskon LIMIT {$baza} , 10 ");
				echo "Od: ".$baza." do: ".($baza+10);
				echo '<table border="1">';
				echo '<br/><td width="20"></td><td width="70">Nr faktury</td><td width="100">Data wyst.</td><td width="100">Kraj</td><td width="100">Miasto</td><td width="150">Nazwa</td><td width="100">Imię</td><td width="100">Nazwisko</td><br/>';
				echo '</table>';
				echo '<form action="'.$_SERVER['PHP_SELF'].'" method="POST" >';
				for($a=0; $a<10; $a++ )
					{
						$faktury_zest=mysqli_fetch_assoc($fakturydaty);
						echo '<table border="1">';
						echo '<td width="20"><input type="checkbox" name="box_faktury['.$faktury_zest['idfaktury'].']" ></td>'.'<td width="70">'.$faktury_zest['nrfaktury'].'</td><td width="100">'.$faktury_zest['datawyst'].'</td><td width="100">'.$faktury_zest['krajn'].'</td><td width="100">'.$faktury_zest['miaston'].'</td><td width="150">'.$faktury_zest['nazwan'].'</td><td width="100">'.$faktury_zest['imien'].'</td><td width="100">'.$faktury_zest['nazwiskon'].'</td><td width="100">'.$faktury_zest['idnabywca'].'</td><br/>';
						echo '</table>';
					}
				echo '<input type="submit" value="Pokaż wybraną fakturę" >';
				echo '</form>';
				if(isset($_POST['box_faktury']))
				{
					$_SESSION['nridfaktury']=key($_POST['box_faktury']);
					$nridfaktury=$_SESSION['nridfaktury'];
					echo '<br/>';
					$danefaktury=mysqli_query($polacz, "select * from faktury, nabywca, firma, towar where faktury.idfaktury = '$nridfaktury' and (faktury.szef_idszef = '$idszef' or faktury.pracownik_szef_idszef = '$idszef') and  (nabywca.idnabywca = nabywca_idnabywca) and towar.faktury_idfaktury = '$nridfaktury' and firma.szef_idszef = '$idszef' group by idtowar");
						
					danehtmlfaktury($polacz, $danefaktury, $nridfaktury);
					opcjewydruku();
					echo '<br/><br/><a href="statystyka.php">Powrót</a>';
				}
			}
			else
				{
				echo '<br/><b><font color="blue">Nie odnaleziono faktur dla wybranego zakresu dat</font></b>';	
				echo '<br/><br/><a href="statystyka.php">Powrót</a>';
				}
	}
	
?>

</body>
</html>