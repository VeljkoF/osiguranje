<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of osiguranici
 *
 * @author Veljko
 */

class Osiguranici {

    public $id_osiguranika;
    public $ime_osiguranika;
    public $prezime_osigranika;
    public $datum_rodjenja_osiguranika;
    public $broj_pasosa_osiguranika;
    public $telefon_osiguranika;
    public $email_osiguranika;
    public $nosilac_osiguranja;
    public $id_osiguranje;
    public $konekcija;

//    public function podaci2($where = null) {
//        if ($id_osiguranika != null):
//            $upit = "SELECT * FROM osiguranici
//                    LEFT JOIN osiguranja ON osiguranja.id_osiguranik = osiguranici.id_osiguranika  WHERE osiguranici.id_osiguranika = :id_osiguranika";
//            $data = array(':id_osiguranika' => $id_osiguranika);
//            try {
//                return $this->vratiPodatke($upit, $data);
//            } catch (Exeption $e) {
//                throw $e;
//            }
//        else:
//            $upit = "SELECT * FROM osiguranici";
//            try {
//                return $this->vratiPodatke($upit);
//            } catch (Exeption $e) {
//                throw $e;
//            }
//        endif;
//    }

    public function podaci($where = null) {
        $this->konekcija = new Konekcija();
        $upit = "SELECT * FROM osiguranici
                    LEFT JOIN osiguranja ON osiguranja.id_osiguranik = osiguranici.id_osiguranika ";
        if ($where != null):
            $upit .= " WHERE ";
            for ($i = 0; $i < count($where); $i++):
                if ($i+1 == count($where)):
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
        $prepare = $this->konekcija->GetKonekcija()->prepare($upit);
        try {
            $prepare->execute();
            $rezultat = $prepare->fetchAll();
            return $rezultat;
        } catch (Exeption $e) {
            throw $e;
        }
    }
    
    public function dodaj() {
        $this->konekcija = new Konekcija();
        $upit = "INSERT INTO osiguranici VALUES ('', :ime, :prezime, :datum_rodjenja, :broj_pasosa, :telefon, :email, :nosilac_osiguranja, :id_osiguranja)";
        $this->konekcija->GetKonekcija()->prepare = $this->konekcija->GetKonekcija()->prepare($upit);
        $this->konekcija->GetKonekcija()->prepare->bindParam(":ime", $this->ime_osiguranika);
        $this->konekcija->GetKonekcija()->prepare->bindParam(":prezime", $this->prezime_osigranika);
        $this->konekcija->GetKonekcija()->prepare->bindParam(":datum_rodjenja", $this->datum_rodjenja_osiguranika);
        $this->konekcija->GetKonekcija()->prepare->bindParam(":broj_pasosa", $this->broj_pasosa_osiguranika);
        $this->konekcija->GetKonekcija()->prepare->bindParam(":telefon", $this->telefon_osiguranika);
        $this->konekcija->GetKonekcija()->prepare->bindParam(":email", $this->email_osiguranika);
        $this->konekcija->GetKonekcija()->prepare->bindParam(":nosilac_osiguranja", $this->nosilac_osiguranja);
        $this->konekcija->GetKonekcija()->prepare->bindParam(":id_osiguranja", $this->id_osiguranje);
        
        try {
            $rezultat = $this->konekcija->GetKonekcija()->prepare->execute();
            return $rezultat;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
