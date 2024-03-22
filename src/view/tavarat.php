<?php $this->layout('template', ['title' => 'Myynnissä nyt']) ?>

<h1>Myynnissä nyt</h1>

<div class='tapahtumat'>
<?php foreach ($tavarat as $tavara): ?>
  <?php $start = new DateTime($tavara['myy_alkaa']); ?>
  <a href='tavara?id=<?= $tavara['idtavara'] ?>' class='tapahtuma'>
      <div>
          <div class='tuote'><?= $tavara['nimi'] ?></div>
          <div class='pvm'><?= $start->format('j.n.Y') ?></div>
          <div class='hinta'><?= $tavara['hinta'] ?>€</div>
          <img src='../tavaranmyynti/public/images/placeholder.png' alt='Placeholder Image'>
      </div>
  </a>
<?php endforeach; ?>
</div>