<?php
require_once 'dbconnect.php';

function slownie($ile)
{
	$ile=(int)$ile;
	function do1000($ile)
	{
		$jednosci=array('', 'jeden', 'dwa', 'trzy', 'cztery', 'pięć', 'sześć', 'siedem', 'osiem', 'dziewięć');
		$nastki=array(10=>'dziesięć', 11=>'jedenaście', 12=>'dwanaście', 13=>'trzynaście', 14=>'czternaście', 15=>'piętnaście', 16=>'szesnaście', 17=>'siedemnaście', 18=>'osiemnaście', 19=>'dziewiętnaście');
		$dziesiatki=array('', '', 'dwadzieścia', 'trzydzieści', 'czterdzieści', 'pięćdziesiąt', 'sześćdziesiąt', 'siedemdziesiąt', 'osiemdziesiąt', 'dziewięćdziesiąt');
		$setki=array('', 'sto', 'dwieście', 'trzysta', 'czterysta', 'pięćset', 'sześćset', 'siedemset', 'osiemset', 'dziewięćset');
		$x=substr($ile, -3);	
		if($x<10)
		{
			$kwota=$jednosci[(int)substr($x, -3, 3)];
		}
		elseif($x>9 && $x<20)
		{
			$kwota=$nastki[(int)$x];
		}
		elseif($x>19 && $x<100)
		{
			$kwota=$dziesiatki[substr($x, -2, 1)].' '.$jednosci[substr($x, -1, 1)];
		}
		elseif($x>99 && $x<1000)
		{
			if(substr($x, -2, 2)<10)
			{
				$kwota=$setki[substr($x, -3, 1)].' '.$jednosci[substr($x, -1, 1)];
			}
			elseif(substr($x, -2, 2)>9 && substr($x, -2, 2)<20)
			{
				$kwota=$setki[substr($x, -3, 1)].' '.$nastki[substr($x, -2, 2)];
			}
			elseif(substr($x, -2, 2)>19 && substr($x, -2, 2)<100)
			{
				$kwota=$setki[substr($x, -3, 1)].' '.$dziesiatki[substr($x, -2, 1)].' '.$jednosci[substr($x, -1, 1)];
			}
		}
		return $kwota;
	}

	function odtysdomil($ile)
	{
		$tysiace=array('tysięcy', 'tysiąc', 'tysiące', 'tysiące', 'tysiące', 'tysięcy', 'tysięcy', 'tysięcy', 'tysięcy', 'tysięcy');
		$tysiace2=array('tysięcy', 'tysięcy', 'tysiące', 'tysiące', 'tysiące', 'tysięcy', 'tysięcy', 'tysięcy', 'tysięcy', 'tysięcy');
		$y=substr($ile, -6, -3);
		$ile=$y;
		if($y>0 && $y<10)
		{
			$kwota=do1000($ile)." ".$tysiace[(int)$y]." ";
		}
		elseif($y>9 && $y<20)
		{
			$kwota=do1000($ile)." tysięcy ";
		}
		elseif($y>19 && $y<110)
		{
			if((int)$y==101)
			{
				$kwota=do1000($ile)." tysięcy ";
			}
			else
			{
				$kwota=do1000($ile)." ".$tysiace[substr($y, -1, 1)]." ";	
			}
		}
		elseif($y>109 && $y<120)
		{
			$kwota=do1000($ile)." tysięcy ";
		}
		elseif($y>119 && $y<1000)
		{
			$kwota=do1000($ile)." ".$tysiace2[substr($y, -1, 1)]." ";
		}
		return $kwota;
	}

	function odmildomiliard($ile)
	{
		$miliony=array('milionów', 'milion', 'miliony', 'miliony', 'miliony', 'milionów', 'milionów', 'milionów', 'milionów', 'milionów');
		$miliony2=array('milionów', 'milionów', 'miliony', 'miliony', 'miliony', 'milionów', 'milionów', 'milionów', 'milionów', 'milionów');
		$z=substr($ile, -9, -6);
		$ile=$z;
		if($z>0 && $z<10)
		{
			$kwota=do1000($ile)." $miliony[$z] ";
		}
		elseif($z>9 && $z<20)
		{
			$kwota=do1000($ile)." milionów ";
		}
		elseif($z>19 && $z<110)
		{
			if((int)$z==101)
			{
				$kwota=do1000($ile)." milionów ";
			}
			else
			{
				$kwota=do1000($ile)." ".$miliony2[substr($z, -1, 1)]." ";	
			}
		}
		elseif($z>109 && $z<120)
		{
			$kwota=do1000($ile)." milionów ";
		}
		elseif($z>119 && $z<1000)
		{
			$kwota=do1000($ile)." ".$miliony2[substr($z, -1, 1)]." ";
		}
		return $kwota;
	}

	switch($ile)
	{
	case $ile<1000: $kwota=do1000($ile)." zł.";  break;
	case $ile>999 && $ile<1000000: $kwota=odtysdomil($ile).do1000($ile)." zł."; break;
	case $ile>999999 && $ile<1000000000: $kwota=odmildomiliard($ile).odtysdomil($ile).do1000($ile)." zł.";  break;
	}
	return $kwota;
}

