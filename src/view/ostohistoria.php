<?php $this->layout('template', ['title' => 'Ostohistoria']);?>

<h1>Ostohistoria</h1>

<div class='ostohistoria'>
<?php

foreach ($ostohistoria as $osto) {

    $ostoaika = new DateTime($osto['aika']);

    echo "<div>";
    echo "<div>{$ostoaika->format('j.n.Y H:i')}</div>";
    echo "<div>{$osto['nimi']}</div>";
    echo "<div>{$osto['hinta']}€</div>";
    echo "<img src='../tavaranmyynti/public/images/placeholder.png' alt='Placeholder Image'>";
    echo "<form action='tavara' method='GET'>";
    echo "<input type='hidden' name='id' value='{$osto['idtavara']}'>";
    echo "<button type='submit'>Lisätietoja</button>";
    echo "</form>";
    echo "</div>";
}

echo "</div>";
?>