<?php
session_start();
$ile=0; 	
foreach($_POST['box1'] as $val1)
{	
$ile+=count($val1);	
}
if (!isset($_SESSION["logidszef"]) && !isset($_SESSION["logidprac"]))
	{
		header('location:index.php');
	}
	elseif (!isset($_SESSION["nridnabywcy"]))
		{
			$_SESSION["pusteid"] = '<b><font color="blue">Należy wybrać nabywcę.</font></b>';
			header('location:fakturychbox.php');
		}	
	elseif ($ile<1)
		{
			$_SESSION["pustent"] = '<b><font color="blue">Należy wybrać co najmniej jeden towar / usługę.</font></b>';
			header('location:fakturychbox.php');
		}
		else
			{
				if(isset($_SESSION["logidszef"]))
				{
					$logidszef = $_SESSION["logidszef"];
					require_once 'dbconnect.php';
					$polacz=mysqli_connect($host,$user,$password,$database);
					$nrfaktury=trim($_POST['nrfaktury']);
					$datawyst=trim($_POST['datawyst']);
					$datasprzed=trim($_POST['datasprzed']);
					$nrzamowienia=trim($_POST['nrzamowienia']);
					$platnosc=$_POST['platnosc'];
					$termin=trim($_POST['termin']);
					$zaplacono=str_replace(',', '.', $_POST['zaplacono']);
					$nridnabywcy=$_POST['nridnabywcy'];
					
					mysqli_query($polacz, "insert into faktury (idfaktury, nrfaktury, datawyst, datasprzed, nrzamowienia, platnosc, termin, zaplacono, szef_idszef, nabywca_idnabywca) values (null, '$nrfaktury', '$datawyst', '$datasprzed', '$nrzamowienia', '$platnosc', '$termin', '$zaplacono', '$logidszef', '$nridnabywcy')");
					
					$zalogowany=mysqli_query($polacz, "select idfaktury from faktury where (pracownik_szef_idszef = '$logidszef' or szef_idszef = '$logidszef') order by idfaktury desc ");
					$ostatniafaktura=mysqli_fetch_assoc($zalogowany);
					$idostfakt=$ostatniafaktura['idfaktury'];
					
					$arrn=$_POST["nazwabox"];
					$arrj=$_POST["jmbox"];
					$arri=str_replace(',', '.', $_POST["ilosc"]);
					$arrc=str_replace(',', '.', $_POST["cena"]);
					$arrv=$_POST["vat"];
					
					$arrayid=array_keys($_POST['box1']);
					foreach($arrayid as $idtowar)
					{
						$wart1=$arrn[$idtowar];
						$wart2=$arrj[$idtowar];
						$wart3=$arri[$idtowar];
						$wart4=$arrc[$idtowar];
						$wart5=$arrv[$idtowar];
						mysqli_query($polacz, "insert into towar (idtowar, produkt, jm, ilosc, cena, vat, faktury_idfaktury, towar_idszef) values (null, '$wart1', '$wart2', '$wart3', '$wart4', '$wart5', '$idostfakt', '$logidszef')");	
					}

					header('location:fakturychbox.php');
					unset($_SESSION["nridnabywcy"]);
				}

				elseif(isset($_SESSION["logidprac"]))
				{
					$logidprac = $_SESSION["logidprac"];
					require_once 'dbconnect.php';
					$polacz=mysqli_connect($host,$user,$password,$database);
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
				
					$arrn=$_POST["nazwabox"];
					$arrj=$_POST["jmbox"];
					$arri=str_replace(',', '.', $_POST["ilosc"]);
					$arrc=str_replace(',', '.', $_POST["cena"]);
					$arrv=$_POST["vat"];
					
					$arrayid=array_keys($_POST['box1']);
					foreach($arrayid as $idtowar)
					{
						$wart1=$arrn[$idtowar];
						$wart2=$arrj[$idtowar];
						$wart3=$arri[$idtowar];
						$wart4=$arrc[$idtowar];
						$wart5=$arrv[$idtowar];
						mysqli_query($polacz, "insert into towar (idtowar, produkt, jm, ilosc, cena, vat, faktury_idfaktury, towar_idszef, towar_idpracownik) values (null, '$wart1', '$wart2', '$wart3', '$wart4', '$wart5', '$idostfakt', '$szef_idszef', '$logidprac')");	
					}
					
					header('location:fakturychbox.php');
					unset($_SESSION["nridnabywcy"]);
				}
			}
?>

