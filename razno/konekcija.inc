<?php

$ime_servera = "localhost";
$korisnik = "root";
$lozinka = "";
$ime_baze = "osiguranje";

try {
    $konekcija = new PDO("mysql:host=" . $ime_servera . ";dbname=" . $ime_baze . ";charset=utf8", $kor_ime, $lozinka);

    $konekcija->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $konekcija->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOexception $ex) {
    $ex->getMessage();
}

?>