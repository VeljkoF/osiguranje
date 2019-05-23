<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of konekcija
 *
 * @author Veljko
 */
$_BASE_URL = 'http://localhost/osiguranje/';
class Konekcija {

    private $ime_servera = 'localhost';
    private $kor_ime = 'root';
    private $lozinka = '';
    private $ime_baze = 'osiguranje';
    private $konekcija;
    
    function GetKonekcija(){
        return $this->konekcija;
    }

    function __construct() {
        try {
            $this->konekcija = new PDO("mysql:host=" . $this->ime_servera . ";dbname=" . $this->ime_baze . ";charset=utf8", $this->kor_ime, $this->lozinka);

            $this->konekcija->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->konekcija->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOexception $ex) {
            $ex->getMessage();
        }
    }
}
