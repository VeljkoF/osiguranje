<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-12">

            <h1 class="page-header">
                Pregled unetih polisa
            </h1>
            
            <table class="table">
                <tr>
                    <th>Datum unosa polise 
                        <br>
                        <a href="<?php echo $_BASE_URL?>index.php?page=pregled_unetih_polisa&datum_unosa_polise=DESC" style="text-decoration: none">&#x2B06;</a> 
                        <a href="<?php echo $_BASE_URL?>index.php?page=pregled_unetih_polisa&datum_unosa_polise=ASC" style="text-decoration: none">&#x2B07;</a>
                    </th>
                    <th>Ime i prezime nosioca 
                        <br>
                        <a href="<?php echo $_BASE_URL?>index.php?page=pregled_unetih_polisa&ime_i_prezime=DESC" style="text-decoration: none">&#x2B06;</a> 
                        <a href="<?php echo $_BASE_URL?>index.php?page=pregled_unetih_polisa&ime_i_prezime=ASC" style="text-decoration: none">&#x2B07;</a>
                    </th>
                    <th>Datum rođenja 
                        <br>
                        <a href="<?php echo $_BASE_URL?>index.php?page=pregled_unetih_polisa&datum_rodjenja=DESC" style="text-decoration: none">&#x2B06;</a> 
                        <a href="<?php echo $_BASE_URL?>index.php?page=pregled_unetih_polisa&datum_rodjenja=ASC" style="text-decoration: none">&#x2B07;</a>
                    </th>
                    <th>Broj pasoša 
                        <br>
                        <a href="<?php echo $_BASE_URL?>index.php?page=pregled_unetih_polisa&broj_pasosa=DESC" style="text-decoration: none">&#x2B06;</a> 
                        <a href="<?php echo $_BASE_URL?>index.php?page=pregled_unetih_polisa&broj_pasosa=ASC" style="text-decoration: none">&#x2B07;</a>
                    </th>
                    <th>Email 
                        <br>
                        <a href="<?php echo $_BASE_URL?>index.php?page=pregled_unetih_polisa&email=DESC" style="text-decoration: none">&#x2B06;</a> 
                        <a href="<?php echo $_BASE_URL?>index.php?page=pregled_unetih_polisa&email=ASC" style="text-decoration: none">&#x2B07;</a>
                    </th>
                    <th>Datum putovanja od 
                        <br>
                        <a href="<?php echo $_BASE_URL?>index.php?page=pregled_unetih_polisa&datum_pocetka_putovanja=DESC" style="text-decoration: none">&#x2B06;</a> 
                        <a href="<?php echo $_BASE_URL?>index.php?page=pregled_unetih_polisa&datum_pocetka_putovanja=ASC" style="text-decoration: none">&#x2B07;</a>
                    </th>
                    <th>Datum putovanja do 
                        <br>
                        <a href="<?php echo $_BASE_URL?>index.php?page=pregled_unetih_polisa&datum_kraja_putovanja=DESC" style="text-decoration: none">&#x2B06;</a> 
                        <a href="<?php echo $_BASE_URL?>index.php?page=pregled_unetih_polisa&datum_kraja_putovanja=ASC" style="text-decoration: none">&#x2B07;</a>
                    </th>
                    <th>Broj dana 
                        <br>
                        <a href="<?php echo $_BASE_URL?>index.php?page=pregled_unetih_polisa&broj_dana=DESC" style="text-decoration: none">&#x2B06;</a> 
                        <a href="<?php echo $_BASE_URL?>index.php?page=pregled_unetih_polisa&broj_dana=ASC" style="text-decoration: none">&#x2B07;</a>
                    </th>
                    <th>Individualno / Grupno osiguranje 
                        <br>
                        <a href="<?php echo $_BASE_URL?>index.php?page=pregled_unetih_polisa&tip_polise=DESC" style="text-decoration: none">&#x2B06;</a> 
                        <a href="<?php echo $_BASE_URL?>index.php?page=pregled_unetih_polisa&tip_polise=ASC" style="text-decoration: none">&#x2B07;</a>
                    </th>
                    <th>Akcija</th>
                </tr>
                <?php
                $osiguranja = new Osiguranja();
                
                $where[0] = array('osiguranici.nosilac_osiguranja' => 1);
                if(isset($_GET['datum_unosa_polise'])):
                    $orderby[0] = array('osiguranja.datum_polise_osiguranje' => $_GET['datum_unosa_polise']);
                endif;
                if(isset($_GET['ime_i_prezime'])):
                    $orderby[0] = array('osiguranici.ime_osiguranika' => $_GET['ime_i_prezime']);
                    $orderby[1] = array('osiguranici.prezime_osiguranika' => $_GET['ime_i_prezime']);
                endif;
                if(isset($_GET['datum_rodjenja'])):
                    $orderby[0] = array('osiguranici.datum_rodjenja_osiguranika' => $_GET['datum_rodjenja']);
                endif;
                if(isset($_GET['broj_pasosa'])):
                    $orderby[0] = array('osiguranici.broj_pasosa_osiguranika' => $_GET['broj_pasosa']);
                endif;
                if(isset($_GET['email'])):
                    $orderby[0] = array('osiguranici.email_osiguranika' => $_GET['email']);
                endif;
                if(isset($_GET['datum_pocetka_putovanja'])):
                    $orderby[0] = array('osiguranja.datum_pocetka_putovanja_osigutanje' => $_GET['datum_pocetka_putovanja']);
                endif;
                if(isset($_GET['datum_kraja_putovanja'])):
                    $orderby[0] = array('osiguranja.datum_kraja_putovanja_osigutanje' => $_GET['datum_kraja_putovanja']);
                endif;
                if(isset($_GET['broj_dana'])):
                    $orderby[0] = array('osiguranja.broj_dana_putovanja_osiguranje' => $_GET['broj_dana']);
                endif;
                if(isset($_GET['tip_polise'])):
                    $orderby[0] = array('tip_osiguranja.naziv_tip_osiguranja' => $_GET['tip_polise']);
                endif;
                
                if(isset($orderby)):
                    $osiguranja = $osiguranja->podaci($where, $orderby);
                else:
                    $osiguranja = $osiguranja->podaci($where);
                endif;
                
                foreach ($osiguranja as $o):
                    ?>        
                    <tr>
                        <?php
                        list($year1, $month1, $day1) = explode('-', $o->datum_polise_osiguranje);
                        $mktime1 = mktime(0, 0, 0, $month1, $day1, $year1);
                        $datum_polise_osiguranje = date('d. m. Y.', $mktime1);
                        ?>
                        <td><?php echo $datum_polise_osiguranje ?></td>
                        <td><?php echo $o->ime_osiguranika . " " . $o->prezime_osiguranika ?></td>
                        <?php
                        list($year2, $month2, $day2) = explode('-', $o->datum_rodjenja_osiguranika);
                        $mktime2 = mktime(0, 0, 0, $month2, $day2, $year2);
                        $datum_rodjenja_osiguranika = date('d. m. Y.', $mktime2);
                        ?>
                        <td><?php echo $datum_rodjenja_osiguranika ?></td>
                        <td><?php echo $o->broj_pasosa_osiguranika ?></td>
                        <td><?php echo $o->email_osiguranika ?></td>
                        <?php
                        list($year3, $month3, $day3) = explode('-', $o->datum_pocetka_putovanja_osigutanje);
                        $mktime3 = mktime(0, 0, 0, $month3, $day3, $year3);
                        $datum_pocetka_putovanja_osigutanje = date('d. m. Y.', $mktime3);
                        
                        list($year4, $month4, $day4) = explode('-', $o->datum_kraja_putovanja_osigutanje);
                        $mktime4 = mktime(0, 0, 0, $month4, $day4, $year4);
                        $datum_kraja_putovanja_osigutanje = date('d. m. Y.', $mktime4);

