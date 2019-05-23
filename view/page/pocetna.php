
<?php
if (isset($_POST)):
    if (isset($_POST['btnDodaj'])):
        $ime = trim($_POST['tbIme']);
        $prezime = trim($_POST['tbPrezime']);
        $datum_rodjenja = trim($_POST['dtpDatumRodjenja']);
        $broj_pasosa = trim($_POST['tbBrojPasosa']);
        $telefon = trim($_POST['tbTelefon']);
        $email = trim($_POST['tbEmail']);
        $datum_pocetka_putovanja = trim($_POST['dtpDatumPocetkaPutovanja']);
        $datum_zavrsetka_putovanja = trim($_POST['dtpDatumZavrsetkaPutovanja']);
        $vrsta_polise = trim($_POST['ddlVrstaOsiguranja']);

        $regIme = "/^[\p{Lu}][\p{L}]{2,59}$/u";
        $regPrezime = "/^[\p{Lu}][\p{L}]{2,59}$/u";
        $regPrezime = "/^[A-ZŠĐŽĆČ][a-zšđžćč]{2,59}$/u";
        $regDatum = "/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/";
        $regBrojPasosa = "/^[\d]{9}$/";
        $regBrojTelefona = "/^[+]?\d{11,12}$/";
        $regEmail = '/^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/';

        $greske = array();
        $pdf = new MyPDF();

        if ($ime != ""):
            if (!preg_match($regIme, $ime)):
                $greske[] = "U polje za ime nisu uneti ispravno podaci!";
            endif;
        else:
            $greske[] = "Polje za ime mora biti uneto!";
        endif;
        if ($prezime != ""):
            if (!preg_match($regPrezime, $prezime)):
                $greske[] = "U polje za prezime nisu uneti ispravno podaci!";
            endif;
        else:
            $greske[] = "Polje za prezime mora biti uneto!";
        endif;
        if ($datum_rodjenja != ""):
            if (!preg_match($regDatum, $datum_rodjenja)):
                $greske[] = "U polje za datum rodjenja nije ispravno uneto!";
            endif;
        else:
            $greske[] = "Polje za prezime mora biti uneto!";
        endif;
        if ($broj_pasosa != ""):
            if (!preg_match($regBrojPasosa, $broj_pasosa)):
                $greske[] = "U polje za broj pasoša nisu uneti ispravno podaci!";
            endif;
        else:
            $greske[] = "Polje za broj pasoša mora biti uneto!";
        endif;
        if ($telefon != ""):
            if (!preg_match($regBrojTelefona, $telefon)):
                $greske[] = "U polje za broj telefona nisu uneti ispravno podaci!";
            endif;
        else:
            $greske[] = "Polje za broj telefona mora biti uneto!";
        endif;
        if ($email != ""):
            if (!preg_match($regEmail, $email)):
                $greske[] = "U polje za email nisu uneti ispravno podaci!";
            endif;
        else:
            $greske[] = "Polje za email mora biti uneto!";
        endif;
        if ($vrsta_polise == 0):
            $greska[] = "Polje za vrstu polise mora biti izabrano!";
        endif;
        if (isset($_POST['tbImeGrupno']) && isset($_POST['tbPrezimeGrupno']) && isset($_POST['dtpDatumRodjenjaGrupno']) && isset($_POST['tbBrojPasosaGrupno'])):

            $ime_grupno = trim($_POST['tbImeGrupno']);
            $prezime_grupno = trim($_POST['tbPrezimeGrupno']);
            $datum_rodjenja_grupno = trim($_POST['dtpDatumRodjenjaGrupno']);
            $broj_pasosa_grupno = trim($_POST['tbBrojPasosaGrupno']);

            if ($ime_grupno != ""):
                if (!preg_match($regIme, $ime_grupno)):
                    $greske[] = "U polje za ime osobe za grupno osiguranje nisu uneti ispravno podaci1!";
                endif;
            endif;
            if ($prezime_grupno != ""):
                if (!preg_match($regPrezime, $prezime_grupno)):
                    $greske[] = "U polje za prezime osobe za grupno osiguranje nisu uneti ispravno podaci1!";
                endif;
            endif;
            if ($broj_pasosa_grupno != ""):
                if (!preg_match($regBrojPasosa, $broj_pasosa_grupno)):
                    $greske[] = "U polje za broj pasoša osobe za grupno osiguranje nisu uneti ispravno podaci1!";
                endif;
            endif;
        endif;

        if (isset($_POST['tbImeGrupnoDodatak']) && isset($_POST['tbPrezimeGrupnoDodatak']) && isset($_POST['dtpDatumRodjenjaGrupnoDodatak']) && isset($_POST['tbBrojPasosaDodatak'])):

            $imeCountGrupno = count($_POST['tbImeGrupnoDodatak']);
            $prezimeCountGrupno = count($_POST['tbPrezimeGrupnoDodatak']);
            $datumRodjenjaCountGrupno = count($_POST['dtpDatumRodjenjaGrupnoDodatak']);
            $brojPasosaCountGrupno = count($_POST['tbBrojPasosaDodatak']);

            if ($imeCountGrupno == $prezimeCountGrupno && $imeCountGrupno == $brojPasosaCountGrupno && $imeCountGrupno == $datumRodjenjaCountGrupno && $prezimeCountGrupno == $brojPasosaCountGrupno && $prezimeCountGrupno == $datumRodjenjaCountGrupno && $datumRodjenjaCountGrupno == $brojPasosaCountGrupno):
