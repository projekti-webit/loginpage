<?php 

	session_start();

    if( !isset($_SESSION['user_id'], $_SESSION['emri'], $_SESSION['mbiemri'], $_SESSION['email'], $_SESSION['roli']) ) {
        header('location: login.php');
    } else {

		require("admin_db/lidhje_db.php");
	}

	//if( ( isset($_POST["detyra_edit"]) ) && ( $_POST["detyra_edit"] == "modifiko_rezervim" ) ) {


			
			//if (isset($_POST["id_mod"])){
			//	$a = $_POST["id_mod"];
				//echo $a;
			//}
		//}

		// if( ( isset($_POST["detyra_del"]) ) && ( $_POST["detyra_del"] == "fshij_rezervim" ) ) {
			
		// 	if (isset($_POST["id_del"])){
		// 		$b = $_POST["id_del"];
		// 		if(isset($_POST["btn_ruaj_fshirezervim"])){
		// 		 $query_fshirezervim = "
	 //                    delete from rezervim where id_reservim = '$b'
	                   
	 //                ";
	                
	 //                // ekzekutojme query per ruajtjen e te dhenave, por njekohesisht verifikojme nese query ekzekutohet me sukses
	 //                if (mysqli_query($db_connect, $query_fshirezervim)) { // if ben return true nese ska error
	                    
	                    
	 //                    $mesazhi = "OK";
	 //                    rezultati_fshirezervim($mesazhi);
	 //                }else{
	 //                    $mesazhi = "NOT";
	 //                    rezultati_fshirezervim($mesazhi);
	 //                }
		                    
		//      }
		// 	}
		// }
		

		// funksion per cfare ndodh kur useri ben nje rezervim
	    function rezultati_rezervim($mesazhi) { 
	        if ($mesazhi == "OK") { 
	            echo "
	                <script type='text/javascript'>
	                    alert('Rezervimi u krye me sukses. Ju do te njoftoheni me tej ne emailin tuaj. Faleminderit!');
	                    $('#modal_rezervim').modal('hide');
	                    window.location.href = 'rezervimet_pacient.php';
	                </script>
	            ";
	        } else {
	            echo "
	                <script type='text/javascript'>
	                   alert('Rezervimi NUK krye me sukses!!!. Riprovoni ne nje moment te dyte ose kontaktoni me administratorin.');
	                   $('#modal_rezervim').modal('hide');
	                   window.location.href = 'rezervimet_pacient.php';
	                </script>
	            ";
	        }
	    }

	    function rezultati_updaterezervim($mesazhi) { 
	        if ($mesazhi == "OK") { 
	            echo "
	                <script type='text/javascript'>
	                    alert('Ndryshimet u ruajten me sukses.Faleminderit!');
	                    $('#modal_updaterezervim').modal('hide');
	                    window.location.href = 'rezervimet_pacient.php';
	                </script>
	            ";
	        } else {
	            echo "
	                <script type='text/javascript'>
	                   alert('Ndryshimet NUK u ruajten me sukses!!!. Riprovoni ne nje moment te dyte ose kontaktoni me administratorin.');
	                   $('#modal_updaterezervim').modal('hide');
	                   window.location.href = 'rezervimet_pacient.php';
	                </script>
	            ";
	        }
	    }


	   function rezultati_fshirezervim($mesazhi){
	   	if ($mesazhi == "OK") { 
	            echo "
	                <script type='text/javascript'>
	                    alert('Rezervimi u fshi me sukses!');
	                    $('#modal_fshirezervim').modal('hide');
	                    window.location.href = 'rezervimet_pacient.php';
	                </script>
	            ";
	        } else {
	            echo "
	                <script type='text/javascript'>
	                   alert('Ndryshimet NUK u ruajten me sukses!!!. Riprovoni ne nje moment te dyte ose kontaktoni me administratorin.');
	                   $('#modal_fshirezervim').modal('hide');
	                   window.location.href = 'rezervimet_pacient.php';
	                </script>
	            ";
	        }

	   }
	    
		if(isset($_POST["btn_ruaj_rezervim"])){
		    
		    //var_dump($_POST);
		    
		    if (isset($_POST["adresa_email"], $_POST["dataora"], $_POST["doktoret"])) { // me isset mund te verifikosh me shume se nje variabel njekohesisht
		         
		            // ruajme vlerat ne variabla qe do i perdorim ne query

		    		$emri        		= trim($_POST["emri_p"]);
		    		$mbiemri        	= trim($_POST["mbiemri_p"]);
		            
		            $dataora        	= trim($_POST["dataora"]);
		            $email           	= trim($_POST["adresa_email"]);
		            $id_pacient         = $_SESSION['user_id'];
		            $id_doktor         	= trim($_POST["doktoret"]);
		        //    $id_rez             = $GET['']
		         
	                $query_rezervim = "
	                    insert into rezervim ( emri_p, mbiemri_p, dataora, email_pacienti, id_pacienti, id_doktori) 
	                    values (
	                        '$emri', '$mbiemri', '$dataora', '$email', '$id_pacient', '$id_doktor'
	                    )
	                ";
	                
	                // ekzekutojme query per ruajtjen e te dhenave, por njekohesisht verifikojme nese query ekzekutohet me sukses
	                if (mysqli_query($db_connect, $query_rezervim)) { // if ben return true nese ska error
	                    
	                    
	                    $mesazhi = "OK";
	                    rezultati_rezervim($mesazhi);
	                }else{
	                    $mesazhi = "NOT";
	                    rezultati_rezervim($mesazhi);
	                }
		                    
		     }
		}
		
		if(isset($_POST["btn_ruaj_updaterezervim"])){

		    
		    if (isset($_POST["adresa_email"], $_POST["mod_dataora"], $_POST["doktoret"])) { // me isset mund te verifikosh me shume se nje variabel njekohesisht
		         
		            // ruajme vlerat ne variabla qe do i perdorim ne query

		    		$emri        		= trim($_POST["emri_p"]);
		    		$mbiemri        	= trim($_POST["mbiemri_p"]);
		            
		            $dataora        	= trim($_POST["mod_dataora"]);
		            $email           	= trim($_POST["adresa_email"]);
		            $id_pacient         = $_SESSION['user_id'];
		            $id_doktor         	= trim($_POST["doktoret"]);
		            $a         	        = trim($_POST["id_mod"]);

		            
		         // kujdes shiko id
	                $query_updaterezervim = "
	                    Update rezervim set emri_p = '$emri', mbiemri_p = '$mbiemri' , dataora = '$dataora' , email_pacienti = '$email', id_pacienti = '$id_pacient', id_doktori = '$id_doktor' where id_reservim = '$a'
	                   
	                ";
	                
	                // ekzekutojme query per ruajtjen e te dhenave, por njekohesisht verifikojme nese query ekzekutohet me sukses
	                if (mysqli_query($db_connect, $query_updaterezervim)) { // if ben return true nese ska error
	                    
	                    
	                    $mesazhi = "OK";
	                    rezultati_updaterezervim($mesazhi);
	                }else{
	                    $mesazhi = "NOT";
	                    rezultati_updaterezervim($mesazhi);
	                }
		                    
		     }
		}

		if(isset($_POST["btn_ruaj_fshirezervim"])){

			       $b = $_POST["id_del"];

		    
	               $query_fshirezervim = "
	                   delete from rezervim where id_reservim = '$b'
	                   
	               ";


	               // ekzekutojme query per ruajtjen e te dhenave, por njekohesisht verifikojme nese query ekzekutohet me sukses
	               if (mysqli_query($db_connect, $query_fshirezervim)) { // if ben return true nese ska error
	                    
	                    
	                   $mesazhi = "OK";
	                   rezultati_fshirezervim($mesazhi);
	               }else{
	                   $mesazhi = "NOT";
	                   rezultati_fshirezervim($mesazhi);
	               }
		                    
		    }
		
		
?>

