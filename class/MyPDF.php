<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MyPDF
 *
 * @author Test
 */
//require_once './classes/fpdf/fpdf.php';
require_once './class/tfpdf/tfpdf.php';

class MyPDF extends tFPDF {
    
    public $datum_polise_osiguranje;
    public $id_tip_osiguranja;
    public $datum_pocetka_putovanja_osigutanje;
    public $datum_kraja_putovanja_osigutanje ;
    public $broj_dana_putovanja_osiguranja;
    public $ime_osiguranika;
    public $prezime_osigranika;
    public $datum_rodjenja_osiguranika;
    public $broj_pasosa_osiguranika;
    public $telefon_osiguranika;
    public $email_osiguranika;
    public $nosilac_osiguranja;
    public $id_osiguranje;  
   
    
    function header() {
        $this->AddFont('Times', '', 'times.ttf', true);
	$this->SetFont('Times', '', 29);
	$this->Ln(59);
	$this->Cell(0, 0, 'POLISA OSIGURANJA', 0, 0, 'C');
	$this->Ln(12);
	$this->SetFont('Times', '', 27);
	$this->Cell(0, 0, $this->ime_osiguranika . " " . $this->prezime_osigranika, 0, 0, 'C');
	$this->Ln(9);
	$this->SetFont('Times', '', 17);
	$this->Cell(0, 0, 'nosilac polise', 0, 0, 'C');
        $this->Ln(12);
	$this->SetFont('Times', '', 17);
	$this->Cell(0, 0, 'Broj pasoša: '.$this->broj_pasosa_osiguranika, 0, 0, 'C');
        $this->Ln(12);
	$this->SetFont('Times', '', 17);
	$this->Cell(0, 0, 'Broj polise: '. $this->id_osiguranje, 0, 0, 'C');
        $this->Ln(12);
	$this->SetFont('Times', '', 17);
        list($year1, $month1, $day1) = explode('-', $this->datum_polise_osiguranje);
        $mktime1 = mktime(0, 0, 0, $month1, $day1, $year1);
        $datum_polise_osiguranje = date('d. m. Y.', $mktime1);
	$this->Cell(0, 0, 'Datum izdavanja polise: '. $datum_polise_osiguranje, 0, 0, 'C');
        if($this->id_tip_osiguranja == 1):
            $naziv_tipa_osiguranja = "Individalna polisa";
        
            $this->Ln(12);
            $this->SetFont('Times', '', 17);
            $this->Cell(0, 0, 'Tip osiguranja: '.$naziv_tipa_osiguranja, 0, 0, 'C');
        elseif($this->id_tip_osiguranja == 2):
            $naziv_tipa_osiguranja = "Grupna polisa";
            $this->Ln(12);
            $this->SetFont('Times', '', 17);
            $this->Cell(0, 0, 'Tip osiguranja: '.$naziv_tipa_osiguranja, 0, 0, 'C');
        endif;
        $this->Ln(12);
	$this->SetFont('Times', '', 17);
        list($year2, $month2, $day2) = explode('-', $this->datum_pocetka_putovanja_osigutanje);
        $mktime2 = mktime(0, 0, 0, $month2, $day2, $year2);
        $datum_poceta_putovanja_osiguranje = date('d. m. Y.', $mktime2);
	$this->Cell(0, 0, 'Datum početka putovanja: '. $datum_poceta_putovanja_osiguranje, 0, 0, 'C');
        $this->Ln(12);
	$this->SetFont('Times', '', 17);
        list($year3, $month3, $day3) = explode('-', $this->datum_kraja_putovanja_osigutanje);
        $mktime3 = mktime(0, 0, 0, $month3, $day3, $year3);
        $datum_kraja_putovanja_osiguranje = date('d. m. Y.', $mktime3);
	$this->Cell(0, 0, 'Datum kraja putovanja: '. $datum_kraja_putovanja_osiguranje, 0, 0, 'C');
    }

    function footer() {
	$this->Ln(70);
	$this->SetFont('Times', '', 15);
	$this->Cell(0, 0, 'OSIGURAVAJUĆA KUĆA            ', 0, 0, 'R');
	$this->Ln(6);
	$this->SetFont('Times', '', 15);
	$this->Cell(0, 0, 'M.P.', 0, 0, 'C');
	$this->Ln(10);
	$this->SetFont('Times', '', 18);
	$this->Cell(0, 0, '_____________________       ', 0, 0, 'R');
    }

}
