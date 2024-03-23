<?php $this->layout('template', ['title' => 'Myynnissä nyt']) ?>

<h1>Myynnissä nyt</h1>

<div class='lajittelu'>
  <p>Lajittele:</p><br>
<a href="?sort=newest" <?php if ($sortBy == 'newest') echo 'class="active"' ?>>Uusimmat</a>
<a href="?sort=oldest" <?php if ($sortBy == 'oldest') echo 'class="active"' ?>>Vanhimmat</a>
</div>

<div class='tapahtumat'>
    <?php foreach ($tavarat as $tavara): ?>
        <?php $start = new DateTime($tavara['myy_alkaa']); ?>
        <a href='tavara?id=<?= $tavara['idtavara'] ?>' class='tapahtuma'>
            <div class='tapahtuma-content'>
                <div class='left-content'>
                    <div class='tuote'><?= $tavara['nimi'] ?></div>
                    <div class='pvm'><?= $start->format('j.n.Y') ?></div>
                    <div class='hinta'><?= $tavara['hinta'] ?>€</div>
                </div>
                <div class='kuva2'><img src="../tavaranmyynti/public/images/placeholder.png" alt="Placeholder Image"></div>
            </div>
        </a>
    <?php endforeach; ?>
</div>