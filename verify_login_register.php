<?php 
    // jemi ne regjistrim te ri, nqs kemi ndonje sesion te hapur ska kuptim keshtu qe do pastrojme sesionin
    if (isset($_SESSION)) {
        session_destroy();
    }

    session_start(); // 
    
    // na duhet lidhja me databazen
    require("admin_db/lidhje_db.php");
    include("header.php");


    // funksion per cfare ndodh kur useri regjistrohet me sukses apo me error
    function rezultati_regjistrim($mesazhi) { 
        if ($mesazhi == "OK") { // meqe do perdorim javascript na duhet libreria jquery qe e kemi tek file struktura2.php
            echo "
                <script type='text/javascript'>
                    alert('Rregjistrimi u krye me sukses.');
                    window.location.href = 'index.php';
                </script>
            ";
        } else {
            echo "
                <script type='text/javascript'>
                    alert('Rregjistrimi NUK krye me sukses!!!. Riprovoni ne nje moment te dyte ose kontaktoni me administratorin.');
                    window.location.href = 'register.php';
                </script>
            ";
        }
    }

    // funksion qe redirect userin pasi eshte autentikuar me sukses ose jo
    function rezultati_login($rasti) { 
        if ($rasti == "Login_OK") { // meqe do perdorim javascript na duhet libreria jquery qe e kemi tek file struktura2.php
            echo "
                <script type='text/javascript'>
                    alert('Jeni autentikuar me sukses...');
                    window.location.href = 'index.php';
                </script>
            ";
        } else {
            echo "
                <script type='text/javascript'>
                    alert('Ka nje gabim ne verifikimin e Userit...! Kontaktoni me administratorin.');
                    window.location.href = 'login.php';
                </script>
            ";
        }
    }

    // funksion qe redirect userin pasi eshte autentikuar me sukses ose jo
    function rezultati_regjistrim_ko_passwd($rasti) { 
        if ($rasti == "KO_passwd") { // meqe do perdorim javascript na duhet libreria jquery qe e kemi tek file struktura2.php
            echo "
                <script type='text/javascript'>
                    alert('Fjalekalimet e perdorura nuk perputhen...');
                    window.location.href = 'register.php';
                </script>
            ";
        }
    }

     // rasti ne login i userit
    if (isset($_POST["user_login"])) {
        // var_dump($_POST); // deri ktu ok?? po
        
        // verifikojme dhe marrim infot nga form qe i ben submit
        if (isset($_POST["username"], $_POST["passwordi"])) {
            // ruajme vlerat qe vijne nga submit form
            $username = trim($_POST["username"]);
            $passwordi = md5( trim($_POST["passwordi"]) ); // ktu e bej direkt enkriptimin e passwordit pasi ne db do bej verifikm te passwordit ne formen e enkriptuar
            
            $query_login = "
                select * from perdoruesit where username = '$username' and password = '$passwordi' LIMIT 1
            "; // e bejme limit 1 qe te jemi te sigurte edhe nese ka me shume se 1 row si resultat te na kthje vetem 1
            
            //
            //
            
            // ekzekutojme query
            $rezultati = mysqli_query($db_connect, $query_login);
            
                if ( $row = mysqli_fetch_array($rezultati, MYSQLI_ASSOC) ) {
                // tani mund ti aksesojme me emrtime ne array, psh: $row["emri"]
                
                // ruajme vlerat ne sesion
                
                $_SESSION["emri"]      = $row["emri"];
                $_SESSION["mbiemri"]   = $row["mbiemri"];
                $_SESSION["user_id"]   = $row["user_id"];
                $_SESSION["email"]     = $row["email"];
                $_SESSION["roli"] 	   = $row["roli"];
                
                // pasi ruajme vlerat ne sesion... pra useri u autentikua me sukses se jemi ne if true... therrasim funksionin qe ben redirekt :)
                rezultati_login("Login_OK");
            } else {
                rezultati_login("Login_KO");
            }
            
        }
    }


    // rasti kur nje user po ben nje regjistrim te ri
    if (isset($_POST["regjistrim_i_ri"])) { // emri i butonit qe i ben submit
        // var_dump($_POST); // ktu shikojme cfare ka postuar forma
        
        if (isset($_POST["username"], $_POST["email"])) { // me isset mund te verifikosh me shume se nje variabel njekohesisht

        	$emri = trim($_POST["emri"]);
            $mbiemri = trim($_POST["mbiemri"]);
            $email = trim($_POST["email"]);
            
            // ruajme vlerat ne variabla qe do i perdorim ne query
            $username = trim($_POST["username"]); // trim perdoret per ceshtje sigurie dhe i ben pastrim nese ka kod te dyshimte, psh kod sql, se perndryshe kur perdore ate vler qe ka fut ne regjistrim, mund te kete vendosur kod slq te tipit drop database 
            
            
            $password_1 = trim($_POST["password_1"]);
            $password_2 = trim($_POST["password_2"]);
            
            // verifikojme a ekziston nje user i tille ne db pasi te ruajme informacionet
            
            $query = "select * from perdoruesit where username = '.$username.' and email = '.$email.' ";
            $rezultati = mysqli_query($db_connect, $query);
            
            if (mysqli_num_rows($rezultati) > 0) { // nqs rezultati eshte me i madh se 0 dmth ka nje user ne db me ato info
                $pergjigje = "Ky username dhe email ekzistojne dhe nuk mund te perdoren per nje regjistrim te ri!!";
            } else { // nqs rezultati eshte me i vogel se 0 dmth ska user dhe mund te regjistrojme userin e ri
                
                // deklarojme rolin default
                $roli = "new"; // new user me rol new, i papercaktuar
                // enkriptojme passwordin me hash md5
                $enc_password_1 = md5($password_1);
                $enc_password_2 = md5($password_2);

                if ($enc_password_1 == $enc_password_2) {
                	$query_ruaj_info = "
	                    insert into perdoruesit (username, emri, mbiemri, email, password, roli) 
	                    values (
	                        '$username', '$emri', '$mbiemri', '$email', '$enc_password_1', '$roli'
	                    )
	                ";

	                // echo $query_ruaj_info;
	                // exit;

	                // ekzekutojme query per ruajtjen e te dhenave, por njekohesisht verifikojme nese query ekzekutohet me sukses
	                if (mysqli_query($db_connect, $query_ruaj_info)) { // if ben return true nese ska error
	                    // marrim id qe krijohet kur ruajme te dhenat
	                    $new_id = mysqli_insert_id($db_connect);
	                    // krijojme sesionet e userit qe te beje login automatik
	                    $_SESSION["emri"]      = $emri;
	                    $_SESSION["mbiemri"]   = $mbiemri;
	                    $_SESSION["user_id"]   = $new_id;
	                    $_SESSION["email"]     = $email;
	                    $_SESSION["roli"] 	   = $roli;
	                    
	                    $mesazhi = "OK";
	                    // therrasim funksionin qe ben redirekt duke i kaluar parameter rezultatin
	                    rezultati_regjistrim($mesazhi);
	                } else { // mund te perdoresh direkt echo "mesazhin" por eshte me VIP kshtu :)
	                    $mesazhi = "KO";
	                    rezultati_regjistrim($mesazhi);
	                }
                } else {
                	$mesazhi = "KO_passwd";
	                rezultati_regjistrim_ko_passwd($mesazhi);
                }
                
                // debug 
                
                
                
                
            }
            
        }
    }

   
?>