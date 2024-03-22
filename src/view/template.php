<!DOCTYPE html>
<html lang="fi">
  <head>
    <title>Myyntipalsta - <?=$this->e($title)?></title>
    <meta charset="UTF-8">    
    <link href="styles/styles.css" rel="stylesheet">
  </head>
  <body>
  <header>
      <h1><a href="<?=BASEURL?>">Myyntipalsta</a></h1>
      <div class="profile">
        <?php
          if (isset($_SESSION['user'])) {
            echo "<div>$_SESSION[user]</div>";
            echo "<div><a href='ostohistoria'>Ostohistoria</a></div>";
            echo "<div><a href='logout'>Kirjaudu ulos</a></div>";
          } else {
            echo "<div class='notsigned'><a href='lisaa_tili'>Rekisteröidy nyt</a></div>";
            echo "<div class='notsigned'><a href='kirjaudu'>Kirjaudu</a></div>";
          }
        ?>
      </div>
    </header>
    <section>
      <?=$this->section('content')?>
    </section>
    <footer>
      <hr>
      <div>Seuraa meitä</div>
      <div>Tietoja meistä</div>
      <div>Yhteystiedot</div>
    </footer>
  </body>
</html>