<!Doctype HTML>
<html lang="pl-PL">
<head>
	<meta charset="utf-8"/>
	<title>Faktury</title>
</head>

<body>
<body bgcolor="gray">

<?php
ob_start();
session_start();
require_once 'dbconnect.php';
$polacz=mysqli_connect($host,$user,$password,$database);
//$nazwa=$_POST['nazwa'];
//$jm=$_POST['jm'];
//$ilosc=$_POST['ilosc'];
//print_r($_POST['nazwa']);

//$arr=$_POST['nazwa'];
$arr1=$_POST['nazwa'];
$arr2=$_POST['jm'];
$arr3=$_POST['ilosc'];
$arr4=$_POST['cena'];
$arr5=$_POST['id2'];
//var_dump($value1);
//print_r($value1);
//echo $value1[0];
//echo count($value1[0]);
//$value3=var_dump(array_values($_POST['ilosc']));
//$value4=var_dump(array_values($_POST['cena']));


	//echo end($value1);
	//print_r(count($value1));
	//echo sizeof($value1);
	//echo sizeof(array_values(array_count_values($_POST['nazwa'])));
	//echo sizeof(array_count_values($_POST['nazwa']));
	//echo sizeof(array_count_values($_POST['id2']));
	//var_dump(array_count_values($_POST['nazwa']));

//$arr1[0]=$_POST['nazwa'];
//$arr2[1]=$_POST['jm'];
//$arr3[2]=$_POST['ilosc'];
//$arr4[3]=$_POST['cena'];

//$arr=$arr1+$arr2+$arr3;		

//print_r($arr);
//print_r($arr[1]);
//print_r($arr[2]);
//print_r($arr[3]);
$suma=0;
		foreach($arr1 as $key => $val1)
		{	
			//echo $value;
			//print_r($arr);
			//echo $value1['nazwa']; 
			//var_dump($key);
			//var_dump($val1);
			//print_r(array_chunk($arr, 4)); 
			//echo count($key);
			//echo $val1[0];
			//print_r($val1);
			echo $val1[0];
			//echo count($key).'<br/>';
			//echo strlen((string)$val1[0]).'<br/>';
			$suma+=strlen((string)$val1[0]).'<br/>';
			//echo $suma.'<br/>';	
			//echo end($value1);
			//echo array_count_values($val1);
			//print_r(array_count_values($val1));
			//echo sizeof($val1);
			//echo $val3;
			//echo $val4;
			//print_r(array_values($value1));			
			//explode($value1);
			//echo $value2[1]; 
			//echo $value3[2]; 
			//echo $value4[3]; 
			//echo $value5; 
			//echo $value6; 
			//$wyswietl = str_replace($value1, $value2, $value1);
			//echo $wyswietl;
			//echo "{$key} => {$value} ";
			//print_r($arr);
			//mysqli_query($polacz, "insert into towar (idtowar, nazwa, jm, ilosc, cena) values (null, '$val1', '$val2', '$val3', '$val4')");
		}
echo $suma.'<br/>';		
echo '<br/>';

$suma2=0;	
for($i=0; $i<25; $i++)
{
	//echo strlen((string)$arr1[$i])." ";
	$suma2+=strlen((string)$arr1[$i])." ";
	//echo $value2[$i]." ";
	//echo $value3[$i]." ";
	//echo $value4[$i]." ";
	//mysqli_query($polacz, "insert into towar (idtowar, nazwa, jm, ilosc, cena) values (null, '$value1[$i]', '$value2[$i]', '$value3[$i]', '$value4[$i]')");	
}
		echo $suma2;
		//header('location:towary.php');	
		ob_end_flush();
?>

<br/>
</body>
</html>
