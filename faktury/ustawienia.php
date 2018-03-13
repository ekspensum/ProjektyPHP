<!Doctype HTML>
<html lang="pl-PL">
<head>
	<meta charset="utf-8"/>
	<title>Ustawienia użytkownika</title>
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

$a1=<<<END
<p>Podaj nowe dane firmy:</p>
<form action="nowedanefirmy.php" method="POST" />
<p>Nazwa firmy<input type="text" name="nazwa" size=25/></p>
<p>Regon<input type="text" name="regon" size=25/></p>
<p>NIP<input type="text" name="nip" size=25/></p>
<p>Kraj<input type="text" name="kraj" size=25/></p>
<p>Kod pocztowy<input type="text" name="kod" size=25/></p>
<p>Miasto<input type="text" name="miasto" size=25/></p>
<p>Ulica<input type="text" name="ulica" size=25/></p>
<p>Nr domu<input type="text" name="ulicanr" size=25/></p>
<p>Nr lokalu<input type="text" name="lokalnr" size=25/></p>
END;

$b1=<<<END
<br/>
<input type="submit" value="Dodaj dane firmy" /><br/>
</form>
END;

if(	isset($_SESSION["logidszef"]))
	{
		echo $a1;
		if (isset($_SESSION["pustendf"]))
		{
			echo $_SESSION["pustendf"]; 
			unset($_SESSION["pustendf"]);
		}
		echo$b1;
	}
?>
<br/>
<?php
$a2=<<<END
<p>Dodaj pracownika:</p>
<form action="nowypracownik.php" method="POST" />
<p>Login<input type="text" name="login" size=25/></p>
<p>Hasło<input type="text" name="haslo" size=25/></p>
<p>Imie<input type="text" name="imie" size=25/></p>
<p>Nazwisko<input type="text" name="nazwisko" size=25/></p>
<p>Email<input type="text" name="email" size=25/></p>
END;

$b2=<<<END
<br/>
<input type="submit" value="Dodaj pracownika" /><br/>
</form>
END;

if(	isset($_SESSION["logidszef"]))
	{
		echo $a2;
		if (isset($_SESSION["pustenp"]))
			{
				echo $_SESSION["pustenp"]; 
				unset($_SESSION["pustenp"]);
			}
		echo $b2;
	}
?>
<br/>
<?php
$a3=<<<END
<p>Podaj nowy nr konta banowego swojej firmy:</p>
<form action="nowynrkonta.php" method="POST" />
<p>Nr konta<input type="text" name="nrkonta" size=35/></p>
<p>Nazwa banku<input type="text" name="bank" size=25/></p>
END;
$b3=<<<END
<br/>
<input type="submit" value="Dodaj konto" /><br/>
</form>
END;

if(	isset($_SESSION["logidszef"]))
	{
		echo $a3;
		if (isset($_SESSION["pustennk"]))
			{
				echo $_SESSION["pustennk"]; 
				unset($_SESSION["pustennk"]);
			}
		echo $b3;
	}
?>
<br/>
<p>Dodaj nowego nabywcę:</p>
<form action="nowynabywca.php" method="POST" />
<a>Nazwa firmy<input type="text" name="nazwan" size=25/></a>
<p>Imię<input type="text" name="imien" size=25/></p>
<p>Nazwisko<input type="text" name="nazwiskon" size=25/></p>
<p>Regon<input type="text" name="regonn" size=25/></p>
<p>NIP<input type="text" name="nipn" size=25/></p>
<p>PESEL<input type="text" name="peseln" size=25/></p>
<p>Kraj<input type="text" name="krajn" size=25/></p>
<p>Kod pocztowy<input type="text" name="kodn" size=25/></p>
<p>Miasto<input type="text" name="miaston" size=25/></p>
<p>Ulica<input type="text" name="ulican" size=25/></p>
<p>Nr domu<input type="text" name="ulicanrn" size=25/></p>
<p>Nr lokalu<input type="text" name="lokalnrn" size=25/></p>
<?php		
	if (isset($_SESSION["pustenn"]))
		{
			echo $_SESSION["pustenn"]; 
			unset($_SESSION["pustenn"]);
		}
?>
<br/>			
<input type="submit" value="Dodaj nabywcę" /><br/>
</form>
</body>
</html>