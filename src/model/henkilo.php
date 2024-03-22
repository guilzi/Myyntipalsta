<?php

  require_once HELPERS_DIR . 'DB.php';

function lisaaHenkilo($nimi,$puhnro,$email,$discord,$salasana) {
    DB::run('INSERT INTO henkilo (nimi, puhnro, email, discord, salasana) VALUE  (?,?,?,?,?);',[$nimi,$puhnro,$email,$discord,$salasana]);
    return DB::lastInsertId();
}

function haeHenkiloSahkopostilla($email) {
  return DB::run('SELECT * FROM henkilo WHERE email = ?;', [$email])->fetchAll();
}

function haeHenkilo($email) {
  return DB::run('SELECT * FROM henkilo WHERE email = ?;', [$email])->fetch();
}

//Lisätään myös puhelinnumero, jotta ei tulisi 
//samaa puhelinnumeroa useammalle tilille
function haeHenkiloPuhelinnumerolla($puhnro) {
  return DB::run('SELECT * FROM henkilo WHERE puhnro = ?;', [$puhnro])->fetchAll();
}

?>