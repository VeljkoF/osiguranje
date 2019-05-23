<?php 
	session_start();
	include "inc/konekcija.inc";
	include "data/IDatabase.php";
	include "data/MySQLBroker.php";
	include "logika/student.php";
	
	try{
		$dbServer = new MySQLBroker($ime_servera, $korisnik, $lozinka, $ime_baze);
		$podaci = Student::lista($dbServer);
		
	} catch(Exception $e){
		$poduke[] = $e->gatMessage();
	}
	
	if(isset($_POST['btnUnesi'])){
		$br_index = trim($_POST['tbBrojIndex']);
		$ime = trim($_POST['tbIme']);
		$prezime = trim($_POST['tbPrezime']);
		$email = trim($_POST['tbEmail']);
		$datumRodjenja = $_POST['dpDatumRodjenja'];
		
		$regIndex = "/^[1-9][0-9]{0,3}\/([1][9][7-9][0-9])|([0-9]{2})$/";
		$regIme = "/^[A-Z][a-z]{2,}$/";
		$regPrezime = "/^[A-Z][a-z]{2,}$/";
		$regEmail = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+])*(\.\w{2,3})+$/";
		
		$greska = array();
		
		if(!preg_match($regIndex, $br_index)){
			$greska['index'] = "Pogresan format indeksa studenta";
		}
		if(!preg_match($regIme, $ime)){
			$greska['ime'] = "Ime studenta nije u dobrom formatu";
		}
		if(!preg_match($regPrezime, $prezime)){
			$greska['prezime'] = "Prezime studenta nije u dobrom formatu";
		}
		if(!preg_match($regEmail, $email)){
			$greska['email'] = "Email studenta nije u dobrom formatu";
		}
		if($datumRodjenja == ''){
			$greska['datumRodjenja'] = "Datum rodjenja nije odabran";
		}
		if($greska == null){
		$student = new Student();
		$student->setBr_indexa_student($br_index);
		$student->setIme_student($ime);
		$student->setPrezime_student($prezime);
		$student->setEmail_student($email);
		$student->setGodina_rodjenja_student($datumRodjenja);
		$student->setDbConn($dbServer);
		$proba = $student->unesi();
		
		if($proba == true){
		$_SESSION['poruke'] = "Uspesno ste uneli studenta!";
		}else{
			$_SESSION['poruke'] = "Greska pri upisu u bazu!";
		}
		}
	}
	if(isset($_GET['id'])){
		try{
			$id = $_GET['id'];
			$dbServer = new MySQLBroker($host, $username, $password, $dbName);
			/* $student = new Student();
			$student->setId_student($id);
			$student->setDbConn($dbServer);
			$student->::lista(); */
			$podaci = Student::lista($dbServer, $id);
		
		} catch(Exception $e){
			$poduke[] = $e->gatMessage();
		}
	}
	if(isset($_POST['btnIzmeni'])){
		$id = $_GET['id'];
		$br_index = trim($_POST['tbBrojIndex']);
		$ime = trim($_POST['tbIme']);
		$prezime = trim($_POST['tbPrezime']);
		$email = trim($_POST['tbEmail']);
		$datumRodjenja = $_POST['dpDatumRodjenja'];
		
		$regIndex = "/^[1-9][0-9]{0,3}\/([1][9][7-9][0-9])|([0-9]{2})$/";
		$regIme = "/^[A-Z][a-z]{2,}$/";
		$regPrezime = "/^[A-Z][a-z]{2,}$/";
		$regEmail = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+])*(\.\w{2,3})+$/";
		
		$greska = array();
		$podaci= array();
		
		if(!preg_match($regIndex, $br_index)){
			$greska['index'] = "Pogresan format indeksa studenta";
			$podaci['index'] = $br_index;
		}
		if(!preg_match($regIme, $ime)){
			$greska['ime'] = "Ime studenta nije u dobrom formatu";
			$podaci['ime'] = $ime;
		}
		if(!preg_match($regPrezime, $prezime)){
			$greska['prezime'] = "Prezime studenta nije u dobrom formatu";
			$podaci['prezime'] = $prezime;
		}
		if(!preg_match($regEmail, $email)){
			$greska['email'] = "Email studenta nije u dobrom formatu";
			$podaci['email'] = $email;
		}
		if($datumRodjenja == ''){
			$greska['datumRodjenja'] = "Datum rodjenja nije odabran";
		}
		if($greska == null){
			$student = new Student();
			$student->setId_student($id);
			$student->setBr_indexa_student($br_index);
			$student->setIme_student($ime);
			$student->setPrezime_student($prezime);
			$student->setEmail_student($email);
			$student->setGodina_rodjenja_student($datumRodjenja);
			$student->setDbConn($dbServer);
			$proba = $student->izmeni();
			
			if($proba == true){
			$_SESSION['poruke'] = "Uspesno ste uneli studenta!";
			header("Location: index.php?id=".$id);
			}else{
				$_SESSION['poruke'] = "Greska pri upisu u bazu!";
				header("Location: index.php?id=".$id);
			}
		}
	}
	
