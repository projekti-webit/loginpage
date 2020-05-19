<?php
session_start();
if( !isset($_SESSION['user_id'], $_SESSION['emri'], $_SESSION['mbiemri'], $_SESSION['email'], $_SESSION['roli']) ) {
        header('location: login.php');
    } else {

		require("admin_db/lidhje_db.php");
	}


function rezultati_recete($mesazhi){
	if ($mesazhi == "OK") { // meqe do perdorim javascript na duhet libreria jquery qe e kemi tek file struktura2.php
	            echo "
	                <script type='text/javascript'>
	                    alert('Receta u ruajt me sukses. Faleminderit!');
	                    $('#modal_recete').modal('hide');
	                    window.location.href = 'recetat.php';
	                </script>
	            ";
	        } else {
	            echo "
	                <script type='text/javascript'>
	                   alert('Receta NUK u ruajt me sukses!!!. Riprovoni ne nje moment te dyte ose kontaktoni me administratorin.');
	                   $('#modal_recete').modal('hide');
	                   window.location.href = 'recetatt.php';
	                </script>
	            ";
	        }



}


function rezultati_fshirecete($mesazhi){
	if ($mesazhi == "OK") { // meqe do perdorim javascript na duhet libreria jquery qe e kemi tek file struktura2.php
	            echo "
	                <script type='text/javascript'>
	                    alert('Receta u fshi me sukses. Faleminderit!');
	                    $('#modal_fshirecete').modal('hide');
	                    window.location.href = 'recetat.php';
	                </script>
	            ";
	        } else {
	            echo "
	                <script type='text/javascript'>
	                   alert('Receta NUK u fshi me sukses!!!. Riprovoni ne nje moment te dyte ose kontaktoni me administratorin.');
	                   $('#modal_fshirecete').modal('hide');
	                   window.location.href = 'recetatt.php';
	                </script>
	            ";
	        }

}

if(isset($_POST["btn_ruaj_recete"])){
		    
		    //var_dump($_POST);
		    
		    if (isset($_POST["diagnoza"], $_POST["pershkrimi"], $_POST["simptomat"])) { // me isset mund te verifikosh me shume se nje variabel njekohesisht
		         
		            // ruajme vlerat ne variabla qe do i perdorim ne query
                    $emri_pacientit     = trim($_POST["emri_pacientit"]);
                    $mbiemri_pacientit  = trim($_POST["mbiemri_pacientit"]);
		    		$diagnoza        	= trim($_POST["diagnoza"]);
		    		$pershkrimi        	= trim($_POST["pershkrimi"]);
		            $simptomat        	= trim($_POST["simptomat"]); 
		            $id_doktor         	= $_SESSION['user_id'];
		       
		         
	                $query_recete = "
	                    insert into diagnoza ( emri_pacientit, mbiemri_pacientit, emertimi, pershkrim_diagnoze, simptomat, doktid) 
	                    values (
	                            '$emri_pacientit', '$mbiemri_pacientit', '$diagnoza', '$pershkrimi', '$simptomat', '$id_doktor'
	                    )
	                ";
	                
	                // ekzekutojme query per ruajtjen e te dhenave, por njekohesisht verifikojme nese query ekzekutohet me sukses
	                if (mysqli_query($db_connect, $query_recete)) { // if ben return true nese ska error
	                    
	                    
	                    $mesazhi = "OK";
	                    rezultati_recete($mesazhi);
	                }else{
	                    $mesazhi = "NOT";
	                    rezultati_recete($mesazhi);
	                }
		                    
		     }
		}

		if(isset($_POST["btn_ruaj_fshirecete"])){
		    
		    //var_dump($_POST);
		    
		    
		            
		             $a  = $_POST["id_fshi"];
		         
	                $query_fshirecete = "
	                   delete from diagnoza where diagnozeID =  '$a'
	                    
	                ";
	               // $qtest = " 
            //delete from diagnoza where diagnozeID =  '$a' 
         //";
          //echo $qtest;
        // exit();
	                
	                // ekzekutojme query per ruajtjen e te dhenave, por njekohesisht verifikojme nese query ekzekutohet me sukses
	                if (mysqli_query($db_connect, $query_fshirecete)) { // if ben return true nese ska error
	                    
	                    
	                    $mesazhi = "OK";
	                    rezultati_fshirecete($mesazhi);
	                }else{
	                    $mesazhi = "NOT";
	                    rezultati_fshirecete($mesazhi);
	                }
		                    
		     }
		
?>