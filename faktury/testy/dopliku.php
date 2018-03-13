<!Doctype HTML>
<html lang="pl-PL">
<head>
	<meta charset="utf-8"/>
	<title>Faktury</title>
</head>

<body>
<body bgcolor="gray">

<?php
session_start();
if(	isset($_SESSION["logidszef"]))
	{
		if (isset($_POST['box1']))
			{
				$array1=array_keys($_POST['box1']);
					$p1=fopen('test.txt', 'w') or die("Nie udało się utworzyć/otworzyć pliku");
					fclose($p1);
					foreach($array1 as $key=>$value1)
				{
					//$lista=mysqli_query($polacz, "select idnabywca, nazwan, nazwiskon, imien from nabywca where idnabywca = '$value1' group by nazwan, nazwiskon, imien");
					//$txt=mysqli_fetch_array($lista);	
					//$_SESSION["nridnabywcy"]=$value1;
					$value5=$value1."\n";
					echo $value5;
					$p2=fopen('test.txt', 'ab') or die("Nie udało się utworzyć/otworzyć pliku");
					fwrite($p2, $value5) or die("Nie udało się zapisać do pliku");
					fclose($p2);
					
				}
			}
	}
	elseif(isset($_SESSION["logidprac"]))
	{
		if (isset($_POST['box1']))
			{
				$array1=array_keys($_POST['box1']);
				$p1=fopen('test.txt', 'w') or die("Nie udało się utworzyć/otworzyć pliku");
				fclose($p1);
				foreach($array1 as $value1)
				{
					//$lista=mysqli_query($polacz, "select idnabywca, nazwan, nazwiskon, imien from nabywca where idnabywca = '$value1' group by nazwan, nazwiskon, imien");
					//$txt=mysqli_fetch_array($lista);	
					//$_SESSION["nridnabywcy"]=$value1;
					$value5=$value1."\t"."\n";
					echo $value5;
					$p2=fopen('test.txt', 'ab') or die("Nie udało się utworzyć/otworzyć pliku");
					fwrite($p2, $value5) or die("Nie udało się zapisać do pliku");
					fclose($p2);
				}
			}
	}
?>

<?php
//$p1=fopen('test.txt', 'a') or die("Nie udało się utworzyć/otworzyć pliku");

//fwrite($p1, $value1) or die("Nie udało się zapisać do pliku");
//fclose(p1);

?>

<br/>
</body>
</html>