<?php

  require_once HELPERS_DIR . 'DB.php';

  function haeTapahtumat($sortBy = 'newest') {
    $orderBy = ($sortBy == 'oldest') ? 'ASC' : 'DESC';
    return DB::run('SELECT * FROM tavara ORDER BY myy_alkaa ' . $orderBy)->fetchAll();
}

  function lajitteleTapahtumat() {
    return DB::run('SELECT * FROM tavara ORDER BY hita;')->fetchAll();
  }

  function haeTapahtuma($id) {
    return DB::run('SELECT * FROM tavara WHERE idtavara = ?;',[$id])->fetch();
  }
  

?>