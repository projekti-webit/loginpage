<?php 
    include("header.php");
    include("top_menu.php");
    include("menu.php");

    function gjenero_receta_temeparshme() {
     	require("admin_db/lidhje_db.php");

	     $query = " SELECT * FROM diagnoza where doktid = '".$_SESSION["user_id"]."' ";

	     $tedhena = mysqli_query($db_connect, $query);

	     if ($tedhena) {
	     	while ($row = mysqli_fetch_array($tedhena)) { 
	 	    	echo '
	 	    		
	 		            <tr>
	 		                <td>' .$row['emri_pacientit']. '</td>
	 		                <td>' .$row['mbiemri_pacientit']. '</td>
	 			            <td>' .$row['emertimi']. '</td>
	 			            <td>' .$row['pershkrim_diagnoze']. '</td> 
	 			            <td>' .$row['simptomat']. '</td>
	 			            <td>
							<button type="button" id="'.$row['diagnozeID'].'" title="Fshij" class="btn btn-danger btn-xs btn_fshij_recete" data-toggle="modal" data-target="#modal_fshirecete">
								<i class="fa fa-ban" aria-hidden="true"> </i> 
							</button>
			            </td>
	 		        	</tr>
	 		        
	 	    	';
 	    }
 	     echo '</table>';
	     } else {
	     	echo '
	     		<div class="alert alert-danger">
	 				<center><strong>Nuk u gjet asnje informacion!!</strong></center>
	 			</div>
	 			</table>
	     	';	    
     	}
	 }
	 function gjenero_recetat(){
	 	require("admin_db/lidhje_db.php");

	     $query = " SELECT * FROM diagnoza ";

	     $tedhena = mysqli_query($db_connect, $query);

	     if ($tedhena) {
	     	while ($row = mysqli_fetch_array($tedhena)) { 
	 	    	echo '
	 	    		
	 		            <tr>
	 		                <td>' .$row['emri_pacientit']. '</td>
	 		                <td>' .$row['mbiemri_pacientit']. '</td>
	 			            <td>' .$row['emertimi']. '</td>
	 			            <td>' .$row['pershkrim_diagnoze']. '</td> 
	 			            <td>' .$row['simptomat']. '</td>
	 			            <td>
							<button type="button" id="'.$row['diagnozeID'].'" title="Fshij" class="btn btn-danger btn-xs btn_fshij_recete" data-toggle="modal" data-target="#modal_fshirecete">
								<i class="fa fa-ban" aria-hidden="true"> </i> 
							</button>
			            </td>
	 		        	</tr>
	 		        
	 	    	';
 	    }
 	     echo '</table>';
	     } else {
	     	echo '
	     		<div class="alert alert-danger">
	 				<center><strong>Nuk u gjet asnje informacion!!</strong></center>
	 			</div>
	 			</table>
	     	';	    
     	}

	 }
?>

<!--/. ktu fillon permbajtja e faqes kryesore me titullin e faqes  -->
<div id="page-wrapper" >
	<div class="header"> 
		<h3 class="page-header">
			Jeni ne faqen e recetave
			<span style="float: right;"><button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal_recete">Recete e re</button></span>
		</h3>
	</div>
	<hr style="height: 1px; background-color: #ccc; border: none;" >
	
	<!--/. main content per cdo faqe fillon ketu  -->
	<div id="page-inner">
		<div class="row">
			<div class="col-md-12">
				<!--/. header i tabeles per listen e rezervimeve -->
				<div class="panel-heading">
                    Recetat e dhena
                </div>
                <!--/. header i tabeles per listen e rezervimeve -->

                <!--/. tabela me listen e rezervimeve -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
				            <thead class="thead-dark">
				                <tr>
				                    <th>Emri i pacientit</th>
				                    <th>Mbiemri i pacienti</th>
				                    <th>Diagnoza</th>
				                    <th>Pershkrimi</th>
				                    <th>Simptomat</th>
				                    <th style="width:10%;">Veprime</th>
				                </tr>
				            </thead> 
				            <?php 
				            if ($_SESSION["roli"] =='admin'){gjenero_recetat();}else{gjenero_receta_temeparshme(); }
				            ?>
				        
                    </div>
                </div>
                <!--/. tabela me listen e rezervimeve -->
			</div>
    	</div>



<?php 
include("footer.php");
?>

<div class="modal fade" id="modal_recete" tabindex="-1" role="dialog" aria-labelledby="modal_receteLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
        	<form action="ruaj_recete.php" method="post">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	                <h4 class="modal-title" id="modal_receteLabel">Recete e re</h4>
	            </div>
	            <div class="modal-body">
	            	    <div class="form-group">
							<input type="text" class="form-control" id="emri_pacientit" name="emri_pacientit" placeholder="Emri i pacientit" required="required" autocomplete="off" autofocus />
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="mbiemri_pacientit" name="mbiemri_pacientit" placeholder="Mbiemri i pacientit" required="required" autocomplete="off" autofocus />
						</div>

	            		<div class="form-group">
							<input type="text" class="form-control" id="diagnoza" name="diagnoza" placeholder="Emertimi i diagnozes" required="required" autocomplete="off" autofocus />
						</div>

						<div class="form-group">
							<input type="text" class="form-control" id="pershkrimi" name="pershkrimi" placeholder="pershkrimi" required="required" autocomplete="off" autofocus />
						</div>
	                
						<div class="form-group">
							<input type="text" class="form-control" id="simptomat" name="simptomat" placeholder="simptomat e pacientit" required="required" autocomplete="off" autofocus />
						</div>
						
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-default" data-dismiss="modal">Anullo</button>
	                <button name="btn_ruaj_recete" id="btn_ruaj_recete" class="btn btn-primary">Ruaj recete</button>
	            </div>
	        </form>
        </div>
    </div>
</div>
 

 <div class="modal fade" id="modal_fshirecete" tabindex="-1" role="dialog" aria-labelledby="modal_rezervimLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
        	<form action="ruaj_recete.php" id = "deleteForm" method="post">
        		
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	                <h4 class="modal-title" id="modal_rezervimLabel">Fshi Recete</h4>
	            </div>
        		
	            <div class="modal-body">
	            	<p class="alert alert-error">Jeni te sigurte qe deshironi te fshini kete rekord ?</p>	
	            	
	            	<input type="hidden" class="form-control" id="idDelete" name="id_fshi" />
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-default" data-dismiss="modal">Anullo</button>
	                <button name="btn_ruaj_fshirecete" id="btn_ruaj_fshirecete" class="btn btn-primary" type="submit">Fshi</button>
	               
	                
	                

	            </div>
	        </form>
        </div>
    </div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		
		$(document).on("click", ".btn_fshij_recete", function() {
			var id_fshi = $(this).attr("id");

			document.getElementById("idDelete").value = id_fshi;

		});
   });

		//$(document).on("click", ".btn_fshij_rezervim", function() {
			//var id_del = $(this).attr("id");

			//document.getElementById("idDelete").value = id_del;
			//	}	
			//);	
</script>