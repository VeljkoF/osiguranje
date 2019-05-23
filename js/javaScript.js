$(document).ready(function () {
    $greske = [];
    $(window).load(function () {
        $greske['vrsta_osiguranja'] = 'Polje za vrstu polise mora biti izabrano!';
    });
    $(document).on('change', ".ddlVrstaOsiguranja", function () {
        $ddlVrstaOsiguranjaPolje = $(".ddlVrstaOsiguranja");
        $ddlVrstaOsiguranja = $(".ddlVrstaOsiguranja").find(":selected").val();
        if ($ddlVrstaOsiguranja == 2) {
            $(".grupno").css('display', 'block');
            $("#tbImeGrupno").prop('required', true);
            $("#tbPrezimeGrupno").prop('required', true);
            $("#dtpDatumRodjenjaGrupno").prop('required', true);
            $("#tbBrojPasosaGrupno").prop('required', true);
            $ddlVrstaOsiguranjaPolje.css('border', '1px solid #ccc');
            $(".ddlVrstaOsiguranjaCss").css('display', 'none');
            $(".ddlVrstaOsiguranjaCss span").text("");
//            $greske.push({vrsta_osiguranja: 'Morate uneti osobu za grupno osiguranje!'});
            delete $greske["vrsta_osiguranja"];
        } else if ($ddlVrstaOsiguranja == 1) {
            $(".grupno").css('display', 'none');
            $("#tbImeGrupno").prop('required', false);
            $("#tbPrezimeGrupno").prop('required', false);
            $("#dtpDatumRodjenjaGrupno").prop('required', false);
            $("#tbBrojPasosaGrupno").prop('required', false);
            $ddlVrstaOsiguranjaPolje.css('border', '1px solid #ccc');
            $(".ddlVrstaOsiguranjaCss").css('display', 'none');
            $(".ddlVrstaOsiguranjaCss span").text("");
//            delete $greske.vrsta_osiguranja;
            delete $greske["vrsta_osiguranja"];
        } else if ($ddlVrstaOsiguranja == 0) {
            $(".grupno").css('display', 'none');
            $("#tbImeGrupno").prop('required', false);
            $("#tbPrezimeGrupno").prop('required', false);
            $("#dtpDatumRodjenjaGrupno").prop('required', false);
            $("#tbBrojPasosaGrupno").prop('required', false);
            $ddlVrstaOsiguranjaPolje.css('border', '1px solid red');
            $(".ddlVrstaOsiguranjaCss").css('display', 'contents');
            $(".ddlVrstaOsiguranjaCss span").text("* Polje za vrstu polise mora biti izabrano!");
//            $greske.push({vrsta_osiguranja: 'Polje za vrstu polise mora biti izabrano!'});
            $greske['vrsta_osiguranja'] = 'Polje za vrstu polise mora biti izabrano!';
        }
    });
    $brojac = 0;
    $("#btnDodajUGrupu").click(function () {
        $brojac++;
        if ($brojac < 9999)
            $d = new Date();
        $dan = $d.getDate();
        $mesecDveCifre = (($d.getMonth().length + 1) === 1) ? ($d.getMonth() + 1) : '0' + ($d.getMonth() + 1);
        $godina = $d.getFullYear();
        $datum = $godina + "-" + $mesecDveCifre + "-" + $dan;
        $(".grupnoTabela").before('<hr><table class="table-condensed" style="margin: 0px auto;"><tr><td>Ime osobe za grupno osiguranje: *</td><td colspan="3"><input type="text" name="tbImeGrupnoDodatak[]" id="tbImeGrupnoDodatak[]" placeholder="Pera" size="45"/></td></tr><tr class="tbImeGrupnoDodatakCss[]" style="display: none"><td style="padding: 0px 5px"></td><td colspan="3" style="padding: 0px 5px"><span style= "font-size: 10px"></span></td></tr><tr><td>Prezime osobe za grupno osiguranje: *</td><td colspan="3"><input type="text"name="tbPrezimeGrupnoDodatak[]" placeholder="Petrović" size="45"/></td></tr><tr class="tbPrezimeGrupnoDodatakCss[]" style="display: none"><td style="padding: 0px 5px"></td><td colspan="3" style="padding: 0px 5px"><span style= "font-size: 10px"></span></td></tr><tr><td>Datum rođenja osobe za grupno osiguranje: *</td><td colspan="3"><input type="date" name="dtpDatumRodjenjaGrupnoDodatak[]" style="width: 350px" max="' + $datum + '" onkeydown="return false"/></td></tr><tr class="dtpDatumRodjenjaGrupnoDodatakCss[]" style="display: none"><td style="padding: 0px 5px"></td><td colspan="3" style="padding: 0px 5px"><span style= "font-size: 10px"></span></td></tr><tr><td>Broj pasoša osobe za grupno osiguranje: *</td><td colspan="3"><input type="text"name="tbBrojPasosaDodatak[]" placeholder="000000000" size="45"/></td></tr><tr class="tbBrojPasosaDodatakCss[]" style="display: none"><td style="padding: 0px 5px"></td><td colspan="3" style="padding: 0px 5px"><span style= "font-size: 10px"></span></td></tr></table>');
    });
    $(document).on('blur', "#tbIme", function () {

        $imePolje = $("#tbIme");
        $imeValue = $("#tbIme").val();
//        $regIme = /^[\p{Lu}][\p{L}]{2,59}$/u;
        $regIme = /^[A-ZŠĐŽĆČ][a-zđšžćč]{2,59}$/;
        if ($imeValue != "") {
            if (!$imeValue.match($regIme)) {
                $imePolje.css('border', '1px solid red');
                $(".tbImeCss").css('display', 'contents');
                $(".tbImeCss span").text("U polje za ime nisu uneti ispravno podaci!");
//                $greske.push({ime: 'U polje za ime nisu uneti ispravno podaci!'});
                $greske['ime'] = 'U polje za ime nisu uneti ispravno podaci!';
            } else {
                $imePolje.css('border', '1px solid #ccc');
                $(".tbImeCss").css('display', 'none');
                $(".tbImeCss span").text("");
//                delete $greske.ime;
                delete $greske["ime"];
            }
        } else {
            $imePolje.css('border', '1px solid red');
            $(".tbImeCss").css('display', 'contents');
            $(".tbImeCss span").text("* Polje za ime mora biti uneto!");
//            $greske.push({ime: 'Polje za ime mora biti uneto!'});
            $greske['ime'] = 'Polje za ime mora biti uneto!';
        }
    });
    $(document).on('blur', "#tbPrezime", function () {

        $prezimePolje = $("#tbPrezime");
        $prezimeValue = $("#tbPrezime").val();
//        $regPrezime = /^[\p{Lu}][\p{L}]{2,59}$/u;
        $regPrezime = /^[A-ZŠĐŽĆČ][a-zđšžćč]{2,59}$/;
        if ($prezimeValue != "") {
            if (!$prezimeValue.match($regPrezime)) {
                $prezimePolje.css('border', '1px solid red');
                $(".tbPrezimeCss").css('display', 'contents');
                $(".tbPrezimeCss span").text("U polje za prezime nisu uneti ispravno podaci!");
//                $greske.push({prezime: 'U polje za prezime nisu uneti ispravno podaci!'});
                $greske['prezime'] = 'U polje za prezime nisu uneti ispravno podaci!';
            } else {
                $prezimePolje.css('border', '1px solid #ccc');
                $(".tbPrezimeCss").css('display', 'none');
                $(".tbPrezimeCss span").text("");
//                delete $greske.prezime;
                delete $greske["prezime"];
            }
        } else {
            $prezimePolje.css('border', '1px solid red');
            $(".tbPrezimeCss").css('display', 'contents');
            $(".tbPrezimeCss span").text("* Polje za prezime mora biti uneto!");
//            $greske.push({prezime: 'Polje za prezime mora biti uneto!'});
            $greske['prezime'] = 'Polje za prezime mora biti uneto!';
        }
    });
    $(document).on('blur', "#dtpDatumRodjenja", function () {

        $datumRodjenjePolje = $("#dtpDatumRodjenja");
        $datumRodjenjeValue = $("#dtpDatumRodjenja").val();
        if ($datumRodjenjeValue != "") {
            $datumRodjenjePolje.css('border', '1px solid #ccc');
            $(".dtpDatimRodjenjaCss").css('display', 'none');
            $(".dtpDatimRodjenjaCss span").text("");
//            delete $greske.datum_rodjenja;
            delete $greske["datum_rodjenja"];
        } else {
            $datumRodjenjePolje.css('border', '1px solid red');
            $(".dtpDatimRodjenjaCss").css('display', 'contents');
            $(".dtpDatimRodjenjaCss span").text("* Polje za datum rođenja mora biti uneto!");
//            $greske.push({datum_rodjenja: 'Polje za datum rođenja mora biti uneto!'});
            $greske['datum_rodjenja'] = 'Polje za datum rođenja mora biti uneto!';
        }
    });
    $(document).on('blur', "#tbBrojPasosa", function () {

        $tbBrojPasosaPolje = $("#tbBrojPasosa");
        $tbBrojPasosaValue = $("#tbBrojPasosa").val();
        $regBrojPasosa = /^[\d]{9}$/;
        if ($tbBrojPasosaValue != "") {
            if (!$tbBrojPasosaValue.match($regBrojPasosa)) {
                $tbBrojPasosaPolje.css('border', '1px solid red');
                $(".tbBrojPasosaCss").css('display', 'contents');
                $(".tbBrojPasosaCss span").text("U polje za broj pasoša nisu uneti ispravno podaci!");
//                $greske.push({broj_pasosa: 'U polje za broj pasoša nisu uneti ispravno podaci!'});
                $greske['broj_pasosa'] = 'U polje za broj pasoša nisu uneti ispravno podaci!';
            } else {
                $tbBrojPasosaPolje.css('border', '1px solid #ccc');
                $(".tbBrojPasosaCss").css('display', 'none');
                $(".tbBrojPasosaCss span").text("");
//                $greske.remove['broj_pasosa'];
                delete $greske["broj_pasosa"];
            }
        } else {
            $tbBrojPasosaPolje.css('border', '1px solid red');
            $(".tbBrojPasosaCss").css('display', 'contents');
            $(".tbBrojPasosaCss span").text("* Polje za broj pasoša mora biti uneto!");
//            $greske.push({broj_pasosa: 'Polje za broj pasoša mora biti uneto!'});
            $greske['broj_pasosa'] = 'Polje za broj pasoša mora biti uneto!';
        }
    });
    $(document).on('blur', "#tbTelefon", function () {

        $tbTelefonPolje = $("#tbTelefon");
        $tbTelefonValue = $("#tbTelefon").val();
        $regBrojTelefona = /^[+]?\d{11,12}$/;
        if ($tbTelefonValue != "") {
            if (!$tbTelefonValue.match($regBrojTelefona)) {
                $tbTelefonPolje.css('border', '1px solid red');
                $(".tbTelefonCss").css('display', 'contents');
                $(".tbTelefonCss span").text("U polje za broj telefona nisu uneti ispravno podaci!");
//                $greske.push({telefon: 'U polje za broj telefona nisu uneti ispravno podaci!'});
                $greske['telefon'] = 'U polje za broj telefona nisu uneti ispravno podaci!';
            } else {
                $tbTelefonPolje.css('border', '1px solid #ccc');
                $(".tbTelefonCss").css('display', 'none');
                $(".tbTelefonCss span").text("");
//                delete $greske.telefon;
                delete $greske["telefon"];
            }
        } else {
            $tbTelefonPolje.css('border', '1px solid red');
            $(".tbTelefonCss").css('display', 'contents');
            $(".tbTelefonCss span").text("* Polje za broj telefona mora biti uneto!");
//            $greske.push({telefon: 'Polje za broj telefona mora biti uneto!'});
            $greske['telefon'] = 'Polje za broj telefona mora biti uneto!';
        }
    });
    $(document).on('blur', "#tbEmail", function () {

        $tbEmailPolje = $("#tbEmail");
        $tbEmailValue = $("#tbEmail").val();
        $regEmail = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/;
        if ($tbEmailValue != "") {
            if (!$tbEmailValue.match($regEmail)) {
                $tbEmailPolje.css('border', '1px solid red');
                $(".tbEmailCss").css('display', 'contents');
                $(".tbEmailCss span").text("U polje za email nisu uneti ispravno podaci!");
//                $greske.push({email: 'U polje za email nisu uneti ispravno podaci!'});
                $greske['email'] = 'U polje za email nisu uneti ispravno podaci!';
            } else {
                $tbEmailPolje.css('border', '1px solid #ccc');
                $(".tbEmailCss").css('display', 'none');
                $(".tbEmailCss span").text("");
//                delete $greske.email;
                delete $greske["email"];
            }
        } else {
            $tbEmailPolje.css('border', '1px solid red');
            $(".tbEmailCss").css('display', 'contents');
            $(".tbEmailCss span").text("* Polje za email mora biti uneto!");
//            $greske.push({email: 'Polje za email mora biti uneto!'});
            $greske['email'] = 'Polje za email mora biti uneto!';
        }
    });
    $(document).on('blur', "#dtpDatumPocetkaPutovanja", function () {

        $dtpDatumPocetkaPutovanjaPolje = $("#dtpDatumPocetkaPutovanja");
        $dtpDatumPocetkaPutovanjaValue = $("#dtpDatumPocetkaPutovanja").val();
        if ($dtpDatumPocetkaPutovanjaValue != "") {
            $dtpDatumPocetkaPutovanjaPolje.css('border', '1px solid #ccc');
            $(".dtpDatumPocetkaPutovanjaCss").css('display', 'none');
            $(".dtpDatumPocetkaPutovanjaCss span").text("");
            $("#dtpDatumZavrsetkaPutovanja").prop('min', $dtpDatumPocetkaPutovanjaValue);
            $("#dtpDatumZavrsetkaPutovanja").removeAttr('max');
//            delete $greske.datum_pocetka_putovanja;
            delete $greske["datum_pocetka_putovanja"];
        } else {
            $dtpDatumPocetkaPutovanjaPolje.css('border', '1px solid red');
            $(".dtpDatumPocetkaPutovanjaCss").css('display', 'table-row');
            $(".dtpDatumPocetkaPutovanjaCss span").text("* Polje za datum početka putovanja mora biti uneto!");
//            $greske.push({datum_pocetka_putovanja: 'Polje za datum početka putovanja mora biti uneto!'});
            $greske['datum_pocetka_putovanja'] = 'Polje za datum početka putovanja mora biti uneto!';
            $d = new Date();
            $dan = $d.getDate();
            $mesecDveCifre = (($d.getMonth().length + 1) === 1) ? ($d.getMonth() + 1) : '0' + ($d.getMonth() + 1);
            $godina = $d.getFullYear();
            $("#dtpDatumZavrsetkaPutovanja").prop('min', $godina + "-" + $mesecDveCifre + "-" + $dan);
            $("#dtpDatumZavrsetkaPutovanja").prop('max', $godina + "-" + $mesecDveCifre + "-" + $dan);
        }
    });
    $(document).on('blur', "#dtpDatumZavrsetkaPutovanja", function () {

        $dtpDatumZavrsetkaPutovanjaPolje = $("#dtpDatumZavrsetkaPutovanja");
        $dtpDatumZavrsetkaPutovanjaValue = $("#dtpDatumZavrsetkaPutovanja").val();
        if ($dtpDatumZavrsetkaPutovanjaValue != "") {
            $dtpDatumZavrsetkaPutovanjaPolje.css('border', '1px solid #ccc');
            $(".dtpDatumZavrsetkaPutovanjaCss").css('display', 'none');
            $(".dtpDatumZavrsetkaPutovanjaCss span").text("");
//            delete $greske.datum_zavrsetka_putovanja;
            delete $greske["datum_zavrsetka_putovanja"];
        } else {
            $dtpDatumZavrsetkaPutovanjaPolje.css('border', '1px solid red');
            $(".dtpDatumZavrsetkaPutovanjaCss").css('display', 'table-row');
            $(".dtpDatumZavrsetkaPutovanjaCss span").text("* Polje za datum završetka putovanja mora biti uneto!");
//            $greske.push({datum_zavrsetka_putovanja: 'Polje za datum završetka putovanja mora biti uneto!'});
            $greske['datum_pocetka_putovanja'] = 'Polje za datum završetka putovanja mora biti uneto!';
        }
    });
    $(document).on('blur', "#tbImeGrupno", function () {

        $tbImeGrupnoPolje = $("#tbImeGrupno");
        $tbImeGrupnoValue = $("#tbImeGrupno").val();
//        $regIme = /^[\p{Lu}][\p{L}]{2,59}$/u;
        $regIme = /^[A-ZŠĐŽĆČ][a-zđšžćč]{2,59}$/;
        if ($tbImeGrupnoValue != "") {
            if (!$tbImeGrupnoValue.match($regIme)) {
                $tbImeGrupnoPolje.css('border', '1px solid red');
                $(".tbImeGrupnoCss").css('display', 'contents');
                $(".tbImeGrupnoCss span").text("U polje za ime osobe za grupno osiguranje nisu uneti ispravno podaci!");
//                $greske.push({ime_grupno: 'U polje za ime osobe za grupno osiguranje nisu uneti ispravno podaci!'});
                $greske['ime_grupno'] = 'U polje za ime osobe za grupno osiguranje nisu uneti ispravno podaci!';
            } else {
                $tbImeGrupnoPolje.css('border', '1px solid #ccc');
                $(".tbImeGrupnoCss").css('display', 'none');
                $(".tbImeGrupnoCss span").text("");
//                delete $greske.ime_grupno;
                delete $greske["ime_grupno"];
            }
        } else {
            $tbImeGrupnoPolje.css('border', '1px solid red');
            $(".tbImeGrupnoCss").css('display', 'contents');
            $(".tbImeGrupnoCss span").text("* Polje za ime osobe za grupno osiguranje mora biti uneto!");
//            $greske.push({ime_grupno: 'Polje za ime osobe za grupno osiguranje mora biti uneto!'});
            $greske['ime_grupno'] = 'Polje za ime osobe za grupno osiguranje mora biti uneto!';
        }
    });
    $(document).on('blur', "#tbPrezimeGrupno", function () {

        $tbPrezimeGrupnoPolje = $("#tbPrezimeGrupno");
        $tbPrezimeGrupnoValue = $("#tbPrezimeGrupno").val();
//        $regPrezime = /^[\p{Lu}][\p{L}]{2,59}$/u;
        $regPrezime = /^[A-ZŠĐŽĆČ][a-zđšžćč]{2,59}$/;
        if ($tbPrezimeGrupnoValue != "") {
            if (!$tbPrezimeGrupnoValue.match($regPrezime)) {
                $tbPrezimeGrupnoPolje.css('border', '1px solid red');
                $(".tbPrezimeGrupnoCss").css('display', 'contents');
                $(".tbPrezimeGrupnoCss span").text("U polje za prezime osobe za grupno osiguranje nisu uneti ispravno podaci!");
//                $greske.push({prezime_grupno: 'U polje za prezime osobe za grupno osiguranje nisu uneti ispravno podaci!'});
                $greske['prezime_grupno'] = 'U polje za prezime osobe za grupno osiguranje nisu uneti ispravno podaci!';
            } else {
                $tbPrezimeGrupnoPolje.css('border', '1px solid #ccc');
                $(".tbPrezimeGrupnoCss").css('display', 'none');
                $(".tbPrezimeGrupnoCss span").text("");
//                delete $greske.prezime_grupno;
                delete $greske["prezime_grupno"];
            }
        } else {
            $tbPrezimeGrupnoPolje.css('border', '1px solid red');
            $(".tbPrezimeGrupnoCss").css('display', 'contents');
            $(".tbPrezimeGrupnoCss span").text("* Polje za prezime osobe za grupno osiguranje mora biti uneto!");
//            $greske.push({prezime_grupno: 'Polje za prezime osobe za grupno osiguranje mora biti uneto!'});
            $greske['prezime_grupno'] = 'Polje za prezime osobe za grupno osiguranje mora biti uneto!';
        }
    });
    $(document).on('blur', "#dtpDatumRodjenjaGrupno", function () {

        $dtpDatumRodjenjaGrupnoPolje = $("#dtpDatumRodjenjaGrupno");
        $dtpDatumRodjenjaGrupnoValue = $("#dtpDatumRodjenjaGrupno").val();
        if ($dtpDatumRodjenjaGrupnoValue != "") {
            $dtpDatumRodjenjaGrupnoPolje.css('border', '1px solid #ccc');
            $(".dtpDatimRodjenjaGrupnoCss").css('display', 'none');
            $(".dtpDatimRodjenjaGrupnoCss span").text("");
//            delete $greske.datum_rodjenja;
            delete $greske["datum_rodjenja_grupno"];
        } else {
            $dtpDatumRodjenjaGrupnoPolje.css('border', '1px solid red');
            $(".dtpDatimRodjenjaGrupnoCss").css('display', 'contents');
            $(".dtpDatimRodjenjaGrupnoCss span").text("* Polje za datum rođenja mora biti uneto!");
//            $greske.push({datum_rodjenja: 'Polje za datum rođenja mora biti uneto!'});
            $greske['datum_rodjenja_grupno'] = 'Polje za datum rođenja osobe za grupno osiguranje mora biti uneto!';
        }
    });
    $(document).on('blur', "#tbBrojPasosaGrupno", function () {

        $tbBrojPasosaGrupnoPolje = $("#tbBrojPasosaGrupno");
        $tbBrojPasosaGrupnoValue = $("#tbBrojPasosaGrupno").val();
        $regBrojPasosa = /^[\d]{9}$/;
        if ($tbBrojPasosaGrupnoValue != "") {
            if (!$tbBrojPasosaGrupnoValue.match($regBrojPasosa)) {
                $tbBrojPasosaGrupnoPolje.css('border', '1px solid red');
                $(".tbBrojPasosaGrupnoCss").css('display', 'contents');
                $(".tbBrojPasosaGrupnoCss span").text("U polje za broj pasoša osobe za grupno osiguranje nisu uneti ispravno podaci!");
//                $greske.push({broj_pasosa_grupno: 'U polje za broj pasoša osobe za grupno osiguranje nisu uneti ispravno podaci!'});
                $greske['broj_pasosa_grupno'] = 'U polje za broj pasoša osobe za grupno osiguranje nisu uneti ispravno podaci!';
            } else {
                $tbBrojPasosaGrupnoPolje.css('border', '1px solid #ccc');
                $(".tbBrojPasosaGrupnoCss").css('display', 'none');
                $(".tbBrojPasosaGrupnoCss span").text("");
//                delete $greske.broj_pasosa_grupno;
                delete $greske["broj_pasosa_grupno"];
            }
        } else {
            $tbBrojPasosaGrupnoPolje.css('border', '1px solid red');
            $(".tbBrojPasosaGrupnoCss").css('display', 'contents');
            $(".tbBrojPasosaGrupnoCss span").text("* Polje za broj pasoša osobe za grupno osiguranje mora biti uneto!");
//            $greske.push({broj_pasosa_grupno: 'Polje za broj pasoša osobe za grupno osiguranje mora biti uneto!'});
            $greske['broj_pasosa_grupno'] = 'Polje za broj pasoša osobe za grupno osiguranje mora biti uneto!';
        }
    });
    $(document).on('blur', "#tbImeGrupnoDodatak", function () {

        $tbImeGrupnoDodatakPolje = $("#tbImeGrupnoDodatak");
        $tbImeGrupnoDodatakValue = $("#tbImeGrupnoDodatak").val();
//        $regIme = /^[\p{Lu}][\p{L}]{2,59}$/u;
        $regIme = /^[A-ZŠĐŽĆČ][a-zđšžćč]{2,59}$/;
        if ($tbImeGrupnoDodatakValue != "") {
            if (!$tbImeGrupnoDodatakValue.match($regIme)) {
                $tbImeGrupnoDodatakPolje.css('border', '1px solid red');
                $(".tbImeGrupnoDodatakCss[]").css('display', 'contents');
                $(".tbImeGrupnoDodatakCss[] span").text("U polje za ime osobe za grupno osiguranje nisu uneti ispravno podaci!");
//                $greske.push({ime_grupno: 'U polje za ime osobe za grupno osiguranje nisu uneti ispravno podaci!'});
                $greske['ime_grupno_dodatak'] = 'U polje za ime osobe za grupno osiguranje nisu uneti ispravno podaci!';
            } else {
                $tbImeGrupnoDodatakPolje.css('border', '1px solid #ccc');
                $(".tbImeGrupnoDodatakCss[]").css('display', 'none');
                $(".tbImeGrupnoDodatakCss[] span").text("");
//                delete $greske.ime_grupno;
                delete $greske["ime_grupno_dodatak"];
            }
        } else {
            $tbImeGrupnoDodatakPolje.css('border', '1px solid red');
            $(".tbImeGrupnoDodatakCss[]").css('display', 'contents');
            $(".tbImeGrupnoDodatakCss[] span").text("* Polje za ime osobe za grupno osiguranje mora biti uneto!");
//            $greske.push({ime_grupno: 'Polje za ime osobe za grupno osiguranje mora biti uneto!'});
            $greske['ime_grupno_dodatak'] = 'Polje za ime osobe za grupno osiguranje mora biti uneto!';
        }
    });
    $(document).on('blur', "#tbPrezimeGrupnoDodatak", function () {

        $tbPrezimeGrupnoDodatakPolje = $("#tbPrezimeGrupnoDodatak");
        $tbPrezimeGrupnoDodatakValue = $("#tbPrezimeGrupnoDodatak").val();
//        $regPrezime = /^[\p{Lu}][\p{L}]{2,59}$/u;
        $regPrezime = /^[A-ZŠĐŽĆČ][a-zđšžćč]{2,59}$/;
        if ($tbPrezimeGrupnoDodatakValue != "") {
            if (!$tbPrezimeGrupnoDodatakValue.match($regPrezime)) {
                $tbPrezimeGrupnoDodatakPolje.css('border', '1px solid red');
                $(".tbPrezimeGrupnoDodatakCss[]").css('display', 'contents');
                $(".tbPrezimeGrupnoDodatakCss[] span").text("U polje za prezime osobe za grupno osiguranje nisu uneti ispravno podaci!");
//                $greske.push({prezime_grupno: 'U polje za prezime osobe za grupno osiguranje nisu uneti ispravno podaci!'});
                $greske['prezime_grupno_dodatak'] = 'U polje za prezime osobe za grupno osiguranje nisu uneti ispravno podaci!';
            } else {
                $tbPrezimeGrupnoDodatakPolje.css('border', '1px solid #ccc');
                $(".tbPrezimeGrupnoDodatakCss[]").css('display', 'none');
                $(".tbPrezimeGrupnoDodatakCss[] span").text("");
//                delete $greske.prezime_grupno;
                delete $greske["prezime_grupno_dodatak"];
            }
        } else {
            $tbPrezimeGrupnoDodatakPolje.css('border', '1px solid red');
            $(".tbPrezimeGrupnoDodatakCss[]").css('display', 'contents');
            $(".tbPrezimeGrupnoDodatakCss[] span").text("* Polje za prezime osobe za grupno osiguranje mora biti uneto!");
//            $greske.push({prezime_grupno: 'Polje za prezime osobe za grupno osiguranje mora biti uneto!'});
            $greske['prezime_grupno_dodatak'] = 'Polje za prezime osobe za grupno osiguranje mora biti uneto!';
        }
    });
    $(document).on('blur', "#dtpDatumRodjenjaGrupnoDodatak", function () {

        $dtpDatumRodjenjaGrupnoDodatakPolje = $("#dtpDatumRodjenjaGrupnoDodatak");
        $dtpDatumRodjenjaGrupnoDodatakValue = $("#dtpDatumRodjenjaGrupnoDodatak").val();
        if ($dtpDatumRodjenjaGrupnoDodatakValue != "") {
            $dtpDatumRodjenjaGrupnoDodatakPolje.css('border', '1px solid #ccc');
            $(".dtpDatimRodjenjaGrupnoDodatakCss[]").css('display', 'none');
            $(".dtpDatimRodjenjaGrupnoDodatakCss[] span").text("");
//            delete $greske.datum_rodjenja;
            delete $greske["datum_rodjenja_grupno_dodatak"];
        } else {
            $dtpDatumRodjenjaGrupnoDodatakPolje.css('border', '1px solid red');
            $(".dtpDatimRodjenjaGrupnoDodatakCss[]").css('display', 'contents');
            $(".dtpDatimRodjenjaGrupnoDodatakCss[] span").text("* Polje za datum rođenja mora biti uneto!");
//            $greske.push({datum_rodjenja: 'Polje za datum rođenja mora biti uneto!'});
            $greske['datum_rodjenja_grupno_dodatak'] = 'Polje za datum rođenja osobe za grupno osiguranje mora biti uneto!';
        }
    });
    $(document).on('blur', "#tbBrojPasosaGrupnoDodatak", function () {

        $tbBrojPasosaGrupnoDodatakPolje = $("#tbBrojPasosaGrupnoDodatak");
        $tbBrojPasosaGrupnoDodatakValue = $("#tbBrojPasosaGrupnoDodatak").val();
        $regBrojPasosa = /^[\d]{9}$/;
        if ($tbBrojPasosaGrupnoDodatakValue != "") {
            if (!$tbBrojPasosaGrupnoDodatakValue.match($regBrojPasosa)) {
                $tbBrojPasosaGrupnoDodatakPolje.css('border', '1px solid red');
                $(".tbBrojPasosaGrupnoDodatakCss[]").css('display', 'contents');
                $(".tbBrojPasosaGrupnoDodatakCss[] span").text("U polje za broj pasoša osobe za grupno osiguranje nisu uneti ispravno podaci!");
//                $greske.push({broj_pasosa_grupno: 'U polje za broj pasoša osobe za grupno osiguranje nisu uneti ispravno podaci!'});
                $greske['broj_pasosa_grupno_dodatak'] = 'U polje za broj pasoša osobe za grupno osiguranje nisu uneti ispravno podaci!';
            } else {
                $tbBrojPasosaGrupnoDodatakPolje.css('border', '1px solid #ccc');
                $(".tbBrojPasosaGrupnoDodatakCss[]").css('display', 'none');
                $(".tbBrojPasosaGrupnoDodatakCss[] span").text("");
//                delete $greske.broj_pasosa_grupno;
                delete $greske["broj_pasosa_grupno_dodatak"];
            }
        } else {
            $tbBrojPasosaGrupnoDodatakPolje.css('border', '1px solid red');
            $(".tbBrojPasosaGrupnoDodatakCss[]").css('display', 'contents');
            $(".tbBrojPasosaGrupnoDodatakCss[] span").text("* Polje za broj pasoša osobe za grupno osiguranje mora biti uneto!");
//            $greske.push({broj_pasosa_grupno: 'Polje za broj pasoša osobe za grupno osiguranje mora biti uneto!'});
            $greske['broj_pasosa_grupno_dodatak'] = 'Polje za broj pasoša osobe za grupno osiguranje mora biti uneto!';
        }
    });
    $("#btnDodaj").click(function (e) {
//        console.log($greske);
//        console.log(jQuery.isEmptyObject($greske));
        if (jQuery.isEmptyObject($greske) == false) {
            $ddlVrstaOsiguranjaPolje = $(".ddlVrstaOsiguranja");
            $ddlVrstaOsiguranja = $(".ddlVrstaOsiguranja").find(":selected").val();
            if ($ddlVrstaOsiguranja == 0) {
                $ddlVrstaOsiguranjaPolje.css('border', '1px solid red');
                $(".ddlVrstaOsiguranjaCss").css('display', 'contents');
                $(".ddlVrstaOsiguranjaCss span").text("* Polje za vrstu polise mora biti izabrano!");
            }
            e.preventDefault();

        }
    });
});