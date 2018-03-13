<?php
session_start();
require_once 'dbconnect.php';
if (isset($_POST['login']))
	{
		$wszystko_OK=true;
		
		$login=trim($_POST['login']);
		if ((strlen($login)<3) || (strlen($login)>20))
		{
			$wszystko_OK=false;
			$_SESSION['login_blad']='<b><font color="blue">Login powinien posiadać od 3 do 20 znaków.</font></b>';
		}
		if (ctype_alnum($login)==false)
		{
			$wszystko_OK=false;
			$_SESSION['login_blad']='<b><font color="blue">Login powinien składać się tylko z liter i cyfr (bez polskich znaków).</font></b>';
		}
		
		$imie=trim($_POST['imie']);
		if (!preg_match('/^[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ]{3,15}$/', $imie))
		{
			$wszystko_OK=false;
			$_SESSION['imie_blad']='<b><font color="blue">Imię powinno składać się tylko z liter (dopuszczalne są tylko angielskie i polskie znaki) i posiadać od 3 do 15 znaków.</font></b>';
		}
		
		$nazwisko=trim($_POST['nazwisko']);
		if (!preg_match('/^[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ\-]{3,25}$/', $nazwisko))
		{
			$wszystko_OK=false;
			$_SESSION['nazwisko_blad']='<b><font color="blue">Nazwisko powino składać się tylko z liter (dopuszczalne są tylko angielskie i polskie znaki) i powinno posiadać od 3 do 25 znaków.</font></b>';
		}
			
		$email=$_POST['email'];
		$email2=filter_var($email, FILTER_SANITIZE_EMAIL);
		if ((filter_var($email2, FILTER_VALIDATE_EMAIL)==false) || ($email2!=$email))
		{
			$wszystko_OK=false;
			$_SESSION['email_blad']='<b><font color="blue">Proszę wprowadzić poprawny adres e-mail.</font></b>';
		}
	
		$haslo1=trim($_POST['haslo1']);
		$haslo2=trim($_POST['haslo2']);
		if ((strlen($haslo1)<6) || (strlen($haslo1)>20))
		{
			$wszystko_OK=false;
			$_SESSION['haslo1_blad']='<b><font color="blue">Hasło powinno zawierać od 6 do 20 znaków.</font></b>';
		}
		if ($haslo1!=$haslo2)
		{
			$wszystko_OK=false;
			$_SESSION['hasla2_blad']='<b><font color="blue">Hasła nie są identyczne</font></b>';
		}
		$haslo_hash=password_hash($haslo1, PASSWORD_DEFAULT);
			
		$nazwa=trim($_POST['nazwa']);
		if (!preg_match('/^[a-zA-Z0-9ąćęłńóśźżĄĆĘŁŃÓŚŹŻ\-\. ]{3,100}$/', $nazwa))
		{
			$wszystko_OK=false;
			$_SESSION['nazwa_blad']='<b><font color="blue">Nazwa firmy powinna składać się tylko z liter i cyfr (dopuszczalne są tylko angielskie i polskie znaki, znak "-", znak spacji i znak ".") oraz posiadać od 3 do 100 znaków.</font></b>';
		}
		
		$regon=trim($_POST['regon']);
		if (!preg_match('/^[0-9]{9}$/', $regon))
		{
			$wszystko_OK=false;
			$_SESSION['regon_blad']='<b><font color="blue">REGON firmy powinna składać się 9 cyfr.</font></b>';
		}
		
		$nip=trim($_POST['nip']);
		if (!preg_match('/^[0-9]{10}$/', $nip))
		{
			$wszystko_OK=false;
			$_SESSION['nip_blad']='<b><font color="blue">NIP firmy powinna składać się 10 cyfr.</font></b>';
		}
		
		$kraj=trim($_POST['kraj']);
		if (!preg_match('/^[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ ]{3,20}$/', $kraj))
		{
			$wszystko_OK=false;
			$_SESSION['kraj_blad']='<b><font color="blue">Nazwa kraju firmy powinna składać się tylko z liter (dopuszczalne są tylko angielskie i polskie znaki i znak spacji) oraz posiadać od 3 do 20 znaków.</font></b>';
		}
		
		$kod=trim($_POST['kod']);
		if (!preg_match('/^[0-9\- ]{6}$/', $kod))
		{
			$wszystko_OK=false;
			$_SESSION['kod_blad']='<b><font color="blue">Kod pocztowy firmy powinna składać się tylko z cyfr i znaku "-" lub spacji oraz posiadać 6 znaków.</font></b>';
		}
		
		$miasto=trim($_POST['miasto']);
		if (!preg_match('/^[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ ]{3,30}$/', $miasto))
		{
			$wszystko_OK=false;
			$_SESSION['miasto_blad']='<b><font color="blue">Miasto firmy powinna składać się tylko z liter (dopuszczalne są tylko angielskie i polskie znaki i znak spacji) oraz posiadać od 3 do 20 znaków.</font></b>';
		}	
		
		$ulica=trim($_POST['ulica']);	
		if (!preg_match('/^[a-zA-Z0-9ąćęłńóśźżĄĆĘŁŃÓŚŹŻ ]{3,30}$/', $ulica))
		{
			$wszystko_OK=false;
			$_SESSION['ulica_blad']='<b><font color="blue">Ulica firmy powinna składać się tylko z liter i cyfr (dopuszczalne są tylko angielskie i polskie znaki i znak spacji) oraz posiadać od 3 do 30 znaków.</font></b>';
		}	
		
		$ulicanr=trim($_POST['ulicanr']);
		if (!preg_match('/^[a-zA-Z0-9ąćęłńóśźżĄĆĘŁŃÓŚŹŻ ]{1,7}$/', $ulicanr))
		{
			$wszystko_OK=false;
			$_SESSION['ulicanr_blad']='<b><font color="blue">Numer budynku firmy powinien składać się tylko z liter i cyfr (dopuszczalne są tylko angielskie i polskie znaki i znak spacji) oraz posiadać od 1 do 7 znaków.</font></b>';
		}
		
		$lokalnr=trim($_POST['lokalnr']);
		if (!preg_match('/^[a-zA-Z0-9ąćęłńóśźżĄĆĘŁŃÓŚŹŻ ]{0,7}$/', $lokalnr))
		{
			$wszystko_OK=false;
			$_SESSION['lokalnr_blad']='<b><font color="blue">Numer budynku firmy powinien składać się tylko z liter i cyfr (dopuszczalne są tylko angielskie i polskie znaki i znak spacji) oraz posiadać od 0 do 7 znaków.</font></b>';
		}
			
		if (!isset($_POST['regulamin']))
		{
			$wszystko_OK=false;
			$_SESSION['regulamin_blad']='<b><font color="blue">Potwierdź zaakceptowanie regulaminu</font></b>';
		}
		
		$tajnyklucz="6LfAOiAUAAAAALJR2gwDGYlzR3A8o65CplwhkDSH";
		$sprawdz=file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$tajnyklucz.'&response='.$_POST['g-recaptcha-response']);
		$odpowiedz=json_decode($sprawdz);
		if ($odpowiedz->success==false)
		{
			$wszystko_OK=false;
			$_SESSION['robot_blad']='<b><font color="blue">Potwierdź, że nie jesteś robotem</font></b>';
		}
		
		$zapszef=mysqli_query($polacz, "select * from szef") or die("Brak połączenia z bazą danych.");
		while($daneszef=mysqli_fetch_assoc($zapszef))
		{
			if($login==$daneszef['login'])
			{
				$wszystko_OK=false;
				$_SESSION['login_blad']='<b><font color="blue">Podany login znajduje się już w bazie. Proszę podać inny login.</font></b>';
			}
			if($email==$daneszef['email'])
			{
				$wszystko_OK=false;
				$_SESSION['email_blad']='<b><font color="blue">Podany email znajduje się już w bazie. Proszę podać inny email.</font></b>';
			}
		}	
		
		if ($wszystko_OK==true)
		{
			$kodtxt=$email.rand(3000, 300000);
			$szyfr_get=hash('md5', $kodtxt);
			$szyfr_baza=password_hash($szyfr_get, PASSWORD_DEFAULT);
			
			$naglowek = 'MIME-Version: 1.0'." \r\n";
			$naglowek .= 'Content-type: text/html; charset=utf-8'." \r\n";
			$list = '
			<html>
			<head>
			<title>Aktywacja konta</title>
			</head>
			<body>
			<p><b>Prosimy o aktywację konta poprzez kliknięcie na podany niżej link:</b></p>
			<a href="http://faktury.pe.hu/aktywacja.php?kod='.$szyfr_get.'" >Dokonaj aktywacji konta</a>
			</body>
			</html>
			';
			$temat='Aktywacja konta użytkownika: '.$imie.' '.$nazwisko;
			
			if(mail($email, $temat, $list, $naglowek))
				{
					mysqli_query($polacz, "insert into szef values (null, '$login', '$haslo_hash', '$imie', '$nazwisko', '$email', now(), '$szyfr_baza', 0, 0)");
					if(mysqli_insert_id($polacz)>0)
					{
						$idszef=mysqli_insert_id($polacz);
						mysqli_query($polacz, "insert into firma values (null, '$nazwa', '$regon', '$nip', '$kraj', '$kod', '$miasto', '$ulica', '$ulicanr', '$lokalnr', now(), '$idszef')");
						if(mysqli_affected_rows($polacz)>0)
						{
							$_SESSION['rejestracja']='<b><font color="blue">Dodano nowego użytkownika. Na Twój adres e-mail została wysłana wiadomość zawierająca link aktywacyjny.</font></b>';
						}
						else
							{
								$_SESSION['rejestracja']='<b><font color="blue">Nie udało się wprowadzić danych do bazy.</font></b>';
							}
					}
					else
						{
							$_SESSION['rejestracja']='<b><font color="blue">Nie udało się wprowadzić danych do bazy.</font></b>';
						}
				}
				else
					{
						$_SESSION['rejestracja']='<b><font color="blue">Nie udało się wysłać e-mail na podany adres.</font></b>';
					}
			
			if($_SERVER['HTTP_CLIENT_IP'])
				{
					$ip = $_SERVER['HTTP_CLIENT_IP'];
				}
				elseif($_SERVER['HTTP_X_FORWARDED_FOR'])
					{
						 $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
					}
				elseif($_SERVER['REMOTE_ADDR'])
					{
						$ip = $_SERVER['REMOTE_ADDR'];
					}
				else
					{
						$ip='nieznany';
					}		
			mysqli_query($polacz, "update szef set ip='$ip' where idszef='$idszef' ");		
		}
	}

