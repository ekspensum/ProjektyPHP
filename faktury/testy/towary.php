<!Doctype HTML>
<html lang="pl-PL">
<head>
	<meta charset="utf-8"/>
	<title>Faktury</title>
</head>

<body>
<body bgcolor="gray">

<form action="wiecejtowaru.php" method="POST" />
<?php

//for($i=0; $i<10; $i++)
$a=0;
do
	
{
	?>
	Id2<input type="text" name="id2[]" value="" />
	Nazwa<input type="text" name="nazwa[]" value="" />
	JM<input type="text" name="jm[]" value="<?php //echo @$_POST['jm']; ?>" />
	Ilość<input type="text" name="ilosc[]" value="<?php //echo @$_POST['ilosc']; ?>" />
	Cena<input type="text" name="cena[]" value="<?php //echo @$_POST['cena']; ?>" />
	Id faktury<input type="text" name="faktyry_idfaktury[]" value="<?php //echo @$_POST['faktury_idfaktury']; ?>" />
	Id szef<input type="text" name="towar_idszef[]" value="<?php //echo @$_POST['towar_idszef']; ?>" />
	Id pracownik<input type="text" name="towar_idpracownik[]" value="<?php //echo @$_POST['towar_idpracownik']; ?>" /><br/>
	<?php
}

while (++$a <25);


?>


<br/>
<input type="submit" value="OK" name=""/>
</form>

<br/>
<br/>
<br/>


</body>
</html>