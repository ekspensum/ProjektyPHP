<?php
session_start();
require_once 'dbconnect.php';
require_once 'funkcje.php';
if (!isset($_SESSION["logidszef"]) && !isset($_SESSION["logidprac"]))
{
	header('location:index.php');
}
else
{
	if(	isset($_SESSION["logidszef"]))
	{
		$logidszef = $_SESSION["logidszef"];
		$idszef=$logidszef;
		$zalogowany=mysqli_query($polacz, "select idszef, imie, nazwisko, nip, nazwa, idfirma, kraj, kod, miasto, ulica, ulicanr, lokalnr, szef_idszef from szef, firma where idszef = '$logidszef' and szef_idszef = '$logidszef' order by idfirma desc ");
		$danefirmy=mysqli_fetch_assoc($zalogowany);
		$imie=$danefirmy['imie'];
		$nazwisko=$danefirmy['nazwisko'];
		//$idszef=$danefirmy['idszef'];
		$idfirma=$danefirmy['idfirma'];
		$nazwa=$danefirmy['nazwa'];
		$nip=$danefirmy['nip'];
		$kraj=$danefirmy['kraj'];
		$kod=$danefirmy['kod'];
		$miasto=$danefirmy['miasto'];
		$ulica=$danefirmy['ulica'];
		$ulicanr=$danefirmy['ulicanr'];
		$lokalnr=$danefirmy['lokalnr'];
		echo "Osoba zalogowana: ".$imie.' '.$nazwisko.' '.$idszef.'<br/>';
		echo "Aktualna nazwa firmy i lokalizacja: ".$idfirma.' '.$nazwa.' '."NIP: ".'  '.$nip.'  '.$kraj.' '.$kod.' '.$miasto.' '."ul. ".' '.$ulica.' '."nr: ".' '.$ulicanr. ' '."/ ".'  '.$lokalnr.'<br/>';
		$faktura=mysqli_query($polacz, "SELECT idfaktury, sum(round((ilosc*cena),2)) as wartosc, nrfaktury, datawyst, termin, faktury.pracownik_szef_idszef, faktury.szef_idszef, nabywca_idnabywca, idnabywca, nazwan, imien, nazwiskon, faktury_idfaktury FROM faktury, nabywca, towar WHERE (faktury.pracownik_szef_idszef = '$idszef' or faktury.szef_idszef = '$idszef') and nabywca_idnabywca=idnabywca and idfaktury = faktury_idfaktury group by faktury_idfaktury order by nrfaktury desc ");
		$ostatniafaktura=mysqli_fetch_assoc($faktura);
		$nrostfakt=$ostatniafaktura['nrfaktury'];
		$datawystostfakt=$ostatniafaktura['datawyst'];
		$wartoscostfakt=$ostatniafaktura['wartosc'];
		$terminostfakt=$ostatniafaktura['termin'];
		$idnabywca=$ostatniafaktura['idnabywca'];
		$nazwan=$ostatniafaktura['nazwan'];
		$imien=$ostatniafaktura['imien'];
		$nazwiskon=$ostatniafaktura['nazwiskon'];
		echo "Ostatnia wystawiona faktura: "."Nr faktury: ".$nrostfakt." Data wystawienia: ".$datawystostfakt." Wartość netto: ".$wartoscostfakt." Termin płatności: ".$terminostfakt." dni"." Wystawiona dla: ".$idnabywca."  ".$nazwan." ".$imien." ".$nazwiskon.'<br/>';
		//echo "Aktualny średni kurs EUR wg notowań NBP: 1 EUR = ".kurs()." PLN ".'<a href="http://www.nbp.pl/home.aspx?f=/kursy/kursya.html" target="_blank">tutaj</a>'.'<br/>';
	}
	elseif(isset($_SESSION["logidprac"]))
	{
		$logidprac = $_SESSION["logidprac"];
		$zalogowany=mysqli_query($polacz, "select idszef, imie, nazwisko, nip, nazwa, idfirma, kraj, kod, miasto, ulica, ulicanr, lokalnr, firma.szef_idszef, idpracownik, imiep, nazwiskop from szef, firma, pracownik where idpracownik = '$logidprac' and idszef=pracownik.szef_idszef and firma.szef_idszef=pracownik.szef_idszef order by idfirma desc ");
		$danefirmy=mysqli_fetch_assoc($zalogowany);
		$imie=$danefirmy['imiep'];
		$nazwisko=$danefirmy['nazwiskop'];
		$idszef=$danefirmy['idszef'];
		$idfirma=$danefirmy['idfirma'];
		$nazwa=$danefirmy['nazwa'];
		$nip=$danefirmy['nip'];
		$kraj=$danefirmy['kraj'];
		$kod=$danefirmy['kod'];
		$miasto=$danefirmy['miasto'];
		$ulica=$danefirmy['ulica'];
		$ulicanr=$danefirmy['ulicanr'];
		$lokalnr=$danefirmy['lokalnr'];
		echo "Osoba zalogowana: ".$imie.' '.$nazwisko.' '.$idszef.'<br/>';
		echo "Aktualna nazwa firmy i lokalizacja: ".$idfirma.' '.$nazwa.' '."NIP: ".'  '.$nip.'  '.$kraj.' '.$kod.' '.$miasto.' '."ul. ".' '.$ulica.' '."nr: ".' '.$ulicanr. ' '."/ ".'  '.$lokalnr.'<br/>';
		$zalogowany=mysqli_query($polacz, "select idfaktury, sum(round((ilosc*cena),2)) as wartosc, nrfaktury, datawyst, termin, faktury.pracownik_szef_idszef, faktury.szef_idszef, nabywca_idnabywca, idnabywca, nazwan, imien, nazwiskon, faktury_idfaktury from faktury, nabywca, towar where (faktury.pracownik_szef_idszef = '$idszef' or faktury.szef_idszef = '$idszef') and nabywca_idnabywca=idnabywca and idfaktury = faktury_idfaktury group by faktury_idfaktury order by nrfaktury desc ");
		$ostatniafaktura=mysqli_fetch_assoc($zalogowany);
		$nrostfakt=$ostatniafaktura['nrfaktury'];
		$datawystostfakt=$ostatniafaktura['datawyst'];
		$wartoscostfakt=$ostatniafaktura['wartosc'];
		$terminostfakt=$ostatniafaktura['termin'];
		$idnabywca=$ostatniafaktura['idnabywca'];
		$nazwan=$ostatniafaktura['nazwan'];
		$imien=$ostatniafaktura['imien'];
		$nazwiskon=$ostatniafaktura['nazwiskon'];
		echo "Ostatnia wystawiona faktura: "."Nr faktury: ".$nrostfakt." Data wystawienia: ".$datawystostfakt." Wartość netto: ".$wartoscostfakt." Termin płatności: ".$terminostfakt." dni"." Wystawiona dla: ".$idnabywca."  ".$nazwan." ".$imien." ".$nazwiskon.'<br/>';
		//echo "Aktualny średni kurs EUR wg notowań NBP: 1 EUR = ".kurs()." PLN ".'<a href="http://www.nbp.pl/home.aspx?f=/kursy/kursya.html" target="_blank">tutaj</a>'.'<br/>';
	}
}
?>