?>
<!Doctype HTML>
<html lang="pl-PL">
<head>
	<meta charset="utf-8"/>
	<title>Rejestracja nowego Użytkownika</title>
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
<body bgcolor="gray">
<form action="logout.php" method="POST" />
<p><input type="submit" value="Powrót do strony logowania" /></p>
</form>
<p/>
<p><b>Rejestracja użytkownika jako szefa firmy:</b></p>
<p/>
<?php
if(isset($_SESSION['rejestracja']))
	{
		echo $_SESSION['rejestracja'];
		unset($_SESSION['rejestracja']);
	}
?>
<p/>
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
<p>Login:<br/><input type="text" name="login" value="<?php if(isset($_POST['login'])) echo $_POST['login']; ?>"/></p>
<?php
if(isset($_SESSION['login_blad']))
	{
		echo $_SESSION['login_blad'];
		unset($_SESSION['login_blad']);
	}
?>
<p>Imię:<br/><input type="text" name="imie" value="<?php if(isset($_POST['imie'])) echo $_POST['imie']; ?>" /></p>
<?php
if(isset($_SESSION['imie_blad']))
	{
		echo $_SESSION['imie_blad'];
		unset($_SESSION['imie_blad']);
	}
?>
<p>Nazwisko:<br/><input type="text" name="nazwisko" value="<?php if(isset($_POST['nazwisko'])) echo $_POST['nazwisko']; ?>" /></p>
<?php
if(isset($_SESSION['nazwisko_blad']))
	{
		echo $_SESSION['nazwisko_blad'];
		unset($_SESSION['nazwisko_blad']);
	}
