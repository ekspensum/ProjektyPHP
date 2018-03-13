<?php

$url='http://www.nbp.pl/home.aspx?f=/kursy/kursya.html';

function curl($url)
{
$c=curl_init();
curl_setopt($c, CURLOPT_URL, $url);
curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
curl_exec($c);
$txt=curl_exec($c);
return $txt;
}
session_start();
print_r($_COOKIE);
echo session_id().'<br/>';
echo session_status();
print_r(session_get_cookie_params());

//$url='http://www.nbp.pl/home.aspx?f=/kursy/kursya.html';
$strona=file_get_contents($url);
//$strona="1";
//$wzor='/[a-zA-Z0-9\,]/';
$wzor='/1 EUR/';
$wynik=preg_match_all($wzor, $strona, $arr);

//echo $wynik.'<br/>';
//print_r($arr);
echo implode(" ", $arr[0]);

//print_r($aa);

function kurs()
{
$url='http://www.nbp.pl/home.aspx?f=/kursy/kursya.html';
$strona=file_get_contents($url);
$poz=strstr($strona, "1 EUR");
$kurs=substr($poz, 34, 6);
return $kurs;
}

//echo kurs();
?>