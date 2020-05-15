<?php
if (session_status() == PHP_SESSION_NONE) {

	session_start();
}
    // switch case qe percakton menute
    function menuja() {
        $roli = $_SESSION['roli'];
        switch($roli) {
            case 'pacient':
                include("menute/menu_pacient.php");
                break;
            case 'staf':
                include("menute/menu_staf.php");
                break;
            case 'admin':
                include("menute/menu_admin.php");
                // include "struktura.php"; ktu e ke ne rast se ke strukture te avancuar me libreri shtese js dhe css
                break;
            case 'new':
                include("menute/menu_new_user.php");
                // include "struktura.php"; ktu e ke ne rast se ke strukture te avancuar me libreri shtese js dhe css
                break;
        }
    }

    menuja();

?>