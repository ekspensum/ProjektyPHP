<?php
session_start();
require_once 'dbconnect.php';
require_once 'funkcje.php';

if(isset($_POST['ostatniafaktura']))
{
    switch ($_POST['ostatniafaktura']) 
	{
        case '1':
            if (!isset($_SESSION["logidszef"]) && !isset($_SESSION["logidprac"]))
				{
					header('location:index.php');
				}
				else
				{
					if(	isset($_SESSION["logidszef"]))
					{
						$idszef = $_SESSION["logidszef"];
						wydrukrtfoomax($idszef, $polacz);
					}
					elseif(isset($_SESSION["logidprac"]))
					{
						$logidprac = $_SESSION["logidprac"];
						$zalogowany=mysqli_query($polacz, "select idszef, firma.szef_idszef, idpracownik from szef, firma, pracownik where idpracownik = '$logidprac' and idszef=pracownik.szef_idszef and firma.szef_idszef=pracownik.szef_idszef ");
						$danefirmy=mysqli_fetch_assoc($zalogowany);
						$idszef=$danefirmy['idszef'];
						wydrukrtfoomax($idszef, $polacz);
					}
				}
            break;
			
		case '2':
            if (!isset($_SESSION["logidszef"]) && !isset($_SESSION["logidprac"]))
				{
					header('location:index.php');
				}
				else
				{
					if(	isset($_SESSION["logidszef"]))
					{
						$idszef = $_SESSION["logidszef"];
						wydrukrtfwinmax($idszef, $polacz);
					}
					elseif(isset($_SESSION["logidprac"]))
					{
						$logidprac = $_SESSION["logidprac"];
						$zalogowany=mysqli_query($polacz, "select idszef, firma.szef_idszef, idpracownik from szef, firma, pracownik where idpracownik = '$logidprac' and idszef=pracownik.szef_idszef and firma.szef_idszef=pracownik.szef_idszef ");
						$danefirmy=mysqli_fetch_assoc($zalogowany);
						$idszef=$danefirmy['idszef'];
						wydrukrtfwinmax($idszef, $polacz);
					}
				}
            break;
		
		case '3':
            if (!isset($_SESSION["logidszef"]) && !isset($_SESSION["logidprac"]))
				{
					header('location:index.php');
				}
				else
				{
					if(	isset($_SESSION["logidszef"]))
					{
						$idszef = $_SESSION["logidszef"];
						naglowekhtml();
						wydrukhtmloomax($idszef, $polacz);
					}
					elseif(isset($_SESSION["logidprac"]))
					{
						$logidprac = $_SESSION["logidprac"];
						$zalogowany=mysqli_query($polacz, "select idszef, firma.szef_idszef, idpracownik from szef, firma, pracownik where idpracownik = '$logidprac' and idszef=pracownik.szef_idszef and firma.szef_idszef=pracownik.szef_idszef ");
						$danefirmy=mysqli_fetch_assoc($zalogowany);
						$idszef=$danefirmy['idszef'];
						naglowekhtml();
						wydrukhtmloomax($idszef, $polacz);
					}
				}
            break;
        case '4':
            if (!isset($_SESSION["logidszef"]) && !isset($_SESSION["logidprac"]))
				{
					header('location:index.php');
				}
				else
				{
					if(	isset($_SESSION["logidszef"]))
					{
						$idszef = $_SESSION["logidszef"];
						naglowekhtml();
						wydrukhtmlwinmax($idszef, $polacz);
					}
					elseif(isset($_SESSION["logidprac"]))
					{
						$logidprac = $_SESSION["logidprac"];
						$zalogowany=mysqli_query($polacz, "select idszef, firma.szef_idszef, idpracownik from szef, firma, pracownik where idpracownik = '$logidprac' and idszef=pracownik.szef_idszef and firma.szef_idszef=pracownik.szef_idszef ");
						$danefirmy=mysqli_fetch_assoc($zalogowany);
						$idszef=$danefirmy['idszef'];
						naglowekhtml();
						wydrukhtmlwinmax($idszef, $polacz);
					}
				}
            break;
    }
}
elseif(isset($_POST['wybranafaktura']))
{
    switch ($_POST['wybranafaktura']) 
	{
        case '1':
            if (!isset($_SESSION["logidszef"]) && !isset($_SESSION["logidprac"]))
				{
					header('location:index.php');
				}
				else
				{
					if(	isset($_SESSION["logidszef"]))
					{
						$idszef = $_SESSION["logidszef"];
						header('Content-type: application/vnd.oasis.opendocument.text-master');
						header('Content-Disposition: inline; filename=faktura1.rtf');
						$nridfaktury=$_SESSION['nridfaktury'];
						wydrukrtf($idszef, $polacz, $nridfaktury);
					}
					elseif(isset($_SESSION["logidprac"]))
					{
						$logidprac = $_SESSION["logidprac"];
						$zalogowany=mysqli_query($polacz, "select idszef, firma.szef_idszef, idpracownik from szef, firma, pracownik where idpracownik = '$logidprac' and idszef=pracownik.szef_idszef and firma.szef_idszef=pracownik.szef_idszef ");
						$danefirmy=mysqli_fetch_assoc($zalogowany);
						$idszef=$danefirmy['idszef'];
						header('Content-type: application/vnd.oasis.opendocument.text-master');
						header('Content-Disposition: inline; filename=faktura1.rtf');
						$nridfaktury=$_SESSION['nridfaktury'];
						wydrukrtf($idszef, $polacz, $nridfaktury);
					}
				}
            break;
			
		case '2':
            if (!isset($_SESSION["logidszef"]) && !isset($_SESSION["logidprac"]))
				{
					header('location:index.php');
				}
				else
				{
					if(	isset($_SESSION["logidszef"]))
					{
						$idszef = $_SESSION["logidszef"];
						header('Content-type: application/msword');
						header('Content-Disposition: inline; filename=faktura1.rtf');
						$nridfaktury=$_SESSION['nridfaktury'];
						wydrukrtf($idszef, $polacz, $nridfaktury);
					}
					elseif(isset($_SESSION["logidprac"]))
					{
						$logidprac = $_SESSION["logidprac"];
						$zalogowany=mysqli_query($polacz, "select idszef, firma.szef_idszef, idpracownik from szef, firma, pracownik where idpracownik = '$logidprac' and idszef=pracownik.szef_idszef and firma.szef_idszef=pracownik.szef_idszef ");
						$danefirmy=mysqli_fetch_assoc($zalogowany);
						$idszef=$danefirmy['idszef'];
						header('Content-type: application/msword');
						header('Content-Disposition: inline; filename=faktura1.rtf');
						$nridfaktury=$_SESSION['nridfaktury'];
						wydrukrtf($idszef, $polacz, $nridfaktury);
					}
				}
            break;
		
		case '3':
            if (!isset($_SESSION["logidszef"]) && !isset($_SESSION["logidprac"]))
				{
					header('location:index.php');
				}
				else
				{
					if(	isset($_SESSION["logidszef"]))
					{
						$idszef = $_SESSION["logidszef"];
						naglowekhtml();
						header('Content-type: application/vnd.oasis.opendocument.text-web');
						header('Content-Disposition: inline; filename=faktura1.html');
						echo '<br/><br/><br/>';
						$nazwa_pliku = 'faktura.html';
						$wyswietl = file_get_contents($nazwa_pliku);
						$nridfaktury=$_SESSION['nridfaktury'];
						$danefaktury=mysqli_query($polacz, "select * from faktury, nabywca, firma where idfaktury='$nridfaktury' and nabywca_idnabywca=idnabywca and firma.szef_idszef='$idszef'");
						danehtmlfaktury($polacz, $danefaktury, $nridfaktury);
					}
					elseif(isset($_SESSION["logidprac"]))
					{
						$logidprac = $_SESSION["logidprac"];
						$zalogowany=mysqli_query($polacz, "select idszef, firma.szef_idszef, idpracownik from szef, firma, pracownik where idpracownik = '$logidprac' and idszef=pracownik.szef_idszef and firma.szef_idszef=pracownik.szef_idszef ");
						$danefirmy=mysqli_fetch_assoc($zalogowany);
						$idszef=$danefirmy['idszef'];
						naglowekhtml();
						header('Content-type: application/vnd.oasis.opendocument.text-web');
						header('Content-Disposition: inline; filename=faktura1.html');
						echo '<br/><br/><br/>';
						$nazwa_pliku = 'faktura.html';
						$wyswietl = file_get_contents($nazwa_pliku);
						$nridfaktury=$_SESSION['nridfaktury'];
						$danefaktury=mysqli_query($polacz, "select * from faktury, nabywca, firma where idfaktury='$nridfaktury' and nabywca_idnabywca=idnabywca and firma.szef_idszef='$idszef'");
						danehtmlfaktury($polacz, $danefaktury, $nridfaktury);
					}
				}
            break;
        case '4':
            if (!isset($_SESSION["logidszef"]) && !isset($_SESSION["logidprac"]))
				{
					header('location:index.php');
				}
				else
				{
					if(	isset($_SESSION["logidszef"]))
					{
						$idszef = $_SESSION["logidszef"];
						naglowekhtml();
						header('Content-type: application/msword');
						header('Content-Disposition: inline; filename=faktura1.html');
						echo '<br/><br/><br/>';
						$nazwa_pliku = 'faktura.html';
						$wyswietl = file_get_contents($nazwa_pliku);
						$nridfaktury=$_SESSION['nridfaktury'];
						$danefaktury=mysqli_query($polacz, "select * from faktury, nabywca, firma where idfaktury='$nridfaktury' and nabywca_idnabywca=idnabywca and firma.szef_idszef='$idszef'");
						danehtmlfaktury($polacz, $danefaktury, $nridfaktury);
					}
					elseif(isset($_SESSION["logidprac"]))
					{
						$logidprac = $_SESSION["logidprac"];
						$zalogowany=mysqli_query($polacz, "select idszef, firma.szef_idszef, idpracownik from szef, firma, pracownik where idpracownik = '$logidprac' and idszef=pracownik.szef_idszef and firma.szef_idszef=pracownik.szef_idszef ");
						$danefirmy=mysqli_fetch_assoc($zalogowany);
						$idszef=$danefirmy['idszef'];
						naglowekhtml();
						header('Content-type: application/msword');
						header('Content-Disposition: inline; filename=faktura1.html');
						echo '<br/><br/><br/>';
						$nazwa_pliku = 'faktura.html';
						$wyswietl = file_get_contents($nazwa_pliku);
						$nridfaktury=$_SESSION['nridfaktury'];
						$danefaktury=mysqli_query($polacz, "select * from faktury, nabywca, firma where idfaktury='$nridfaktury' and nabywca_idnabywca=idnabywca and firma.szef_idszef='$idszef'");
						danehtmlfaktury($polacz, $danefaktury, $nridfaktury);
					}
				}
            break;
    }
}
elseif(empty($_POST['system']))
{
	header('location: faktury.php');
}
else
{
	header('location: index.php');
}
?>