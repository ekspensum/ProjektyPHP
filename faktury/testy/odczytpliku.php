<?php
session_start();
require_once 'dbconnect.php';
$polacz=mysqli_connect($host,$user,$password,$database);

if(	isset($_SESSION["logidszef"]))
	{
		$p1=fopen('test.txt', 'r');
		$sum=0;
		while(!feof($p1))
		{
			$towary=fgets($p1);
			$sum+=count($towary);
		}
		//echo $sum;
		//fclose($p1);
		
		$p1=fopen('test.txt', 'r');
			
		$a=1;	
		do
		{
			$towary=fgets($p1);
			//echo strlen((string)$towary);
			//echo $towary;
				
			//mysqli_query($polacz, "insert into towar (ilosc) values ('$towary')");	
		}
		while (++$a <$sum);
		fclose($p1);
		
	}
	elseif(isset($_SESSION["logidprac"]))
	{
		$p1=fopen('test.txt', 'r');
		
		while(!feof($p1))
		{
			$towary=fgets($p1);
			//echo $towary;
			//mysqli_query($polacz, "insert into towar (idtowar, nazwa, jm, ilosc, cena) values (null, '$value1[$i]', '$value2[$i]', '$value3[$i]', '$value4[$i]')");	
		}
		
		fclose($p1);
	}
?>