//                var_dump($imeCountGrupno);
                for ($i = 0; $i < $imeCountGrupno; $i++):
                    $ime_grupno_vise = trim($_POST['tbImeGrupnoDodatak'][$i]);
                    $prezime_grupno_vise = trim($_POST['tbPrezimeGrupnoDodatak'][$i]);
                    $datim_rodjenja_grupno_vise = trim($_POST['dtpDatumRodjenjaGrupnoDodatak'][$i]);
                    $broj_pasosa_grupno_vise = trim($_POST['tbBrojPasosaDodatak'][$i]);

                    if (!preg_match($regIme, $ime_grupno_vise)):
                        $greske[] = "U polje za ime osobe " . $ime_grupno_vise . " za grupno osiguranje nisu uneti ispravno podaci!";
                    endif;
                    if (!preg_match($regPrezime, $prezime_grupno_vise)):
                        $greske[] = "U polje za prezime osobe " . $prezime_grupno_vise . " za grupno osiguranje nisu uneti ispravno podaci!";
                    endif;
                    if (!preg_match($regBrojPasosa, $broj_pasosa_grupno_vise)):
                        $greske[] = "U polje za broj pasoša osobe " . $broj_pasosa_grupno_vise . " za grupno osiguranje nisu uneti ispravno podaci!";
                    endif;
                endfor;
            endif;
        endif;

        if (count($greske) == 0):

            $osiguranici = new Osiguranici();
            $osiguranja = new Osiguranja();

            list($year1, $month1, $day1) = explode('-', $datum_pocetka_putovanja);
            list($year2, $month2, $day2) = explode('-', $datum_zavrsetka_putovanja);
            $pocetak_putovanja = mktime(0, 0, 0, $month1, $day1, $year1);
            $zavrsetak_putovanja = mktime(0, 0, 0, $month2, $day2, $year2);

            $broj_dana = $zavrsetak_putovanja - $pocetak_putovanja;

            $broj_dana = floor($broj_dana / (60 * 60 * 24));

            $osiguranja->datum_polise_osiguranje = date('Y-m-d');
            $pdf->datum_polise_osiguranje = date('Y-m-d');
            $osiguranja->id_tip_osiguranja = $vrsta_polise;
            $pdf->id_tip_osiguranja = $vrsta_polise;
            $osiguranja->datum_pocetka_putovanja_osigutanje = $datum_pocetka_putovanja;
            $pdf->datum_pocetka_putovanja_osigutanje = $datum_pocetka_putovanja;
            $osiguranja->datum_kraja_putovanja_osigutanje = $datum_zavrsetka_putovanja;
            $pdf->datum_kraja_putovanja_osigutanje = $datum_zavrsetka_putovanja;
            $osiguranja->broj_dana_putovanja_osiguranja = $broj_dana;
            $pdf->broj_dana_putovanja_osiguranja = $broj_dana;

            $rezultatOsiguranja = $osiguranja->dodaj();
            $last_id = $osiguranja->lastId();

            $osiguranici->ime_osiguranika = $ime;
            $pdf->ime_osiguranika = $ime;
            $osiguranici->prezime_osigranika = $prezime;
            $pdf->prezime_osigranika = $prezime;
            $osiguranici->datum_rodjenja_osiguranika = $datum_rodjenja;
            $pdf->datum_rodjenja_osiguranika = $datum_rodjenja;
            $osiguranici->broj_pasosa_osiguranika = $broj_pasosa;
            $pdf->broj_pasosa_osiguranika = $broj_pasosa;
            $osiguranici->telefon_osiguranika = $telefon;
            $pdf->telefon_osiguranika = $telefon;
            $osiguranici->email_osiguranika = $email;
            $pdf->email_osiguranika = $email;
            $osiguranici->nosilac_osiguranja = 1;
            $pdf->nosilac_osiguranja = 1;
            $osiguranici->id_osiguranje = $last_id[0]->lastId;
            $pdf->id_osiguranje = $last_id[0]->lastId;

            $osiguranici->dodaj();

            if ($vrsta_polise == 2):

                $osiguranici2 = new Osiguranici();

                $osiguranici2->ime_osiguranika = $ime_grupno;
                $osiguranici2->prezime_osigranika = $prezime_grupno;
                $osiguranici2->datum_rodjenja_osiguranika = $datum_rodjenja_grupno;
                $osiguranici2->broj_pasosa_osiguranika = $broj_pasosa_grupno;
                $osiguranici2->broj_pasosa_osiguranika = $broj_pasosa_grupno;
                $osiguranici2->telefon_osiguranika = NULL;
                $osiguranici2->email_osiguranika = NULL;
                $osiguranici2->nosilac_osiguranja = 0;
                $osiguranici2->id_osiguranje = $last_id[0]->lastId;

                $osiguranici2->dodaj();

                if (isset($_POST['tbImeGrupnoDodatak']) && isset($_POST['tbPrezimeGrupnoDodatak']) && isset($_POST['dtpDatumRodjenjaGrupnoDodatak']) && isset($_POST['tbBrojPasosaDodatak'])):

                    $imeCountGrupno = count($_POST['tbImeGrupnoDodatak']);
                    $prezimeCountGrupno = count($_POST['tbPrezimeGrupnoDodatak']);
                    $datumRodjenjaCountGrupno = count($_POST['dtpDatumRodjenjaGrupnoDodatak']);
                    $brojPasosaCountGrupno = count($_POST['tbBrojPasosaDodatak']);
                    if ($imeCountGrupno == $prezimeCountGrupno && $imeCountGrupno == $brojPasosaCountGrupno && $imeCountGrupno == $datumRodjenjaCountGrupno && $prezimeCountGrupno == $brojPasosaCountGrupno && $prezimeCountGrupno == $datumRodjenjaCountGrupno && $datumRodjenjaCountGrupno == $brojPasosaCountGrupno):

                        for ($i = 0; $i < $imeCountGrupno; $i++):
                            $ime_grupno_vise = trim($_POST['tbImeGrupnoDodatak'][$i]);
                            $prezime_grupno_vise = trim($_POST['tbPrezimeGrupnoDodatak'][$i]);
                            $datim_rodjenja_grupno_vise = trim($_POST['dtpDatumRodjenjaGrupnoDodatak'][$i]);
                            $broj_pasosa_grupno_vise = trim($_POST['tbBrojPasosaDodatak'][$i]);

                            $osiguranici3 = new Osiguranici();

                            $osiguranici3->ime_osiguranika = $ime_grupno_vise;
                            $osiguranici3->prezime_osigranika = $prezime_grupno_vise;
                            $osiguranici3->datum_rodjenja_osiguranika = $datim_rodjenja_grupno_vise;
                            $osiguranici3->broj_pasosa_osiguranika = $broj_pasosa_grupno_vise;
                            $osiguranici3->telefon_osiguranika = NULL;
                            $osiguranici3->email_osiguranika = NULL;
                            $osiguranici3->nosilac_osiguranja = 0;
                            $osiguranici3->id_osiguranje = $last_id[0]->lastId;

                            $osiguranici3->dodaj();
                        endfor;
                    endif;
                endif;
            endif;
            echo "<script>alert('Uspesno ste dodali polisu.');</script>";
            $pdf->AliasNbPages();
            $pdf->AddPage('P', 'A4', 0);
            $filename = "./pdf/" . time() . ".pdf";
            $pdf->Output($filename, 'F');
        else:
            $ispisGreske = "Greška:\\n";
            foreach ($greske as $g):
                $ispisGreske .= $g . "\\n";
            endforeach;
            echo "<script>alert('" . $ispisGreske . "\\nPonovite ceo unos!');</script>";
        endif;
    endif;
