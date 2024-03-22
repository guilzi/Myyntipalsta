<?php

  require_once HELPERS_DIR . 'DB.php';

  function haeTapahtumat() {
    return DB::run('SELECT * FROM tavara ORDER BY myy_alkaa;')->fetchAll();
  }

  function lajitteleTapahtumat() {
    return DB::run('SELECT * FROM tavara ORDER BY hita;')->fetchAll();
  }

  function haeTapahtuma($id) {
    return DB::run('SELECT * FROM tavara WHERE idtavara = ?;',[$id])->fetch();
  }

?>