?>
<html>
	<head>
	</head>
	<body>
	<?php 
		if(isset($_GET['id'])){
			if(isset($podaci)):
			foreach($podaci as $p):
	?>
	<p><a href="index.php">Nazad</a></p>
	<?php 
		if(isset($_SESSION['poruke'])):
			echo $_SESSION['poruke'];
		endif;
		unset($_SESSION['poruke']);
	?>
				<form action='<?php echo $_SERVER["PHP_SELF"]?>?id=<?php echo $_GET["id"]?>' method='POST'>
				<table>
					<tr>
						<td>Broj indeksa:</td>
						<td>
							<input type='text' id='tbBrojIndex' name='tbBrojIndex' placeholder='000/00' value="<?php echo (isset($podaci['index'])? $podaci['index'] : $p['br_indexa_student'])?>"/>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<?php 
								if(isset($greska['index'])):
									echo $greska['index'];
								endif;
							?>
						</td>
					</tr>
					<tr>
						<td>Ime studenta:</td>
						<td>
							<input type='text' id='tbIme' name='tbIme' placeholder='Milan' value="<?php echo(isset($podaci['ime'])?  $podaci['ime']  : $p['ime_student'])?>"/>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<?php 
								if(isset($greska['ime'])):
									echo $greska['ime'];
								endif;
							?>
						</td>
					</tr>
					<tr>
						<td>Prezime studenta:</td>
						<td>
							<input type='text' id='tbPrezime' name='tbPrezime' placeholder='Milic' value="<?php  echo(isset($podaci['prezime'])?  $podaci['prezime']  :  $p['prezime_student'])?>"/>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<?php 
								if(isset($greska['prezime'])):
									echo $greska['prezime'];
								endif;
							?>
						</td>
					</tr>
					<tr>
						<td>Email studenta:</td>
						<td>
							<input type='text' id='tbEmail' name='tbEmail' placeholder='milan@gmail.com' value="<?php echo(isset($podaci['email'])?  $podaci['email']  : $p['email_student'])?>"/>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<?php 
								if(isset($greska['email'])):
									echo $greska['email'];
								endif;
							?>
						</td>
					</tr>
					<tr>
						<td>Datum rodjenja studenta:</td>
						<td>
							<input type='date' id='dpDatumRodjenja' name='dpDatumRodjenja' value="<?php echo $p['godina_rodjenja_student']?>"/>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<?php 
								if(isset($greska['datumRodjenja'])):
									echo $greska['datumRodjenja'];
								endif;
							?>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type='submit' id='btnIzmeni' name='btnIzmeni' value='Izmeni'/>
						</td>
					</tr>
				</table>
			</form>
		<?php
				endforeach;
			endif;
		}
		else{
	?>
	<?php if(isset($podaci)):?>
			<table>
				<tr>
					<th>Br. indeksa</th>
					<th>Ime</th>
					<th>Prezime</th>
					<th>Email</th>
					<th>Datum rodjenja</th>
					<th>Akcija</th>
				</tr>
				<?php foreach($podaci as $p):?>
				<tr>
					<td><?php echo $p['br_indexa_student']?></td>
					<td><?php echo $p['ime_student']?></td>
					<td><?php echo $p['prezime_student']?></td>
					<td><?php echo $p['email_student']?></td>
					<?php $date = $p['godina_rodjenja_student']; ?>
					<?php $myDate = DateTime::createFromFormat('Y-m-d',  $date);?>
					
					<td><?php echo $myDate->format('d. m. Y.');?></td>
					<td><a href="index.php?id=<?php echo $p['id_student']?>">Izmeni</a> <a href="inc/obrisiStudent.php?id=<?php echo $p['id_student']?>">Obrisi</a></td>
				</tr>
				<?php endforeach;?>
			</table>
		<?php
			endif;
		?>
		<br/>
		<p>
		<?php 
			if(isset($_SESSION['poruke'])):
				/* foreach($_SESSION['poruke'] as $p): */
					echo $_SESSION['poruke'];
					
				/* endforeach; */
			endif;
			unset($_SESSION['poruke']);
		?>
		</p>
		<form action='<?php echo $_SERVER['PHP_SELF']?>' method='POST'>
			<table>
				<tr>
					<td>Broj indeksa:</td>
					<td>
						<input type='text' id='tbBrojIndex' name='tbBrojIndex' placeholder='000/00'/>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<?php 
							if(isset($greska['index'])):
								echo $greska['index'];
							endif;
						?>
					</td>
				</tr>
				<tr>
					<td>Ime studenta:</td>
					<td>
						<input type='text' id='tbIme' name='tbIme' placeholder='Milan'/>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<?php 
							if(isset($greska['ime'])):
								echo $greska['ime'];
							endif;
						?>
					</td>
				</tr>
				<tr>
					<td>Prezime studenta:</td>
					<td>
						<input type='text' id='tbPrezime' name='tbPrezime' placeholder='Milic'/>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<?php 
							if(isset($greska['prezime'])):
								echo $greska['prezime'];
							endif;
						?>
					</td>
				</tr>
				<tr>
					<td>Email studenta:</td>
					<td>
						<input type='text' id='tbEmail' name='tbEmail' placeholder='milan@gmail.com'/>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<?php 
							if(isset($greska['email'])):
								echo $greska['email'];
							endif;
						?>
					</td>
				</tr>
				<tr>
					<td>Datum rodjenja studenta:</td>
					<td>
						<input type='date' id='dpDatumRodjenja' name='dpDatumRodjenja'/>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<?php 
							if(isset($greska['datumRodjenja'])):
								echo $greska['datumRodjenja'];
							endif;
						?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input type='submit' id='btnUnesi' name='btnUnesi' value='Unesi'/>
					</td>
				</tr>
			</table>
		</form>
		<?php }?>
	</body>
</html>
