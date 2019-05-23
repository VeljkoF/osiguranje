<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of osiguranja
 *
 * @author Veljko
 */
class Osiguranja {

    public $id_osiguranje;
    public $datum_polise_osiguranje;
    public $id_tip_osiguranja;
    public $datum_pocetka_putovanja_osigutanje;
    public $datum_kraja_putovanja_osigutanje;
    public $broj_dana_putovanja_osiguranja;
    public $konekcija;

//    public function podaci2($id_tip_osiguranja = null) {
//        if ($id_tip_osiguranja != null):
//            $upit = "SELECT * FROM osiguranja
//                    LEFT JOIN osiguranici ON osiguranici.id_osiguranje = osiguranja.id_osiguranje 
//                    WHERE osiguranja.id_osiguranje = :id_osiguranje";
//            $prepare = $this->konekcija->prepare($upit);
//            $prepare->bindParam(":id_osiguranje", $this->$id_osiguranje);
//            try {
//                $prepare->execute();
//                $rezultat = $prepare->fetchAll();
//                return $rezultat;
//            } catch (Exeption $e) {
//                throw $e;
//            }
//        else:
//            $upit = "SELECT * FROM osiguranja
//                    LEFT JOIN osiguranici ON osiguranici.id_osiguranje = osiguranja.id_osiguranje";
//            $prepare = $this->konekcija->prepare($upit);
//            try {
//                $prepare->execute();
//                $rezultat = $prepare->fetchAll();
//                return $rezultat;
//            } catch (Exeption $e) {
//                throw $e;
//            }
//        endif;
//    }

    public function podaci($where = null, $orderby = null) {
        $this->konekcija = new Konekcija();
        $upit = "SELECT * FROM osiguranja
                    LEFT JOIN osiguranici ON osiguranici.id_osiguranje = osiguranja.id_osiguranje 
                    LEFT JOIN tip_osiguranja ON osiguranja.id_tip_osiguranja = tip_osiguranja.id_tip_osiguranja ";
        if ($where != null):
            $upit .= " WHERE ";
            for ($i = 0; $i < count($where); $i++):
                if ($i + 1 == count($where)):
                    foreach ($where[$i] as $kolona => $vrednost):
                        $upit .= " " . $kolona . " = " . $vrednost;
                    endforeach;
                else:
                    foreach ($where[$i] as $kolona => $vrednost):
                        $upit .= " " . $kolona . " = " . $vrednost . " AND ";
                    endforeach;
                endif;

            endfor;
        endif;
        if ($orderby != null):
            $upit .= " ORDER BY ";
            for ($i = 0; $i < count($orderby); $i++):
                if ($i + 1 == count($orderby)):
                    foreach ($orderby[$i] as $kolona => $vrednost):
                        $upit .= " " . $kolona . " " . $vrednost;
                    endforeach;
                else:
                    foreach ($orderby[$i] as $kolona => $vrednost):
                        $upit .= " " . $kolona . " " . $vrednost . ", ";
                    endforeach;
                endif;

            endfor;
        endif;
        $prepare = $this->konekcija->GetKonekcija()->prepare($upit);
        try {
            $prepare->execute();
            $rezultat = $prepare->fetchAll();
            return $rezultat;
        } catch (Exeption $ex) {
            throw $ex;
        }
    }

    public function dodaj() {
        $this->konekcija = new Konekcija();
        $upit = "INSERT INTO osiguranja VALUES ('', :datim_polise, :tip_polise, :datum_pocetka_putovanja, :datum_kraja_putovanja, :broj_dana)";
        $this->konekcija->GetKonekcija()->prepare = $this->konekcija->GetKonekcija()->prepare($upit);
        $this->konekcija->GetKonekcija()->prepare->bindParam(":datim_polise", $this->datum_polise_osiguranje);
        $this->konekcija->GetKonekcija()->prepare->bindParam(":tip_polise", $this->id_tip_osiguranja);
        $this->konekcija->GetKonekcija()->prepare->bindParam(":datum_pocetka_putovanja", $this->datum_pocetka_putovanja_osigutanje);
        $this->konekcija->GetKonekcija()->prepare->bindParam(":datum_kraja_putovanja", $this->datum_kraja_putovanja_osigutanje);
        $this->konekcija->GetKonekcija()->prepare->bindParam(":broj_dana", $this->broj_dana_putovanja_osiguranja);


        try {
            $rezultat = $this->konekcija->GetKonekcija()->prepare->execute();
            return $rezultat;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function lastId() {
        $upit = "SELECT MAX(id_osiguranje) as lastId FROM	osiguranja";
        $prepare = $this->konekcija->GetKonekcija()->prepare($upit);
        try {
            $prepare->execute();
            $rezultat = $prepare->fetchAll();
            return $rezultat;
        } catch (Exeption $ex) {
            throw $ex;
        }
    }

}
