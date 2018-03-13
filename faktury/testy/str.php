
<?php
$transport = array('stopa', 'rower', 'samochód', 'samolot');
$tryb = current($transport); // $tryb = 'stopa';
$tryb = next($transport);    // $tryb = 'rower';
$tryb = next($transport);    // $tryb = 'samochód';
//$tryb = prev($transport);    // $tryb = 'rower';
//$tryb = end($transport);     // $tryb = 'samolot';
echo $tryb;
?>

<br/>

<?php

$tablica = array('krok pierwszy', 'krok drugi', 'krok trzeci', 'krok czwarty');

// domyślnie, wskażnik jest na pierwszym elemencie
echo current($tablica) . "<br />\n"; // "krok pierwszy"

// przeskocz dwa kroki
next($tablica);
next($tablica);
echo current($tablica) . "<br />\n"; // "krok trzeci"

// zresetuj wskaźnik, zacznik od nowa na pierwszym kroku
reset($tablica);
echo current($tablica) . "<br />\n"; // "krok pierwszy"

?>

<br/>

<?php

function silnia($liczba)
{
   if($liczba < 2) 
      return 1;
   else
      return $liczba*silnia($liczba-1);  
}

echo silnia(5);

?>
<form action="?akcja=kasowanie" method="post">
<input type="hidden" name="id" value="1" />
<p>Czy na pewno chcesz to zrobić?</p>
<input type="submit" name="potwierdzenie" value="Tak" />
<input type="submit" name="potwierdzenie" value="Nie" />
</form>

<form action="mailto:e-mail" method="post">
<input type="submit" name="opcja" value="Opcja 1" />
<input type="submit" name="opcja" value="Opcja 2" />
<input type="submit" name="opcja" value="Opcja 3" />
</form>