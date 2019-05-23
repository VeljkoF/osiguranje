<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tip_podataka
 *
 * @author Veljko
 */


class Tip_osiguranja {

    public $id_tip_osiguranja;
    public $naziv_tip_osiguranja;
    public $konekcija;

    public function podaci($id_tip_osiguranja = null) {
        $this->konekcija = new Konekcija();
        if ($id_tip_osiguranja != null):
            $upit = "SELECT * FROM tip_osiguranja WHERE tip_osiguranja.id_tip_osiguranja = :id_tip_osiguranja";
            $prepare = $this->konekcija->GetKonekcija()->prepare($upit);
            $prepare->bindParam(":id_tip_osiguranja", $this->id_tip_osiguranja);
            try {
                $prepare->execute();
                $rezultat = $prepare->fetchAll();
                return $rezultat;
            } catch (Exeption $e) {
                throw $e;
            }
        else:
            $upit = "SELECT * FROM tip_osiguranja";
            $prepare = $this->konekcija->GetKonekcija()->prepare($upit);
            try {
                $prepare->execute();
                $rezultat = $prepare->fetchAll();
                return $rezultat;
            } catch (Exeption $e) {
                throw $e;
            }
        endif;
    }

}
