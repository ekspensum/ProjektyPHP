<?php
session_start();
$ilenazwa=0;
foreach($_POST['produkt'] as $valnazwa)
	{
		$ilenazwa+=strlen(substr($valnazwa,0,1));
	}
$ilecena=0;
foreach($_POST['cena'] as $valcena)
	{
		$ilecena+=strlen(substr($valcena,0,1));
	}
if (!isset($_SESSION["logidszef"]) && !isset($_SESSION["logidprac"]))
	{
		header('location:index.php');
	}
	elseif (!isset($_SESSION["nridnabywcy"]))
		{
			$_SESSION["pusteid"] = '<b><font color="blue">Należy wybrać nabywcę.</font></b>';
			header('location:faktury.php');
		}	
	elseif ($ilenazwa<1 || $ilecena<1 || ($ilenazwa<1 && $ilecena<1) || ($ilenazwa<>$ilecena))
		{
			$_SESSION["pustent"] = '<b><font color="blue">Należy uzupełnić pola dot. towaru/usługi: nazwa, j.m., ilość, cena</font></b>';
			header('location:faktury.php');
		}
		else
			{
				if(isset($_SESSION["logidszef"]))
				{
					$logidszef = $_SESSION["logidszef"];
					require_once 'dbconnect.php';
					$nrfaktury=trim($_POST['nrfaktury']);
					$datawyst=trim($_POST['datawyst']);
					$datasprzed=trim($_POST['datasprzed']);
					$nrzamowienia=trim($_POST['nrzamowienia']);
					$platnosc=$_POST['platnosc'];
					$termin=trim($_POST['termin']);
					$zaplacono=str_replace(',', '.', $_POST['zaplacono']);
					$nridnabywcy=$_POST['nridnabywcy'];
					
					$sql="lock tables faktury write;";
					$sql.="insert into faktury (idfaktury, nrfaktury, datawyst, datasprzed, nrzamowienia, platnosc, termin, zaplacono, szef_idszef, nabywca_idnabywca) values (null, '$nrfaktury', '$datawyst', '$datasprzed', '$nrzamowienia', '$platnosc', '$termin', '$zaplacono', '$logidszef', '$nridnabywcy');";
					$sql.="select idfaktury from faktury where (pracownik_szef_idszef = '$logidszef' or szef_idszef = '$logidszef') order by idfaktury desc limit 1;";
					$sql.="unlock tables";
					
					if(mysqli_multi_query($polacz, $sql))
					{
						do
							{
								if($zalogowany=mysqli_store_result($polacz))
								{
									$ostatniafaktura=mysqli_fetch_assoc($zalogowany);
									$idostfakt=$ostatniafaktura['idfaktury'];
								}
							}
						while(@mysqli_next_result($polacz));
										
						$produkt=$_POST['produkt'];
						$jm=$_POST['jm'];
						$ilosc=str_replace(',', '.', $_POST['ilosc']);
						$cena=str_replace(',', '.', $_POST['cena']);
						$vat=$_POST['vat'];
									
						for($i=0; $i<$ilenazwa; $i++)
							{
								mysqli_query($polacz, "insert into towar (idtowar, produkt, jm, ilosc, cena, vat, faktury_idfaktury, towar_idszef) values (null, '$produkt[$i]', '$jm[$i]', '$ilosc[$i]', '$cena[$i]', '$vat[$i]', '$idostfakt', '$logidszef')");	
							}
						header('location:faktury.php');
						unset($_SESSION["nridnabywcy"]);
					}
				}
				elseif(isset($_SESSION["logidprac"]))
				{
					$logidprac = $_SESSION["logidprac"];
					require_once 'dbconnect.php';
					$daneszefa=mysqli_query($polacz, "select szef_idszef from pracownik where idpracownik='$logidprac'");
					$daneidszef=mysqli_fetch_assoc($daneszefa);
					$szef_idszef=$daneidszef['szef_idszef'];
					$nrfaktury=trim($_POST['nrfaktury']);
					$datawyst=trim($_POST['datawyst']);
					$datasprzed=trim($_POST['datasprzed']);
					$nrzamowienia=trim($_POST['nrzamowienia']);
					$platnosc=$_POST['platnosc'];
					$termin=trim($_POST['termin']);
					$zaplacono=str_replace(',', '.', $_POST['zaplacono']);
					$nridnabywcy=$_POST['nridnabywcy'];
					
					mysqli_query($polacz, "insert into faktury (idfaktury, nrfaktury, datawyst, datasprzed, nrzamowienia, platnosc, termin, zaplacono, pracownik_idpracownik, pracownik_szef_idszef, nabywca_idnabywca) values (null, '$nrfaktury', '$datawyst', '$datasprzed', '$nrzamowienia', '$platnosc', '$termin', '$zaplacono', '$logidprac', '$szef_idszef', '$nridnabywcy')");
					
					$zalogowany=mysqli_query($polacz, "select idfaktury from faktury where (pracownik_szef_idszef = '$szef_idszef' or szef_idszef = '$szef_idszef') order by idfaktury desc ");
					$ostatniafaktura=mysqli_fetch_assoc($zalogowany);
					$idostfakt=$ostatniafaktura['idfaktury'];
					
					$produkt=$_POST['produkt'];
					$jm=$_POST['jm'];
					$ilosc=str_replace(',', '.', $_POST['ilosc']);
					$cena=str_replace(',', '.', $_POST['cena']);
					$vat=$_POST['vat'];
					
					for($i=0; $i<$ilenazwa; $i++)
						{
						mysqli_query($polacz, "insert into towar (idtowar, produkt, jm, ilosc, cena, vat, faktury_idfaktury, towar_idszef, towar_idpracownik) values (null, '$produkt[$i]', '$jm[$i]', '$ilosc[$i]', '$cena[$i]', '$vat[$i]', '$idostfakt', '$szef_idszef', '$logidprac')");	
						}
						
					header('location:faktury.php');
					unset($_SESSION["nridnabywcy"]);
				}
			}
?>