endif;
?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-9">

            <h1 class="page-header">
                Forma za unos novog osiguranja
            </h1>
            <form method="POST" action="<?php echo $_BASE_URL ?>">
                <table class="table-condensed" style="margin: 0px auto">
                    <tr>
                        <td>Ime: *</td>
                        <td colspan="3">
                            <input type="text" id="tbIme" name="tbIme" size="45" required="true" placeholder="Pera"/>
                        </td>
                    </tr>
                    <tr class="tbImeCss" style="display: none">
                        <td style="padding: 0px 5px"></td>
                        <td colspan="3" style="padding: 0px 5px">
                            <span style= "font-size: 10px"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Prezime: *</td>
                        <td colspan="3">
                            <input type="text" id="tbPrezime" name="tbPrezime" size="45" required="true" placeholder="Petrović"/>
                        </td>
                    </tr>
                    <tr class="tbPrezimeCss" style="display: none">
                        <td style="padding: 0px 5px"></td>
                        <td colspan="3" style="padding: 0px 5px">
                            <span style= "font-size: 10px"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Datum rođenja: *</td>
                        <td colspan="3">
                            <input type="date" id="dtpDatumRodjenja" name="dtpDatumRodjenja" style="width: 350px" required="true" max="<?php echo date("Y-m-d") ?>" onkeydown="return false" data-date-format="DD. MM. YYYY."/>
                        </td>
                    </tr>
                    <tr class="dtpDatimRodjenjaCss" style="display: none">
                        <td style="padding: 0px 5px"></td>
                        <td colspan="3" style="padding: 0px 5px">
                            <span style= "font-size: 10px"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Broj pasoša: *</td>
                        <td colspan="3">
                            <input type="text" id="tbBrojPasosa" name="tbBrojPasosa" size="45" required="true" placeholder="000000000"/>
                        </td>
                    </tr>
                    <tr class="tbBrojPasosaCss" style="display: none">
                        <td style="padding: 0px 5px"></td>
                        <td colspan="3" style="padding: 0px 5px">
                            <span style= "font-size: 10px"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Telefon: *</td>
                        <td colspan="3">
                            <input type="text" id="tbTelefon" name="tbTelefon" size="45" required="true" placeholder="+38163000000(0)"/>
                        </td>
                    </tr>
                    <tr class="tbTelefonCss" style="display: none">
                        <td style="padding: 0px 5px"></td>
                        <td colspan="3" style="padding: 0px 5px">
                            <span style= "font-size: 10px"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Email: *</td>
                        <td colspan="3">
                            <input type="text" id="tbEmail" name="tbEmail" size="45" required="true" placeholder="name@domen.com"/>
                        </td>
                    </tr>
                    <tr class="tbEmailCss" style="display: none">
                        <td style="padding: 0px 5px"></td>
                        <td colspan="3" style="padding: 0px 5px">
                            <span style= "font-size: 10px"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Datum putovanja: *</td>
                        <td>
                            <input type="date" id="dtpDatumPocetkaPutovanja" class="dtpDatumPocetkaPutovanja" name="dtpDatumPocetkaPutovanja" style="width: 150px" required="true" min="<?php echo date("Y-m-d") ?>" onkeydown="return false"/>
                        </td>
                        <td style="text-align: center; width: 40px">DO:</td>
                        <td>
                            <input type="date" id="dtpDatumZavrsetkaPutovanja" class="dtpDatumZavrsetkaPutovanja" name="dtpDatumZavrsetkaPutovanja"  style="width: 150px" required="true" min="<?php echo date("Y-m-d") ?>" max="<?php echo date("Y-m-d") ?>" onkeydown="return false"/>
                        </td>
                    </tr>
                    <tr class="dtpDatumPocetkaPutovanjaCss" style="display: block-inline">
                        <td style="padding: 0px 5px"></td>
                        <td colspan="3" style="padding: 0px 5px">
                            <span style= "font-size: 10px"></span>
                        </td>
                    </tr>
                    <tr class="dtpDatumZavrsetkaPutovanjaCss" style="display: block-inline">
                        <td style="padding: 0px 5px"></td>
                        <td colspan="3" style="padding: 0px 5px">
                            <span style= "font-size: 10px"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Vrsta polise osiguranja: *</td>
                        <td colspan="3">
                            <select style="width: 350px" name="ddlVrstaOsiguranja" class="ddlVrstaOsiguranja" required="true">
                                <option value="0">Izaberi...</option>
                                <?php
                                $tip_osiguranja = new Tip_osiguranja();
                                $tip_osiguranja = $tip_osiguranja->podaci();
                                foreach ($tip_osiguranja as $t):
                                    echo "<option value='" . $t->id_tip_osiguranja . "'>" . $t->naziv_tip_osiguranja . "</option>";
                                endforeach;
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr class="ddlVrstaOsiguranjaCss" style="display: none">
                        <td style="padding: 0px 5px"></td>
                        <td colspan="3" style="padding: 0px 5px">
                            <span style= "font-size: 10px"></span>
                        </td>
                    </tr>
                </table>
                <div class="grupno" style="display: none">
                    <hr>
                    <table class="table-condensed" style="margin: 0px auto">
                        <tr>
                            <td>Ime osobe za grupno osiguranje: *</td>
                            <td colspan="3">
                                <input type="text" id="tbImeGrupno" name="tbImeGrupno" size="45" placeholder="Pera"/>
                            </td>
                        </tr>
                        <tr class="tbImeGrupnoCss" style="display: none">
                            <td style="padding: 0px 5px"></td>
                            <td colspan="3" style="padding: 0px 5px">
                                <span style= "font-size: 10px"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Prezime osobe za grupno osiguranje: *</td>
                            <td colspan="3">
                                <input type="text" id="tbPrezimeGrupno" name="tbPrezimeGrupno" size="45" placeholder="Petrović"/>
                            </td>
                        </tr>
                        <tr class="tbPrezimeGrupnoCss" style="display: none">
                            <td style="padding: 0px 5px"></td>
                            <td colspan="3" style="padding: 0px 5px">
                                <span style= "font-size: 10px"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Datum rođenja osobe za grupno osiguranje: *</td>
                            <td colspan="3">
                                <input type="date" id="dtpDatumRodjenjaGrupno" name="dtpDatumRodjenjaGrupno" style="width: 350px" max="<?php echo date("Y-m-d") ?>" onkeydown="return false"/>
                            </td>
                        </tr>
                        <tr class="dtpDatimRodjenjaGrupnoCss" style="display: none">
                            <td style="padding: 0px 5px"></td>
                            <td colspan="3" style="padding: 0px 5px">
                                <span style= "font-size: 10px"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Broj pasoša osobe za grupno osiguranje: *</td>
                            <td colspan="3">
                                <input type="text" id="tbBrojPasosaGrupno" name="tbBrojPasosaGrupno" size="45" placeholder="000000000"/>
                            </td>
                        </tr>
                        <tr class="tbBrojPasosaGrupnoCss" style="display: none">
                            <td style="padding: 0px 5px"></td>
                            <td colspan="3" style="padding: 0px 5px">
                                <span style= "font-size: 10px"></span>
                            </td>
                        </tr>
                    </table>
                    <table class="table-condensed grupnoTabela" style="margin: 0px auto">
                        <tr>
                            <td colspan="4" style="text-align:center">
                                <input type="button" id="btnDodajUGrupu" name="btnDodajUGrupu" value="Dodaj u grupu" class="btn btn-primary" style="margin: 5px"/>
                            </td>
                        </tr>
                    </table>

                </div>
                <table class="table-condensed" style="margin: 0px auto">
                    <tr>
                        <td colspan="4" style="text-align:center">
                            <input type="submit" id="btnDodaj" name="btnDodaj" value="Dodaj" class="btn btn-primary" style="margin: 10px"/>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <!-- /.row -->
    <hr>