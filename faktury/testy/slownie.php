<!Doctype HTML>
<html lang="pl-PL">
<head>
	<meta charset="utf-8"/>
	<title>Kwota słownie</title>
</head>

<body>
<body bgcolor="gray">

<form action="" method="POST">
<input type="text" name="slownie" value="" />
<input type="submit" value="Pokaż kwotę słownie" />
</form>

<?php
$ile=(int)$_POST['slownie'];
echo $ile.'<br/>';

function slownie($ile)

{

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
				$kwota=do1000($ile)." ".$miliony[substr($z, -1, 1)]." ";	
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

echo slownie($ile);

?>
</body>
</html>