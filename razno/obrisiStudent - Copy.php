<?php 
	session_start();
	include "konekcija.inc";
	include "../data/IDatabase.php";
	include "../data/MySQLBroker.php";
	include "../logika/student.php";
	
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$dbServer = new MySQLBroker($host, $username, $password, $dbName);
		$student = new Student();
		$student->setId_student($id);
		$student->setDbConn($dbServer);
		$student->obrisi();
		$_SESSION['poruke'] = "Uspesno ste obrisali studenta";
		header("Location:../index.php");
	}
	else{
		$_SESSION['poruke'] = "Greska pri obrisanju studenta";
		header("Location:../index.php");
	}
?>