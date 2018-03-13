<!Doctype HTML>
<html lang="pl-PL">
<head>
	<meta charset="utf-8"/>
	<title>Wyszukaj towar / usługę</title>
</head>

<body>
<?php
include 'danefirmy.php';
?>
<body bgcolor="gray">
<form action="logout.php" method="POST" />
<p><input type="submit" value="Wyloguj" /></p>
</form>
<br/>
<br/>
<p>Zarejestrowani nabywcy:</p>
<form action="dopliku.php" method="POST">
<?php
if(	isset($_SESSION["logidszef"]))
	{
		$lista=mysqli_query($polacz, "select idnabywca, nazwan, imien, nazwiskon, szef_idszef, pracownik_szef_idszef from nabywca where szef_idszef='$logidszef' or pracownik_szef_idszef='$logidszef' group by nazwan, imien, nazwiskon order by nazwan, nazwiskon, imien desc");

		while($txt=mysqli_fetch_array($lista)) 
			{
			echo '<input type="checkbox" name="box1['.$txt['idnabywca'].']" value"" >'.$txt['idnabywca'].' '.$txt['nazwan'].' '.$txt['imien'].' '.$txt['nazwiskon'].'<br/>';
			}
	}
	elseif(	isset($_SESSION["logidprac"]))
	{
		$daneszefa=mysqli_query($polacz, "select szef_idszef from pracownik where idpracownik='$logidprac'");
		$daneidszef=mysqli_fetch_assoc($daneszefa);
		$szef_idszef=$daneidszef['szef_idszef'];
		$lista=mysqli_query($polacz, "select idnabywca, nazwan, imien, nazwiskon, szef_idszef, pracownik_szef_idszef from nabywca where szef_idszef='$szef_idszef' or pracownik_szef_idszef='$szef_idszef' group by nazwan, imien, nazwiskon order by nazwan, nazwiskon, imien desc");
		while($txt=mysqli_fetch_array($lista)) 
			{
			echo '<input type="checkbox" name="box1['.$txt['idnabywca'].']" value"" >'.$txt['idnabywca'].' '.$txt['nazwan'].' '.$txt['imien'].' '.$txt['nazwiskon'].'<br/>';
			}
	}
?>
<input type="submit" value="Wybierz towar"/>
</form>
<br/>
<br/>

Odczytanie towaru z pliku:
<form action="odczytpliku.php" method="POST" >

<input type="submit" value="Odczyt pliku" >
</form>
<br/>
<br/>
<br/>
<a href="faktury.php">Powrót do faktury</a>
<br/>
<br/>
<br/>
<br/>
<br/>
</body>
</html>