//                        $date = new DateTime($o->datum_putovanja_osigutanje);
//                        $date->modify($o->broj_dana_putovanja_osiguranje . ' day');
//                        $kraj_putovanja = $date->format('d. m. Y.');
                        ?>
                        <td><?php echo $datum_pocetka_putovanja_osigutanje ?></td>
                        <td><?php echo $datum_kraja_putovanja_osigutanje ?></td>
                        <td><?php echo $o->broj_dana_putovanja_osiguranje ?></td>
                        <td><?php echo $o->naziv_tip_osiguranja ?> osiguranje</td>
                        <td>
                            <?php if ($o->id_tip_osiguranja == 2): ?>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo $o->id_osiguranje ?>">
                                    Akcija
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="<?php echo $o->id_osiguranje ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h3 class="modal-title" id="exampleModalLongTitle">Osobe grupne polise</h3>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table">
                                                    <tr>
                                                        <th>Ime i prezime nosioca</th>
                                                        <th>Datum rođenja</th>
                                                        <th>Broj pasoša</th>
                                                    </tr>
                                                    <?php 
                                                        $osiguranja2 = new Osiguranja();
                                                        
                                                        $where2[0] = array('osiguranja.id_osiguranje' => $o->id_osiguranje);
                                                        $where2[1] = array('osiguranici.nosilac_osiguranja' => 0);
                                                        
                                                        $osiguranja2 = $osiguranja2->podaci($where2, $orderby);

                                                        foreach ($osiguranja2 as $o2):
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $o2->ime_osiguranika . " " . $o2->prezime_osiguranika ?></td>
                                                        <?php
                                                        list($year5, $month5, $day5) = explode('-', $o2->datum_rodjenja_osiguranika);
                                                        $mktime5 = mktime(0, 0, 0, $month5, $day5, $year5);
                                                        $datum_rodjenja_osiguranika2 = date('d. m. Y.', $mktime5);
                                                        ?>
                                                        <td><?php echo $datum_rodjenja_osiguranika2 ?></td>
                                                        <td><?php echo $o2->broj_pasosa_osiguranika ?></td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </table>
                                            </div>
<!--                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>-->
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
    <!-- /.row -->
    <hr>