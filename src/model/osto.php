<?php

  require_once HELPERS_DIR . 'DB.php';

  function haeIlmoittautuminen($idhenkilo,$idtavara) {
    return DB::run('SELECT * FROM osto WHERE idhenkilo = ? AND idtavara = ?',
                   [$idhenkilo, $idtavara])->fetchAll();
  }

  function lisaaIlmoittautuminen($idhenkilo,$idtavara) {
    DB::run('INSERT INTO osto (idhenkilo, idtavara) VALUE (?,?)',
            [$idhenkilo, $idtavara]);
    return DB::lastInsertId();
  }

  function poistaIlmoittautuminen($idhenkilo, $idtavara) {
    return DB::run('DELETE FROM osto  WHERE idhenkilo = ? AND idtavara = ?',
                   [$idhenkilo, $idtavara])->rowCount();
  }

?>