?>
<p>E-mail:<br/><input type="text" name="email" value="<?php if(isset($_POST['nazwisko'])) echo $_POST['email']; ?>" /></p>
<?php
if(isset($_SESSION['email_blad']))
	{
		echo $_SESSION['email_blad'];
		unset($_SESSION['email_blad']);
	}
?>
<p>Podaj hało:<br/><input type="password" name="haslo1" value="<?php if(isset($_POST['haslo1'])) echo $_POST['haslo1']; ?>" /></p>
<?php
if(isset($_SESSION['haslo1_blad']))
	{
		echo $_SESSION['haslo1_blad'];
		unset($_SESSION['haslo1_blad']);
	}
?>
<p>Powtórz hało:<br/><input type="password" name="haslo2" value="<?php if(isset($_POST['haslo2'])) echo $_POST['haslo2']; ?>" /></p>
<?php
if(isset($_SESSION['haslo2_blad']))
	{
		echo $_SESSION['haslo2_blad'];
		unset($_SESSION['haslo2_blad']);
	}
?>
<p>Nazwa firmy:<br/><input type="text" name="nazwa" value="<?php if(isset($_POST['nazwa'])) echo $_POST['nazwa']; ?>" /></p>
<?php
if(isset($_SESSION['nazwa_blad']))
	{
		echo $_SESSION['nazwa_blad'];
		unset($_SESSION['nazwa_blad']);
	}
