<!Doctype HTML>
<html lang="pl-PL">
<head>
	<meta charset="utf-8"/>
	<title>Faktury</title>
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
echo '<br/>';
echo '<form action="wybierznabywcechbox.php" method="POST" >';
echo '<select name="box2">';
if(	isset($_SESSION["logidszef"]))
	{
		$lista=mysqli_query($polacz, "select idnabywca, krajn, miaston, nazwan, imien, nazwiskon, szef_idszef, pracownik_szef_idszef from nabywca where szef_idszef='$logidszef' or pracownik_szef_idszef='$logidszef' order by krajn, miaston, nazwan, nazwiskon, imien");
		echo '<option  disabled selected>Wybierz nabywcę:</option>';
		while($txt=mysqli_fetch_array($lista)) 
			{
			echo '<option value="'.$txt['idnabywca'].'">'.$txt['krajn'].' '.$txt['miaston'].' '.$txt['nazwan'].' '.$txt['imien'].' '.$txt['nazwiskon'].' '.$txt['idnabywca'].' '.'</option>';
			}
		echo '</select>';
	}
	elseif(isset($_SESSION["logidprac"]))
	{
		$daneszefa=mysqli_query($polacz, "select szef_idszef from pracownik where idpracownik='$logidprac'");
		$daneidszef=mysqli_fetch_assoc($daneszefa);
		$szef_idszef=$daneidszef['szef_idszef'];
		$lista=mysqli_query($polacz, "select idnabywca, krajn, miaston, nazwan, imien, nazwiskon, szef_idszef, pracownik_szef_idszef from nabywca where szef_idszef='$szef_idszef' or pracownik_szef_idszef='$szef_idszef' order by krajn, miaston, nazwan, nazwiskon, imien");
		echo '<option  disabled selected>Wybierz nabywcę:</option>';
		while($txt=mysqli_fetch_array($lista)) 
			{
			echo '<option value="'.$txt['idnabywca'].'">'.$txt['krajn'].' '.$txt['miaston'].' '.$txt['nazwan'].' '.$txt['imien'].' '.$txt['nazwiskon'].' '.$txt['idnabywca'].' '.'</option>';;
			}
		echo '</select>';
	}
echo '<input type="submit" value="OK"/>';
echo '</form>';
?>

<?php
	if(	isset($_SESSION["logidszef"]))
	{
		$danefaktury=mysqli_query($polacz, "select nrfaktury from faktury where szef_idszef = '$logidszef' or pracownik_szef_idszef = '$logidszef' order by nrfaktury desc ");
		$nrfaktury=mysqli_fetch_assoc($danefaktury);
		$nr=$nrfaktury['nrfaktury'];
	}
	elseif(isset($_SESSION["logidprac"]))
	{
		$danefaktury=mysqli_query($polacz, "select nrfaktury from faktury, pracownik where pracownik_idpracownik = '$logidprac' or (idpracownik = '$logidprac' and  faktury.szef_idszef = pracownik.szef_idszef) order by nrfaktury desc ");
		$nrfaktury=mysqli_fetch_assoc($danefaktury);
		$nr=$nrfaktury['nrfaktury'];
	}
	if (isset($_SESSION["nridnabywcy"]))
	{
		$nridn=$_SESSION["nridnabywcy"];
		$lista=mysqli_query($polacz, "select idnabywca, nazwan, nazwiskon, imien from nabywca where idnabywca = '$nridn' group by nazwan, nazwiskon, imien");
		$txt=mysqli_fetch_array($lista);
	}
