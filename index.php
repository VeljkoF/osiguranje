<?php
include "view/head.php";
include "view/menu.php";
if (isset($_GET['page'])):
    switch ($_GET['page']):
        case 'pregled_unetih_polisa':
            include "view/page/pregled_polisa.php";
            break;
        default :
            include "view/page/pocetna.php";
    endswitch;
else:
    include "view/page/pocetna.php";
endif;
//include "view/content.php";
include "view/footer.php";
?>