?>
<p>REGON firmy:<br/><input type="text" name="regon" value="<?php if(isset($_POST['regon'])) echo $_POST['regon']; ?>" /></p>
<?php
if(isset($_SESSION['regon_blad']))
	{
		echo $_SESSION['regon_blad'];
		unset($_SESSION['regon_blad']);
	}
?>
<p>NIP firmy:<br/><input type="text" name="nip" value="<?php if(isset($_POST['nip'])) echo $_POST['nip']; ?>" /></p>
<?php
if(isset($_SESSION['nip_blad']))
	{
		echo $_SESSION['nip_blad'];
		unset($_SESSION['nip_blad']);
	}
?>
<p>Kraj firmy:<br/><input type="text" name="kraj" value="<?php if(isset($_POST['kraj'])) echo $_POST['kraj']; ?>" /></p>
<?php
if(isset($_SESSION['kraj_blad']))
	{
		echo $_SESSION['kraj_blad'];
		unset($_SESSION['kraj_blad']);
	}
?>
<p>Kod pocztowy firmy:<br/><input type="text" name="kod" value="<?php if(isset($_POST['kod'])) echo $_POST['kod']; ?>" /></p>
<?php
if(isset($_SESSION['kod_blad']))
	{
		echo $_SESSION['kod_blad'];
		unset($_SESSION['kod_blad']);
	}
?>
<p>Miasto firmy:<br/><input type="text" name="miasto" value="<?php if(isset($_POST['miasto'])) echo $_POST['miasto']; ?>" /></p>
<?php
if(isset($_SESSION['miasto_blad']))
	{
		echo $_SESSION['miasto_blad'];
		unset($_SESSION['miasto_blad']);
	}
?>
<p>Ulica firmy:<br/><input type="text" name="ulica" value="<?php if(isset($_POST['ulica'])) echo $_POST['ulica']; ?>" /></p>
<?php
if(isset($_SESSION['ulica_blad']))
	{
		echo $_SESSION['ulica_blad'];
		unset($_SESSION['ulica_blad']);
	}
?>
<p>Numer budynku firmy:<br/><input type="text" name="ulicanr" value="<?php if(isset($_POST['ulicanr'])) echo $_POST['ulicanr']; ?>" /></p>
<?php
if(isset($_SESSION['ulicanr_blad']))
	{
		echo $_SESSION['ulicanr_blad'];
		unset($_SESSION['ulicanr_blad']);
	}
?>
<p>Numer lokalu firmy:<br/><input type="text" name="lokalnr" value="<?php if(isset($_POST['lokalnr'])) echo $_POST['lokalnr']; ?>" /></p>
<?php
if(isset($_SESSION['lokalnr_blad']))
	{
		echo $_SESSION['lokalnr_blad'];
		unset($_SESSION['lokalnr_blad']);
	}
?>
<label>
<p><input type="checkbox" checked="checked" name="regulamin" /> Akceptuję <a target="_blank" href="regulamin.pdf">	regulamin</a></p>
</label>
<?php
if(isset($_SESSION['regulamin_blad']))
	{
		echo $_SESSION['regulamin_blad'];
		unset($_SESSION['regulamin_blad']);
	}
?>
<br/><br/>
<div class="g-recaptcha" data-sitekey="6LfAOiAUAAAAAIfxgtmlVLOJfG_LR082Kn0wpFQC"></div>
<br/>
<?php
if(isset($_SESSION['robot_blad']))
	{
		echo $_SESSION['robot_blad'];
		unset($_SESSION['robot_blad']);
	}
?>
<br/><br/>
<p><button type="submit" /><b>Zarejestruj się</b></button></p>
</form>
<br/>

</body>
</html>