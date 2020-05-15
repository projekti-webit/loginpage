<?php
session_start();
 // lidhja me db
require("db_lidhje2.php");
 // include filet css e javascript
    include "struktura2.php";

 // funksion per cfare ndodh kur useri ben nje rezervim
    function rezultati_rezervim($mesazhi) { 
        if ($mesazhi == "OK") { // meqe do perdorim javascript na duhet libreria jquery qe e kemi tek file struktura2.php
            echo "
                <script type='text/javascript'>
                    alert('Rezervimi u krye me sukses. Ju do te njoftoheni me tej ne emailin tuaj. Faleminderit!');
                    window.location.href = '../rezervo_takim.php';
                </script>
            ";
        } else {
            echo "
                <script type='text/javascript'>
                    alert('Rezervimi NUK krye me sukses!!!. Riprovoni ne nje moment te dyte ose kontaktoni me administratorin.');
                    window.location.href = '../rezervo_takim.php';
                </script>
            ";
        }
    }

if(isset($_POST["user_rezervim"])){
    
    //var_dump($_POST);
    
     if (isset($_POST["emri_pacientit"], $_POST["mbiemri_pacientit"], $_POST["idcard_pacient"], $_POST["emaili_pacientit"], $_POST["doktor_id"], $_POST["data_rezervimit"],$_POST["ora_rezervimit"])) { // me isset mund te verifikosh me shume se nje variabel njekohesisht
         
            // ruajme vlerat ne variabla qe do i perdorim ne query
            $emri           = trim($_POST["emri_pacientit"]); // trim perdoret per ceshtje sigurie dhe i ben pastrim nese ka kod te dyshimte
            $mbiemri        = trim($_POST["mbiemri_pacientit"]);
            $idcard         = trim($_POST["idcard_pacient"]);
            $email          = trim($_POST["emaili_pacientit"]);
            $doktor_id      = trim($_POST["doktor_id"]);
            $data           = trim($_POST["data_rezervimit"]);
            $ora            = trim($_POST["ora_rezervimit"]);
         
         
         
                $query_rezervim = "
                    insert into rezervim ( data_r, orari, pacientID, doktorID, emri, mbiemri) 
                    values (
                        '$data', '$ora', '$idcard', '$doktor_id', '$emri', '$mbiemri'
                    )
                ";
//         $qtest = "insert into rezervim ( data_r, orari, pacientID, doktorID, emri, mbiemri) 
//                    values (
//                        '$data', '$ora', '$idcard', '$doktor_id', '$emri', '$mbiemri'
//                    )";
//         echo $qtest;
                
                // ekzekutojme query per ruajtjen e te dhenave, por njekohesisht verifikojme nese query ekzekutohet me sukses
                if (mysqli_query($db2, $query_rezervim)) { // if ben return true nese ska error
                    
                    
                    $mesazhi = "OK";
                    rezultati_rezervim($mesazhi);
                }else{
                    $mesazhi = "NOT";
                    rezultati_rezervim($mesazhi);
                }
                    
     }
}
?>