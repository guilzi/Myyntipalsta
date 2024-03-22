<?php $this->layout('template', ['title' => $tapahtuma['nimi']]) ?>

<?php
  $start = new DateTime($tavara['myy_alkaa']);
?>

<div><?=$start->format('j.n.Y G:i')?></div>
<h1><?=$tavara['nimi']?></h1>
<div><?=$tavara['kuvaus']?></div>