function kurs()
{
$url='http://www.nbp.pl/home.aspx?f=/kursy/kursya.html';
$strona=file_get_contents($url);
$poz=strstr($strona, "1 EUR");
$kurs=substr($poz, 34, 6);
return $kurs;
}

function maxidfaktury($idszef, $polacz)
	{
		$nr=mysqli_query($polacz, "select max(idfaktury) from faktury where (faktury.pracownik_szef_idszef = '$idszef' or faktury.szef_idszef = '$idszef')");
		$nrass=mysqli_fetch_assoc($nr);
		$maxid=$nrass['max(idfaktury)'];
		return $maxid;
	}
	
function danehtmlfaktury($polacz, $danefaktury, $nridfaktury)
		{
			$daneass=mysqli_fetch_assoc($danefaktury);
			echo '<b>'."Sprzedawca: ".$daneass['nazwa'].'</b>'.'<br/>';
			echo "NIP: ".$daneass['nip'].'<br/>';
			echo "Kraj: ".$daneass['kraj'].'<br/>';
			echo "Adres: ".$daneass['kod']." ".$daneass['miasto']." ul. ".$daneass['ulica']." ".$daneass['ulicanr'].'<br/><br/>';
			echo '<b>'."Nr faktury: ".$daneass['nrfaktury'].'</b><br/>';
			echo "Data wystawienia: ".$daneass['datawyst'].'<br/>';
			echo "Data sprzedaży: ".$daneass['datasprzed'].'<br/>';
			echo "Termin zapłaty: ".$daneass['termin']." dni".'<br/><br/>';
			if(!empty($daneass['nazwan']))
			{
				echo '<b>'."Nabywca: ".$daneass['nazwan'].'</b><br/>';
				echo "NIP: ".$daneass['nip'].'<br/>';
				echo "Kraj: ".$daneass['krajn'].'<br/>';
				echo "Adres: ".$daneass['kodn']." ".$daneass['miaston']." ul. ".$daneass['ulican']." ".$daneass['ulicanrn'].'<br/><br/>';
			}
			else
			{
				echo '<b>'."Imię nabywcy: ".$daneass['imien'].'</b><br/>';
				echo '<b>'."Nazwisko nabywcy: ".$daneass['nazwiskon'].'</b><br/>';
				echo "Pesel: ".$daneass['peseln'].'<br/>';
				echo "Kraj: ".$daneass['krajn'].'<br/>';
				echo "Adres: ".$daneass['kodn']." ".$daneass['miaston']." ul. ".$daneass['ulican']." ".$daneass['ulicanrn'].'<br/><br/>';
			}
			echo "Wpłacona zaliczka: ".$daneass['zaplacono']." zł.".'<br/>';
			echo "Sposób zapłaty: ".$daneass['platnosc'].'<br/>';
			echo "Nr zamówienia: ".$daneass['nrzamowienia'].'<br/><br/>';
			$towary=mysqli_query($polacz, "select idtowar, produkt, jm, ilosc, cena, vat, (round((ilosc*cena),2)) as wartosc, faktury_idfaktury from towar where faktury_idfaktury='$nridfaktury' group by cena");
			$ogolem=0;
			while($listatow=mysqli_fetch_array($towary))
			{
				echo "Nazwa towaru: ".$listatow['produkt']." Jedn. miary: ".$listatow['jm']." Ilość: ".$listatow['ilosc']." Cena: ".$listatow['cena']." zł."." Vat: ".$listatow['vat']."%"." Wartość netto: ".$listatow['wartosc']." zł.".'<br/>';
				$ogolem+=$listatow['wartosc'];
			}
				echo '<br/>';
				echo '<b>'."Ogółem wartość netto: ".$ogolem." zł.".'</b><br/>';
				$ile=$ogolem;
				echo "Kwota słownie: ".slownie($ile);
		}
		
		function wydrukhtmloomax($idszef, $polacz)
		{
			header('Content-type: application/vnd.oasis.opendocument.text-web');
			header('Content-Disposition: inline; filename=faktura1.html');
			echo '<br/><br/><br/>';
			$nazwa_pliku = 'faktura.html';
			$wyswietl = file_get_contents($nazwa_pliku);
			$maxid=maxidfaktury($idszef, $polacz);
			$danefaktury=mysqli_query($polacz, "select * from faktury, nabywca, firma where idfaktury='$maxid' and nabywca_idnabywca=idnabywca and firma.szef_idszef='$idszef'");
			$nridfaktury=$maxid;
			danehtmlfaktury($polacz, $danefaktury, $nridfaktury);
		}
		
		function wydrukhtmlwinmax($idszef, $polacz)
		{
			header('Content-type: application/msword');
			header('Content-Disposition: inline; filename=faktura1.html');
			echo '<br/><br/><br/>';
			$nazwa_pliku = 'faktura.html';
			$wyswietl = file_get_contents($nazwa_pliku);
			$maxid=maxidfaktury($idszef, $polacz);
			$danefaktury=mysqli_query($polacz, "select * from faktury, nabywca, firma where idfaktury='$maxid' and nabywca_idnabywca=idnabywca and firma.szef_idszef='$idszef'");
			$nridfaktury=$maxid;
			danehtmlfaktury($polacz, $danefaktury, $nridfaktury);
		}
		
		function wydrukrtf($idszef, $polacz, $nridfaktury)
		{
			$danefaktury=mysqli_query($polacz, "select * from faktury, nabywca, firma where idfaktury='$nridfaktury' and nabywca_idnabywca=idnabywca and firma.szef_idszef='$idszef'");
			
			$daneass=mysqli_fetch_assoc($danefaktury);
			
			$sprzedawcaadres=$daneass['kod']." ".$daneass['miasto']." ul. ".$daneass['ulica']." ".$daneass['ulicanr'];
			
			if(!empty($daneass['nazwan']))
			{
				$nabywca=$daneass['nazwan'];
				$nabywcaozn="NIP: ".$daneass['nip'];
				$nabywcaadres=$daneass['kodn']." ".$daneass['miaston']." ul. ".$daneass['ulican']." ".$daneass['ulicanrn'];
			}
			else
			{
				$nabywca=$daneass['imien']."	".$daneass['nazwiskon'];
				$nabywcaozn="PESEL: ".$daneass['peseln'];
				$nabywcaadres=$daneass['kodn']." ".$daneass['miaston']." ul. ".$daneass['ulican']." ".$daneass['ulicanrn'];
			}
			
			$towary=mysqli_query($polacz, "select idtowar, produkt, jm, ilosc, cena, vat, (round((ilosc*cena),2)) as wartosc, faktury_idfaktury from towar where faktury_idfaktury='$nridfaktury' group by cena");
			
			$zest_tow="";
			$ogolem=0;
			while($listatow=mysqli_fetch_array($towary))
			{
				$zest_tow.='{\rtf1'.$listatow['produkt'].'	'.$listatow['jm'].'	'.$listatow['ilosc'].'		'.$listatow['cena'].' zł.	'.$listatow['wartosc'].' zł.	'.'\f0}\line';
				$ogolem+=$listatow['wartosc'];
			}
				$nazwa_pliku = 'faktura.rtf';
				$wyswietl = file_get_contents($nazwa_pliku);
				$ile=$ogolem;
				
				$tab1=array("Ą", "Ć", "Ę", "Ł", "Ń", "Ó", "Ś", "Ź", "Ż", "ą", "ć", "ę", "ł", "ń", "ó", "ś", "ź", "ż");
				$tab2=array("\'a5", "\'c6", "\'ca", "\'a3", "\'d1", "\'d3", "\'8c", "\'8f", "\'af", "\'b9", "\'e6", "\'ea", "\'b3", "\'f1", "\'f3", "\'9c", "\'9f", "\'bf");
				
				$daneass['nazwa'] = str_replace( $tab1, $tab2, $daneass['nazwa']);
				$daneass['kraj'] = str_replace( $tab1, $tab2, $daneass['kraj']);
				$sprzedawcaadres = str_replace( $tab1, $tab2, $sprzedawcaadres);
				$nabywca = str_replace( $tab1, $tab2, $nabywca);
				$daneass['krajn'] = str_replace( $tab1, $tab2, $daneass['krajn']);
				$nabywcaadres = str_replace( $tab1, $tab2, $nabywcaadres);
				$zest_tow = str_replace( $tab1, $tab2, $zest_tow);
				$slownie = str_replace( $tab1, $tab2, slownie($ile));
					
				$wyswietl = str_replace('<<sprzedawca>>', $daneass['nazwa'], $wyswietl);
				$wyswietl = str_replace('<<sprzedawcanip>>', $daneass['nip'], $wyswietl);
				$wyswietl = str_replace('<<sprzedawcakraj>>', $daneass['kraj'], $wyswietl);
				$wyswietl = str_replace('<<sprzedawcaadres>>', $sprzedawcaadres, $wyswietl);
				
				$wyswietl = str_replace('<<datawyst>>', $daneass['datawyst'], $wyswietl);
				$wyswietl = str_replace('<<datasprzed>>', $daneass['datasprzed'], $wyswietl);
				$wyswietl = str_replace('<<nrfaktury>>', $daneass['nrfaktury'], $wyswietl);
				
				$wyswietl = str_replace('<<nabywca>>', $nabywca, $wyswietl);
				$wyswietl = str_replace('<<nabywcaozn>>', $nabywcaozn, $wyswietl);
				$wyswietl = str_replace('<<nabywcakraj>>', $daneass['krajn'], $wyswietl);
				$wyswietl = str_replace('<<nabywcaadres>>', $nabywcaadres, $wyswietl);
				
				$wyswietl = str_replace('<<zaplacono>>', $daneass['zaplacono'], $wyswietl);
				$wyswietl = str_replace('<<platnosc>>', $daneass['platnosc'], $wyswietl);
				$wyswietl = str_replace('<<nrzamowienia>>', $daneass['nrzamowienia'], $wyswietl);
				
				$wyswietl = str_replace('<<towary>>', $zest_tow, $wyswietl);
				
				$wyswietl = str_replace('<<termin>>', $daneass['termin'], $wyswietl);
				$wyswietl = str_replace('<<ogolem>>', $ogolem, $wyswietl);
				$wyswietl = str_replace('<<slownie>>', $slownie, $wyswietl);
				echo $wyswietl;
		}

		function wydrukrtfoomax($idszef, $polacz)
		{
			header('Content-type: application/vnd.oasis.opendocument.text-master');
			header('Content-Disposition: inline; filename=faktura1.rtf');
			$maxid=maxidfaktury($idszef, $polacz);
			$nridfaktury=$maxid;
			wydrukrtf($idszef, $polacz, $nridfaktury);
		}
		
		function wydrukrtfwinmax($idszef, $polacz)
		{
			header('Content-type: application/msword');
			header('Content-Disposition: inline; filename=faktura1.rtf');
			$maxid=maxidfaktury($idszef, $polacz);
			$nridfaktury=$maxid;
			wydrukrtf($idszef, $polacz, $nridfaktury);
		}
			
		function naglowekhtml()
		{
echo<<<END
<!Doctype HTML>
<html lang="pl-PL">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Wydruk faktury</title>
</head>
END;
		}
		
		function strzalki($ilewierszy)
		{
			$ilestron=ceil($ilewierszy/10);
			echo '<form method="POST" action="'.$_SERVER['PHP_SELF'].'"><button type="submit" name="str" value="-1"><<</button><button type="submit" name="str" value="1">>></button></form>';	
			@$_SESSION['strony']+=$_POST['str'];
			if($_SESSION['strony']<=0)
				{
					$_SESSION['strony']=0;
				}
			elseif($_SESSION['strony']>=$ilestron)
				{
					$_SESSION['strony']=$ilestron-1;
				}
			$baza=0+$_SESSION['strony']*10;
			return $baza;
		}
		
		function strzalki2($ilewierszy)
		{
			$ilestron=ceil($ilewierszy/10);
			echo '<form method="POST" action="'.$_SERVER['PHP_SELF'].'"><button type="submit" name="str2" value="-1"><<</button><button type="submit" name="str2" value="1">>></button></form>';	
			@$_SESSION['strony2']+=$_POST['str2'];
			if($_SESSION['strony2']<=0)
				{
					$_SESSION['strony2']=0;
				}
			elseif($_SESSION['strony2']>=$ilestron)
				{
					$_SESSION['strony2']=$ilestron-1;
				}	
			$baza=0+$_SESSION['strony2']*10;
			return $baza;
		}
		
		function opcjewydruku()
		{
echo<<<END
<br/><br/>
<form action="wydruki.php" method="POST" >
Drukuj bieżącą fakturę:<select name="wybranafaktura">
<option disabled selected>Wybierz system:</option>
<option value="1">Unix/Linux - rtf</option>
<option value="2" >Windows - rtf</option>
<option value="3">Unix/Linux - html</option>
<option value="4" >Windows - html</option>
<input type="submit" value="OK" name="submit"/>
</select>
</form>
END;
		}
		
?>