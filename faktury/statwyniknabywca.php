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
		
		if(isset($_POST['box_dost']))
		{
			$_SESSION["idnab"]=key($_POST['box_dost']);
		}
			$idnab=$_SESSION["idnab"];
			$zestfakt=mysqli_query($polacz, "select * from faktury, nabywca where (faktury.szef_idszef = '$idszef' or faktury.pracownik_szef_idszef = '$idszef') and  (nabywca.idnabywca = '$idnab' and nabywca_idnabywca = '$idnab') order by nrfaktury desc");
			$ilefaktur=mysqli_num_rows($zestfakt);
			echo'<br/><b>Zestawienie faktur dla wybranego nabywcy: </b><br/><br/>';
		
			if($ilefaktur>0)
			{
				echo '<form action="'.$_SERVER['PHP_SELF'].'" method="POST" >';
				while($faktury=mysqli_fetch_assoc($zestfakt))
				{
					echo '<input type="checkbox" name="box_faktury['.$faktury['idfaktury'].']" value="" >'.$faktury['idfaktury'].'	Nr faktury: '.$faktury['nrfaktury'].'	'.$faktury['nazwan'].'	'.$faktury['imien'].'	'.$faktury['nazwiskon'].'<br/>';
				}
				echo '<br/>';
				echo '<input type="submit" value="Pokaż fakturę" >';
				echo '</form>';
				if(isset($_POST['box_faktury']))
				{
					$_SESSION['nridfaktury']=key($_POST['box_faktury']);
					$nridfaktury=$_SESSION['nridfaktury'];
					echo '<br/>';
					$danefaktury=mysqli_query($polacz, "select * from faktury, nabywca, firma, towar where faktury.idfaktury = '$nridfaktury' and (faktury.szef_idszef = '$idszef' or faktury.pracownik_szef_idszef = '$idszef') and  (nabywca.idnabywca = '$idnab' and nabywca_idnabywca = '$idnab') and towar.faktury_idfaktury = '$nridfaktury' and firma.szef_idszef = '$idszef' group by idtowar");
						
					danehtmlfaktury($polacz, $danefaktury, $nridfaktury);
					opcjewydruku();
					echo '<br/><br/><a href="statystyka.php">Powrót</a>';
				}
			}
			else
				{
				echo '<br/><b><font color="blue">Nie odnaleziono faktur dla wybranego nabywcy</font></b>';	
				echo '<br/><br/><a href="statystyka.php">Powrót</a>';
				}
	}
		
?>

</body>
</html>