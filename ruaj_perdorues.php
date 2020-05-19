<?php 

	session_start();

    if( !isset($_SESSION['user_id'], $_SESSION['emri'], $_SESSION['mbiemri'], $_SESSION['email'], $_SESSION['roli']) ) {
        header('location: login.php');
    } else {

		require("admin_db/lidhje_db.php");
	}


	function rezultati_updateuser($mesazhi) { 
	        if ($mesazhi == "OK") { 
	            echo "
	                <script type='text/javascript'>
	                    alert('Ndryshimet u ruajten me sukses.Faleminderit!');
	                    $('#modal_updateuser').modal('hide');
	                    window.location.href = 'perdoruesit.php';
	                </script>
	            ";
	        } else {
	            echo "
	                <script type='text/javascript'>
	                   alert('Ndryshimet NUK u ruajten me sukses!!!. Riprovoni ne nje moment te dyte ose kontaktoni me administratorin.');
	                   $('#modal_updateuser').modal('hide');
	                   window.location.href = 'perdoruesit.php';
	                </script>
	            ";
	        }
	    }


	    function rezultati_fshiuser($mesazhi){
	   	if ($mesazhi == "OK") { 
	            echo "
	                <script type='text/javascript'>
	                    alert('Perdoruesu u fshi me sukses!');
	                    $('#modal_fshiuser').modal('hide');
	                    window.location.href = 'perdoruesit.php';
	                </script>
	            ";
	        } else {
	            echo "
	                <script type='text/javascript'>
	                   alert('Ndryshimet NUK u ruajten me sukses!!!. Riprovoni ne nje moment te dyte ose kontaktoni me administratorin.');
	                   $('#modal_fshiuser').modal('hide');
	                   window.location.href = 'perdoruesit.php';
	                </script>
	            ";
	        }

	   }


	   if(isset($_POST["btn_ruaj_updateuser"])){

		    
		    if (isset($_POST["emri"], $_POST["mbiemri"], $_POST["email"], $_POST["roli"])) { // me isset mund te verifikosh me shume se nje variabel njekohesisht
		         
		            // ruajme vlerat ne variabla qe do i perdorim ne query

		    		$emri        		= trim($_POST["emri"]);
		    		$mbiemri        	= trim($_POST["mbiemri"]);
		            $email           	= trim($_POST["email"]);
		            $roli               = trim($_POST["roli"]);
		            $a         	        = trim($_POST["id_mod"]);

		            
		         // kujdes shiko id
	                $query_updateuser = "
	                    Update perdoruesit set emri = '$emri', mbiemri = '$mbiemri' , email = '$email' , roli = '$roli' where user_id = '$a'
	                   
	                ";
	                
	                // ekzekutojme query per ruajtjen e te dhenave, por njekohesisht verifikojme nese query ekzekutohet me sukses
	                if (mysqli_query($db_connect, $query_updateuser)) { // if ben return true nese ska error
	                    
	                    
	                    $mesazhi = "OK";
	                    rezultati_updateuser($mesazhi);
	                }else{
	                    $mesazhi = "NOT";
	                    rezultati_updateuser($mesazhi);
	                }
		                    
		     }
		}

		if(isset($_POST["btn_ruaj_fshiuser"])){

			       $b = $_POST["id_del"];

		    
	               $query_fshirezervim = "
	                   delete from perdoruesit where user_id = '$b'
	                   
	               ";


	               // ekzekutojme query per ruajtjen e te dhenave, por njekohesisht verifikojme nese query ekzekutohet me sukses
	               if (mysqli_query($db_connect, $query_fshirezervim)) { // if ben return true nese ska error
	                    
	                    
	                   $mesazhi = "OK";
	                   rezultati_fshiuser($mesazhi);
	               }else{
	                   $mesazhi = "NOT";
	                   rezultati_fshiuser($mesazhi);
	               }
		                    
		    }
		
		
?>
