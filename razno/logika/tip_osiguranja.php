<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tip_osiguranja
 *
 * @author Veljko
 */
class Tip_osiguranja {

    private $id_tip_osiguranja;
    private $naziv_tip_osiguranja;
    private $konekcija;

    function __construct() {
        $this->id_tip_osiguranja = 0;
    }

    function getId_tip_osiguranja() {
        return $this->id_tip_osiguranja;
    }

    function getNaziv_tip_osiguranja() {
        return $this->naziv_tip_osiguranja;
    }

    function setNaziv_tip_osiguranja($naziv_tip_osiguranja) {
        $this->naziv_tip_osiguranja = $naziv_tip_osiguranja;
    }

    public function lista($konekcija, $id_tip_osiguranja = null) {
        if ($id_tip_osiguranja != null) {
            $upit = sprintf("SELECT * FROM studenti WHERE id_student=%d", $id_tip_osiguranja);
        } else {
            $upit = sprintf("SELECT * FROM studenti WHERE status_student=%d", 1);
        }
        try {
            return $dbConn->vratiPodatke($upit);
        } catch (Exeption $e) {
            throw $e;
        }
    }

}
