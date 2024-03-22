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
    </header>
    <section>
      <?=$this->section('content')?>
    </section>
    <footer>
      <hr>
      <div>Myyntipalsta by Yes</div>
    </footer>
  </body>
</html>