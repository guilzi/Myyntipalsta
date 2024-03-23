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


//Lisätään funktio noutamaan ostohistoriaan tarvitsevat tiedot.
function ostoHistoria($idhenkilo) {
    $stmt = DB::run('SELECT osto.*, tavara.nimi, tavara.hinta 
                     FROM osto 
                     INNER JOIN tavara ON osto.idtavara = tavara.idtavara 
                     WHERE idhenkilo = ?
                     ORDER BY aika DESC', 
                     [$idhenkilo]);
    return $stmt->fetchAll();
}

function poistaIlmoittautuminen($idhenkilo, $idtavara) {
    return DB::run('DELETE FROM osto  WHERE idhenkilo = ? AND idtavara = ?',
                   [$idhenkilo, $idtavara])->rowCount();
}

?>