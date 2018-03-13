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
		
		echo '<br/><b>Wyszukaj faktury wg NABYWCY:</b><br/>';
		$nabywcy=mysqli_query($polacz, "select * from nabywca where szef_idszef = '$idszef' or pracownik_szef_idszef = '$idszef'");
		$ilewierszy=mysqli_num_rows($nabywcy);
		$baza=strzalki($ilewierszy);
		$nabywca=mysqli_query($polacz, "select * from nabywca where szef_idszef = '$idszef' or pracownik_szef_idszef = '$idszef' order by krajn, miaston, nazwan, imien, nazwiskon LIMIT {$baza} , 10 ");
		echo "Od: ".$baza." do: ".($baza+10);
			
		echo '<form action="statwyniknabywca.php" method="POST" >';
		for($a=0; $a<10; $a++ )
			{
				$nab_zest=mysqli_fetch_assoc($nabywca);
				echo '<input type="checkbox" name="box_dost['.$nab_zest['idnabywca'].']" >'.$nab_zest['krajn'].'	'.$nab_zest['miaston'].'	'.$nab_zest['nazwan'].'	'.$nab_zest['imien'].'	'.$nab_zest['nazwiskon'].'	'.$nab_zest['idnabywca'].'<br/>';
			}
		echo '<input type="submit" value="Pokaż faktury dla wybranego nabywcy" >';
		echo '</form>';
		
		echo '<br/><b>Wyszukaj faktury wg DATY wystawienia:</b><br/>';
		echo '<form action="statwynikdaty.php" method="POST">';
		echo 'Data od:<input type="text" name="dataod" value="2017-01-01" size="7" />';
		echo 'Data do:<input type="text" name="datado" value="'.date('Y-m-d').'" size="7" />';
		echo '<input type="submit" value="OK"/>';
		echo '</form>';
		
		echo '<br/><b>Wyszukaj faktury wg NUMERU faktury:</b><br/>';
		echo '<form action="statwyniknr.php" method="POST">';
		echo 'Podaj nr faktury:<input type="text" name="nr" size="5" />';
		echo '<input type="submit" value="OK"/>';
		echo '</form>';
		if(isset($_SESSION['pustynr']))
		{
			echo $_SESSION['pustynr'];
		}
	}
	
?>

</body>
</html>