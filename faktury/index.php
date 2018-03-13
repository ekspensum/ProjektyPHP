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
?>
<p><b>Logowanie do serwisu faktury:</b></p>
<form action="logowanie.php" method="POST" />
<p>Podaj login: <input type="text" name="login" size=25 /></p>
<p>Podaj hasło: <input type="password" name="haslo" size=25 /></p>
<p><input type="radio" name="jako" value="szef" checked="checked" />Zaloguj jako szef</p>
<p><input type="radio" name="jako" value="pracownik" />Zaloguj jako pracownik</p>
<?php 
if (isset($_SESSION["puste"]))
{
	echo $_SESSION["puste"]; 
	unset($_SESSION["puste"]);
}
if (isset($_SESSION["blad"]))
{
	echo $_SESSION["blad"]; 
	unset($_SESSION["blad"]);
}
?>
<p><input type="submit" value="Zaloguj" /></p>
</form>
<br/>
<br/>
<a href="rejestracja.php">Rejestracja nowego użytkownika</a>
</body>
</html>