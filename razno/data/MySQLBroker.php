<?php

class MySQLBroker implements IDatabase {

    private $ime_servera;
    private $kor_ime;
    private $lozinka;
    private $ime_baze;
    private $konekcija;

    function __construct($ime_servera, $kor_ime, $lozinka, $ime_baze) {
        $this->ime_servera = $ime_servera;
        $this->kor_ime = $kor_ime;
        $this->lozinka = $lozinka;
        $this->ime_baze = $ime_baze;

//		$this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->dbName);
//		if(mysqli_connect_error()):
//			throw new Exception("Greska u konkeciji sa bazom podataka");
//		endif;

        try {
            $this->konekcija = new PDO("mysql:host=" . $this->ime_servera . ";dbname=" . $this->ime_baze . ";charset=utf8", $this->kor_ime, $this->lozinka);

            $this->konekcija->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->konekcija->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOexception $ex) {
            $ex->getMessage();
        }
    }

//    function __destruct() {
//        if ($this->konekcija != null):
//            mysqli_close($this->konekcija);
//        endif;
//    }

    public function izvrsiUpit($upit) {
        try {
            $rezultat = mysqli_query($this->konekcija, $upit);
            return $rezultat;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function vratiPodatke($upit) {
        try {
            $rezultat = mysqli_query($this->konekcija, $upit);
            while ($red = mysqli_fetch_array($rezultat)) {
                $podaci[] = $red;
            }
            return $podaci;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

}
