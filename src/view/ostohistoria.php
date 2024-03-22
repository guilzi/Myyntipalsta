<?php $this->layout('template', ['title' => 'Ostohistoria']);?>

<h1>Ostohistoria</h1>

<div class='tapahtumat'>
<?php

foreach ($ostohistoria as $osto) {

    $ostoaika = new DateTime($osto['aika']);

    echo "<div>";
    echo "<div>Tuotteen nimi: {$osto['nimi']}</div>";
    echo "<div>Hinta: {$osto['hinta']}€</div>";
    echo "<div>Ostoaika: {$ostoaika->format('j.n.Y')}</div>";
    echo "<div><a href='tavara?id={$osto['idtavara']}'>Lisätietoja</a></div>";
    echo "</div>";
}

echo "</div>";
?>