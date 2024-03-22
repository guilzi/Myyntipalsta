<?php $this->layout('template', ['title' => 'Myynnissä nyt']) ?>

<h1>Myynnissä nyt</h1>

<div class='tapahtumat'>
<?php

foreach ($tavarat as $tavara) {

  $start = new DateTime($tavara['myy_alkaa']);

  echo "<div>";
    echo "<div>$tavara[nimi]</div>";
    echo "<div>" . $start->format('j.n.Y') .  "</div>";
    echo "<div><a href='tavara?id=" . $tavara['idtavara'] . "'>TIEDOT</a></div>";
  echo "</div>";

}

?>
</div>