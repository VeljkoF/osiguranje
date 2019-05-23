<?php

class Student{
	private $id_student;
	private $br_indexa_student;
	private $ime_student;
	private $prezime_student;
	private $email_student;
	private $godina_rodjenja_student;
	private $dbConn;
	
	function __construct(){
		$this->id_student = 0;
	}
	
	function getId_student(){
		return $this->id_student;
	}
	function setId_student($id){
		$this->id_student = $id;
	}
	function getBr_indexa_student(){
		return $this->br_indexa_student;
	}
	function setBr_indexa_student($br_index){
		$this->br_indexa_student = $br_index;
	}
	function getIme_student(){
		return $this->ime_student;
	}
	function setIme_student($ime){
		$this->ime_student = $ime;
	}
	function getPrezime_student(){
		return $this->prezime_student;
	}
	function setPrezime_student($prezime){
		$this->prezime_student = $prezime;
	}
	function getEmail_student(){
		return $this->email_student;
	}
	function setEmail_student($email){
		$this->email_student = $email;
	}
	function getGodina_rodjenja_student(){
		return $this->godina_rodjenja_student;
	}
	function setGodina_rodjenja_student($godina_rodjenja){
		$this->godina_rodjenja_student = $godina_rodjenja;
	}
	function setDbConn($dbConn){
		$this->dbConn = $dbConn;
	}
	
	public function unesi(){
		if($this->dbConn != null):
			try{
				$upit =  sprintf("INSERT INTO studenti(br_indexa_student, ime_student, prezime_student, email_student, godina_rodjenja_student, status_student) VALUES ('%s', '%s', '%s', '%s', '%s', %d)", $this->br_indexa_student, $this->ime_student, $this->prezime_student, $this->email_student, $this->godina_rodjenja_student, 1);
				return $this->dbConn->izvrsiUpit($upit);
			}catch(Exeption $e){
				throw $e;
			}
		else:
			return false;
		endif;
	}
	
	public function obrisi(){
		if($this->dbConn != null){
			try{
			$upit = sprintf("UPDATE studenti SET status_student = %d WHERE id_student = %d", 0, $this->id_student);
			return $this->dbConn->izvrsiUpit($upit);
			}
			catch(Exeption $e){
				throw $e;
			}
		}
	}
	public function izmeni(){
		if($this->dbConn != null):
			try{
				$upit =  sprintf("UPDATE studenti SET br_indexa_student = '%s', ime_student = '%s', prezime_student = '%s', email_student = '%s', godina_rodjenja_student = '%s' WHERE id_student = %d", $this->br_indexa_student, $this->ime_student, $this->prezime_student, $this->email_student, $this->godina_rodjenja_student, $this->id_student);
				return $this->dbConn->izvrsiUpit($upit);
			}catch(Exeption $e){
				throw $e;
			}
		else:
			return false;
		endif;
	}
	
	public function lista($dbConn, $id = null){
		if($id != null){
			$upit = sprintf("SELECT * FROM studenti WHERE id_student=%d", $id);
		}
		else{
			$upit = sprintf("SELECT * FROM studenti WHERE status_student=%d", 1);
		}
		try{
			return $dbConn->vratiPodatke($upit);
		}catch(Exeption $e){
			throw $e;
		}
	}
	
	
}