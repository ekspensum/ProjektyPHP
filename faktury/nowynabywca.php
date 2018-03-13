<?php
session_start();
require_once 'dbconnect.php';
if (!isset($_SESSION["logidszef"]) && !isset($_SESSION["logidprac"]))
	{
		header('location:index.php');
	}
	elseif (((empty($_POST['nazwan']) || empty($_POST['nipn'])) && (empty($_POST['imien']) || empty($_POST['nazwiskon']))) || empty($_POST['krajn']) || empty($_POST['kodn']) || empty($_POST['miaston']) || empty($_POST['ulican']) || empty($_POST['ulicanrn']))
		{
			$_SESSION["pustenn"] = '<b><font color="blue">Należy uzupełnić pola - dla firmy lub instytucji: nazwa firmy, nip, kraj, kod pocztowy, miasto, ulica, nr ulicy. Dla nabywcy prywatnego: imię, nazwisko, kraj, kod pocztowy, miasto, ulica, nr ulicy. Pola regon, pesel oraz nr lokalu są ocjonalne.</font></b>';
			header('location:ustawienia.php');
		}
		else
			{
				if(isset($_SESSION["logidszef"]))
				{
					$logidszef = $_SESSION["logidszef"];
					$nazwan=trim($_POST['nazwan']);
					$imien=trim($_POST['imien']);
					$nazwiskon=trim($_POST['nazwiskon']);
					$regonn=trim($_POST['regonn']);
					$nipn=trim($_POST['nipn']);
					$peseln=trim($_POST['peseln']);
					$krajn=trim($_POST['krajn']);
					$kodn=trim($_POST['kodn']);
					$miaston=trim($_POST['miaston']);
					$ulican=trim($_POST['ulican']);
					$ulicanrn=trim($_POST['ulicanrn']);
					$lokalnrn=trim($_POST['lokalnrn']);
					mysqli_query($polacz, "insert into nabywca values (null, '$nazwan', '$imien', '$nazwiskon', '$regonn', '$nipn', '$peseln', '$krajn', '$kodn', '$miaston', '$ulican', '$ulicanrn', '$lokalnrn', now(), '$logidszef')");
					header('location:ustawienia.php');
				}
				elseif(isset($_SESSION["logidprac"]))
				{
					$logidprac = $_SESSION["logidprac"];
					$daneszefa=mysqli_query($polacz, "select szef_idszef from pracownik where idpracownik='$logidprac'");
					$daneidszef=mysqli_fetch_assoc($daneszefa);
					$szef_idszef=$daneidszef['szef_idszef'];
					$nazwan=trim($_POST['nazwan']);
					$imien=trim($_POST['imien']);
					$nazwiskon=trim($_POST['nazwiskon']);
					$regonn=trim($_POST['regonn']);
					$nipn=trim($_POST['nipn']);
					$peseln=trim($_POST['peseln']);
					$krajn=trim($_POST['krajn']);
					$kodn=trim($_POST['kodn']);
					$miaston=trim($_POST['miaston']);
					$ulican=trim($_POST['ulican']);
					$ulicanrn=trim($_POST['ulicanrn']);
					$lokalnrn=trim($_POST['lokalnrn']);
					mysqli_query($polacz, "insert into nabywca values (null, '$nazwan', '$imien', '$nazwiskon', '$regonn', '$nipn', '$peseln', '$krajn', '$kodn', '$miaston', '$ulican', '$ulicanrn', '$lokalnrn', now(), '$logidprac', '$szef_idszef')");
					header('location:ustawienia.php');
				}
			}
?>