?>
<form action="nowafakturachbox.php" method="POST" />
<p>Wybrano nabywcę: <input type="text" name="nabywca" readonly="readonly" value="<?php if (isset($_SESSION["nridnabywcy"])) {echo $txt['nazwan'].' '.$txt['imien'].' '.$txt['nazwiskon'];} ?>" /></p>
<p><input type="hidden" name="nridnabywcy" value="<?php if (isset($_SESSION["nridnabywcy"])) {echo $nridn;} ?>" /></p>
<p>Numer kolejny faktury: <input type="text" name="nrfaktury" value="<?php echo ++$nr; ?>" />(tylko liczba)</p>
<p>Data wystawienia: <input type="text" name="datawyst" value="<?php echo date('Y.m.d'); ?>" /></p>
<p>Data sprzedaży: <input type="text" name="datasprzed" value="<?php echo date('Y.m.d'); ?>" /></p>
<p>Nr zamówienia: <input type="text" name="nrzamowienia" value="" /></p>
<?php
if(	isset($_SESSION["logidszef"]))
	{
		$lista=mysqli_query($polacz, "select idtowar, produkt, jm, ilosc, cena, vat, towar_idszef from towar where towar_idszef='$logidszef' group by produkt, cena order by produkt");
		echo '<div style="height: 200px; overflow: scroll;">';
		while($txt=mysqli_fetch_array($lista)) 
			{
			echo '<input type="checkbox" name="box1['.$txt['idtowar'].']" value="'.$txt['idtowar'].'" />'.' Nazwa: <input type="text" name="nazwabox['.$txt['idtowar'].']" value="'.$txt['produkt'].'" size="40" />'.' J.m.: <input type="text" name="jmbox['.$txt['idtowar'].']" value="'.$txt['jm'].'" size="4" />'.' Ilość: <input type="text" name="ilosc['.$txt['idtowar'].']" value="'.$txt['ilosc'].'" size="4"/>'.' Cena: <input type="text" name="cena['.$txt['idtowar'].']" value="'.$txt['cena'].'" size="6" />'.' Vat: <input type="text" name="vat['.$txt['idtowar'].']" value="'.$txt['vat'].'" size="1"/>'.'<br/>';
			}
		echo '</div>';
	}
	elseif(	isset($_SESSION["logidprac"]))
	{
		$daneszefa=mysqli_query($polacz, "select szef_idszef from pracownik where idpracownik='$logidprac'");
		$daneidszef=mysqli_fetch_assoc($daneszefa);
		$szef_idszef=$daneidszef['szef_idszef'];
		$lista=mysqli_query($polacz, "select idtowar, produkt, jm, ilosc, cena, vat, towar_idszef, towar_idpracownik from towar where towar_idszef='$szef_idszef' or towar_idpracownik='$logidprac' group by produkt, cena order by produkt");
		echo '<div style="height: 200px; overflow: scroll;">';
		while($txt=mysqli_fetch_array($lista)) 
			{
			echo '<input type="checkbox" name="box1['.$txt['idtowar'].']" value="'.$txt['produkt'].'" />'.' Nazwa: <input type="text" name="nazwabox['.$txt['idtowar'].']" value="'.$txt['produkt'].'" size="40" />'.' J.m.: <input type="text" name="jmbox['.$txt['idtowar'].']" value="'.$txt['jm'].'" size="4" />'.' Ilość: <input type="text" name="ilosc['.$txt['idtowar'].']" value="'.$txt['ilosc'].'" size="4" />'.' Cena: <input type="text" name="cena['.$txt['idtowar'].']" value="'.$txt['cena'].'" size="6" />'.' Vat: <input type="text" name="vat['.$txt['idtowar'].']" value="'.$txt['vat'].'" size="1" />'.'<br/>';
			}
		echo '</div>';
	}
?>
<p>Sposób zapłaty: <select name="platnosc">
		<p><option value="gotowka">Gotówka</option></p>
		<p><option value="przelew">Przelew</option></p>
		</select></p>
<p>Termin zapłaty (dni): <input type="text" name="termin" value="14" /></p>
<p>Wpłacono zaliczkę: <input type="text" name="zaplacono" value="" /></p>
<?php 
if (isset($_SESSION["pusteid"]))
{
	echo $_SESSION["pusteid"]; 
	unset($_SESSION["pusteid"]);
}
elseif(isset($_SESSION["pustent"]))	
{
	echo $_SESSION["pustent"]; 
	unset($_SESSION["pustent"]);
}
?>
<br/>
<p><input type="submit" value="Wystaw fakturę" /></p>
</form>
<br/>
<form action="wydruki.php" method="POST" >
Drukuj bieżącą fakturę:<select name="ostatniafaktura">
<option disabled selected>Wybierz system:</option>
<option value="1">Unix/Linux - rtf</option>
<option value="2" >Windows - rtf</option>
<option value="3">Unix/Linux - html</option>
<option value="4" >Windows - html</option>
<input type="submit" value="OK" />
</select>
</form>

</body>
</html>