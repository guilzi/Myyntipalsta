<?php $this->layout('template', ['title' => $tavara['nimi']]) ?>

<?php
  $start = new DateTime($tavara['myy_alkaa']);
?>

<div><?=$start->format('j.n.Y G:i')?></div>
<h1><?=$tavara['nimi']?></h1>
<div class='hinta'><?= $tavara['hinta'] ?>€</div>
<img src='../tavaranmyynti/public/images/placeholder.png' alt='Placeholder Image'>
<div><?=$tavara['kuvaus']?></div>

<?php
  if ($loggeduser) {
    if (!$osto) {
      echo "<div class='flexarea'><a href='osto?id=$tavara[idtavara]' class='button'>Osta nyt</a></div>";    
    } else {
      echo "<div class='flexarea'>";
      echo "<div>Kiitos ostoksestasi!</div>";
      echo "<a href='peru?id=$tavara[idtavara]' class='button'>PERUUTA OSTO</a>";
      echo "</div>";
    }
  }
?>